<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with('users')
            ->when($request->get('order_status') !== null, function (Builder $query) use ($request) {
                $query->where('order_status', '=', $request->get('order_status'));
            })
            ->when($request->get('payment_status') !== null, function (Builder $query) use ($request) {
                $query->where('payment_status', '=', $request->get('payment_status'));
            })
            ->when($request->get('src') !== null, function (Builder $query) use ($request) {
                $query->where('id', 'LIKE', '%' . $request->get('src') . '%');

                $query->orWhereHas('users', function (Builder $query) use ($request) {
                    $query->where('name', 'LIKE', '%' . $request->get('src') . '%');
                });
            })
            ->when($request->get('start') !== null, function (Builder $query) use ($request) {
                $query->whereDate('created_at', '>=', $request->get('start'));
            })
            ->when($request->get('end') !== null, function (Builder $query) use ($request) {
                $query->whereDate('created_at', '<=', $request->get('end'));
            })
            ->latest()
            ->paginate(10);


        $all = Order::get();
        $pending = Order::whereOrderStatus(0)->get();
        $processing = Order::whereOrderStatus(1)->get();
        $shipping = Order::whereOrderStatus(2)->get();
        $complete = Order::whereOrderStatus(3)->get();
        $cancel = Order::whereOrderStatus(4)->get();

        return view('admin.orders.index', compact('orders','all','complete','shipping','processing','pending','cancel'));
    }

    public function edit($id){
        $order = Order::with('users')->findOrFail($id);
        return view('admin.orders.edit',compact('order'));
    }

    public function show($id){
         $order = Order::with(['users','orderProducts','deliveryAddress','orderProducts.product.owner' => function($query){
           $query->select(['id','name']);
       },'orderProducts.product' => function($query){
           $query->select(['id','product_name','vendor_id','product_color','product_code','slug']);
       }])

           ->findOrFail($id);

        return view('admin.orders.show',compact('order'));
    }

    public function paymentStatusUpdate(Request $request,$id){
        $order = Order::find($id);
        $order->payment_status = $request->payment_status;
        $order->order_status = $request->order_status;
        $order->save();
        return response()->json( [ 'message' =>  'Status Update Successfully'] );

    }

    public function massDestroy(Request $request)
    {

        if($request->deleteAction == 'delete') {
            if (isset($request->ids)) {
                foreach ($request->ids as $id) {
                    $category = Order::findOrFail($id);
                    $category->delete();
                }
                return response()->json([
                    'message' =>  __('Order Deleted Successfully'),
                    'redirect' => route('admin.orders.index')
                ]);
            }else{
                return  response()->json(   __('Please Select Checkbox'),422 );
            }
        }else{
            return  response()->json(   __('Please Select Action'),422 );
        }

    }



}
