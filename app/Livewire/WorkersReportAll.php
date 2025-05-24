<?php

namespace App\Livewire;

use Livewire\WithPagination;
use App\Models\Registration;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class WorkersReportAll extends Component
{
    use WithPagination;

    public $for, $approval_only = false, $ro_verification;
    public $search = '', $dates = '';

    public function mount($for = null, $approval_only = null, $ro_verification = null)
    {
        $this->for = $for;
        $this->approval_only = $approval_only;
        $this->ro_verification = $ro_verification;
    }
    public function doNothig(){
        //nothing
    }
    public function render()
    {
        $items = Registration::when($this->dates, function($q){
            return $q->where(DB::raw('DATE(created_at)'), '>=' ,  \App\DateRange::date($this->dates)->from)
            ->where(DB::raw('DATE(created_at)'), '<=' ,  \App\DateRange::date($this->dates)->to);
        })
        ->when($this->search, function($q){
            return $q->where('name', 'like', '%'.$this->search.'%')
            ->orWhere('system_id', 'like', '%'.$this->search.'%');
        })
        ->orderByDesc('id')
        ->whereDel(0);

        if($this->approval_only){
            $items = $items->where('approval', 0);
        }
        
        switch ($this->for) {
            case 'operator':
                $items = $items->where('operator_id', auth()->user()->id)
                ->paginate(10);
                break;

            case 'district':
                if($this->ro_verification){
                    $items = $items->where('approval', $this->ro_verification);
                }
                $items = $items->whereIn('operator_id', function ($query) {
                    $query->select('id')
                    ->from('operators')
                    ->where('district_id', auth()->user()->id);
                })
                ->paginate(10);
                break;
            
            default:
                $items = $items->paginate(10);
                break;
        }

        return view('livewire.workers-report-all', compact('items'));
    }
}
