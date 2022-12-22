<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExchangeOrder;
use App\Models\OrderProduct;
use Illuminate\Http\Request;

class ExchangeOrderController extends Controller
{
    public function index(){
          $orders = ExchangeOrder::with(['product' => fn($query) =>
        $query->select(['id','product_name','slug','product_image','product_price']),
            'user'   => fn($query) => $query->select(['id','name'])])
            ->paginate(10);
        return view('admin.orders.exchange-order',compact('orders'));
    }

    public function updateStatus(Request $request,$id){
        //order product status
        OrderProduct::where('order_id',$request->input('order_id'))
            ->where('product_id',$request->input('product_id'))
            ->update([
                'item_status' => 'exchange '. $request->input('exchange_status')
            ]);

        ExchangeOrder::where('id',$id)->update([
            'exchange_status' => $request->input('exchange_status')
        ]);

        return response()->json( [
            'message' =>  'Order Exchange Status Updated Successfully',
            'redirect' => route('admin.orders.exchange')
        ] );



    }
}
