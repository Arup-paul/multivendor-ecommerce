<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Order;
use App\Models\OrderProduct;
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
           $currentMonthOrder = Order::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at',Carbon::now()->year)->count();
           $beforeOneMonthOrder = Order::whereMonth('created_at', Carbon::now()->subMonth(1))
            ->whereYear('created_at',Carbon::now()->year)->count();
           $beforeTwoMonthOrder = Order::whereMonth('created_at', Carbon::now()->subMonth(2))
            ->whereYear('created_at',Carbon::now()->year)->count();
           $beforeThreeMonthOrder = Order::whereMonth('created_at', Carbon::now()->subMonth(3))
            ->whereYear('created_at',Carbon::now()->year)->count();
          $beforeFourMonthOrder = Order::whereMonth('created_at', Carbon::now()->subMonth(4))
            ->whereYear('created_at',Carbon::now()->year)->count();
          $beforeFiveMonthOrder = Order::whereMonth('created_at', Carbon::now()->subMonth(5))
            ->whereYear('created_at',Carbon::now()->year)->count();

          $orderCount = [$currentMonthOrder,$beforeOneMonthOrder,$beforeTwoMonthOrder,$beforeThreeMonthOrder,$beforeFourMonthOrder,$beforeFiveMonthOrder];
          $orderMonth = [Carbon::now()->format('F'),Carbon::now()->subMonth(1)->format('F'),Carbon::now()->subMonth(2)->format('F'),Carbon::now()->subMonth(3)->format('F'),Carbon::now()->subMonth(4)->format('F'),Carbon::now()->subMonth(5)->format('F')];


          for($i = 0; $i < 12; $i++){
                 $userCount =  User::whereMonth('created_at', Carbon::now()->subMonth($i))
                  ->whereYear('created_at',Carbon::now()->year)->count();
                if($i == 0){
                    $currentMonthUser = $userCount;
                    $currentMonthName = Carbon::now()->subMonth($i)->format('F');
                }else if($i == 1){
                    $beforeOneMonthUser = $userCount;
                    $beforeOneMonthName =  Carbon::now()->subMonth($i)->format('F');
                }else if($i == 2){
                    $beforeTwoMonthUser = $userCount;
                    $beforeTwoMonthName =  Carbon::now()->subMonth($i)->format('F');
                } else if($i == 3){
                    $beforeThreeMonthUser = $userCount;
                    $beforeThreeMonthName =  Carbon::now()->subMonth($i)->format('F');
                } else if($i == 4){
                    $beforeFourMonthUser = $userCount;
                    $beforeFourMonthName =  Carbon::now()->subMonth($i)->format('F');
                } else if($i == 5){
                    $beforeFiveMonthUser = $userCount;
                    $beforeFiveMonthName =  Carbon::now()->subMonth($i)->format('F');
                } else if($i == 6){
                    $beforeSixMonthUser = $userCount;
                    $beforeSixMonthName =  Carbon::now()->subMonth($i)->format('F');
                } else if($i == 7){
                    $beforeSevenMonthUser = $userCount;
                    $beforeSevenMonthName =  Carbon::now()->subMonth($i)->format('F');
                } else if($i == 8){
                    $beforeEightMonthUser = $userCount;
                    $beforeEightMonthName =  Carbon::now()->subMonth($i)->format('F');
                } else if($i == 9){
                    $beforeNineMonthUser = $userCount;
                    $beforeNineMonthName =  Carbon::now()->subMonth($i)->format('F');
                } else if($i == 10){
                    $beforeTenMonthUser = $userCount;
                    $beforeTenMonthName =  Carbon::now()->subMonth($i)->format('F');
                } else if($i == 11){
                    $beforeElevenMonthUser = $userCount;
                    $beforeElevenMonthName =  Carbon::now()->subMonth($i)->format('F');
                }
          }

        $userCount =  [$currentMonthUser,$beforeOneMonthUser,$beforeTwoMonthUser,$beforeThreeMonthUser,$beforeFourMonthUser,$beforeFiveMonthUser,$beforeSixMonthUser,$beforeSevenMonthUser,$beforeEightMonthUser,$beforeNineMonthUser,$beforeTenMonthUser,$beforeElevenMonthUser];
        $userMonthName = [$currentMonthName,$beforeOneMonthName,$beforeTwoMonthName,$beforeThreeMonthName,$beforeFourMonthName,$beforeFiveMonthName,$beforeSixMonthName,$beforeSevenMonthName,$beforeEightMonthName,$beforeNineMonthName,$beforeTenMonthName,$beforeElevenMonthName];


        return view('admin.dashboard',compact('orderCount','orderMonth','userCount','userMonthName'));
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
