<?php

namespace App\Services;

use App\Models\Category;
use App\Models\ProductFilter;
use Illuminate\Support\Str;

class CouponService
{

    public function couponCreateUpdate($request,$coupon,$vendor_id = null)
    {
        $coupon->coupon_option = $request->input('coupon_option');
        $coupon->coupon_code = $request->input('coupon_code');
        $coupon->coupon_type = $request->input('coupon_type');
        $coupon->amount_type = $request->input('amount_type');
        $coupon->amount = $request->input('amount');
        $coupon->start_date = date('Y-m-d', strtotime($request->input('start_date')));
        $coupon->end_date = date('Y-m-d', strtotime($request->input('end_date')));
        $coupon->status = $request->input('status');

        //categories
        $categories = $request->input('categories');
        if ($categories) {
            $categoryId = implode(',', $categories);
            $coupon->categories = $categoryId;
        }


        if ($vendor_id) {
            if (auth('admin')->user()->type == 'vendor') {
                $coupon->vendor_id = auth('admin')->user()->vendor_id;
            } else {
                $coupon->vendor_id = null;
            }
        }

        //users
        $users = $request->input('users');
        if($users){
            $usersId = implode(',',$users);
            $coupon->users = $usersId;
        }

    }

}
