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
            $grandTotal = 0;
        }

        DB::beginTransaction();
        try {

        $order = new Order();
        $order->user_id = auth()->user()->id;
        $order->delivery_address_id = $request->delivery_address;
        $order->shipping_charge = 0;
        $order->coupon_code = $couponCode;
        $order->coupon_discount = $couponAmount;
        $order->order_status = 'new';
        $order->payment_method = $payment_method;
        $order->payment_status = 'pending';
        $order->payment_gateway = $request->payment_gateway;
        $order->grand_total = $grandTotal;
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

        DB::commit();
        return response()->json([
            'message' => __('Successfully Order Placed'),
            'redirect' => url()->previous()
         ]);
         } catch (\Exception $e) {
            DB::rollback();
            return response()->json(__('Something Went Wrong'), 401);
        }






    }
}
