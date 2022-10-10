<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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

    public function logout() {
        auth()->guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
