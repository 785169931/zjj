<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * 登录表单
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('admin.login_register.login');
    }

    #重写方法，增加status验证，larave自带的验证中没有验证status字段
    public function credentials(Request $request)
    {
        $data = $request->only($this->username(),'password');
        return array_merge($data,['status' => User::NORMAL]);
    }

    #重写覆盖登录表单的验证
    public function validateLogin(Request $request)
    {
        $this->validate($request,[
            $this->username() => 'required|string',
            'password' => 'required',
            'vercode' => 'required|size:'.User::VERCODE_length
        ],[
            'vercode.required' => '验证码不能为空',
            'vercode.size' => '验证码为 '.User::VERCODE_length.' 位',
        ]);
    }

    /**
     * 用于登录的字段
     * @return string
     */
    public function username()
    {
        return 'username';
    }

    /**
     * 登录成功后的跳转地址
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirectTo()
    {
        return route('admin.layout');
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect(route('admin.login'));
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard();
    }

}
