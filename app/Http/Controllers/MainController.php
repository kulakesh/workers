<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Crypt;

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
    public function adminWorkersReport(){
        $params = [
            'page_group' => 'Report',
            'page_name' => 'Worker Report',
            'page_id' => 'worker_report_all'

        ];
        return view('admin.main', compact('params'));
    }
    public function operatorWorkersReport(){
        $params = [
            'page_group' => 'Report',
            'page_name' => 'Worker Report',
            'page_id' => 'worker_report_all'

        ];
        return view('operator.main', compact('params'));
    }
    public function districtWorkersReport(){
        $params = [
            'page_group' => 'Report',
            'page_name' => 'Worker Report',
            'page_id' => 'worker_report_all'

        ];
        return view('district.main', compact('params'));
    }
    public function adminWorkerEdit($id){
        $worker_id = Crypt::decrypt($id);
        $params = [
            'page_group' => 'Workers',
            'page_name' => 'Edit Worker',
            'page_id' => 'worker-edit',
            'worker_id' => $worker_id

        ];
        return view('admin.main', compact('params', 'worker_id'));
    }
    public function districtWorkerEdit($id){
        $worker_id = Crypt::decrypt($id);
        $params = [
            'page_group' => 'Workers',
            'page_name' => 'Edit Worker',
            'page_id' => 'worker-edit',
            'worker_id' => $worker_id

        ];
        return view('district.main', compact('params', 'worker_id'));
    }
    public function operatorWorkerEdit($id){
        $worker_id = Crypt::decrypt($id);
        $params = [
            'page_group' => 'Workers',
            'page_name' => 'Edit Worker',
            'page_id' => 'worker-edit',
            'worker_id' => $worker_id

        ];
        return view('operator.main', compact('params', 'worker_id'));
    }
    public function adminIcard($id){
        $registration = Registration::where('id', $id)->first();
        return view('admin.icard', compact('registration'));
    }
    public function barcodeIndex($code)
    {
        if($code != null) {
            $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
            $image = $generator->getBarcode($code, $generator::TYPE_CODE_128);
    
            return response($image)->header('Content-type','image/png');
        }
    }
    public function qrcodeIndex($code)
    {
        if($code != null) {
            $qrCode = QrCode::size(300)->generate($code);

            return response($qrCode)->header('Content-Type', 'image/svg+xml');
        }
    }
}
