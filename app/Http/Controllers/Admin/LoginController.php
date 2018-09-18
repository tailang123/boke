<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // 加载登录页
    public function getLogin()
    {
        return view('Admin.login.login');
    }


    // 登录操作
    public function postLogin(Request $request)
    {
        $credentials = $request->only(['name', 'password']);
        Validator::make($credentials, [
            'name' => 'required',
            'password' => 'required',
        ])->validate();
        if (Auth::guard('admin')->attempt($credentials, $request->has('remember'))) {
            return ['status' => 1, 'msg' => '登录成功!'];
        }

        return ['status' => 0, 'msg' => '账号或者密码错误!'];
    }

    // 注销
    public function loginOut()
    {
        Auth::guard('admin')->logout();
        return redirect('aadmin/login');
    }
}