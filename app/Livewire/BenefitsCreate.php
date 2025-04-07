<?php

namespace App\Livewire;

use App\Models\Benefit;
use Livewire\Component;

class BenefitsCreate extends Component
{
    public $benefits;
    public $id, $name;

    public function mount()
    {
        $this->benefits = Benefit::whereDel(0)->orderBy('name')->get();
    }
    public function addBenefit(){
        $this->validate([
            'name' => 'required',
        ]);

        Benefit::create([
            'name' => $this->name
        ]);

        $this->benefits = Benefit::whereDel(0)->orderBy('name')->get();
        session()->flash('message', 'Benefit Added');
        $this->resetVals();
        $this->dispatch('close-modal');
    }
    public function deleteBenefit($id){
        $this->id = $id;
    }
    public function destroyBenefit(){
        $delete = Benefit::where('id',$this->id)->update([
            "del" => 1
        ]);
        $this->benefits = Benefit::whereDel(0)->orderBy('name')->get();
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
    }
    public function render()
    {

        return view('livewire.benefits-create');
    }
}
