<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\DeliveryAddress;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout()
    {
        if(!auth()->check()){
            return redirect()->route('login');
        }
        $cartItems = Cart::getCartItems();
         $deliveryAddress = DeliveryAddress::getDeliveryAddress();
        return view('frontend.checkout.index',compact('cartItems','deliveryAddress'));
    }
}
