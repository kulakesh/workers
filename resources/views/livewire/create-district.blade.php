<div>
    <div>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signupModals">Add RO</button>
        
            </div>
            <div class="col-sm-12 col-md-6">
                <div id="example_filter" class="float-end">
                <form wire:submit.prevent="closeModal">
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
    </div>
    
    <div id="signupModals" class="modal fade" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 overflow-hidden">
                <div class="modal-header p-3">
                    <h4 class="card-title mb-0">Add RO</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal" aria-label="Close"></button>
                </div>
                <div class="hide-me-after-done pb-3">
                    @if(session()->has('message'))
                    <div class="alert alert-success  rounded-0 mb-0">
                        <p class="mb-0">{{ session('message') }}</p>
                    </div>
                    @endif
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="save"> 
                        <div class="row">
                            <div class="col-6">
                                <x-input-wire name="name"
                                    label="RO Name"
                                    placeholder="RO Name"
                                    required
                                />
                                <div class="mb-3">
                                    <label for="name" class="form-label ">District  <span class="required">*</span></label>
                                    <select name="district_id" id="district_id" wire:model="district_id" class="form-select" aria-label="District">
                                        <option selected="">Select District</option>
                                        @foreach ($district_names as $district_name)
                                        <option value="{{ $district_name->district_code }}">{{ $district_name->district_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('district_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <x-input-wire name="ro_code"
                                    label="RO Code"
                                    placeholder="3 Characters Only"
                                    required
                                />
                                <x-input-wire name="contact_person"
                                    label="Contact Person"
                                    placeholder="Contact Person Name"
                                />
                                <x-input-wire name="designation"
                                    placeholder="Designation of above person"
                                />
                                <x-input-wire name="email"
                                    placeholder="Email Address"
                                />
                                <x-input-wire name="phone"
                                    placeholder="Phone Number"
                                />
                            </div>
                            <div class="col-6">
                                <x-input-wire name="state"
                                    placeholder="Arunachal"
                                />
                                <x-input-wire name="address"
                                    placeholder="Address"
                                />
                                <x-input-wire name="pin"
                                    placeholder="Postal Pin"
                                />
                                <x-input-wire name="username"
                                    placeholder="User Name"
                                    required
                                />
                                <x-input-wire name="password"
                                    placeholder="Password"
                                    type="password"
                                    required
                                />
                            </div>
                        </div>
                        
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" wire:click="closeModal" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div class="row">
        <div class="col-12">

        <x-alert/>

        <table class="table table-bordered">
            <thead>
                <tr class="table-primary">
                    <th>#</th>
                    <th>ID</th>
                    <th>Username</th>
                    <th>RO Code</th>
                    <th>District</th>
                    <th>Circle</th>
                    <th>Contact Person</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>-</th>
                </tr>
            </thead>
            <tbody>
            @forelse ($items as $item)
                
                    <tr wire:key="{{ $item->id }}">
                        <td>{{ ($items->currentpage()-1) * $items->perpage() + $loop->index + 1 }}</td>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->username }}</td>
                        <td>{{ $item->ro_code }}</td>
                        <td>{{ $item->district_code->district_name }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->contact_person }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->phone }}</td>
                        <td>
                            <div class="float-end">

                                <button type="button" data-bs-toggle="modal" data-bs-target="#editModals" wire:click="edit({{$item->id}})" class="btn btn-sm btn-primary">
                                    Edit
                                </button>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#deleteModals" wire:click="delete({{$item->id}})" class="btn btn-sm btn-danger">
                                    Delete
                                </button>
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

    <div id="editModals" class="modal fade" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 overflow-hidden">
                <div class="modal-header p-3">
                    <h4 class="card-title mb-0">Add RO</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal" aria-label="Close"></button>
                </div>
                <div class="hide-me-after-done pb-3">
                    @if(session()->has('message'))
                    <div class="alert alert-success  rounded-0 mb-0">
                        <p class="mb-0">{{ session('message') }}</p>
                    </div>
                    @endif
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="update"> 
                    <div class="row">
                            <div class="col-6">
                                <x-input-wire name="name"
                                    placeholder="RO Name"
                                    required
                                />
                                <div class="mb-3">
                                    <label for="name" class="form-label ">District <span class="required">*</span></label>
                                    <select name="district_id" id="district_id" wire:model="district_id" class="form-select" aria-label="District">
                                        <option selected="">Select District</option>
                                        @foreach ($district_names as $district_name)
                                        <option value="{{ $district_name->district_code }}">{{ $district_name->district_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('district_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <x-input-wire name="ro_code"
                                    label="RO Code"
                                    placeholder="3 Characters Only"
                                    required
                                />
                                <x-input-wire name="contact_person"
                                    label="Contact Person"
                                    placeholder="Contact Person Name"
                                />
                                <x-input-wire name="designation"
                                    placeholder="Designation of above person"
                                />
                                <x-input-wire name="email"
                                    placeholder="Email Address"
                                />
                                <x-input-wire name="phone"
                                    placeholder="Phone Number"
                                />
                            </div>
                            <div class="col-6">
                                <x-input-wire name="state"
                                    placeholder="Arunachal"
                                />
                                <x-input-wire name="address"
                                    placeholder="Address"
                                />
                                <x-input-wire name="pin"
                                    placeholder="Postal Pin"
                                />
                                <x-input-wire name="username"
                                    placeholder="User Name"
                                    required
                                />
                                <x-input-wire name="password"
                                    placeholder="Password"
                                    type="password"
                                />
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" wire:click="closeModal" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <div id="deleteModals" class="modal fade" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 overflow-hidden">
                <div class="modal-header p-3">
                    <h4 class="card-title mb-0">Delete</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click="closeModal" aria-label="Close"></button>
                </div>
                <div class="hide-me-after-done pb-3">
                    @if(session()->has('message'))
                    <div class="alert alert-success  rounded-0 mb-0">
                        <p class="mb-0">{{ session('message') }}</p>
                    </div>
                    @endif
                </div>
                @if(!session()->has('message'))
                <form wire:submit.prevent="destroy"> 
                    <div class="modal-body">
                        <h4>Are you sure you want to delete this data?</h4>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" wire:click="closeModal" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Yes! Delete</button>
                    </div>
                </form>
                @endif
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

</div>