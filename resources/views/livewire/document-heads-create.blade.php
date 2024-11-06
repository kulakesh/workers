<div>
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
                <tr>
                    <td></td>
                    <td>
                        
                        <form wire:submit.prevent="addDocumentHead">
                            <div class="input-group">
                                <input type="text" class="form-control" name="document_head_name" wire:model="document_head_name" placeholder="Add New Document Head">
                                <select name="document_head_type" wire:model="document_head_type" class="form-select" aria-label="Document Type">
                                    <option selected="">Document Type</option>
                                    <option value="image">image</option>
                                    <option value="pdf">pdf</option>
                                    <option value="both">both</option>
                                </select>
                                <button class="btn btn-success" type="submit">Add</button>
                            </div>
                        </form>
                        @error('document_head_name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                        @error('document_head_type')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </td>
                    <td></td>
                </tr>
            @forelse ($document_heads as $document_head)
                
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $document_head->name }} ({{ $document_head->type }})</td>
                        <td>
                            <form wire:submit.prevent="addDocument({{$document_head->id}})">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="document_name" wire:model="document_name" placeholder="Add New Document">
                                    <button class="btn btn-success" type="submit">Add</button>
                                </div>
                            </form>
                            <p>
                            @forelse ($document_head->docs as $document)
                            {{ $loop->iteration }}. {{ $document->name }} <br/>
                            @empty
                                <div class="align-middle text-center">
                                    No document found
                                </div>
                            @endforelse
                            </p>
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
</div>
