<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function index()
    {
        if(auth()->guard('admin')->check()){
            return redirect(route('admin.dashboard'));
        }
        return view('auth.admin');
    }

    public function login(Request $request){

        if(auth()->guard('district')->check()){
            return redirect(route('admin.index'))->with('errors', 'Please logout from DISTRICT account');
        }
        if(auth()->guard('operator')->check()){
            return redirect(route('admin.index'))->with('errors', 'Please logout from OPERATOR account');
        }
        // validate data 
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        // login code 
        
        if(auth()->guard('admin')->attempt($request->only('email','password'))){
            return redirect(route('admin.dashboard'));
        }

        return redirect(route('admin.index'))->with('errors', 'Login details are not valid');

    }

    public function logout(){
        \Session::flush();
        auth()->guard('admin')->logout();
        return redirect(route('admin.index'));
    }

    
}