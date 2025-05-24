<?php

namespace App\Livewire;

use App\Models\Renewals;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Livewire\Component;

class PaymentVarification extends Component
{
    use WithPagination;

    public $id, $varified;

    public $search = '', $dates = '';
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
        $item = Renewals::when($this->dates, function($q){
            return $q->where(DB::raw('DATE(payment_date)'), '>=' ,  \App\DateRange::date($this->dates)->from)
            ->where(DB::raw('DATE(payment_date)'), '<=' ,  \App\DateRange::date($this->dates)->to);
        })
        ->when($this->search, function($q){
            return $q->whereHas('worker', function($q) {
                $q->where('name', 'like', '%'.$this->search.'%')
                ->orWhere('system_id', 'like', '%'.$this->search.'%');
            });
        })
        ->whereDel(0);

        $items = $this->varified !== null
        ? $item->whereApproval($this->varified)->paginate(10) 
        : $item->paginate(10);

        return view('livewire.payment-verification', compact('items'));
    }
}
