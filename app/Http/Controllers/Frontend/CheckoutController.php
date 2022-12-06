<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\DeliveryAddress;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function checkout()
    {
        if(!auth()->check()){
            return redirect()->route('login');
        }
         $cartItems = Cart::getCartItems();

        if($cartItems->count() == 0) {
            return redirect()->route('cart');
        }


         $deliveryAddress = DeliveryAddress::getDeliveryAddress();

        foreach ($deliveryAddress as $key => $value) {
            $deliveryAddress[$key]['shipping_charge'] = DB::table('shipping_charges')->where('country',$value->country)->pluck('shipping_charge')->first();
         }

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
        $shippingCharge = DB::table('shipping_charges')->where('country',$deliveryAddress->country)->pluck('shipping_charge')->first();


        DB::beginTransaction();
        try {

        $order = new Order();
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

        $cartItems = Cart::getCartItems();

         foreach ($cartItems as $item) {
             $cartItem = new OrderProduct();
             $cartItem->order_id = $order->id;
             $cartItem->product_id = $item->product_id;
             $cartItem->size = $item->size;
             $cartItem->qty = $item->quantity;
             $getDiscountedPrice = Product::getDisCountAttributePrice($item->product_id,$item->size);
             $cartItem->total = $getDiscountedPrice['total_price'];
             $cartItem->save();
         }

         //delete cart items

         $session_id = Session::get('session_id');
         Cart::where('user_id',auth()->user()->id)->orWhere('session_id',$session_id)->delete();

            Session::forget('couponAmount');
            Session::forget('couponCode');
            Session::forget('grandTotal');

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
