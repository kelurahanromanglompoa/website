<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use \App\Models\{
	User, Role
};

class AuthController extends Controller
{
    public function index()
    {
        if(Auth::check()){
			if(auth()->user()->role_id == Role::SUPER_ADMIN || auth()->user()->role_id == Role::ADMIN){
				return redirect()->route('dashboard');
			}
		}else{
			return view('app.auth.login');
		}
    }

    public function postlogin(Request $request)
    {
        if(Auth::attempt($request->only('username', 'password'))){
    		return $this->index();
        }else{
    		return redirect()->route('login')->with('status', 'Username dan password tidak ditemukan');
    	}
    }

    public function logout()
    {
    	$auth = User::find(auth()->user()->id);
    	$auth->last_login = date('Y-m-d H:i');
    	$auth->save();
    	Auth::logout();
    	return redirect()->route('login');
    }
}
