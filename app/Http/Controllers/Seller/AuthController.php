<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login(){
        return view('seller.auth.login');
    }

    public function processLogin(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);


        if(Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])){
            $request->session()->regenerate();
            return  response()->json([
                'message' => __('Login Successfully'),
                'redirect' => route('admin.dashboard')
            ]);
        }
        return response()->json( [ 'message' =>  'The provided credentials do not match our records'],401 );



    }

    public function register(){
        return view('seller.auth.register');
    }

    public function processRegister(Request $request){

        $request->validate([
            'name' => 'required',
            'mobile' => 'required|unique:users|digits_between:10,13|numeric',
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed|min:8',
        ]);
        DB::beginTransaction();

        $user = new Vendor();
        $user->name = $request->name;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->status = 0;
        $user->save();

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->mobile = $request->mobile;
        $admin->email = $request->email;
        $admin->password = bcrypt($request->password);
        $admin->vendor_id = $user->id;
        $admin->status = 0;
        $admin->type = 'vendor';
        $admin->save();

        DB::commit();



        return  response()->json([
            'message' => __('Account Created Successfully'),
            'redirect' => route('seller.login')
        ]);


    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('seller.login');

    }
}
