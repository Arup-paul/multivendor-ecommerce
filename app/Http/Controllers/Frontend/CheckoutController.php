<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\DeliveryAddress;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ShippingCharge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function checkout()
    {
        if(empty(Session::get('session_id'))){
            $session_id = Hash::make(time());
            Session::put('session_id',$session_id);
         }else{
            $session_id = Session::get('session_id');
        }
        if(!auth()->check()){
            return redirect()->route('login');
        }
         $cartItems = Cart::getCartItems();

        if($cartItems->count() == 0) {
            return redirect()->route('cart');
        }

        //total product weight
        $total_weight = 0;
        foreach($cartItems as $item){
            $total_weight += $item->product->product_weight * $item->quantity;
        }

         $deliveryAddress = DeliveryAddress::getDeliveryAddress();

        foreach ($deliveryAddress as $key => $value) {
            $deliveryAddress[$key]['shipping_charge'] = DeliveryAddress::getShippingCharge($total_weight, $value->country);
         }
         Session::put('total_weight', $total_weight);


        return view('frontend.checkout.index',compact('cartItems','deliveryAddress'));
    }

    public function processCheckout(Request $request){
         $request->validate([
            'delivery_address' => 'required',
            'payment_gateway' => 'required',
         ]);

         if($request->payment_gateway == 'COD'){
             $payment_method = 'COD';
         }else{
                $payment_method = 'Prepaid';
         }
         if(Session::has('couponAmount')){
             $couponAmount = Session::get('couponAmount');
          }else{
                $couponAmount = 0;
          }
        if(Session::has('couponCode')){
            $couponCode = Session::get('couponCode');
        }else{
            $couponCode = null;
        }



        if(Session::has('grandTotal')){
            $grandTotal = Session::get('grandTotal');
        }else{
            if(Session::has('total')) {
                $grandTotal = Session::get('total');
            }else{
                $grandTotal = 0;
            }
        }

        $deliveryAddress = DeliveryAddress::where('id',$request->delivery_address)->first();
        $shippingCharge =  DeliveryAddress::getShippingCharge(Session::get('total_weight') ?? 0, $deliveryAddress->country);


        DB::beginTransaction();
        try {
        $cartItems = Cart::getCartItems();

        //prevent disable product checkout
        foreach($cartItems as $item){

            if($item->product->status == 0){
                return response()->json([
                    'message' => __($item->product->product_name.'('.$item->product->product_code.')'.' is not available. Please remove from cart'),
                    'redirect' => route('cart')
                ], 422);
            }
            //product stock
            $productStock = Product::getProductStock($item->product_id, $item->size);
            if($productStock < $item->quantity){
                return response()->json([
                    'message' => __($item->product->product_name.'('.$item->product->product_code.')'.' stock not available. Available stock is '.$productStock),
                    'redirect' => route('cart')
                ], 422);
            }

            //get attribute
            $attribute = Product::getProductAttribute($item->product_id, $item->size);
            if(!$attribute){
                return response()->json([
                    'message' => __($item->product->product_name.'('.$item->product->product_code.')'.' is not available. Please remove from cart'),
                    'redirect' => route('cart')
                ], 422);
            }

            $categoryStatus = Product::getCategoryStatus($item->product->category_id);
            if($categoryStatus == 0){
                return response()->json([
                    'message' => __($item->product->product_name.'('.$item->product->product_code.')'.' is not available. Please remove from cart'),
                    'redirect' => route('cart')
                ], 422);
            }
        }

        $order = new Order();
        $order->order_id = Str::random(8).auth()->id().random_int(1,100);
        $order->user_id = auth()->user()->id;
        $order->delivery_address_id = $request->delivery_address;
        $order->shipping_charge = $shippingCharge ?? 0;
        $order->coupon_code = $couponCode;
        $order->coupon_discount = $couponAmount;
        $order->order_status = 0;
        $order->payment_method = $payment_method;
        $order->payment_status = 2;
        $order->payment_gateway = $request->payment_gateway;
        $order->grand_total = $shippingCharge ? $grandTotal + $shippingCharge : $grandTotal;
        $order->save();



         foreach ($cartItems as $item) {
             $cartItem = new OrderProduct();
             $cartItem->order_id = $order->id;
             $cartItem->product_id = $item->product_id;
             $cartItem->size = $item->size;
             $cartItem->qty = $item->quantity;
             $getDiscountedPrice = Product::getDisCountAttributePrice($item->product_id,$item->size);
             $cartItem->total = $getDiscountedPrice['total_price'];
             $cartItem->save();

             //update stock
             Product::updateProductStock($item->product_id,$item->size,$item->quantity);

         }

         //delete cart items
         $session_id = Session::get('session_id');
         Cart::where('user_id',auth()->user()->id)->orWhere('session_id',$session_id)->delete();

            Session::forget('couponAmount');
            Session::forget('couponCode');
            Session::forget('grandTotal');
            Session::forget('total_weight');

        DB::commit();
        return response()->json([
            'message' => __('Thank You, Your Order Successfully Placed'),
            'redirect' => route('cart')
         ]);
         } catch (\Exception $e) {
            DB::rollback();
            return response()->json(__('Something Went Wrong'), 401);
        }






    }
}
