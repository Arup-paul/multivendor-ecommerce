<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(){
        $orders = Order::with('orderProducts','orderProducts.product')
            ->where('user_id',auth()->user()->id)->orderByDesc('id')->get();
        return view('frontend.user.orders.index',compact('orders'));
    }

    public function orderDetails($id){
        $order = Order::with('deliveryAddress','orderProducts','orderProducts.product')
            ->where('user_id',auth()->user()->id)->where('id',$id)->first();

        return view('frontend.user.orders.details',compact('order'));
    }
}
