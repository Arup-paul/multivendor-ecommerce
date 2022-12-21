<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderProduct;
use App\Models\ReturnOrder;
use Illuminate\Http\Request;

class ReturnOrderController extends Controller
{
     public function index(){
            $returnOrders = ReturnOrder::with(['product' => fn($query) =>
          $query->select(['id','product_name','slug','product_image','product_price']),
              'user'   => fn($query) => $query->select(['id','name'])])
              ->paginate(10);
         return view('admin.orders.return-order',compact('returnOrders'));
     }

     public function updateStatus(Request $request,$id){
          //order product status
         OrderProduct::where('order_id',$request->input('order_id'))
                      ->where('product_id',$request->input('product_id'))
                      ->update([
                          'item_status' => 'Return '. $request->input('return_status')
                      ]);

         ReturnOrder::where('id',$id)->update([
             'return_status' => $request->input('return_status')
         ]);

         return response()->json( [
             'message' =>  'Order Return Status Updated Successfully',
             'redirect' => route('admin.orders.return')
         ] );



     }

}
