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
}
