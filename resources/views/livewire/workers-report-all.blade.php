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
</div>
@section('script')

<script src="{{ URL::asset('build/libs/flatpickr/flatpickr.min.js') }}"></script>

@endsection