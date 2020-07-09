<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Admin;
use Auth;

class AdminController extends Controller
{
	public function login(Request $request){
		if($request->isMethod('post')){
			$data = $request->all();
			if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password'],'admin'=>'1'])){
				return redirect('/home');
			}else{
				return redirect('/admin')->with('delete','Invalid email or password');
			}
		}
		return view('auth.login');
	}
	public function logout(){
    	Session::flush();
    	return redirect('/admin')->with('flash_message_success','Logged out successfully!');
    }
}
