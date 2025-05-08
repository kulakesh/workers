<?php

namespace App\Livewire;

use App\Models\Renewals;
use Livewire\WithPagination;
use Livewire\Component;

class PaymentVarification extends Component
{
    use WithPagination;

    public $id, $varified;

    public $search = '';
    public function mount($varified = null)
    {
        $this->varified = $varified;
    }
    public function doNothig(){
        //nothing
    }
    public function approve(int $id){
        Renewals::where('id',$id)->update([
            "approval" => 1
        ]);
    }
    public function reject(int $id){
        $this->id = $id;
    }
    public function rejectConfirm(){
        Renewals::where('id',$this->id)->update([
            "approval" => 2
        ]);
        session()->flash('message', 'Payment Rejected Successfully');
        $this->resetVals();
        $this->dispatch('close-modal');
    }
    public function closeModal()
    {
        $this->resetVals();
    }
    public function resetVals(){
        $this->id = null;
    }
    public function render()
    {
        $items = [];

        $items = $this->varified !== null
        ? Renewals::whereDel(0)->whereApproval($this->varified)->paginate(10) 
        : Renewals::whereDel(0)->paginate(10);

        return view('livewire.payment-verification', compact('items'));
    }
}
