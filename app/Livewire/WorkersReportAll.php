<?php

namespace App\Livewire;

use Livewire\WithPagination;
use App\Models\Registration;
use Livewire\Component;

class WorkersReportAll extends Component
{
    use WithPagination;

    public $for = null;
    public $search = '';

    public function mount($for = null)
    {
        $this->for = $for;
    }
    public function doNothig(){
        //nothing
    }
    public function render()
    {
        $items = Registration::when($this->search, function($q){
            return $q->where('name', 'like', '%'.$this->search.'%')
            ->orWhere('address_t', 'like', '%'.$this->search.'%');
        })
        ->whereDel(0);
        if($this->for == 'operator'){
            $items = $items->where('operator_id', auth()->user()->id)
            ->paginate(10);
        }elseif($this->for == 'district'){
            $items = $items->whereIn('operator_id', function ($query) {
				$query->select('id')
				->from('operators')
				->where('districti_id', auth()->user()->id);
			})
            ->paginate(10);
        }else{
            $items = $items->paginate(10);
        }
        return view('livewire.workers-report-all', compact('items'));
    }
}
