<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\User;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::paginate(20);
        return view('admin.coupons.index',compact('coupons'));
    }

    public function create()
    {
        $categories = Category::with('subcategories')->select(['id','category_name'])->where('parent_id',null)->where('status',1)->get();
        $users = User::select(['id','email'])->whereStatus(1)->get();

        return view('admin.coupons.create',compact('categories','users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'coupon_option' => 'required',
            'coupon_type' => 'required',
            'amount_type' => 'required',
            'amount' => 'required|numeric',
        ]);

        $coupon = new Coupon();
        $coupon->coupon_option = $request->input('coupon_option');
        $coupon->coupon_code = $request->input('coupon_code');
        $coupon->coupon_type = $request->input('coupon_type');
        $coupon->amount_type = $request->input('amount_type');
        $coupon->amount = $request->input('amount');
        $coupon->start_date = date('Y-m-d',strtotime($request->input('start_date')));
        $coupon->end_date =  date('Y-m-d',strtotime($request->input('end_date')));
        $coupon->status = $request->input('status');

        //categories
        $categories = $request->input('categories');
        $categoryId = implode(',',$categories);
        $coupon->categories = $categoryId;

        //users
        $users = $request->input('users');
        $usersId = implode(',',$categories);
        $coupon->users = $usersId;

        $coupon->save();

        return response()->json( [
            'message' =>  'Coupon created successfully',
            'redirect' =>  url()->previous()
        ] );
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.brands.edit',compact('brand'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $section = Brand::findOrFail($id);
        $section->name = $request->name;
        $section->status = $request->status;
        $section->save();

        return response()->json( [ 'message' =>  'Brand updated successfully'] );
    }

    public function massDestroy(Request $request)
    {

        if($request->deleteAction == 'delete') {
            if (isset($request->ids)) {
                foreach ($request->ids as $id) {
                    $brand = Brand::findOrFail($id);
                    $brand->delete();
                }
                return response()->json([
                    'message' =>  __('Brand Deleted Successfully'),
                    'redirect' => route('admin.sections.index')
                ]);
            }else{
                return  response()->json(   __('Please Select Checkbox'),422 );
            }
        }else{
            return  response()->json(   __('Please Select Action'),422 );
        }




    }
}
