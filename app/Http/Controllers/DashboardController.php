<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller{

    public function adminDashboard(){
        return view('admin.dashboard');
    }
    public function districtDashboard(){
        return view('district.dashboard');
    }
    public function operatorDashboard(){
        return view('operator.dashboard');
    }

}