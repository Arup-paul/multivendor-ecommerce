<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\Ratings;
use App\Models\User;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;

class AdminController extends Controller
{
    public function login(Request $request) {
        if($request->isMethod('post')) {
            $data = $request->all();
            $request->validate([
                'email' => 'required',
                'password' => 'required',
            ]);

            if(auth()->guard('admin')->attempt(['email' => $data['email'], 'password' => $data['password'], 'status' => 1])) {
               return  response()->json([
                    'message' => __('Logged In Successfully'),
                    'redirect' => route('admin.dashboard')
                ]);

            } else {
                return  response()->json(  __('these credentials do not match our records'), 401 );
            }
        }

        return view('admin.login');
    }
    public function dashboard() {
          for($i = 0; $i < 12; $i++){
                 $userCount =  User::whereMonth('created_at', Carbon::now()->subMonth($i))
                  ->whereYear('created_at',Carbon::now()->year)->count();
                 $orderCount = Order::whereMonth('created_at', Carbon::now()->subMonth($i))
                  ->whereYear('created_at',Carbon::now()->year)->count();
                 $sellerCount = Admin::where('type','vendor')->whereMonth('created_at', Carbon::now()->subMonth($i))
                  ->whereYear('created_at',Carbon::now()->year)->count();
                if($i == 0){
                    $currentMonthUser = $userCount;
                    $currentMonthOrder = $orderCount;
                    $currentMonthSeller = $sellerCount;
                    $currentMonthName = Carbon::now()->subMonth($i)->format('F');
                }else if($i == 1){
                    $beforeOneMonthUser = $userCount;
                    $beforeOneMonthOrder = $orderCount;
                    $beforeOneMonthSeller = $sellerCount;
                    $beforeOneMonthName =  Carbon::now()->subMonth($i)->format('F');
                }else if($i == 2){
                    $beforeTwoMonthUser = $userCount;
                    $beforeTwoMonthOrder = $orderCount;
                    $beforeTwoMonthSeller = $sellerCount;
                    $beforeTwoMonthName =  Carbon::now()->subMonth($i)->format('F');
                } else if($i == 3){
                    $beforeThreeMonthUser = $userCount;
                    $beforeThreeMonthOrder = $orderCount;
                    $beforeThreeMonthSeller = $sellerCount;
                    $beforeThreeMonthName =  Carbon::now()->subMonth($i)->format('F');
                } else if($i == 4){
                    $beforeFourMonthUser = $userCount;
                    $beforeFourMonthOrder = $orderCount;
                    $beforeFourMonthSeller = $sellerCount;
                    $beforeFourMonthName =  Carbon::now()->subMonth($i)->format('F');
                } else if($i == 5){
                    $beforeFiveMonthUser = $userCount;
                    $beforeFiveMonthOrder = $orderCount;
                    $beforeFiveMonthSeller = $sellerCount;
                    $beforeFiveMonthName =  Carbon::now()->subMonth($i)->format('F');
                } else if($i == 6){
                    $beforeSixMonthUser = $userCount;
                    $beforeSixMonthOrder = $orderCount;
                    $beforeSixMonthSeller = $sellerCount;
                    $beforeSixMonthName =  Carbon::now()->subMonth($i)->format('F');
                } else if($i == 7){
                    $beforeSevenMonthUser = $userCount;
                    $beforeSevenMonthOrder = $orderCount;
                    $beforeSevenMonthSeller = $sellerCount;
                    $beforeSevenMonthName =  Carbon::now()->subMonth($i)->format('F');
                } else if($i == 8){
                    $beforeEightMonthUser = $userCount;
                    $beforeEightMonthOrder = $orderCount;
                    $beforeEightMonthSeller = $sellerCount;
                    $beforeEightMonthName =  Carbon::now()->subMonth($i)->format('F');
                } else if($i == 9){
                    $beforeNineMonthUser = $userCount;
                    $beforeNineMonthOrder = $orderCount;
                    $beforeNineMonthSeller = $sellerCount;
                    $beforeNineMonthName =  Carbon::now()->subMonth($i)->format('F');
                } else if($i == 10){
                    $beforeTenMonthUser = $userCount;
                    $beforeTenMonthOrder = $orderCount;
                    $beforeTenMonthSeller = $sellerCount;
                    $beforeTenMonthName =  Carbon::now()->subMonth($i)->format('F');
                } else if($i == 11){
                    $beforeElevenMonthUser = $userCount;
                    $beforeElevenMonthOrder = $orderCount;
                    $beforeElevenMonthSeller = $sellerCount;
                    $beforeElevenMonthName =  Carbon::now()->subMonth($i)->format('F');
                }
          }


        $userCount =  [$currentMonthUser,$beforeOneMonthUser,$beforeTwoMonthUser,$beforeThreeMonthUser,$beforeFourMonthUser,$beforeFiveMonthUser,$beforeSixMonthUser,$beforeSevenMonthUser,$beforeEightMonthUser,$beforeNineMonthUser,$beforeTenMonthUser,$beforeElevenMonthUser];
        $orderCount =  [$currentMonthOrder,$beforeOneMonthOrder,$beforeTwoMonthOrder,$beforeThreeMonthOrder,$beforeFourMonthOrder,$beforeFiveMonthOrder,$beforeSixMonthOrder,$beforeSevenMonthOrder,$beforeEightMonthOrder,$beforeNineMonthOrder,$beforeTenMonthOrder,$beforeElevenMonthOrder];
        $sellerCount =  [$currentMonthSeller,$beforeOneMonthSeller,$beforeTwoMonthSeller,$beforeThreeMonthSeller,$beforeFourMonthSeller,$beforeFiveMonthSeller,$beforeSixMonthSeller,$beforeSevenMonthSeller,$beforeEightMonthSeller,$beforeNineMonthSeller,$beforeTenMonthSeller,$beforeElevenMonthSeller];
        $monthName = [$currentMonthName,$beforeOneMonthName,$beforeTwoMonthName,$beforeThreeMonthName,$beforeFourMonthName,$beforeFiveMonthName,$beforeSixMonthName,$beforeSevenMonthName,$beforeEightMonthName,$beforeNineMonthName,$beforeTenMonthName,$beforeElevenMonthName];

        $admin = auth()->guard('admin')->user();
        if($admin->type == 'superadmin'){
            $totalProducts = Product::count();
        }else{
            $totalProducts = Product::where('vendor_id',$admin->vendor_id)->count();
        }
        //order
        $orders = Order::with('users')->latest()->limit(10)->get();

        $allOrder = Order::get();
        $pendingOrder = Order::whereOrderStatus(0)->get();
        $completeOrder = Order::whereOrderStatus(3)->get();
        $cancelOrder = Order::whereOrderStatus(4)->get();

         $thisMonthEarning = Order::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at',Carbon::now()->year)->sum('grand_total');
        $thisYearEarning = Order::whereYear('created_at',Carbon::now()->year)->sum('grand_total');


        $totalCategory = Category::count();
        $totalBrand = Brand::count();
        $totalRating = Ratings::count();


        return view('admin.dashboard',compact('orderCount', 'userCount','monthName','sellerCount','orders','allOrder','pendingOrder','completeOrder','cancelOrder','thisMonthEarning','thisYearEarning','totalProducts','totalBrand','totalCategory','totalRating'));
    }

