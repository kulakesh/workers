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
                    <th>District office</th>
                    <th>City/Village</th>
                    <th>District</th>
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
                        <td>{{ $item->created_at ? $item->created_at->format('d M, Y h:i a') : '--' }}</td>
                        <td>
                            <div class="float-end">
                                @if($for == 'admin')
                                <a target="_blank" href="{{ route('admin.adminIcard', ['id' => $item->id]) }}" class="btn btn-sm btn-primary">
                                    Print
                                </a>
                                @endif
                                <a target="_blank" href="{{ route($for.'.workerEdit', ['id' => Crypt::encrypt($item->id)]) }}" class="btn btn-sm btn-secondary">
                                    Edit
                                </a>
                            </div>
                        </td>
                        
                    </tr>
            @empty
                <tr>
                    <td class="align-middle text-center" colspan="8">
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
