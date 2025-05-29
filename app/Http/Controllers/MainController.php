<?php

namespace App\Http\Controllers;

use App\Models\DistrictNames;
use App\Models\Registration;
use App\Models\StateDistricts;
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
    public function createOperator(){
        $params = [
            'page_group' => 'Operators',
            'page_name' => 'Create Operator',
            'page_id' => 'operator'

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
    public function createBenefits(){
        $params = [
            'page_group' => 'Settings',
            'page_name' => 'Create Benefits',
            'page_id' => 'benefit'

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
    public function accountantPaymentUnVerify(){
        $params = [
            'page_group' => 'Report',
            'page_name' => 'Payment Verification',
            'page_id' => 'payment_unverified'

        ];
        return view('accountant.main', compact('params'));
    }
    public function accountantPaymentVerify(){
        $params = [
            'page_group' => 'Report',
            'page_name' => 'Payment Verification',
            'page_id' => 'payment_verified'

        ];
        return view('accountant.main', compact('params'));
    }
    public function accountantPaymentReject(){
        $params = [
            'page_group' => 'Report',
            'page_name' => 'Payment Verification',
            'page_id' => 'payment_rejected'

        ];
        return view('accountant.main', compact('params'));
    }
    public function accountantPaymentAll(){
        $params = [
            'page_group' => 'Report',
            'page_name' => 'Payment Verification',
            'page_id' => 'payment_all'

        ];
        return view('accountant.main', compact('params'));
    }
    public function districtWorkersReport(){
        $params = [
            'page_group' => 'Report',
            'page_name' => 'Worker Report',
            'page_id' => 'worker_report_all'

        ];
        return view('district.main', compact('params'));
    }
    public function districtWorkersApproved(){
        $params = [
            'page_group' => 'Report',
            'page_name' => 'Worker Report',
            'page_id' => 'worker_report_approved'

        ];
        return view('district.main', compact('params'));
    }
    public function districtWorkersRejected(){
        $params = [
            'page_group' => 'Report',
            'page_name' => 'Worker Report',
            'page_id' => 'worker_report_rejected'

        ];
        return view('district.main', compact('params'));
    }
    public function districtWorkersReportApproval(){
        $params = [
            'page_group' => 'Report',
            'page_name' => 'Worker Report',
            'page_id' => 'worker_report_approval'

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
            $code = str_replace('-', '/', $code);
            $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();
            $image = $generator->getBarcode($code, $generator::TYPE_CODE_128);
    
            return response($image)->header('Content-type','image/png');
        }
    }
    public function qrcodeIndex($code)
    {
        if($code != null) {
            $qrCode = QrCode::size(300)->generate('https://apbocwwb-id.in/verify/' . $code);

            return response($qrCode)->header('Content-Type', 'image/svg+xml');
        }
    }
    public function verifyIndex($code)
    {
        if($code != null) {

            $code = str_replace('-', '/', $code);
            $registration = Registration::where('system_id', $code)->first();
            return view('verify', compact('registration'));
        }
    }
    public function selectDistrict(){
        $district_names = StateDistricts::where('state_code', 12)->orderBy('district_name')->get();
        return view('website.select-district', compact('district_names'));
    }
}
