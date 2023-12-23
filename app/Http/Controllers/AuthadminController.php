<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthadminController extends Controller
{
    public function auth(){
        return view('admin.auth.login');
    }
    public function login(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);
        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials)){
            if(Auth::user()->role == 'admin'){
                 return redirect()->route('vote.index');
            }
            return redirect()->route('platform.index');
        }
        return redirect()->back()->with('message',' البيانات غير مدرجة أعد المحاولة ! ');
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('platform.index');
    }
}
