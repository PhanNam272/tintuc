<?php

namespace App\Http\Controllers\admin\auth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminLoginControllers extends Controller
{
    public function login()
    { 
        if (Auth::check()) { 
            return redirect()->route('admin.dashboard');
        }
        return view('admin.login');
    }
     
     function storeLogin(Request $request)
     {
        $name = $request->input('name');
        $password = $request->input('password'); 
        if (Auth::attempt(['name' => $name, 'password' => $password])) {
            return redirect()->route('admin.dashboard');
        }
            Session::put('message', "Tài khoản hoặc mật khẩu không chính xác!");
            return redirect()->back();
 }
                    
     function logout(){
        Auth::logout();
       return redirect()->route('admin.login');
     }
}
