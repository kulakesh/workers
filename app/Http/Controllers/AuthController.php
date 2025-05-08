<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function adminIndex()
    {
        if(auth()->guard('admin')->check()){
            return redirect(route('admin.dashboard'));
        }
        return view('auth.admin');
    }

    public function adminLogin(Request $request){

        if(auth()->guard('district')->check()){
            return redirect(route('admin.index'))->with('errors', 'Please logout from DISTRICT account');
        }
        if(auth()->guard('operator')->check()){
            return redirect(route('admin.index'))->with('errors', 'Please logout from OPERATOR account');
        }
        if(auth()->guard('accountant')->check()){
            return redirect(route('admin.index'))->with('errors', 'Please logout from ACCOUNTANT account');
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

    public function adminLogout(){
        \Session::flush();
        auth()->guard('admin')->logout();
        return redirect(route('admin.index'));
    }

    public function districtIndex()
    {
        if(auth()->guard('district')->check()){
            return redirect(route('district.dashboard'));
        }
        return view('auth.district');
    }

    public function districtLogin(Request $request){

        if(auth()->guard('admin')->check()){
            return redirect(route('district.index'))->with('errors', 'Please logout from ADMIN account');
        }
        if(auth()->guard('operator')->check()){
            return redirect(route('district.index'))->with('errors', 'Please logout from OPERATOR account');
        }
        if(auth()->guard('accountant')->check()){
            return redirect(route('district.index'))->with('errors', 'Please logout from ACCOUNTANT account');
        }
        // validate data 
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        // login code 
        
        if(auth()->guard('district')->attempt($request->only('username','password'))){
            return redirect(route('district.dashboard'));
        }

        return redirect(route('district.index'))->with('errors', 'Login details are not valid');

    }
    public function districtLogout(){
        \Session::flush();
        auth()->guard('district')->logout();
        return redirect(route('district.index'));
    }

    public function operatorIndex()
    {
        if(auth()->guard('operator')->check()){
            return redirect(route('operator.dashboard'));
        }
        return view('auth.operator');
    }
    public function operatorLogin(Request $request){

        if(auth()->guard('admin')->check()){
            return redirect(route('operator.index'))->with('errors', 'Please logout from ADMIN account');
        }
        if(auth()->guard('district')->check()){
            return redirect(route('operator.index'))->with('errors', 'Please logout from DISTRICT account');
        }
        if(auth()->guard('accountant')->check()){
            return redirect(route('operator.index'))->with('errors', 'Please logout from ACCOUNTANT account');
        }
        // validate data 
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        // login code 
        
        if(auth()->guard('operator')->attempt($request->only('username','password'))){
            return redirect(route('operator.dashboard'));
        }

        return redirect(route('operator.index'))->with('errors', 'Login details are not valid');

    }

    public function operatorLogout(){
        \Session::flush();
        auth()->guard('operator')->logout();
        return redirect(route('operator.index'));
    }
    public function accountantIndex()
    {
        if(auth()->guard('accountant')->check()){
            return redirect(route('accountant.dashboard'));
        }
        return view('auth.accountant');
    }
    public function accountantLogin(Request $request){

        if(auth()->guard('admin')->check()){
            return redirect(route('accountant.index'))->with('errors', 'Please logout from ADMIN account');
        }
        if(auth()->guard('district')->check()){
            return redirect(route('accountant.index'))->with('errors', 'Please logout from DISTRICT account');
        }
        if(auth()->guard('operator')->check()){
            return redirect(route('accountant.index'))->with('errors', 'Please logout from OPERATOR account');
        }
        // validate data 
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        // login code 
        
        if(auth()->guard('accountant')->attempt($request->only('username','password'))){
            return redirect(route('accountant.dashboard'));
        }

        return redirect(route('accountant.index'))->with('errors', 'Login details are not valid');

    }

    public function accountantLogout(){
        \Session::flush();
        auth()->guard('accountant')->logout();
        return redirect(route('accountant.index'));
    }

}