<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionsController extends Controller
{
    public function create(){
        return view('sessions.create');
    }

    public function store(Request $request){
        //验证正确性
        $credentials=$this->validate($request,[
            'email'=>'required|email|max:255',
            'password'=>'required'
        ]);
        //attempt验证是否与数据库中的信息一致
        if (Auth::attempt($credentials,$request->has('remember'))) {
            session()->flash('success','登录成功');
            return redirect()->route('users.show',[Auth::user()]);
        }else{
            session()->flash('danger','邮箱与密码不符');
            return redirect()->back();
        }
        //返回消息

    }


    public function destroy(){
        Auth::logout();
        session()->flash('success','退出成功');
        return redirect('login');
    }
}
