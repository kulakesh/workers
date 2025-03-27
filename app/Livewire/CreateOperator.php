<?php

namespace App\Livewire;

use App\Models\Operator;
use Livewire\WithPagination;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class CreateOperator extends Component
{
    use WithPagination;

    public $id, $name, $designation, $email, $phone, $state, $address, $pin, $username, $password, $del;
 
    public $search = '';

    public function save() 
    {
        $this->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'phone' => 'nullable|digits:10',
            'username' => 'required|alpha_num|min:5|max:20|unique:operators',
            'password' => 'required|min:6',
        ]);

        $create = Operator::create([
            'district_id' => auth()->user()->id,
            'name' => $this->name,
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

        session()->flash('message', 'Operator Created');
        $this->resetVals();
        $this->dispatch('close-modal');
    }
    public function edit(int $id){
        $table = Operator::where('id', $id)->first();
        if($table){
            $this->id = $table->id;
            $this->name = $table->name;
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
            'email' => 'nullable|email',
            'phone' => 'nullable|digits:10',
            'username' => 'required|alpha_num|min:5|max:20|unique:operators,username,'.$this->id,
        ]);

        $update = Operator::where('id', $this->id);
        $update->update([
            'name' => $this->name,
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

        session()->flash('message', 'Operator Updated');
        $this->resetVals();
        $this->dispatch('close-modal');
    }
    public function delete(int $id){
        $this->id = $id;
    }
    public function destroy(){
        $delete = Operator::where('id',$this->id)->update([
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
        $items = Operator::when($this->search, function($q){
            return $q->where('name', 'like', '%'.$this->search.'%')->orWhere('contact_person', 'like', '%'.$this->search.'%');
        })
        ->where('district_id', auth()->user()->id)
        ->whereDel(0)
        ->paginate(10);
        return view('livewire.create-operator',compact('items'));
    }
}