    public function updatePassword(Request $request) {
        if($request->isMethod('post')){
            $data = $request->all();
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required|min:8',
                'confirm_password' => 'required|same:new_password',
            ]);
            //check if current password is correct
            if(Hash::check($data['current_password'], auth()->guard('admin')->user()->password)) {
              Admin::where('id', auth()->guard('admin')->user()->id)->update(['password' => bcrypt($data['new_password'])]);
                    return  response()->json([
                        'message' => __('Password Updated Successfully'),
                        'redirect' => url()->previous()
                    ]);
             } else {
                return  response()->json(  __('Your Current Password is Incorrect'), 401 );
            }
        }
        $adminDetails = Admin::where('email', auth()->guard('admin')->user()->email)->first()->toArray();
        return view('admin.profile.update-password',compact('adminDetails'));
    }

    public function checkCurrentPassword(Request $request) {
        $data = $request->all();
          if(Hash::check($data['current_password'], auth()->guard('admin')->user()->password)) {
             return true;
          } else {
             return false;
        }
    }

    public function updateAdminDetails(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $request->validate([
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
                'mobile' => 'required|numeric|unique:admins,mobile,'.auth()->guard('admin')->user()->id,
                'email' => 'required|email|unique:admins,email,'.auth()->guard('admin')->user()->id,
            ]);

            $admin = Admin::find(auth()->guard('admin')->user()->id);
            $admin->name = $data['name'];
            $admin->mobile = $data['mobile'];
            $admin->email = $data['email'];
            $admin->image = $data['preview'];
            $admin->save();

               return  response()->json([
                    'message' => __('Admin Details Updated Successfully'),
                    'redirect' => url()->previous()
                ]);
        }
        return view('admin.profile.profile_details');

    }




    public function logout() {
        auth()->guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
