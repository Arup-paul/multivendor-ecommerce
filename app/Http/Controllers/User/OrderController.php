<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderLog;
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

    public function orderCancel($id){
          $order = Order::with('orderProducts.product')->where('id',$id)->first();
         return view('frontend.user.orders.ordercancel',compact('order','id'));
    }

    public function orderCancelProcess(Request $request,$id){
        $request->validate([
            'reason' => 'required'
        ]);


        $order = Order::find($id);
        $order->order_status = 4;
        $order->save();

        $orderLog = new OrderLog();
        $orderLog->order_id = $order->id;
        $orderLog->status = 4;
        $orderLog->reason = $request->input('reason');
        $orderLog->additional_reason = $request->input('additional_reason');
        $orderLog->save();

        return response()->json( [
            'message' =>  'Order Cancel Successfully',
            'redirect' => route('user.orders.index')
        ] );
    }
}
