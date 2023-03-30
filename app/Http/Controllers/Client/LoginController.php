<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
    }
    public function show()
    {
        if(!Auth::guard('web')->check()){
            return view('client.authentication.login');
        }
        if (Auth::guard('web')->check()){
            return to_route('client.home');
        }
    }

    //
    public function login(LoginRequest $request)
    {
        $login = [
            'email'=>$request->email,
            'password'=>$request->password
        ];
        if(Auth::guard('web')->attempt($login,false)){
            return redirect()->route('client.home');
        }else{
            return redirect()->back()->with(['message'=>'Thông tin đăng nhập chưa chính xác!!!']);
        }
    }

    public function logout()
    {
        Session::flush();
        Cache::flush();
        Auth::guard('web')->logout();
        return redirect()->route('client.home');
    }
}
