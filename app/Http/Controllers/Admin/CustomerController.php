<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $users = User:: when($request->get('src') !== null, function (Builder $query) use ($request) {
            $query->where('mobile', 'LIKE', '%' . $request->get('src') . '%');
            $query->orWhere('email', 'LIKE', '%' . $request->get('src') . '%');
        })->orderByDesc('id')->paginate(20);
        $active_users = User::where('status',1)->count();
        $deactive_users = User::where('status',0)->count();
        return view('admin.customers.index',compact('users','active_users','deactive_users'));
    }

    public function massDestroy(Request $request)
    {

        if($request->deleteAction == 'delete') {
            if (isset($request->ids)) {
                foreach ($request->ids as $id) {
                    $category = User::findOrFail($id);
                    $category->delete();
                }
                return response()->json([
                    'message' =>  __('Customer Deleted Successfully'),
                    'redirect' => route('admin.orders.index')
                ]);
            }else{
                return  response()->json(   __('Please Select Checkbox'),422 );
            }
        }else{
            return  response()->json(   __('Please Select Action'),422 );
        }

    }

    public function edit($id){
        $customer = User::findOrfail($id);

        return view('admin.customers.edit',compact('customer'));
    }

    public function update(Request $request,$id){
        $customer = User::findOrfail($id);
        $customer->status = $request->status;
        $customer->save();
        return response()->json( [ 'message' =>  'Customer Status Update Successfully'] );
    }
}
