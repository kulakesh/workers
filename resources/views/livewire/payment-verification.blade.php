<div>
<div class="row">
    <div class="col-sm-12 col-md-6">
        {{--BLANK CAN BE ADD--}}
    </div>
    <div class="col-sm-12 col-md-6">
        <div id="example_filter" class="float-end">
        <form wire:submit.prevent="doNothig">
            <label>Search:
                <input type="search" wire:model="search" class="form-control form-control-sm" aria-controls="example">
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
                    <th>RO</th>
                    <th>Renewal Year(s)</th>
                    <th>Paid Amount</th>
                    <th>Payment Mode</th>
                    <th>Ref. No</th>
                    <th>Payment Date</th>
                    <th>Entry Date</th>
                    <th>Receipt</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($items as $renewals)
                
                    <tr wire:key="{{ $renewals->id }}">
                        <td>{{ ($items->currentpage()-1) * $items->perpage() + $loop->index + 1 }}</td>
                        <td>{{ $renewals->worker->system_id }}</td>
                        <td>{{ $renewals->worker->name }}</td>
                        <td>{{ $renewals->worker->operator->district->name }}</td>
                        <td>{{ $renewals->payment_years }}</td>
                        <td>{{ $renewals->payment_amount }}</td>
                        <td>{{ $renewals->payment_mode }}</td>
                        <td>{{ $renewals->payment_ref_no }}</td>
                        <td>{{ \Carbon\Carbon::parse($renewals->payment_date)->format('d M Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($renewals->created_at)->format('d M Y h:i a') }}</td>
                        <td>
                            @if($renewals->doc_path && file_exists(public_path('storage/payment/') . $renewals->doc_path))
                            <a target="_blank" href="{{ asset('storage/payment/'. $renewals->doc_path)}}" class="btn btn-primary btn-sm">View</a>
                            @endif
                        </td>
                        <td>
                            @if($renewals->img_path && file_exists(public_path('storage/payment/') . $renewals->img_path))
                            <a target="_blank" href="{{ asset('storage/payment/'. $renewals->img_path)}}" class="btn btn-primary btn-sm">View</a>
                            @endif
                        </td>
                        <td>
                        @if($renewals->approval == 1)
                            <span class="badge bg-success">Approved</span>
                        @elseif($renewals->approval == 2)
                            <span class="badge bg-danger">Rejected</span>
                        @else
                            <span class="badge bg-warning">Pending</span>
                        @endif
                        </td>
                        <td>
                            <div class="float-end">
                                @if($renewals->approval == 0)
                                <button type="button" wire:click="approve({{$renewals->id}})" class="btn btn-sm btn-success">Approve</button>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteModals" wire:click="reject({{$renewals->id}})" class="btn btn-sm btn-danger">Reject</button>
                                @endif
                            </div>
                        </td>
                        
                    </tr>
            @empty
                <tr>
                    <td class="align-middle text-center" colspan="14">
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
                    <h4 class="card-title mb-0">Confirm</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal" aria-label="Close"></button>
                </div>
                <div class="hide-me-after-done">
                    @if(session()->has('message'))
                    <div class="alert alert-success  rounded-0 mb-0">
                        <p class="mb-0">{{ session('message') }}</p>
                    </div>
                    @endif
                </div>
                <form wire:submit.prevent="rejectConfirm"> 
                    <div class="modal-body">
                        <h4>Are you sure you want to Reject?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Yes! Reject</button>
                    </div>
                </form>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</div>
@section('script')
<script src="{{ URL::asset('build/libs/flatpickr/flatpickr.min.js') }}"></script>
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('close-modal', (event) => {
            setTimeout(() => {
                $('.modal').modal('hide');
                $('.modal').find('.hide-me-after-done').html('');
            }, 1500);
        });
    });
</script>
@endsection