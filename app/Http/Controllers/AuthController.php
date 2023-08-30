<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
	public function login(){
		return view('login');
	}
    public function login_u(Request $request){
    	$request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('manager')->attempt($request->only(['username','password']))){
            $request->session()->regenerate();
            return redirect()->intended('/manager')->with('g2Wr2P' , 'this session.');
        }
        if (Auth::guard('web')->attempt($request->only(['username','password']))){ 
            $request->session()->regenerate();
            return redirect()->intended('/kasir');
        }
        // elseif (Auth::attempt($request->only('username','password'))) {
        //     $request->session()->regenerate();
        //     return redirect()->intended('/dashboard')->with('succces','Login');
        // }
        return back()->withInput($request->only('username', 'remember'));
    }
    public function logout(Request $request)
    {
        if (Auth::guard('web')->check())
        {
            Auth::guard('web')->logout(); 
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/login');
        }
        if (Auth::guard('manager')->check())
        {    
            Auth::guard('manager')->logout(); 
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/login');
        }
    }
}
