<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login(Request $request) {
        if($request->isMethod('post')) {
            $data = $request->all();
            $validated = $request->validate([
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
        return view('admin.dashboard');
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


    public function logout() {
        auth()->guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
