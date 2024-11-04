<?php

namespace App\Livewire;

use App\Models\Registration;
use Carbon\Carbon;
use Livewire\Component;

class CreateWorker extends Component
{

    public $id, $system_id, $name, $father, $mother, $spouse, $gender, $dob, $cast, $tribe, $email, $phone, $city_t, $district_t, $state_t, $pin_t, $address_t, $city_p, $district_p, $state_p, $pin_p, $address_p, $nature, $serial, $doe, $dor, $turnover, $nominee, $relation, $del;

    public function generalSave() 
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

        $create = Registration::create([
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

        session()->flash('message', 'Worker Created');
        $this->resetVals();
        $this->dispatch('move-to-family');
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
        return view('livewire.create-worker');
    }
}
