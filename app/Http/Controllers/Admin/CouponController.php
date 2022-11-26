<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CouponRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\User;
use App\Services\CouponService;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::orderByDesc('id')->paginate(20);
        return view('admin.coupons.index',compact('coupons'));
    }

    public function create()
    {
        $categories = Category::with('subcategories')->select(['id','category_name'])->where('parent_id',null)->where('status',1)->get();
        $users = User::select(['id','email'])->whereStatus(1)->get();

        return view('admin.coupons.create',compact('categories','users'));
    }

    public function store(CouponRequest $request)
    {
        $coupon = new Coupon();
        $couponService = new CouponService();
        $couponService->couponCreateUpdate($request,$coupon);
        $coupon->save();

        return response()->json( [
            'message' =>  'Coupon created successfully',
            'redirect' =>  url()->previous()
        ] );
    }

    public function edit($id)
    {
         $coupon = Coupon::findOrFail($id);
         $categoryIds = explode(',',$coupon->categories);
         $userIds = explode(',',$coupon->users);

        $categories = Category::with('subcategories')->select(['id','category_name'])->where('parent_id',null)->where('status',1)->get();
        $users = User::select(['id','email'])->whereStatus(1)->get();
        return view('admin.coupons.edit',compact('coupon','categories','users','categoryIds','userIds'));
    }

    public function update(CouponRequest $request, $id)
    {
        $coupon = Coupon::findOrFail($id);
        $couponService = new CouponService();
        $couponService->couponCreateUpdate($request,$coupon);
        $coupon->save();

        return response()->json( [ 'message' =>  'Coupon updated successfully'] );
    }

    public function massDestroy(Request $request)
    {

        if($request->deleteAction == 'delete') {
            if (isset($request->ids)) {
                foreach ($request->ids as $id) {
                    $coupon = Coupon::findOrFail($id);
                    $coupon->delete();
                }
                return response()->json([
                    'message' =>  __('Coupon Deleted Successfully'),
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
