<?php

namespace App\Livewire;

use App\Models\Benefit;
use App\Models\District;
use App\Models\DistrictNames;
use App\Models\Operator;
use App\Models\RegBenefit;
use App\Models\RegBiomatric;
use App\Models\RegDocument;
use App\Models\RegEmployer;
use App\Models\RegFamily;
use App\Models\RegNominee;
use App\Models\RegPhoto;
use App\Models\Rejection;
use App\Models\Renewals;
use App\Models\StateDistricts;
use App\SMS;
use Livewire\WithFileUploads;
use App\Models\DocumentHeads;
use App\Models\Registration;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class CreateWorker extends Component
{
    use WithFileUploads;

    public $id, $system_id, $name, $father, $mother, $spouse, $gender, $dob, $marital, $cast, $tribe, $email, $phone, $bg,
    $city_t, $district_t, $state_t, $pin_t, $po_t, $ps_t, $address_t, 
    $city_p, $district_p, $state_p, $pin_p, $po_p, $ps_p, $address_p, 
    $aadhaar, $nature, $serial, $serial_date, $pf_no, $doe, $dor, $turnover, 
    $total_years, $est_name, $est_reg_no, $est_address, $employer_name, $employer_address, $other_welfare, $welfare_name, $welfare_reg_no,
    $more_bocw, $number_of_bocw, $primary_bocw,
    $nominee, $relation, $del;

    public $state_districts_t = [], $state_districts_p = [];
    public $edit_mode = false;
    public bool $same_address = false;

    public $family_member_name, $family_member_age, $family_member_relation;

    public $nominee_name1, $nominee_dob1, $nominee_relation1, $nominee_address1, $nominee_name2, $nominee_dob2, $nominee_relation2, $nominee_address2;

    public $employer_description, $employer_name_address, $employer_nature, $employer_document, $employer_document_name;
    public $employers = [];
    
    public $benefit_name, $benefit_date, $benefit_amount, $benefit_cheque, $benefit_bank;
    public $benefits = [];

    public $payment_years, $payment_amount, $payment_mode, $payment_ref_no, $payment_date, $payment_document, $payment_document_name, $payment_photo, $payment_photo_name;
    public $documents = [];
    public $uploaded_documents = [];

    public $uploaded_document_name = [];

    public $photo, $photo_name;

    public $finger_captured, $finger, $finger_name, $finger_template;
    
    public $documentRule = [], $documentMessage = [], $documentAttributes = [];

    public $smsreply;

    public $approval, $approvalChecked, $rejection_reason;


    public function submitPayment(){
        $this->validate([
            'payment_years' => 'required|numeric|in:1,2,3',
            'payment_mode' => 'required',
            'payment_ref_no' => 'required',
            'payment_date' => 'required|date_format:d M Y',
            'payment_document' => 'nullable|mimes:jpeg,png,pdf|max:1024',
        ]);
        
        if($this->payment_document){
            $this->payment_document_name = hexdec(uniqid()).'.'.$this->payment_document->getClientOriginalExtension();
            if(!file_exists(public_path('payment/') . $this->payment_document_name)){
                $this->payment_document->storeAs('payment/', $this->payment_document_name, 'public');
            }
        }
        if($this->payment_photo){
            $this->payment_photo_name = hexdec(uniqid()).'.png';
            $data = $this->payment_photo;
            if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
                $data = substr($data, strpos($data, ',') + 1);
                $type = strtolower($type[1]); // jpg, png, gif
            
                if (!in_array($type, [ 'jpg', 'jpeg', 'gif', 'png' ])) {
                    throw new \Exception('invalid image type');
                }
                $data = str_replace( ' ', '+', $data );
                $data = base64_decode($data);
            
                if ($data === false) {
                    throw new \Exception('base64_decode failed');
                }
            } else {
                throw new \Exception('did not match data URI with image data');
            }
            if(!file_exists(public_path('payment/') . $this->payment_photo_name)){
                Storage::disk('public')->put('payment/'.$this->payment_photo_name, $data);
            }
        }
        Renewals::where('worker_id', $this->id)->whereDel(0)->update(['del' => 1]);
        $renewal = Renewals::create([
            'worker_id' => $this->id,
            'payment_years' => $this->payment_years,
            'payment_amount' => $this->payment_amount,
            'payment_mode' => $this->payment_mode,
            'payment_ref_no' => $this->payment_ref_no,
            'payment_date' => Carbon::createFromFormat('d M Y', $this->payment_date)->format('Y-m-d'),
            'doc_path' => $this->payment_document_name,
            'img_path' => $this->payment_photo_name,
            'approval' => 0
        ]);

        session()->flash('message', 'Renewal payment complete, require Approval');
        $this->dispatch('payment-done');
    }
    public function payment_year_change()
    {
        $this->payment_amount = $this->payment_years * 240;
    }
    public function mount($worker_id = null)
    {
        if($worker_id){
            $this->edit_mode = true;
            $this->edit($worker_id);
            if(isset($_REQUEST['done']) || isset($_REQUEST['edit'])){
                $this->dispatch('move-to-finish');
            }
        }

        $document_heads = DocumentHeads::whereDel(0)->orderBy('id')->get();
        foreach($document_heads as $index => $document_head){
            if($document_head->type == 'required' && !$this->edit_mode) {
                $this->documentRule['documents.'.$index] = 'required';
                $this->documentMessage['documents.'.$index] = $document_head->name.' is required';
            }
            $this->documentRule['uploaded_documents.'.$index] = ($document_head->type == 'required' && !$this->edit_mode ? 'required|' : '') . 'mimes:jpeg,png,pdf|max:1024';
            $this->documentMessage['uploaded_documents.'.$index.'.required'] = 'Select document for '. $document_head->name;
            $this->documentMessage['uploaded_documents.'.$index.'.mimes'] = 'Only jpeg,png,pdf';
            $this->documentAttributes['uploaded_documents.'.$index] = $document_head->name;
        }
        
    }
    public function state_change_t()
    {
       $this->state_districts_t = StateDistricts::select('district_name')->where('state_name', $this->state_t)->orderBy('district_name')->get();
    }
    public function state_change_p()
    {
       $this->state_districts_p = StateDistricts::select('district_name')->where('state_name', $this->state_p)->orderBy('district_name')->get();
    }
    private $fingerRules= [
        'finger' => 'required',
        'finger_template' => 'required'
    ];
    private $fingerMessages= [
        'finger' => 'required',
        'finger_template' => 'required'
    ];
    public function validateFinger(){
        if(!$this->edit_mode){
            $this->validate($this->fingerRules, $this->fingerMessages);
        }
        if($this->finger_captured){
            if($this->finger != 'testing'){
                $this->finger_name = hexdec(uniqid()).'.png';
                $data = base64_decode($this->finger);
                if(!file_exists(public_path('biometric/') . $this->finger_name)){
                    Storage::disk('public')->put('biometric/'.$this->finger_name, $data);
                }
            }else{
                $this->finger_name = 'do-not-delete-finger.png';
            }
        }
        session()->flash('message', 'Worker Biometric Capture Complete');
        $this->dispatch('move-to-document');
    }

    private $photoRules= [
        'photo' => 'required'
    ];
    private $photoMessages= [
        'photo.required' => 'Start the camera then take a photo'
    ];
    public function validatePhoto(){
        if(!$this->edit_mode){
            $this->validate($this->photoRules, $this->photoMessages);
        }
        if($this->photo){
            $this->photo_name = hexdec(uniqid()).'.png';
            $data = $this->photo;
            if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
                $data = substr($data, strpos($data, ',') + 1);
                $type = strtolower($type[1]); // jpg, png, gif
            
                if (!in_array($type, [ 'jpg', 'jpeg', 'gif', 'png' ])) {
                    throw new \Exception('invalid image type');
                }
                $data = str_replace( ' ', '+', $data );
                $data = base64_decode($data);
            
                if ($data === false) {
                    throw new \Exception('base64_decode failed');
                }
            } else {
                throw new \Exception('did not match data URI with image data');
            }
            if(!file_exists(public_path('photo/') . $this->photo_name)){
                Storage::disk('public')->put('photo/'.$this->photo_name, $data);
            }
        }
        session()->flash('message', 'Worker Photo Capture Complete');
        $this->dispatch('move-to-biometric');
    }
    public function doNothig(){
        //nothing
    }
    public function validateDocuments(){
        if(!$this->edit_mode){
            $this->validate($this->documentRule, $this->documentMessage, $this->documentAttributes);
        }
        
        foreach($this->uploaded_documents as $index => $uploaded_document){
            $this->uploaded_document_name[$index] = hexdec(uniqid()).'.'.$uploaded_document->getClientOriginalExtension();
            
            if(!file_exists(public_path('document/') . $this->uploaded_document_name[$index])){
                $uploaded_document->storeAs('document/', $this->uploaded_document_name[$index], 'public');
            }
        }

        session()->flash('message', 'Worker Document Upload Complete');
        $this->dispatch('move-to-review');
    }
    
    private $employerRule = [
        'employer_description' => 'required',
        'employer_name_address' => 'required',
        'employer_nature' => 'required',
        'employer_document' => 'required|mimes:jpeg,png,pdf|max:1024',
    ];
    public function addEmployers(){
        $this->validate($this->employerRule);

        $this->employer_document_name = hexdec(uniqid()).'.'.$this->employer_document->getClientOriginalExtension();
        if(!file_exists(public_path('employer/') . $this->employer_document_name)){
            $this->employer_document->storeAs('employer/', $this->employer_document_name, 'public');
        }

        array_push($this->employers, [
            'employer_description' => $this->employer_description,
            'employer_name_address' => $this->employer_name_address,
            'employer_nature' => $this->employer_nature,
            'employer_document_name' => $this->employer_document_name
        ]);

        $this->employer_description = null;
        $this->employer_name_address = null;
        $this->employer_nature = null;
        $this->employer_document = null;
        $this->employer_document_name = null;
    }

    public function submitEmployers(){
        session()->flash('message', 'Worker Employer Complete');
        $this->dispatch('move-to-photo');
    }
    public function removeEmployers($index){
        array_splice($this->employers, $index, 1);
    }
    private $benefitRule = [
        'benefit_name' => 'required',
        'benefit_date' => 'required',
        'benefit_amount' => 'nullable|min:1',
    ];
    public function addBenefit(){
        $this->validate($this->benefitRule);

        array_push($this->benefits, [
            'benefit_name' => $this->benefit_name,
            'benefit_date' => $this->benefit_date,
            'benefit_amount' => $this->benefit_amount,
            'benefit_cheque' => $this->benefit_cheque,
            'benefit_bank' => $this->benefit_bank
        ]);

        $this->benefit_name = null;
        $this->benefit_date = null;
        $this->benefit_amount = null;
        $this->benefit_cheque = null;
        $this->benefit_bank = null;
    }

    public function submitBenefits(){
        session()->flash('message', 'Worker Employer Complete');
        $this->dispatch('move-to-review');
    }
    public function removeBenefit($index){
        array_splice($this->benefits, $index, 1);
    }
    private $nomineeRule = [
        'nominee_name1' => 'required',
        'nominee_dob1' => 'required|date_format:d/m/Y',
        'nominee_relation1' => 'required',
        'nominee_dob2' => 'nullable|date_format:d/m/Y',
    ];
    private $nomineeMessage = [
        'nominee_name1.required' => 'Nominee name required',
        'nominee_dob1.required' => 'Nominee DOB required',
        'nominee_relation1.required' => 'Nominee Relation required',
        'nominee_dob1.date_format' => 'No a valid Format',
        'nominee_dob2.date_format' => 'No a valid Format',
    ];
    public function validateNominee(){
        $this->validate($this->nomineeRule, $this->nomineeMessage);
        
        session()->flash('message', 'Worker Nominee Complete');
        $this->dispatch('move-to-employer');

    }
    private $generalRules = [
        'name' => 'required|string|max:150',
        'gender' => 'required|in:Male,Female,Other',
        'marital' => 'required|in:Married,Unmarried,Widowed,Other',
        'spouse' => 'required_if:marital,Married|max:150',
        'dob' => 'required|date_format:d/m/Y',
        'email' => 'nullable|email',
        'phone' => 'required|digits:10',
        'bg' => 'nullable|max:10',
        'district_t' => 'required',
        'state_t' => 'required',
        'pin_t' => 'nullable|digits:6',
        'district_p' => 'required',
        'state_p' => 'required',
        'pin_p' => 'nullable|digits:6',
        'aadhaar' => 'required|digits:12',
        'serial_date' => 'nullable|date_format:d/m/Y',
        'doe' => 'nullable|date_format:d/m/Y',
        'dor' => 'nullable|date_format:d/m/Y',
        'turnover' => 'nullable|numeric',
        'other_welfare' => 'nullable|in:yes,no',
        'welfare_name' => 'required_if:other_welfare,yes|max:225',
        'welfare_reg_no' => 'required_if:other_welfare,yes|max:100',
        'more_bocw' => 'nullable|in:yes,no',
        'number_of_bocw' => 'required_if:more_bocw,yes|max:225',
        'primary_bocw' => 'required_if:other_wmore_bocwelfare,yes|max:100',
    ];
    private $generalMessages = [
        'dob.date_format' => 'Must match the format DD/MM/YYYY',
        'serial_date.date_format' => 'Must match the format DD/MM/YYYY',
        'doe.date_format' => 'Must match the format DD/MM/YYYY',
        'dor.date_format' => 'Must match the format DD/MM/YYYY',
        'other_welfare' => 'Select yes or no',
        'more_bocw' => 'Select yes or no',
    ];
    public function generalValidate() 
    {
        try {
            $this->validate($this->generalRules,$this->generalMessages);

            session()->flash('message', 'Worker General Complete');
            $this->dispatch('move-to-family');
        } catch (\Throwable $e) {
            $this->dispatch('validation-error');
            throw $e;
        }

    }
    public function processMark()
    {
        if ($this->same_address) {
            $this->same();
        } else {
            $this->notSame();
        }
    }
    public function same()
    {
        $this->city_p = $this->city_t;
        $this->district_p = $this->district_t;
        $this->state_p = $this->state_t;
        $this->pin_p = $this->pin_t;
        $this->po_p = $this->po_t;
        $this->ps_p = $this->ps_t;
        $this->address_p = $this->address_t;

    }

    public function notSame()
    {
        $this->city_p = null;
        $this->district_p = null;
        $this->state_p = null;
        $this->pin_p = null;
        $this->po_p = null;
        $this->ps_p = null;
        $this->address_p = null;

    }
    public function submitAll(){
        $this->validate($this->generalRules,$this->generalMessages);
        $this->validate($this->nomineeRule, $this->nomineeMessage);
        $this->validate($this->documentRule, $this->documentMessage, $this->documentAttributes);
        $this->validate($this->photoRules, $this->photoMessages);
        $this->validate($this->fingerRules, $this->fingerMessages);

        $worker = Registration::create([
            'operator_id' => auth()->user()->id,
            'system_id' => $this->getSystemID(),
            'name' => $this->name,
            'father' => $this->father,
            'mother' => $this->mother,
            'spouse' => $this->spouse,
            'gender' => $this->gender,
            'dob' => Carbon::createFromFormat('d/m/Y', $this->dob)->format('Y-m-d'),
            'marital' => $this->marital,
            'cast' => $this->cast,
            'tribe' => $this->tribe,
            'email' => $this->email,
            'phone' => $this->phone,
            'bg' => $this->bg,
            'city_t' => $this->city_t,
            'district_t' => $this->district_t,
            'state_t' => $this->state_t,
            'pin_t' => $this->pin_t,
            'po_t' => $this->po_t,
            'ps_t' => $this->ps_t,
            'address_t' => $this->address_t,
            'city_p' => $this->city_p,
            'district_p' => $this->district_p,
            'state_p' => $this->state_p,
            'pin_p' => $this->pin_p,
            'po_p' => $this->po_p,
            'ps_p' => $this->ps_p,
            'address_p' => $this->address_p,
            'aadhaar' => $this->aadhaar,
            'nature' => $this->nature,
            'serial' => $this->serial,
            'pf_no' => $this->pf_no,
            'serial_date' => $this->serial_date ? Carbon::createFromFormat('d/m/Y', $this->serial_date)->format('Y-m-d') : null,
            'doe' => $this->doe ? Carbon::createFromFormat('d/m/Y', $this->doe)->format('Y-m-d') : null,
            'dor' => $this->dor ? Carbon::createFromFormat('d/m/Y', $this->dor)->format('Y-m-d') : null,
            'turnover' => $this->turnover,
            'total_years' => $this->total_years,
            'est_name' => $this->est_name,
            'est_reg_no' => $this->est_reg_no,
            'est_address' => $this->est_address,
            'employer_name' => $this->employer_name,
            'employer_address' => $this->employer_address,
            'other_welfare' => $this->other_welfare,
            'welfare_name' => $this->welfare_name,
            'welfare_reg_no' => $this->welfare_reg_no,
            'more_bocw' => $this->more_bocw,
            'number_of_bocw' => $this->number_of_bocw,
            'primary_bocw' => $this->primary_bocw,
            'nominee' => $this->nominee,
            'relation' => $this->relation,
            'del' => 0
        ]);

        RegNominee::create([
            'worker_id' => $worker->id,
            'nominee_name1' => $this->nominee_name1,
            'nominee_dob1' => $this->nominee_dob1 ? Carbon::createFromFormat('d/m/Y', $this->nominee_dob1)->format('Y-m-d') : null,
            'nominee_relation1' => $this->nominee_relation1,
            'nominee_address1' => $this->nominee_address1,
            'nominee_name2' => $this->nominee_name2,
            'nominee_dob2' => $this->nominee_dob2 ? Carbon::createFromFormat('d/m/Y', $this->nominee_dob2)->format('Y-m-d') : null,
            'nominee_relation2' => $this->nominee_relation2,
            'nominee_address2' => $this->nominee_address2,
            'del' => 0
        ]);

        foreach($this->employers as $employer){
            RegEmployer::create([
                'worker_id' => $worker->id,
                'description' => $employer['employer_description'],
                'employer' => $employer['employer_name_address'],
                'nature_of_work' => $employer['employer_nature'],
                'img_path' => $employer['employer_document_name'],
            ]);
        }
        foreach($this->benefits as $benefit){
            RegBenefit::create([
                'worker_id' => $worker->id,
                'name' => $benefit['benefit_name'],
                'dob' => $benefit['benefit_date'] ? Carbon::createFromFormat('d/m/Y', $benefit['benefit_date'])->format('Y-m-d') : null,
                'amount' => $benefit['benefit_amount'],
                'cheque' => $benefit['benefit_cheque'],
                'bank' => $benefit['benefit_bank'],
            ]);
        }

        RegPhoto::create([
            'worker_id' => $worker->id,
            'img_path' => $this->photo_name
        ]);
        RegBiomatric::create([
            'worker_id' => $worker->id,
            'img_path' => $this->finger_name,
            'template' => $this->finger_template
        ]);

        $document_heads = DocumentHeads::whereDel(0)->orderBy('id')->get();
        foreach($document_heads as $index => $document_head){
            $document_id = array_key_exists($index,$this->documents) ? $this->documents[$index] : 999999;
            $img_path = array_key_exists($index,$this->uploaded_document_name) ? $this->uploaded_document_name[$index] : '';
            RegDocument::create([
                'worker_id' => $worker->id,
                'document_id' => $document_id,
                'img_path' => $img_path
            ]);
        }
        if(auth()->guard('admin')->check()){
            return redirect()->to(route('admin.workerEdit', ['id' => encrypt($worker->id), 'done' => 1]));
        }
        if(auth()->guard('district')->check()){
            return redirect()->to(route('district.workerEdit', ['id' => encrypt($worker->id), 'done' => 1]));
        }
        if(auth()->guard('operator')->check()){
            return redirect()->to(route('operator.workerEdit', ['id' => encrypt($worker->id), 'done' => 1]));
        }
        // session()->flash('message', 'Worker Registration Complete');
        // $this->dispatch('move-to-finish');
    }
    public function edit(int $id){
        $table = Registration::where('id', $id)->first();
        if($table){
            $this->id = $table->id;
            $this->system_id = $table->system_id;
            $this->name = $table->name;
            $this->father = $table->father;
            $this->mother = $table->mother;
            $this->spouse = $table->spouse;
            $this->gender = $table->gender;
            $this->dob = $table->dob ? Carbon::parse($table->dob)->format('d/m/Y') : null;
            $this->marital = $table->marital;
            $this->cast = $table->cast;
            $this->tribe = $table->tribe;
            $this->email = $table->email;
            $this->phone = $table->phone;
            $this->bg = $table->bg;
            $this->city_t = $table->city_t;
            $this->state_t = $table->state_t;
            $this->state_change_t();
            $this->district_t = $table->district_t;
            $this->pin_t = $table->pin_t;
            $this->po_t = $table->po_t;
            $this->ps_t = $table->ps_t;
            $this->address_t = $table->address_t;
            $this->city_p = $table->city_p;
            $this->state_p = $table->state_p;
            $this->state_change_p();
            $this->district_p = $table->district_p;
            $this->pin_p = $table->pin_p;
            $this->po_p = $table->po_p;
            $this->ps_p = $table->ps_p;
            $this->address_p = $table->address_p;
            $this->aadhaar = $table->aadhaar;
            $this->nature = $table->nature;
            $this->serial = $table->serial;
            $this->pf_no = $table->pf_no;
            $this->serial_date = $table->serial_date ? Carbon::parse($table->serial_date)->format('d/m/Y') : null;
            $this->doe = $table->doe ? Carbon::parse($table->doe)->format('d/m/Y') : null;
            $this->dor = $table->dor ? Carbon::parse($table->dor)->format('d/m/Y') : null;
            $this->turnover = $table->turnover;
            $this->total_years = $table->total_years;
            $this->est_name = $table->est_name;
            $this->est_reg_no = $table->est_reg_no;
            $this->est_address = $table->est_address;
            $this->employer_name = $table->employer_name;
            $this->employer_address = $table->employer_address;
            $this->other_welfare = $table->other_welfare;
            $this->welfare_name = $table->welfare_name;
            $this->welfare_reg_no = $table->welfare_reg_no;
            $this->more_bocw = $table->more_bocw;
            $this->number_of_bocw = $table->number_of_bocw;
            $this->primary_bocw = $table->primary_bocw;
            $this->nominee = $table->nominee;
            $this->relation = $table->relation;
            $this->approval = $table->approval;
        }else{
            return abort(404, 'Not found');
        }

        $nominee = RegNominee::where('worker_id', $this->id)->whereDel(0)->first();
        if($nominee){
            $this->nominee_name1 = $nominee->nominee_name1;
            $this->nominee_dob1 = $nominee->nominee_dob1 ? Carbon::parse($nominee->nominee_dob1)->format('d/m/Y') : null;
            $this->nominee_relation1 = $nominee->nominee_relation1;
            $this->nominee_address1 = $nominee->nominee_address1;
            $this->nominee_name2 = $nominee->nominee_name2;
            $this->nominee_dob2 = $nominee->nominee_dob2 ? Carbon::parse($nominee->nominee_dob2)->format('d/m/Y') : null;
            $this->nominee_relation2 = $nominee->nominee_relation2;
            $this->nominee_address2 = $nominee->nominee_address2;
        }

        foreach(RegEmployer::where('worker_id', $this->id)->whereDel(0)->get() as $employer){
            array_push($this->employers, [
                'employer_description' => $employer->description,
                'employer_name_address' => $employer->employer,
                'employer_nature' => $employer->nature_of_work,
                'employer_document_name' => $employer->img_path,
            ]);
        }
        foreach(RegBenefit::where('worker_id', $this->id)->whereDel(0)->get() as $benefit){
            array_push($this->benefits, [
                'benefit_name' => $benefit->name,
                'benefit_date' => $benefit->dob ? Carbon::parse($benefit->dob)->format('d/m/Y') : null,
                'benefit_amount' => $benefit->amount,
                'benefit_cheque' => $benefit->cheque,
                'benefit_bank' => $benefit->bank,
            ]);
        }
        
        $photo = RegPhoto::where('worker_id', $this->id)->orderBy('id', 'DESC')->first();
        if($photo){
            $this->photo_name = $photo->img_path;
        }
        
        $finger = RegBiomatric::where('worker_id', $this->id)->orderBy('id', 'DESC')->first();
        if($finger){
            $this->finger_name = $finger->img_path;
            $this->finger_template = $finger->emplate;
        }

        $documents = RegDocument::where('worker_id', $this->id)->orderBy('document_id')->whereDel(0)->get();
        foreach($documents as $index => $document){
            $this->documents[$index] = $document->document_id;
            $this->uploaded_document_name[$index] = $document->img_path;
        }

        $approval = Rejection::where('worker_id', $this->id)->whereDel(0)->first();
        if($approval){
            $this->rejection_reason = $approval->reason;
        }

    }
    public function updateAll()
    {
        
        $this->validate($this->generalRules,$this->generalMessages);
        $this->validate($this->documentRule, $this->documentMessage, $this->documentAttributes);

        $update = Registration::where('id', $this->id);
        $update->update([
            'name' => $this->name,
            'father' => $this->father,
            'mother' => $this->mother,
            'spouse' => $this->spouse,
            'gender' => $this->gender,
            'dob' => Carbon::createFromFormat('d/m/Y', $this->dob)->format('Y-m-d'),
            'marital' => $this->marital,
            'cast' => $this->cast,
            'tribe' => $this->tribe,
            'email' => $this->email,
            'phone' => $this->phone,
            'bg' => $this->bg,
            'city_t' => $this->city_t,
            'district_t' => $this->district_t,
            'state_t' => $this->state_t,
            'pin_t' => $this->pin_t,
            'po_t' => $this->po_t,
            'ps_t' => $this->ps_t,
            'address_t' => $this->address_t,
            'city_p' => $this->city_p,
            'district_p' => $this->district_p,
            'state_p' => $this->state_p,
            'pin_p' => $this->pin_p,
            'po_p' => $this->po_p,
            'ps_p' => $this->ps_p,
            'address_p' => $this->address_p,
            'aadhaar' => $this->aadhaar,
            'nature' => $this->nature,
            'serial' => $this->serial,
            'pf_no' => $this->pf_no,
            'serial_date' => $this->serial_date ? Carbon::createFromFormat('d/m/Y', $this->serial_date)->format('Y-m-d') : null,
            'doe' => $this->doe ? Carbon::createFromFormat('d/m/Y', $this->doe)->format('Y-m-d') : null,
            'dor' => $this->dor ? Carbon::createFromFormat('d/m/Y', $this->dor)->format('Y-m-d') : null,
            'turnover' => $this->turnover,
            'total_years' => $this->total_years,
            'est_name' => $this->est_name,
            'est_reg_no' => $this->est_reg_no,
            'est_address' => $this->est_address,
            'employer_name' => $this->employer_name,
            'employer_address' => $this->employer_address,
            'other_welfare' => $this->other_welfare,
            'welfare_name' => $this->welfare_name,
            'welfare_reg_no' => $this->welfare_reg_no,
            'more_bocw' => $this->more_bocw,
            'number_of_bocw' => $this->number_of_bocw,
            'primary_bocw' => $this->primary_bocw,
            'nominee' => $this->nominee,
            'relation' => $this->relation,
        ]);
        RegNominee::where('worker_id', $this->id)->update([
            'del' => 1
        ]);
        RegNominee::create([
            'worker_id' => $this->id,
            'nominee_name1' => $this->nominee_name1,
            'nominee_dob1' => $this->nominee_dob1 ? Carbon::createFromFormat('d/m/Y', $this->nominee_dob1)->format('Y-m-d') : null,
            'nominee_relation1' => $this->nominee_relation1,
            'nominee_address1' => $this->nominee_address1,
            'nominee_name2' => $this->nominee_name2,
            'nominee_dob2' => $this->nominee_dob2 ? Carbon::createFromFormat('d/m/Y', $this->nominee_dob2)->format('Y-m-d') : null,
            'nominee_relation2' => $this->nominee_relation2,
            'nominee_address2' => $this->nominee_address2,
            'del' => 0
        ]);

        RegEmployer::where('worker_id', $this->id)->whereDel(0)->update(['del' => 1]);
        foreach($this->employers as $employer){
            RegEmployer::create([
                'worker_id' => $this->id,
                'description' => $employer['employer_description'],
                'employer' => $employer['employer_name_address'],
                'nature_of_work' => $employer['employer_nature'],
                'img_path' => $employer['employer_document_name'],
            ]);
        }

        RegBenefit::where('worker_id', $this->id)->whereDel(0)->update(['del' => 1]);
        foreach($this->benefits as $benefit){
            RegBenefit::create([
                'worker_id' => $this->id,
                'name' => $benefit['benefit_name'],
                'dob' => $benefit['benefit_date'] ? Carbon::createFromFormat('d/m/Y', $benefit['benefit_date'])->format('Y-m-d') : null,
                'amount' => $benefit['benefit_amount'],
                'cheque' => $benefit['benefit_cheque'],
                'bank' => $benefit['benefit_bank'],
            ]);
        }
        if(!RegPhoto::where('worker_id', $this->id)->where('img_path',$this->photo_name)->exists()){
            RegPhoto::create([
                'worker_id' => $this->id,
                'img_path' => $this->photo_name
            ]);
        }
        if(!RegBiomatric::where('worker_id', $this->id)->where('img_path',$this->finger_name)->exists()){
            RegBiomatric::create([
                'worker_id' => $this->id,
                'img_path' => $this->finger_name,
                'template' => $this->finger_template
            ]);
        }

        $document_heads = DocumentHeads::whereDel(0)->orderBy('id')->get();
        foreach($document_heads as $index => $document_head){
            $document_id = array_key_exists($index,$this->documents) ? $this->documents[$index] : 999999;
            $img_path = array_key_exists($index,$this->uploaded_document_name) ? $this->uploaded_document_name[$index] : '';
            if(!RegDocument::where('worker_id', $this->id)
                ->where('img_path',$img_path)
                ->exists() && $img_path != ''){

                    $head_id = $document_head->id;
                    RegDocument::where('worker_id', $this->id)
                    ->whereIn('document_id', function($q) use ($head_id){
                        $q->select('id')->from('documents')->where('head_id', $head_id);
                    })
                    ->whereDel(0)
                    ->update(['del' => 1]);

                    RegDocument::create([
                        'worker_id' => $this->id,
                        'document_id' => $document_id,
                        'img_path' => $img_path
                    ]);
            }
        }
        if(auth()->guard('admin')->check()){
            return redirect()->to(route('admin.workerEdit', ['id' => encrypt($this->id), 'edit' => 1]));
        }
        if(auth()->guard('district')->check()){
            return redirect()->to(route('district.workerEdit', ['id' => encrypt($this->id), 'edit' => 1]));
        }
        if(auth()->guard('operator')->check()){
            return redirect()->to(route('operator.workerEdit', ['id' => encrypt($this->id), 'edit' => 1]));
        }

        // session()->flash('message', 'Worker Registration Complete');
        // $this->dispatch('move-to-finish');
    }
    public function delete(int $id){
        $this->id = $id;
    }

    public function sendsms(){
        if(!$this->id){
            return;
        }
        $name = substr($this->name, 0, 18);

        $sms = new SMS();
        $sms->phone($this->phone);
        $sms->message("Dear {$name}, your worker registration for APB&OCWWB submitted. Acknowledgement no: {$this->system_id}. You'll be notified after verification - TR INFRA");
        $sms->templet('1707174299382719181');
        $sms->send();

        $this->smsreply = $sms->reply();
    }
    public function approveWorker(){
        if(!$this->id){
            return;
        }
        $this->validate([
            'approvalChecked' => 'required|accepted'
        ],[
            'approvalChecked' => 'Consent require, please tick the check box'
        ]);

        Rejection::where('worker_id', $this->id)->update([
            'del' => 1
        ]);

        Registration::where('id', $this->id)->update([
            'approval' => 1
        ]);

        $this->approval = 1;
        
    }
    public function rejectWorker(){
        if(!$this->id){
            return;
        }
        $this->validate([
            'rejection_reason' => 'required|min:5'
        ]);
        
        Rejection::where('worker_id', $this->id)->update([
            'del' => 1
        ]);
        Registration::where('id', $this->id)->update([
            'approval' => 2
        ]);

        $rejection = new Rejection();
        $rejection->worker_id = $this->id;
        $rejection->rejected_by = 'RO';
        $rejection->district_id = auth()->user()->id;
        $rejection->reason = $this->rejection_reason;
        $rejection->save();

        $this->approval = 2;
        
    }
    private function getSystemID(){
        // $number = time(); 
        // $isUsed =  Registration::where('system_id', $number)->first();
        // if ($isUsed) {
        //     return $this->getSystemID();
        // }
        // return $number;
        $ro = [];
        if(auth()->guard('admin')->check()){
            return $this->nextID('XXX-XXX-', 'id');
        }
        if(auth()->guard('district')->check()){
            $ro = District::where('id', auth()->user()->id)->first();
        }
        if(auth()->guard('operator')->check()){
            $ro = District::where('id', auth()->user()->district_id)->first();
        }
        $ro_code = $ro->ro_code;
        return $this->nextID('APB&OCWWB/' . $ro_code. '/', 'system_id');
    }
    private function nextID($prefix,$idno,$start = 1) {
        $row = Registration::select(DB::raw("max( cast( right( ".$idno.", length( ".$idno." ) -".strlen($prefix).") AS signed ) ) as id"))
        ->whereLike('system_id', $prefix.'%')
        ->first();
        $NewId = $row->id == 0 ? $start : $row->id + 1;
        return $prefix . str_pad($NewId, 6, '0', STR_PAD_LEFT);
    }
    public function render()
    {
        $state_names = StateDistricts::select('state_name')->orderBy('state_name')->distinct()->get();
        $document_heads = DocumentHeads::whereDel(0)->orderBy('id')->get();
        $benefit_names = Benefit::whereDel(0)->orderBy('name')->get();
        $renewals = Renewals::where('worker_id', $this->id)->whereDel(0)->first();
        $sys_id = $this->getSystemID();
        return view('livewire.create-worker', compact('document_heads', 'state_names', 'benefit_names', 'renewals', 'sys_id'));
    }
}

// ALTER TABLE `registration` ADD `total_years` INT NULL DEFAULT NULL AFTER `turnover`, ADD `est_name` VARCHAR(225) NULL DEFAULT NULL AFTER `total_years`, ADD `est_reg_no` VARCHAR(100) NULL DEFAULT NULL AFTER `est_name`, ADD `est_address` VARCHAR(225) NULL DEFAULT NULL AFTER `est_reg_no`, ADD `employer_name` VARCHAR(150) NULL DEFAULT NULL AFTER `est_address`, ADD `employer_address` VARCHAR(225) NULL DEFAULT NULL AFTER `employer_name`, ADD `other_welfare` VARCHAR(5) NULL DEFAULT NULL AFTER `employer_address`, ADD `welfare_name` VARCHAR(255) NULL DEFAULT NULL AFTER `other_welfare`, ADD `welfare_reg_no` VARCHAR(100) NULL DEFAULT NULL AFTER `welfare_name`;
// ALTER TABLE `reg_nominee` ADD `nominee_address1` VARCHAR(225) NULL DEFAULT NULL AFTER `nominee_relation1`, ADD `nominee_address2` VARCHAR(225) NULL DEFAULT NULL AFTER `nominee_relation2`; 
