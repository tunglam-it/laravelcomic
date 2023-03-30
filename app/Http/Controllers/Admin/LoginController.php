<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function show()
    {
        if(!Auth::guard('admin')->check()){
            return view('admin.admin-login');
        }
        if (Auth::guard('admin')->check()){
            return to_route('admin.dashboard');
        }
    }

    public function login(LoginRequest $request)
    {
        $login = [
            'email'=>$request->email,
            'password'=>$request->password
        ];
        if(Auth::guard('admin')->attempt($login,false)){
            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->back()->with(['message'=>'Thông tin đăng nhập chưa chính xác!!!']);
        }
    }

    public function logout()
    {
        Session::flush();
        Cache::flush();
        Auth::guard('admin')->logout();
        return to_route('admin.login');
    }
}
