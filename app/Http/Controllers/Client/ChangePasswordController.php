<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\ChangePasswordRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    private $user;
    public function __construct(User $user)
    {
        $this->middleware('auth');
        $this->user = $user;
    }

    public function redirectUserInfo()
    {
        $user = Auth::guard('web')->user();
        return view('client.authentication.change-password',compact('user'));
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $this->user->findOrFail(auth()->user()->id)->update(['password'=>Hash::make($request->new_password)]);
        return redirect()->route('client.info')->with(['message'=>'Đổi mật khẩu thành công']);
    }
}
