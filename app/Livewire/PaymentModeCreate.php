<?php

namespace App\Livewire;

use App\Models\PaymentMode;
use Livewire\Component;

class PaymentModeCreate extends Component
{
    public $benefits;
    public $id, $name;

    public function mount()
    {
        $this->benefits = PaymentMode::whereDel(0)->orderBy('id')->get();
    }
    public function addBenefit(){
        $this->validate([
            'name' => 'required',
        ]);

        PaymentMode::create([
            'name' => $this->name
        ]);

        $this->benefits = PaymentMode::whereDel(0)->orderBy('name')->get();
        session()->flash('message', 'Payment Mode Added');
        $this->resetVals();
        $this->dispatch('close-modal');
    }
    public function deleteBenefit($id){
        $this->id = $id;
    }
    public function destroyBenefit(){
        $delete = PaymentMode::where('id',$this->id)->update([
            "del" => 1
        ]);
        $this->benefits = PaymentMode::whereDel(0)->orderBy('name')->get();
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

        return view('livewire.payment-mode-create');
    }
}
