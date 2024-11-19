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
    public function createDocument(){
        $params = [
            'page_group' => 'Settings',
            'page_name' => 'Document Heads',
            'page_id' => 'document'

        ];
        return view('admin.main', compact('params'));
    }
    public function workersReport(){
        $params = [
            'page_group' => 'Report',
            'page_name' => 'Worker Report',
            'page_id' => 'worker_report_all'

        ];
        return view('admin.main', compact('params'));
    }
    public function adminIcard(){
        
        return view('admin.icard');
    }
    public function barcodeIndex($code)
    {
        if($code != null) {
            $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
            $image = $generator->getBarcode($code, $generator::TYPE_CODE_128);
    
            return response($image)->header('Content-type','image/png');
        }
    }
}
