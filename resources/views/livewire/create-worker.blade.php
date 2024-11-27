<div>
    <div class="row">
        <div class="col-md-12 col-xl-8 offset-2">
            <div class="card">
                <div class="card-body">
                        
                        <div class="step-arrow-nav mb-4">

                            <ul class="nav nav-pills custom-nav nav-justified" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="steparrow-gen-info-tab" data-bs-toggle="pill"
                                        data-bs-target="#steparrow-gen-info" type="button" role="tab"
                                        aria-controls="steparrow-gen-info" aria-selected="false" wire:ignore.self>General</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="steparrow-family-info-tab"
                                        data-bs-toggle="pill" data-bs-target="#steparrow-family-info" type="button"
                                        role="tab" aria-controls="steparrow-family-info"
                                        aria-selected="false" wire:ignore.self>Family</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="steparrow-employment-info-tab"
                                        data-bs-toggle="pill" data-bs-target="#steparrow-employment-info" type="button"
                                        role="tab" aria-controls="steparrow-employment-info"
                                        aria-selected="false" wire:ignore.self>Employment</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="steparrow-photo-info-tab"
                                        data-bs-toggle="pill" data-bs-target="#steparrow-photo-info" type="button"
                                        role="tab" aria-controls="steparrow-photo-info"
                                        aria-selected="false" wire:ignore.self>Photo</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="steparrow-biometric-info-tab"
                                        data-bs-toggle="pill" data-bs-target="#steparrow-biometric-info" type="button"
                                        role="tab" aria-controls="steparrow-biometric-info"
                                        aria-selected="false" wire:ignore.self>Biometric</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="steparrow-document-info-tab"
                                        data-bs-toggle="pill" data-bs-target="#steparrow-document-info" type="button"
                                        role="tab" aria-controls="steparrow-document-info"
                                        aria-selected="false" wire:ignore.self>Document</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="steparrow-review-info-tab"
                                        data-bs-toggle="pill" data-bs-target="#steparrow-review-info" type="button"
                                        role="tab" aria-controls="steparrow-review-info"
                                        aria-selected="false" wire:ignore.self>Review</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="steparrow-finish-info-tab"
                                        data-bs-toggle="pill" data-bs-target="#steparrow-finish-info" type="button"
                                        role="tab" aria-controls="steparrow-finish-info"
                                        aria-selected="false" wire:ignore.self>Finish</button>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="steparrow-gen-info" role="tabpanel"
                            aria-labelledby="steparrow-gen-info-tab" wire:ignore.self>
                            <form wire:submit.prevent="generalValidate">
                                <div>
                                    <div class="card">
                                        <div class="card-header"><h5>Personal Details</h5></div>
                                        <div class="card-body">
                                            <div class="row">
                                            <x-input-wire name="name"
                                                placeholder="Beneficiary Name"
                                                required
                                            />
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="father"
                                                    placeholder="Father's Name"
                                                />
                                                </div>
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="mother"
                                                    placeholder="Mother's Name"
                                                />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="spouse"
                                                    placeholder="Spouse's Name"
                                                />
                                                </div>
                                                <div class="col-md-12 col-xl-6">
                                                <label for="spouse" class="form-label ">Gender</label>
                                                <select name="gender" id="gender" wire:model="gender" class="form-select" aria-label="Gender">
                                                    <option selected="">Select Gender</option>
                                                    <option value="Male" @if(old('gender')=='Male') selected="selected" @endif>Male</option>
                                                    <option value="Female" @if(old('gender')=='Female') selected="selected" @endif>Female</option>
                                                    <option value="Other" @if(old('gender')=='Other') selected="selected" @endif>Other</option>
                                                </select>
                                                @error('gender')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-xl-4">
                                                <x-input-wire name="dob"
                                                    label="Date of Birth"
                                                    placeholder="DD/MM/YYYY"
                                                    required
                                                />
                                                </div>
                                                <div class="col-md-12 col-xl-4">
                                                <x-input-wire name="cast"
                                                    placeholder="Cast"
                                                />
                                                </div>
                                                <div class="col-md-12 col-xl-4">
                                                <x-input-wire name="tribe"
                                                    placeholder="Tribe's Name"
                                                />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="email"
                                                    placeholder="E-mail"
                                                />
                                                </div>
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="phone"
                                                    placeholder="Phome Number"
                                                />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header"><h5>Present Address</h5></div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="city_t"
                                                    label="City/Village"
                                                    placeholder="City/Village"
                                                />
                                                </div>
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="district_t"
                                                    label="District"
                                                    placeholder="District"
                                                    />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="state_t"
                                                    label="State"
                                                    placeholder="Arunachal"
                                                />
                                                </div>
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="pin_t"
                                                    label="Pin"
                                                    placeholder="Pin Number"
                                                />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <x-input-wire name="address_t"
                                                    label="Address"
                                                    placeholder="Address"
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h5>Permanent Address</h5>
                                            <div>
                                            <input type="checkbox" wire:model="same_address" wire:change="processMark()" wire:loading.attr="disabled">
                                            <label for="vehicle3"> Same as present address</label>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="city_p"
                                                    label="City/Village"
                                                    placeholder="City/Village"
                                                />
                                                </div>
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="district_p"
                                                    label="District"
                                                    placeholder="District"
                                                    />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="state_p"
                                                    label="State"
                                                    placeholder="Arunachal"
                                                />
                                                </div>
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="pin_p"
                                                    label="Pin"
                                                    placeholder="Pin number"
                                                />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <x-input-wire name="address_p"
                                                    label="Address"
                                                    placeholder="Address"
                                                />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header"><h5>Work Details</h5></div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="nature"
                                                    label="Nature of work"
                                                    placeholder="Nature of work"
                                                />
                                                </div>
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="serial"
                                                    label="Serial number"
                                                    placeholder="Old serial/registration number"
                                                    />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="doe"
                                                    label="Date of registration"
                                                    placeholder="DD/MM/YYYY"
                                                />
                                                </div>
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="dor"
                                                    label="Date of retirement"
                                                    placeholder="DD/MM/YYYY"
                                                />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="turnover"
                                                    label="Anual turnover"
                                                    placeholder="0.00"
                                                />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header"><h5>Nominee details</h5></div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="nominee"
                                                    placeholder="Nominee Name"
                                                />
                                                </div>
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="relation"
                                                    label="Relationship"
                                                    placeholder="Relation with beneficiary"
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="d-flex align-items-start gap-3 mt-4">
                                    <button type="submit" class="btn btn-success btn-label right ms-auto nexttab nexttab"
                                        data-nexttab="steparrow-description-info-tab"><i
                                            class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Next</button>
                                </div>
                            </form>
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane fade" id="steparrow-family-info" role="tabpanel"
                                aria-labelledby="steparrow-family-info-tab" wire:ignore.self>
                                <div>
                                    <h4>Family</h4>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="table-primary">
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Age</th>
                                                <th>Relation</th>
                                                <th>-</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <form wire:submit.prevent="addFamilyMember">
                                            <tr>
                                                <td></td>
                                                
                                                <td>
                                                    <input type="text" class="form-control" name="family_member_name" wire:model="family_member_name" placeholder="Family member name">
                                                    @error('family_member_name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="family_member_age" wire:model="family_member_age" placeholder="Family member age">
                                                    @error('family_member_age')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="family_member_relation" wire:model="family_member_relation" placeholder="Relation with Family member">
                                                    @error('family_member_relation')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td><button type="submit" class="btn btn-primary">Add</button></td>
                                            </tr>
                                            </form>
                                            @forelse ($family_members as $family_member)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $family_member['family_member_name'] }}</td>
                                                    <td>{{ $family_member['family_member_age'] }}</td>
                                                    <td>{{ $family_member['family_member_relation'] }}</td>
                                                    <td><button class="btn btn-danger btn-sm" wire:click="removeFamilyMember({{$loop->index}})">Remove</button></td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td class="align-middle text-center" colspan="5">
                                                        No results found
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex align-items-start gap-3 mt-4">
                                    <button type="button" class="btn btn-light btn-label previestab"
                                        data-previous="steparrow-gen-info-tab"><i
                                            class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back to
                                        General</button>
                                    <button type="button" wire:click="submitFamilyMember()" class="btn btn-success btn-label right ms-auto nexttab nexttab"
                                        data-nexttab="steparrow-employment-info"><i
                                            class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Next</button>
                                </div>
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane fade" id="steparrow-employment-info" role="tabpanel"
                                aria-labelledby="steparrow-employment-info-tab" wire:ignore.self>
                                <div>
                                    <h4>Employer Details</h4>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="table-primary">
                                                <th>#</th>
                                                <th>Description</th>
                                                <th>Employer</th>
                                                <th>Nature of work</th>
                                                <th>-</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <form wire:submit.prevent="addEmployers">
                                            <tr>
                                                <td></td>
                                                
                                                <td>
                                                    <textarea class="form-control" name="employer_description" wire:model="employer_description" rows="5"
                                                    placeholder="Description of establishment / building work & address where the beneficiary is employed"></textarea>
                                                    @error('employer_description')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <textarea class="form-control" name="employer_name_address" wire:model="employer_name_address" 
                                                    placeholder="Name of employer & address"></textarea>
                                                    @error('employer_name_address')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <textarea class="form-control" name="employer_nature" wire:model="employer_nature"  rows="4"
                                                    placeholder="Nature of work done by the beneficiary/ which work dose he/she do"></textarea>
                                                    @error('employer_nature')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td><button type="submit" class="btn btn-primary">Add</button></td>
                                            </tr>
                                            </form>
                                            @forelse ($employers as $employer)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $employer['employer_description'] }}</td>
                                                    <td>{{ $employer['employer_name_address'] }}</td>
                                                    <td>{{ $employer['employer_nature'] }}</td>
                                                    <td><button class="btn btn-danger btn-sm" wire:click="removeEmployers({{$loop->index}})">Remove</button></td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td class="align-middle text-center" colspan="5">
                                                        No results found
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex align-items-start gap-3 mt-4">
                                    <button type="button" class="btn btn-light btn-label previestab"
                                        data-previous="steparrow-family-info-tab"><i
                                            class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back to
                                        Family</button>
                                    <button type="button" wire:click="submitEmployers()" class="btn btn-success btn-label right ms-auto nexttab nexttab"
                                        data-nexttab="pills-photo-tab"><i
                                            class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Submit</button>
                                </div>
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane fade" id="steparrow-photo-info" role="tabpanel"
                                aria-labelledby="steparrow-photo-info-tab" wire:ignore.self>
                                <div>
                                    <h4>Photo capture</h4>
                                    <div class="row">
                                        <div class="col-12">
                                            <button class="btn btn-primary" id="startWebcam">Start Camera</button>
                                            <button class="btn btn-danger" id="stoptWebcam">Stop Camera</button>
                                            <button class="btn btn-warning" id="takePhoto">Take Photo</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <video width=400 height=400 id="video" controls autoplay></video>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            @error('photo')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            <canvas style="border:1px solid black;" id="myCanvas" width="400" height="300"></canvas>  
                                        </div>
                                    </div>
                                </div>
                                <form wire:submit.prevent="validatePhoto">
                                    <div class="d-flex align-items-start gap-3 mt-4">
                                        <button type="button" class="btn btn-light btn-label previestab"
                                            data-previous="steparrow-employment-info-tab"><i
                                                class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back to
                                                Employment</button>
                                        <button type="submit" class="btn btn-success btn-label right ms-auto nexttab nexttab"
                                            data-nexttab="steparrow-biometric-info"><i
                                                class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Submit</button>
                                    </div>
                                </form>
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane fade" id="steparrow-biometric-info" role="tabpanel"
                                aria-labelledby="steparrow-biometric-info-tab" wire:ignore.self>
                                <div>
                                    <h4>Biometric Capture</h4>
                                    <div class="row">
                                        <div class="col-12">
                                            <button class="btn btn-primary" id="captureFinger">Capture</button>
                                        </div>
                                        <div class="col-12">
                                            @error('finger')
                                            <div class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                            @enderror
                                            <img id="finger-print" src="@if($finger_name){{ asset('storage/biometric/'. $finger_name)}}@endif" wire:ignore.self />
                                        </div>
                                    </div>
                                </div>
                                <form wire:submit.prevent="validateFinger">
                                    <div class="d-flex align-items-start gap-3 mt-4">
                                        <button type="button" class="btn btn-light btn-label previestab"
                                            data-previous="steparrow-photo-info-tab"><i
                                                class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back to
                                                Photo</button>
                                        <button type="submit" class="btn btn-success btn-label right ms-auto nexttab nexttab"
                                            data-nexttab="steparrow-document-info-tab"><i
                                                class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Submit</button>
                                    </div>
                                </form>
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane fade" id="steparrow-document-info" role="tabpanel"
                                aria-labelledby="steparrow-document-info-tab" wire:ignore.self>
                                <form wire:submit.prevent="validateDocuments">
                                <div>
                                    <h4>Upload documents</h4>
                                    <div class="row">
                                        <div class="col-12">
                                            <table class="table table-bordered">
                                            @foreach($document_heads as $index => $document_head)
                                                <tr>
                                                    <td>
                                                        {{ $document_head->name }}
                                                        @if($document_head->type == 'required') <span class="required">*</span> @endif
                                                    </td>
                                                    <td>
                                                    <select name="documents.{{$index}}" wire:model="documents.{{$index}}" class="form-select" aria-label="Document Type">
                                                        <option value="" selected="">Document Type</option>
                                                        @foreach($document_head->docs as $document)
                                                        <option value="{{ $document->id }}">{{ $document->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('documents.'.$index)
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    </td>
                                                    <td>
                                                    <input type="file" wire:model="uploaded_documents.{{$index}}" accept="image/png, image/jpeg, application/pdf" class="form-select" />
                                                    @error('uploaded_documents.'.$index)
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-start gap-3 mt-4">
                                    <button type="button" class="btn btn-light btn-label previestab"
                                        data-previous="steparrow-biometric-info-tab"><i
                                            class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back to
                                            Biometric</button>
                                    <button type="submit" class="btn btn-success btn-label right ms-auto nexttab nexttab"
                                        data-nexttab="steparrow-review-info-tab"><i
                                            class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Submit</button>
                                </div>
                                </form>
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane fade" id="steparrow-review-info" role="tabpanel"
                                aria-labelledby="steparrow-review-info-tab" wire:ignore.self>
                                <div>
                                    <h4>Personal Details</h4>
                                    <div class="row">
                                        <div class="col-md-8 col-sm-6">
                                            <div>Beneficiary Name :  <strong>{{ $name }}</strong>
                                                @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div>Father's Name :  <strong>{{ $father }}</strong>
                                                @error('father')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div>Mother's Name :  <strong>{{ $mother }}</strong>
                                                @error('mother')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div>Spouse's Name :  <strong>{{ $spouse }}</strong>
                                                @error('spouse')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div>Gender :  <strong>{{ $gender }}</strong>
                                                @error('gender')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div>Date of Birth :  <strong>{{ $dob }}</strong>
                                                @error('dob')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div>Cast :  <strong>{{ $cast }}</strong>
                                                @error('cast')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div>Tribe's Name :  <strong>{{ $tribe }}</strong>
                                                @error('tribe')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            @if($photo_name && file_exists(public_path('storage/photo/') . $photo_name))
                                            <img class="d-block img-fluid mx-auto" src="{{ asset('storage/photo/'. $photo_name)}}" alt="Photo">
                                            @endif
                                        </div>
                                    </div>
                                    <h4>Present Address</h4>
                                    <div class="row">
                                        <div class="col-md-8 col-sm-6">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div>City/Village :  <strong>{{ $city_t }}</strong>
                                                        @error('city_t')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div>District :  <strong>{{ $district_t }}</strong>
                                                        @error('district_t')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div>State :  <strong>{{ $state_t }}</strong>
                                                        @error('state_t')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div>Pin Number :  <strong>{{ $pin_t }}</strong>
                                                        @error('pin_t')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div>Address :  <strong>{{ $address_t }}</strong>
                                                        @error('address_t')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <h4>Permanent Address</h4>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div>City/Village :  <strong>{{ $city_p }}</strong>
                                                        @error('city_p')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div>District :  <strong>{{ $district_p }}</strong>
                                                        @error('district_p')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div>State :  <strong>{{ $state_p }}</strong>
                                                        @error('state_p')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div>Pin Number :  <strong>{{ $pin_p }}</strong>
                                                        @error('pin_p')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div>Address :  <strong>{{ $address_p }}</strong>
                                                        @error('address_p')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <h4>Work Details</h4>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div>Nature of work :  <strong>{{ $nature }}</strong>
                                                        @error('nature')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div>Old serial/registration number :  <strong>{{ $serial }}</strong>
                                                        @error('serial')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div>Date of registration :  <strong>{{ $doe }}</strong>
                                                        @error('doe')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div>Date of retirement :  <strong>{{ $dor }}</strong>
                                                        @error('dor')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div>Anual turnover :  <strong>{{ $turnover }}</strong>
                                                        @error('turnover')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            @if($finger_name && file_exists(public_path('storage/biometric/') . $finger_name))
                                            <img class="d-block img-fluid mx-auto" src="{{ asset('storage/biometric/'. $finger_name)}}" alt="Biometric">
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <h4>Nominee details</h4>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div>Nominee Name :  <strong>{{ $nominee }}</strong>
                                                @error('nominee')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div>Relation with beneficiary :  <strong>{{ $relation }}</strong>
                                                @error('relation')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <h4>Family Details</h4>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="table-primary">
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Age</th>
                                                        <th>Relation</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($family_members as $family_member)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $family_member['family_member_name'] }}</td>
                                                            <td>{{ $family_member['family_member_age'] }}</td>
                                                            <td>{{ $family_member['family_member_relation'] }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td class="align-middle text-center" colspan="4">
                                                                No results found
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <h4>Employer Details</h4>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="table-primary">
                                                        <th>#</th>
                                                        <th>Description</th>
                                                        <th>Employer</th>
                                                        <th>Nature of work</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($employers as $employer)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $employer['employer_description'] }}</td>
                                                            <td>{{ $employer['employer_name_address'] }}</td>
                                                            <td>{{ $employer['employer_nature'] }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td class="align-middle text-center" colspan="4">
                                                                No results found
                                                            </td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <h4>Documents</h4>
                                    <div class="row">
                                        <div class="col-md-12">
                                        @foreach($document_heads as $index => $document_head)
                                            <div>
                                                {{ $document_head->name }} 
                                                @if(array_key_exists($index,$documents)) - {{ $document_head->docs->where('id',$documents[$index])->first()->name }} @endif
                                                @if(array_key_exists($index,$uploaded_document_name)) 
                                                    - <a target="_blank" href="{{ asset('storage/document/'.$uploaded_document_name[$index]) }}">View</a>
                                                @endif
                                            </div>
                                        @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex align-items-start gap-3 mt-4">
                                    <button type="button" class="btn btn-light btn-label previestab"
                                        data-previous="steparrow-upload-info-tab"><i
                                            class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back to
                                            Upload</button>
                                    <button type="button" wire:click="submitAll()" class="btn btn-success btn-label right ms-auto nexttab nexttab"
                                        data-nexttab="steparrow-finish-info-tab"><i
                                            class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Submit</button>
                                </div>
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane fade" id="steparrow-finish-info" role="tabpanel" wire:ignore.self>
                                <div class="text-center">

                                    <div class="avatar-md mt-5 mb-4 mx-auto">
                                        <div class="avatar-title bg-light text-success display-4 rounded-circle">
                                            <i class="ri-checkbox-circle-fill"></i>
                                        </div>
                                    </div>
                                    <h5>Well Done !</h5>
                                    <p class="text-muted">You have Successfully Registered</p>
                                </div>
                            </div>
                            <!-- end tab pane -->

                        </div>
                        <!-- end tab content -->
                </div>
                <!-- end card body -->
            </div>
        </div>
    </div>
</div>
@section('script')
<script src="{{ URL::asset('build/js/pages/form-wizard.init.js') }}"></script>
<script src="{{ URL::asset('build/libs/cleave.js/cleave.min.js') }}"></script>
<script>
    if (document.querySelector("#dob")) {
        var cleaveDate = new Cleave('#dob', {
            date: true,
            delimiter: '/',
            datePattern: ['d', 'm', 'Y']
        });
    }
    if (document.querySelector("#doe")) {
        var cleaveDate = new Cleave('#doe', {
            date: true,
            delimiter: '/',
            datePattern: ['d', 'm', 'Y']
        });
    }
    if (document.querySelector("#dor")) {
        var cleaveDate = new Cleave('#dor', {
            date: true,
            delimiter: '/',
            datePattern: ['d', 'm', 'Y']
        });
    }
    // Listners
    document.addEventListener('livewire:init', () => {
        Livewire.on('close-modal', (event) => {
            setTimeout(() => {
                $('.modal').modal('hide');
                $('.modal').find('.hide-me-after-done').html('');
            }, 2000);
        });
        Livewire.on('move-to-family', (event) => {
            setTimeout(() => {
                $("#steparrow-family-info-tab").trigger("click");
            }, 200);
        });
        Livewire.on('move-to-employer', (event) => {
            setTimeout(() => {
                $("#steparrow-employment-info-tab").trigger("click");
            }, 200);
        });
        Livewire.on('move-to-photo', (event) => {
            setTimeout(() => {
                $("#steparrow-photo-info-tab").trigger("click");
            }, 200);
        });
        Livewire.on('move-to-biometric', (event) => {
            setTimeout(() => {
                $("#steparrow-biometric-info-tab").trigger("click");
            }, 200);
        });
        Livewire.on('move-to-document', (event) => {
            setTimeout(() => {
                $("#steparrow-document-info-tab").trigger("click");
            }, 200);
        });
        Livewire.on('move-to-review', (event) => {
            setTimeout(() => {
                $("#steparrow-review-info-tab").trigger("click");
            }, 200);
        });
        Livewire.on('move-to-finish', (event) => {
            setTimeout(() => {
                $("#steparrow-finish-info-tab").trigger("click");
            }, 200);
        });
    });

    ////Photo scripts
    navigator.getUserMedia = ( navigator.getUserMedia ||
                             navigator.webkitGetUserMedia ||
                             navigator.mozGetUserMedia ||
                             navigator.msGetUserMedia);

    var video, webcamStream;
    var canvas, ctx;

    $(document).ready(function () {
        canvas = document.getElementById("myCanvas");
        ctx = canvas.getContext('2d');
    });
    $('#startWebcam').click(function () {
        console.log(navigator.getUserMedia);
        if (navigator.getUserMedia) {
           navigator.getUserMedia (
              // constraints
              {
                 video: true,
                 audio: false
              },

              // successCallback
              function(localMediaStream) {
                video = document.querySelector('video');
                 video.srcObject=localMediaStream;
                 // webcamStream = localMediaStream;
              },

              // errorCallback
              function(err) {
                 console.log("The following error occured: " + err);
              }
           );
        } else {
           console.log("getUserMedia not supported");
        }  
    });

    $('#stoptWebcam').click(function () {
        video.srcObject=null;
    });
    $('#takePhoto').click(function () {
        ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
        var dataURL = canvas.toDataURL();
        @this.set('photo', dataURL);
        video.srcObject=null;
    });

    //finger print
    $('#captureFinger').click(function () {
        if(!navigator.userAgent.includes('Windows')){
            console.log('testing from other os');
            @this.set('finger', 'testing');
            @this.set('finger_template', 'testing from mac');
            return;
        }
        var url = "http://localhost:8080/CallMorphoAPI";
        var xmlhttp;
        if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
        }else{// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
        }
        
        xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200){
                fpobject = JSON.parse(xmlhttp.responseText);
                console.log(fpobject.Base64ISOTemplate);
                document.getElementById("finger-print").src = "data:image/png;base64, "+fpobject.Base64BMPIMage+"";
                @this.set('finger', fpobject.Base64BMPIMage);
                @this.set('finger_template',fpobject.Base64ISOTemplate);
            }
        }

        var timeout = 5;
        xmlhttp.open("POST",url+"?"+timeout,true);
        xmlhttp.send();
    });
</script>
@endsection
