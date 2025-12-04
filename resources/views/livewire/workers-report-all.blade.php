<div>
<div class="row">
    <div class="col-sm-12 col-md-6">
        {{--BLANK CAN BE ADD--}}
    </div>
    <div class="col-sm-12 col-md-6">
        <div id="example_filter" class="float-end">
            <form wire:submit.prevent="doNothig">
                @if($for == 'admin')
                <label>RO:
                    <select wire:model="circle" class="form-select form-select-sm">
                        <option value="">All</option>
                        @foreach($ros as $ro)
                            <option value="{{ $ro->id }}">{{ $ro->name }}</option>
                        @endforeach
                    </select>
                </label>
                @endif
                <label>Date:
                <input name="dates" wire:model="dates"
                        placeholder="From, To" type="text" class="form-control form-control-sm flatpickr-input" 
                        data-provider="flatpickr" data-date-format="d M, Y" data-range-date="true" readonly="readonly">
                </label>
                <label>Search:
                    <input type="search" wire:model="search" placeholder="System ID, Name" class="form-control form-control-sm" aria-controls="example">
                </label>
                <button type="submit" class="btn btn-sm btn-primary">
                    Search
                </button>
                <button type="button" class="btn btn-sm btn-primary" wire:click="exportExcel()">
                    Export
                </button>
            </form>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">

        <x-alert/>

        <table class="table table-bordered">
            <thead>
                <tr class="table-primary">
                    <th>#</th>
                    <th>System ID</th>
                    <th>Name</th>
                    <th>Circle office</th>
                    <th>City/Village</th>
                    <th>District</th>
                    <th>RO Review</th>
                    <th>Payment</th>
                    <th>Date</th>
                    <th>-</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($items as $item)
                
                    <tr wire:key="{{ $item->id }}">
                        <td>{{ ($items->currentpage()-1) * $items->perpage() + $loop->index + 1 }}</td>
                        <td>{{ $item->system_id }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->operator->district->name }}</td>
                        <td>{{ $item->city_t }}</td>
                        <td>{{ $item->district_t }}</td>
                        <td>
                        @if($item->approval == 1)
                            <span class="badge bg-success">Approved</span>
                        @elseif($item->approval == 2)
                            <span class="badge bg-danger">Rejected</span>
                        @else
                            <span class="badge bg-warning">Pending</span>
                        @endif
                        </td>
                        <td>
                        @php 
                        $payment_approvlal = 3;
                        if($item->payment->first() != null) {
                            $payment_approvlal = $item->payment->first()->approval;
                        }
                        @endphp
                        @if($payment_approvlal == 1)
                            <span class="badge bg-success">Approved</span>
                        @elseif($payment_approvlal == 2)
                            <span class="badge bg-danger">Rejected</span>
                        @elseif($payment_approvlal == 3)
                            <span class="badge bg-info">Incomplete</span>
                        @else
                            <span class="badge bg-warning">Pending</span>
                        @endif
                        </td>
                        <td>{{ $item->created_at ? $item->created_at->format('d M, Y h:i a') : '--' }}</td>
                        <td>
                            <div class="float-end">
                                @if($for != 'operator')
                                <a target="_blank" href="{{ route('adminIcard', ['id' => $item->id]) }}" class="btn btn-sm btn-primary">
                                    Print
                                </a>
                                @endif
                                <a target="_blank" href="{{ route($for.'.workerEdit', ['id' => Crypt::encrypt($item->id)]) }}" class="btn btn-sm btn-secondary">
                                    View
                                </a>
                                @if($for == 'admin')
                                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteModals" wire:click="delete({{$item->id}})" class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                                @endif
                            </div>
                        </td>
                        
                    </tr>
            @empty
                <tr>
                    <td class="align-middle text-center" colspan="10">
                        No results found
                    </td>
                </tr>
            @endforelse
            <tbody>
        </table>
        {{ $items->links() }}
        </div>
    </div>

    <div id="deleteModals" class="modal fade" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 overflow-hidden">
                <div class="modal-header p-3">
                    <h4 class="card-title mb-0">Add Category</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal" aria-label="Close"></button>
                </div>
                <div class="hide-me-after-done">
                    @if(session()->has('message'))
                    <div class="alert alert-success  rounded-0 mb-0">
                        <p class="mb-0">{{ session('message') }}</p>
                    </div>
                    @endif
                </div>
                <form wire:submit.prevent="destroy"> 
                    <div class="modal-body">
                        <h4>Are you sure you want to delete this data?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeDeleteModal" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Yes! Delete</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</div>
@section('script')

<script src="{{ URL::asset('build/libs/flatpickr/flatpickr.min.js') }}"></script>

@endsection