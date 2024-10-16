<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function createDistrict(){
        $params = [
            'page_group' => 'Districts',
            'page_name' => 'Create District',
            'page_id' => 'district'

        ];
        return view('admin.main', compact('params'));
    }
    public function createOparator(){
        $params = [
            'page_group' => 'Oparators',
            'page_name' => 'Create Oparator',
            'page_id' => 'oparator'

        ];
        return view('district.main', compact('params'));
    }
    public function createWorker(){
        $params = [
            'page_group' => 'Workers',
            'page_name' => 'Create Worker',
            'page_id' => 'worker'

        ];
        return view('operator.main', compact('params'));
    }
}
