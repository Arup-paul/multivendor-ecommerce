<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Payment\PaypalController;
use App\Models\Cart;
use App\Models\DeliveryAddress;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ShippingCharge;
use App\Services\OrderService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Omnipay\Omnipay;

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
                $message = $item->product->product_name.'('.$item->product->product_code.')'.' is not available. Please remove from cart';
                Session::flash('error', $message);
                return redirect()->route('cart');
            }
            //product stock
            $productStock = Product::getProductStock($item->product_id, $item->size);
            if($productStock < $item->quantity){
                $message = $item->product->product_name.'('.$item->product->product_code.')'.' stock not available. Available stock is '.$productStock;
                Session::flash('error', $message);
                return redirect()->route('cart');
            }

            //get attribute
            $attribute = Product::getProductAttribute($item->product_id, $item->size);
            if(!$attribute){
                $message = $item->product->product_name.'('.$item->product->product_code.')'.' is not available. Please remove from cart';
                Session::flash('error', $message);
                return redirect()->route('cart');
            }

            $categoryStatus = Product::getCategoryStatus($item->product->category_id);
            if($categoryStatus == 0){
                $message = $item->product->product_name.'('.$item->product->product_code.')'.' is not available. Please remove from cart';
                Session::flash('error', $message);
                return redirect()->route('cart');
            }
        }

        //process Order
            if($request->payment_gateway == 'COD'){
              $orderProcess = new OrderService();
              $deliverAddress = $request->input('delivery_address');
              $payment_gateway = $request->input('payment_gateway');
              $order = $orderProcess->orderProcess($deliverAddress,$payment_gateway,$payment_method,$shippingCharge);

                $session_id = Session::get('session_id');
                Cart::where('user_id',auth()->user()->id)->orWhere('session_id',$session_id)->delete();
                Session::forget('couponAmount');
                Session::forget('couponCode');
                Session::forget('grandTotal');
                Session::forget('total');
                Session::forget('total_weight');
            }else if($request->payment_gateway == 'Paypal'){
                  $amount = $shippingCharge ? $grandTotal + $shippingCharge : $grandTotal;
                  Session::put('delivery_address',$request->input('delivery_address'));
                  Session::put('payment_gateway',$request->input('payment_gateway'));
                  Session::put('shipping_charge',$shippingCharge);
                  Session::put('total_amount',$grandTotal);
                  Session::put('payment_method',$payment_method);
                  $paypalController = new PaypalController();
                  $paypalController->makePayment($amount);

            }


        DB::commit();

            Session::flash('success', 'Order placed successfully');
            return redirect()->route('order.success',$order->order_id);

         } catch (\Exception $e) {
            DB::rollback();
            Session::flash('error', 'Something went wrong');
            return redirect()->route('cart');
        }

    }

    public function orderSuccess($orderId){
        $order = Order::where('order_id',$orderId)->first();
        return view('frontend.checkout.success',compact('order'));
    }

}
