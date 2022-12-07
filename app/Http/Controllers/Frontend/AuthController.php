<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
     public function login(){
        return view('frontend.auth.login');
    }

    public function processLogin(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email','password');

        if(Auth::attempt($credentials)){
            $request->session()->regenerate();
            return  response()->json([
                'message' => __('Login Successfully'),
                'redirect' => route('home')
            ]);
        }
        return response()->json( [ 'message' =>  'The provided credentials do not match our records'],401);



    }

    public function register(){
        return view('frontend.auth.register');
    }

    public function processRegister(Request $request){

          $request->validate([
             'name' => 'required',
             'mobile' => 'required|unique:users|digits_between:10,13|numeric',
             'email' => 'required|unique:users|email',
             'password' => 'required|confirmed|min:8',
          ]);

           $user = new User();
            $user->name = $request->name;
            $user->mobile = $request->mobile;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->save();


        return  response()->json([
            'message' => __('Account Created Successfully'),
            'redirect' => route('login')
        ]);


    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');

    }
}
