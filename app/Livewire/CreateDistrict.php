<?php

namespace App\Livewire;

use App\Models\District;
use App\Models\DistrictNames;
use App\Models\StateDistricts;
use Livewire\WithPagination;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class CreateDistrict extends Component
{
    use WithPagination;

    public $id, $district_id, $ro_code, $name, $contact_person, $designation, $email, $phone, $state, $address, $pin, $username, $password, $del;
 
    public $search = '';

    public function save() 
    {
        $this->validate([
            'name' => 'required',
            'district_id' => 'required',
            'ro_code' => 'required|min:3|max:3|unique:districts,ro_code',
            'email' => 'nullable|email',
            'phone' => 'nullable|digits:10',
            'username' => 'required|alpha_num|min:5|max:20|unique:districts',
            'password' => 'required|min:6',
        ]);

        $create = District::create([
            'name' => $this->name,
            'district_id' => $this->district_id,
            'ro_code' => strtoupper($this->ro_code),
            'contact_person' => $this->contact_person,
            'designation' => $this->designation,
            'email' => $this->email,
            'phone' => $this->phone,
            'state' => $this->state,
            'address' => $this->address,
            'pin' => $this->pin,
            'username' => $this->username,
            'password' => $this->password,
            'del' => 0
        ]);

        session()->flash('message', 'District Created');
        $this->resetVals();
        $this->dispatch('close-modal');
    }
    public function edit(int $id){
        $table = District::where('id', $id)->first();
        if($table){
            $this->id = $table->id;
            $this->name = $table->name;
            $this->district_id = $table->district_id;
            $this->ro_code = $table->ro_code;
            $this->contact_person = $table->contact_person;
            $this->designation = $table->designation;
            $this->email = $table->email;
            $this->phone = $table->phone;
            $this->state = $table->state;
            $this->address = $table->address;
            $this->pin = $table->pin;
            $this->username = $table->username;
        }else{
            return abort(404, 'Not found');
        }
    }
    public function update()
    {
        $this->validate([
            'name' => 'required',
            'district_id' => 'required',
            'ro_code' => 'required|min:3|max:3|unique:districts,ro_code,'.$this->id,
            'email' => 'nullable|email',
            'phone' => 'nullable|digits:10',
            'username' => 'required|alpha_num|min:5|max:20|unique:districts,username,'.$this->id,
        ]);

        $update = District::where('id', $this->id);
        $update->update([
            'name' => $this->name,
            'district_id' => $this->district_id,
            'ro_code' => strtoupper($this->ro_code),
            'contact_person' => $this->contact_person,
            'designation' => $this->designation,
            'email' => $this->email,
            'phone' => $this->phone,
            'state' => $this->state,
            'address' => $this->address,
            'pin' => $this->pin,
            'username' => $this->username,
        ]);

        if($this->password){
            $this->validate([
                'password' => 'required|min:6',
            ]);
            $update->update([
                'password' => Hash::make($this->password),
            ]);
        }

        session()->flash('message', 'District Updated');
        $this->resetVals();
        $this->dispatch('close-modal');
    }
    public function delete(int $id){
        $this->id = $id;
    }
    public function destroy(){
        $delete = District::where('id',$this->id)->update([
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
        $this->id = null;
        $this->name = null;
        $this->district_id = null;
        $this->ro_code = null;
        $this->contact_person = null;
        $this->designation = null;
        $this->email = null;
        $this->phone = null;
        $this->state = null;
        $this->address = null;
        $this->pin = null;
        $this->username = null;
        $this->password = null;
    }
    public function render()
    {
        $items = District::when($this->search, function($q){
            return $q->where('name', 'like', '%'.$this->search.'%')->orWhere('contact_person', 'like', '%'.$this->search.'%');
        })
        ->whereDel(0)
        ->paginate(10);

        $district_names = StateDistricts::where('state_code', 12)->orderBy('district_name')->get();

        return view('livewire.create-district',compact('items', 'district_names'));
    }
}
