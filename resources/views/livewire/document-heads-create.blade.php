<div>
     
    <div id="headModals" class="modal fade" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 overflow-hidden">
                <div class="modal-header p-3">
                    <h4 class="card-title mb-0">Add Document Head</h4>
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
                    <form wire:submit.prevent="addDocumentHead"> 
                        <div class="row">
                            <div class="col-6">
                                <x-input-wire name="document_head_name"
                                    label="Document Head Name"
                                    placeholder="Add New Document Head"
                                    required
                                />
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="document_head_name" class="form-label ">Document type <span class="required">*</span></label>
                                    <select name="document_head_type" wire:model="document_head_type" class="form-select" aria-label="Document Type">
                                        <option selected="">Requirement</option>
                                        <option value="required">Required</option>
                                        <option value="optional">Optional</option>
                                    </select>
                                </div>
                                @error('document_head_type')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
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

    <div id="documentModals" class="modal fade" tabindex="-1" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 overflow-hidden">
                <div class="modal-header p-3">
                    <h4 class="card-title mb-0">Add Document</h4>
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
                    <form wire:submit.prevent="addDocument"> 
                        <div class="row">
                            <div class="col-12">
                                <x-input-wire name="document_name"
                                    label="Document"
                                    placeholder="Add New Document"
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
        <div class="col-sm-12 col-md-6">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#headModals">Add Document Head</button>
        </div>
    </div>
    <div class="row">
        <div class="col-12">

        <x-alert/>

        <table class="table table-bordered">
            <thead>
                <tr class="table-primary">
                    <th>#</th>
                    <th>Document Head</th>
                    <th>Documents</th>
                </tr>
            </thead>
            <tbody>
                
            @forelse ($document_heads as $document_head)
                
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $document_head->name }} ({{ $document_head->type }})
                            <span role="button" data-bs-toggle="modal" data-bs-target="#deleteDocumentHeadModals" wire:click="deleteDocumentHead({{$document_head->id}})" class="badge bg-danger">Delete </span>
                        </td>
                        <td>
                            @forelse ($document_head->docs as $document)
                            {{ $loop->iteration }}. {{ $document->name }}
                            <span role="button" data-bs-toggle="modal" data-bs-target="#deleteDocumentModals" wire:click="deleteDocument({{$document->id}})" class="badge bg-danger">Delete </span>
                            <br/>
                            @empty
                            {{-- Nothing to do --}}
                            @endforelse
                            <button type="button" wire:click="setDocumentId({{$document_head->id}})" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#documentModals">Add New</button>
                        </td>
                        
                    </tr>
            @empty
                <tr>
                    <td class="align-middle text-center" colspan="8">
                        No Head found
                    </td>
                </tr>
            @endforelse
            <tbody>
        </table>
        </div>
    </div>

    <div id="deleteDocumentHeadModals" class="modal fade" tabindex="-1" aria-hidden="true" wire:ignore.self>
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
                <form wire:submit.prevent="destroyDocumentHead"> 
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

    <div id="deleteDocumentModals" class="modal fade" tabindex="-1" aria-hidden="true" wire:ignore.self>
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
                <form wire:submit.prevent="destroyDocument"> 
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
