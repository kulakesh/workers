<?php

namespace App\Livewire;

use App\Models\RegBiomatric;
use App\Models\RegDocument;
use App\Models\RegEmployer;
use App\Models\RegFamily;
use App\Models\RegPhoto;
use Livewire\WithFileUploads;
use App\Models\DocumentHeads;
use App\Models\Registration;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;


class CreateWorker extends Component
{
    use WithFileUploads;

    public $id, $system_id, $name, $father, $mother, $spouse, $gender, $dob, $cast, $tribe, $email, $phone, $city_t, $district_t, $state_t, $pin_t, $address_t, $city_p, $district_p, $state_p, $pin_p, $address_p, $nature, $serial, $doe, $dor, $turnover, $nominee, $relation, $del;

    public bool $same_address = false;

    public $family_member_name, $family_member_age, $family_member_relation;
    public $family_members = [];

    public $employer_description, $employer_name_address, $employer_nature;
    public $employers = [];

    public $documents = [];
    public $uploaded_documents = [];

    public $uploaded_document_name = [];

    public $photo, $photo_name;

    public $finger, $finger_name, $finger_template;
    
    public $documentRule = [], $documentMessage = [], $documentAttributes = [];
    public function mount($worker_id = null)
    {
        $document_heads = DocumentHeads::whereDel(0)->orderBy('id')->get();
        foreach($document_heads as $index => $document_head){
            if($document_head->type == 'required') {
                $this->documentRule['documents.'.$index] = 'required';
                $this->documentMessage['documents.'.$index] = $document_head->name.' is required';
            }
            $this->documentRule['uploaded_documents.'.$index] = ($document_head->type == 'required' ? 'required|' : '') . 'mimes:jpeg,png,pdf|max:1024';
            $this->documentMessage['uploaded_documents.'.$index.'.required'] = 'Select document for '. $document_head->name;
            $this->documentMessage['uploaded_documents.'.$index.'.mimes'] = 'Only jpeg,png,pdf';
            $this->documentAttributes['uploaded_documents.'.$index] = $document_head->name;
        }

        if($worker_id){
            $this->edit($worker_id);
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
        $this->validate($this->fingerRules, $this->fingerMessages);
        if($this->finger != 'testing'){
            $this->finger_name = hexdec(uniqid()).'.png';
            $data = base64_decode($this->finger);
            Storage::disk('public')->put('biometric/'.$this->finger_name, $data);
        }else{
            $this->finger_name = 'do-not-delete-finger.png';
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
        
        $this->validate($this->photoRules, $this->photoMessages);
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

        Storage::disk('public')->put('photo/'.$this->photo_name, $data);

        session()->flash('message', 'Worker Photo Capture Complete');
        $this->dispatch('move-to-biometric');
    }
    public function validateDocuments(){
        $this->validate($this->documentRule, $this->documentMessage, $this->documentAttributes);
        
        $this->uploaded_document_name = [];
        foreach($this->uploaded_documents as $index => $uploaded_document){
            $this->uploaded_document_name[$index] = hexdec(uniqid()).'.'.$uploaded_document->getClientOriginalExtension();
            $uploaded_document->storeAs('document/', $this->uploaded_document_name[$index], 'public');
        }

        session()->flash('message', 'Worker Document Upload Complete');
        $this->dispatch('move-to-review');
    }

    private $employerRule = [
        'employer_description' => 'required',
        'employer_name_address' => 'required',
        'employer_nature' => 'required',
    ];
    public function addEmployers(){
        $this->validate($this->employerRule);

        array_push($this->employers, [
            'employer_description' => $this->employer_description,
            'employer_name_address' => $this->employer_name_address,
            'employer_nature' => $this->employer_nature,
        ]);

        $this->employer_description = null;
        $this->employer_name_address = null;
        $this->employer_nature = null;
    }
    public function submitEmployers(){
        session()->flash('message', 'Worker Employer Complete');
        $this->dispatch('move-to-photo');
    }
    public function removeEmployers($index){
        array_splice($this->employers, $index, 1);
    }

    private $familyRule = [
        'family_member_name' => 'required',
        'family_member_age' => 'required|numeric',
        'family_member_relation' => 'required',
    ];
    public function addFamilyMember(){
        $this->validate($this->familyRule);
        array_push($this->family_members, [
            'family_member_name' => $this->family_member_name,
            'family_member_age' => $this->family_member_age,
            'family_member_relation' => $this->family_member_relation,
        ]);

        $this->family_member_name = null;
        $this->family_member_age = null;
        $this->family_member_relation = null;

    }
    public function submitFamilyMember(){
        session()->flash('message', 'Worker Family Complete');
        $this->dispatch('move-to-employer');
    }
    public function removeFamilyMember($index){
        array_splice($this->family_members, $index, 1);
    }
    private $generalRules = [
        'name' => 'required',
        'gender' => 'required|in:Male,Female,Other',
        'dob' => 'required|date_format:d/m/Y',
        'email' => 'nullable|email',
        'phone' => 'nullable|digits:10',
        'pin_t' => 'nullable|digits:6',
        'pin_p' => 'nullable|digits:6',
        'doe' => 'nullable|date_format:d/m/Y',
        'dor' => 'nullable|date_format:d/m/Y',
        'turnover' => 'nullable|numeric'
    ];
    private $generalMessages = [
        'dob.date_format' => 'Must match the format DD/MM/YYYY',
        'doe.date_format' => 'Must match the format DD/MM/YYYY',
        'dor.date_format' => 'Must match the format DD/MM/YYYY'
    ];
    public function generalValidate() 
    {
        $this->validate($this->generalRules,$this->generalMessages);

        session()->flash('message', 'Worker General Complete');
        // $this->resetVals();
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
        $this->address_p = $this->address_t;

    }

    public function notSame()
    {
        $this->city_p = null;
        $this->district_p = null;
        $this->state_p = null;
        $this->pin_p = null;
        $this->address_p = null;

    }
    public function submitAll(){
        $this->validate($this->generalRules,$this->generalMessages);
        // $this->validate($this->familyRule);
        // $this->validate($this->employerRule);
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
            'cast' => $this->cast,
            'tribe' => $this->tribe,
            'email' => $this->email,
            'phone' => $this->phone,
            'city_t' => $this->city_t,
            'district_t' => $this->district_t,
            'state_t' => $this->state_t,
            'pin_t' => $this->pin_t,
            'address_t' => $this->address_t,
            'city_p' => $this->city_p,
            'district_p' => $this->district_p,
            'state_p' => $this->state_p,
            'pin_p' => $this->pin_p,
            'address_p' => $this->address_p,
            'nature' => $this->nature,
            'serial' => $this->serial,
            'doe' => $this->doe ? Carbon::createFromFormat('d/m/Y', $this->doe)->format('Y-m-d') : null,
            'dor' => $this->dor ? Carbon::createFromFormat('d/m/Y', $this->dor)->format('Y-m-d') : null,
            'turnover' => $this->turnover,
            'nominee' => $this->nominee,
            'relation' => $this->relation,
            'del' => 0
        ]);

        foreach($this->family_members as $family_member){
            RegFamily::create([
                'worker_id' => $worker->id,
                'name' => $family_member['family_member_name'],
                'age' => $family_member['family_member_age'],
                'relation' => $family_member['family_member_relation'],
            ]);
        }
        foreach($this->employers as $employer){
            RegEmployer::create([
                'worker_id' => $worker->id,
                'description' => $employer['employer_description'],
                'employer' => $employer['employer_name_address'],
                'nature_of_work' => $employer['employer_nature'],
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
        // $this->resetVals();
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
            $this->dob = $table->dob;
            $this->cast = $table->cast;
            $this->tribe = $table->tribe;
            $this->email = $table->email;
            $this->phone = $table->phone;
            $this->city_t = $table->city_t;
            $this->district_t = $table->district_t;
            $this->state_t = $table->state_t;
            $this->pin_t = $table->pin_t;
            $this->address_t = $table->address_t;
            $this->city_p = $table->city_p;
            $this->district_p = $table->district_p;
            $this->state_p = $table->state_p;
            $this->pin_p = $table->pin_p;
            $this->address_p = $table->address_p;
            $this->nature = $table->nature;
            $this->serial = $table->serial;
            $this->doe = $table->doe;
            $this->dor = $table->dor;
            $this->turnover = $table->turnover;
            $this->nominee = $table->nominee;
            $this->relation = $table->relation;
        }else{
            return abort(404, 'Not found');
        }

        foreach(RegFamily::where('worker_id', $this->id)->get() as $family){
            array_push($this->family_members, [
                'family_member_name' => $family->name,
                'family_member_age' => $family->age,
                'family_member_relation' => $family->relation,
            ]);
        }
        foreach(RegEmployer::where('worker_id', $this->id)->get() as $employer){
            array_push($this->employers, [
                'employer_description' => $employer->description,
                'employer_name_address' => $employer->employer,
                'employer_nature' => $employer->nature_of_work,
            ]);
        }
    }
    public function generalUpdate()
    {
        $this->validate([
            'name' => 'required',
            'gender' => 'required|in:Male,Female,Other',
            'dob' => 'required|date_format:d/m/Y',
            'email' => 'nullable|email',
            'phone' => 'nullable|digits:10',
            'pin_t' => 'nullable|digits:6',
            'pin_p' => 'nullable|digits:6',
            'doe' => 'nullable|date_format:d/m/Y',
            'dor' => 'nullable|date_format:d/m/Y',
            'turnover' => 'nullable|numeric'
        ]);

        $update = Registration::where('id', $this->id);
        $update->update([
            'designation' => $this->designation,
            'name' => $this->name,
            'father' => $this->father,
            'mother' => $this->mother,
            'spouse' => $this->spouse,
            'gender' => $this->gender,
            'dob' => $this->dob,
            'cast' => $this->cast,
            'tribe' => $this->tribe,
            'email' => $this->email,
            'phone' => $this->phone,
            'city_t' => $this->city_t,
            'district_t' => $this->district_t,
            'state_t' => $this->state_t,
            'pin_t' => $this->pin_t,
            'address_t' => $this->address_t,
            'city_p' => $this->city_p,
            'district_p' => $this->district_p,
            'state_p' => $this->state_p,
            'pin_p' => $this->pin_p,
            'address_p' => $this->address_p,
            'nature' => $this->nature,
            'serial' => $this->serial,
            'doe' => $this->doe,
            'dor' => $this->dor,
            'turnover' => $this->turnover,
            'nominee' => $this->nominee,
            'relation' => $this->relation
        ]);

        session()->flash('message', 'Worker Updated');
        $this->resetVals();
        $this->dispatch('close-modal');
    }
    public function delete(int $id){
        $this->id = $id;
    }
    public function destroy(){
        $delete = Registration::where('id',$this->id)->update([
            "del" => 1
        ]);
        session()->flash('message', 'Record Deleted');
        $this->resetVals();
        $this->dispatch('close-modal');
    }
    public function closeModal()
    {
        $this->resetVals();
    }
    public function resetVals(){
        $this->system_id = null;
        $this->name = null;
        $this->father = null;
        $this->mother = null;
        $this->spouse = null;
        $this->gender = null;
        $this->dob = null;
        $this->cast = null;
        $this->tribe = null;
        $this->email = null;
        $this->phone = null;
        $this->city_t = null;
        $this->district_t = null;
        $this->state_t = null;
        $this->pin_t = null;
        $this->address_t = null;
        $this->city_p = null;
        $this->district_p = null;
        $this->state_p = null;
        $this->pin_p = null;
        $this->address_p = null;
        $this->nature = null;
        $this->serial = null;
        $this->doe = null;
        $this->dor = null;
        $this->turnover = null;
        $this->nominee = null;
        $this->relation = null;
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
        $document_heads = DocumentHeads::whereDel(0)->orderBy('id')->get();
        return view('livewire.create-worker', compact('document_heads'));
    }
}
