<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderLog;
use App\Models\OrderProduct;
use App\Models\ReturnOrder;
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

         abort_if(auth()->id() !== $order->user_id,404);

        return view('frontend.user.orders.details',compact('order'));
    }

    public function orderCancel($id){
          $order = Order::with('orderProducts.product')->where('id',$id)->first();
          abort_if(auth()->id() !== $order->user_id,404);
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

    public function orderReturn($id){
        $order = Order::with('orderProducts.product')->where('id',$id)->first();
        abort_if(auth()->id() !== $order->user_id,404);

        return view('frontend.user.orders.orderreturn',compact('order','id'));
    }

    public function orderReturnProcess($id,Request $request){
          $request->validate([
              'product_info' => 'required',
              'reason' => 'required',
              'comment' => 'max:255'
          ]);

          $productArr = explode('-',$request->input('product_info'));
          $product_size = $productArr[0];
          $productId= $productArr[1];

          OrderProduct::where('order_id',$id)
              ->where('product_id',$productId)
              ->where('size',$product_size)->update([
                  'item_status' => 'return initiated'
              ]);

          $returnOrder = new ReturnOrder();
          $returnOrder->order_id = $id;
          $returnOrder->user_id = auth()->id();
          $returnOrder->product_id = $productId;
          $returnOrder->product_size = $product_size;
          $returnOrder->reason = $request->input('reason');
          $returnOrder->comment = $request->input('comment');
          $returnOrder->save();

        return response()->json( [
            'message' =>  'Order Return Process Apply Successfully',
            'redirect' => route('user.orders.index')
        ] );



    }
}
