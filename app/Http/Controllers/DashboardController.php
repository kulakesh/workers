<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;

class DashboardController extends Controller{

    public function adminDashboard(){
        $entries = Registration::whereDel(0)->count();
        return view('admin.dashboard', compact('entries'));
    }
    public function districtDashboard(){
        $entries = Registration::whereIn('operator_id', function ($query) {
            $query->select('id')
            ->from('operators')
            ->where('district_id', auth()->user()->id);
        })
        ->whereDel(0)
        ->count();
        return view('district.dashboard', compact('entries'));
    }
    public function operatorDashboard(){
        $entries = Registration::where('operator_id', auth()->user()->id)
        ->whereDel(0)
        ->count();
        return view('operator.dashboard', compact('entries'));
    }

}