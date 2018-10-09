<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Requests;
use App\Models\User;

class UsersController extends Controller
{
    public function create(){
        return view('users.create');
    }

    public function show(User $user){
        return view('users.show',compact('user'));
    }

    public function store(Request $request){
        //验证数据是否规范
        $this->validate($request,[
            'name'=>'required|max:50',
            'email'=>'required|unique:users|email|max:255',
            'password'=>'required|min:6|confirmed'
        ]);

        //保存
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
        ]);
        //返回信息
        session()->flash('success','注册成功');
        return redirect()->route('users.show',[$user]);
    }
}
