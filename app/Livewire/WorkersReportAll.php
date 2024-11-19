<?php

namespace App\Livewire;

use Livewire\WithPagination;
use App\Models\Registration;
use Livewire\Component;

class WorkersReportAll extends Component
{
    use WithPagination;

    public $search = '';

    public function doNothig(){
        //nothing
    }
    public function render()
    {
        $items = Registration::when($this->search, function($q){
            return $q->where('name', 'like', '%'.$this->search.'%')
            ->orWhere('address_t', 'like', '%'.$this->search.'%');
        })
        ->whereDel(0)
        ->paginate(10);
        return view('livewire.workers-report-all', compact('items'));
    }
}
