<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderLog;
use Illuminate\Http\Request;

class OrderTrackController extends Controller
{
    public function index(){
       return view('frontend.user.orders.ordertrack');
    }

    public function orderTrack(Request $request){
        $trackId = $request->input('track_id');

        $orderId = Order::where('order_id',$trackId)->select('id')->first();

        if($orderId){
            $orderTrack = OrderLog::where('order_id',$orderId->id)->orderByDesc('id')->get();
        }else{
            $orderTrack = [];
        }



       return view('frontend.user.orders.ordertrack',compact('orderTrack'));

    }

}
