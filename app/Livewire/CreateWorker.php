<?php

namespace App\Livewire;

use App\Models\DistrictNames;
use App\Models\RegBenefit;
use App\Models\RegBiomatric;
use App\Models\RegDocument;
use App\Models\RegEmployer;
use App\Models\RegFamily;
use App\Models\RegNominee;
use App\Models\RegPhoto;
use App\Models\Rejection;
use App\SMS;
use Livewire\WithFileUploads;
use App\Models\DocumentHeads;
use App\Models\Registration;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;


class CreateWorker extends Component
{
    use WithFileUploads;

    public $id, $system_id, $name, $father, $mother, $spouse, $gender, $dob, $marital, $cast, $tribe, $email, $phone, $bg,
    $city_t, $district_t, $state_t, $pin_t, $po_t, $ps_t, $address_t, 
    $city_p, $district_p, $state_p, $pin_p, $po_p, $ps_p, $address_p, 
    $aadhaar, $nature, $serial, $doe, $dor, $turnover, 
    $total_years, $est_name, $est_reg_no, $est_address, $employer_name, $employer_address, $other_welfare, $welfare_name, $welfare_reg_no,
    $nominee, $relation, $del;

    public $edit_mode = false;
    public bool $same_address = false;

    public $family_member_name, $family_member_age, $family_member_relation;

    public $nominee_name1, $nominee_dob1, $nominee_relation1, $nominee_address1, $nominee_name2, $nominee_dob2, $nominee_relation2, $nominee_address2;

    public $employer_description, $employer_name_address, $employer_nature, $employer_document, $employer_document_name;
    public $employers = [];
    
    public $benefit_name, $benefit_date, $benefit_amount, $benefit_cheque, $benefit_bank;
    public $benefits = [];

    public $documents = [];
    public $uploaded_documents = [];

    public $uploaded_document_name = [];

    public $photo, $photo_name;

    public $finger_captured, $finger, $finger_name, $finger_template;
    
    public $documentRule = [], $documentMessage = [], $documentAttributes = [];

    public $smsreply;

    public $approval, $approvalChecked, $rejection_reason;

    public function mount($worker_id = null)
    {
        if($worker_id){
            $this->edit_mode = true;
            $this->edit($worker_id);
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
        $this->dispatch('move-to-benefits');
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
        $this->dispatch('move-to-photo');
    }
    public function removeEmployers($index){
        array_splice($this->employers, $index, 1);
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
        'pin_t' => 'nullable|digits:6',
        'pin_p' => 'nullable|digits:6',
        'aadhaar' => 'required|digits:12',
        'doe' => 'nullable|date_format:d/m/Y',
        'dor' => 'nullable|date_format:d/m/Y',
        'turnover' => 'nullable|numeric',
        'other_welfare' => 'nullable|in:yes,no',
        'welfare_name' => 'required_if:other_welfare,yes|max:225',
        'welfare_reg_no' => 'required_if:other_welfare,yes|max:100',
    ];
    private $generalMessages = [
        'dob.date_format' => 'Must match the format DD/MM/YYYY',
        'doe.date_format' => 'Must match the format DD/MM/YYYY',
        'dor.date_format' => 'Must match the format DD/MM/YYYY',
        'other_welfare' => 'Select yes or no',
    ];
    public function generalValidate() 
    {
        $this->validate($this->generalRules,$this->generalMessages);

        session()->flash('message', 'Worker General Complete');
        $this->dispatch('move-to-family');
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
        session()->flash('message', 'Worker Registration Complete');
        $this->dispatch('move-to-finish');
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
            $this->district_t = $table->district_t;
            $this->state_t = $table->state_t;
            $this->pin_t = $table->pin_t;
            $this->po_t = $table->po_t;
            $this->ps_t = $table->ps_t;
            $this->address_t = $table->address_t;
            $this->city_p = $table->city_p;
            $this->district_p = $table->district_p;
            $this->state_p = $table->state_p;
            $this->pin_p = $table->pin_p;
            $this->po_p = $table->po_p;
            $this->ps_p = $table->ps_p;
            $this->address_p = $table->address_p;
            $this->aadhaar = $table->aadhaar;
            $this->nature = $table->nature;
            $this->serial = $table->serial;
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

        session()->flash('message', 'Worker Registration Complete');
        $this->dispatch('move-to-finish');
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
        $number = time(); 
        $isUsed =  Registration::where('system_id', $number)->first();
        if ($isUsed) {
            return $this->getSystemID();
        }
        return $number;
    }
    public function render()
    {
        $district_names = DistrictNames::orderBy('name')->get();
        $document_heads = DocumentHeads::whereDel(0)->orderBy('id')->get();
        return view('livewire.create-worker', compact('document_heads','district_names'));
    }
}

// ALTER TABLE `registration` ADD `total_years` INT NULL DEFAULT NULL AFTER `turnover`, ADD `est_name` VARCHAR(225) NULL DEFAULT NULL AFTER `total_years`, ADD `est_reg_no` VARCHAR(100) NULL DEFAULT NULL AFTER `est_name`, ADD `est_address` VARCHAR(225) NULL DEFAULT NULL AFTER `est_reg_no`, ADD `employer_name` VARCHAR(150) NULL DEFAULT NULL AFTER `est_address`, ADD `employer_address` VARCHAR(225) NULL DEFAULT NULL AFTER `employer_name`, ADD `other_welfare` VARCHAR(5) NULL DEFAULT NULL AFTER `employer_address`, ADD `welfare_name` VARCHAR(255) NULL DEFAULT NULL AFTER `other_welfare`, ADD `welfare_reg_no` VARCHAR(100) NULL DEFAULT NULL AFTER `welfare_name`;
// ALTER TABLE `reg_nominee` ADD `nominee_address1` VARCHAR(225) NULL DEFAULT NULL AFTER `nominee_relation1`, ADD `nominee_address2` VARCHAR(225) NULL DEFAULT NULL AFTER `nominee_relation2`; 
