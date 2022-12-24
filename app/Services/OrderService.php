<?php

namespace App\Services;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class OrderService
{
     public function  orderProcess($deliveryAddress = null,$paymentGateway = null,$payment_method = null,$shippingCharge = null){

         $deliveryAddress = $deliveryAddress != null ? $deliveryAddress : Session::get('delivery_address');
         $paymentGateway = $paymentGateway ? $payment_method : Session::get('payment_gateway');
         $payment_method = $payment_method ? $payment_method : Session::get('payment_method');
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

         $order = new Order();
         $order->order_id = Str::random(8).auth()->id().random_int(1,100);
         $order->user_id = auth()->user()->id;
         $order->delivery_address_id = $deliveryAddress;
         $order->shipping_charge = $shippingCharge ?? 0;
         $order->coupon_code = $couponCode;
         $order->coupon_discount = $couponAmount;
         $order->order_status = 0;
         $order->payment_method = $payment_method;
         $order->payment_status = 2;
         $order->payment_gateway = $paymentGateway;
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

             //update stock
             Product::updateProductStock($item->product_id,$item->size,$item->quantity);

         }
     }
}
