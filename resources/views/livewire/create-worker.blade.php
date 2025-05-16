<div>
    <x-loading-indicator />
    <div class="row">
        <div class="col-md-12"> 
            <!-- col-xl-8 offset-2 -->
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
                                        aria-selected="false" wire:ignore.self>Nominee</button>
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
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="steparrow-benefits-info-tab"
                                        data-bs-toggle="pill" data-bs-target="#steparrow-benefits-info" type="button"
                                        role="tab" aria-controls="steparrow-benefits-info"
                                        aria-selected="false" wire:ignore.self>Benefits</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="steparrow-payment-info-tab"
                                        data-bs-toggle="pill" data-bs-target="#steparrow-payment-info" type="button"
                                        role="tab" aria-controls="steparrow-payment-info"
                                        aria-selected="false" wire:ignore.self>Renewal</button>
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
                                                <label for="marital" class="form-label ">Marital status</label>
                                                <span class="required">*</span>
                                                <select name="marital" id="marital" wire:model="marital" class="form-select" aria-label="Marital">
                                                    <option selected="">Select status</option>
                                                    <option value="Married" @if(old('marital')=='Married') selected="selected" @endif>Married</option>
                                                    <option value="Unmarried" @if(old('marital')=='Unmarried') selected="selected" @endif>Unmarried</option>
                                                    <option value="Widowed" @if(old('marital')=='Widowed') selected="selected" @endif>Widowed</option>
                                                    <option value="Other" @if(old('marital')=='Other') selected="selected" @endif>Other</option>
                                                </select>
                                                @error('marital')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                </div>
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="spouse"
                                                    label="Spouse's Name (if married)"
                                                    placeholder="Spouse's Name"
                                                />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="dob"
                                                    label="Date of Birth"
                                                    placeholder="DD/MM/YYYY"
                                                    required
                                                />
                                                </div>
                                                <div class="col-md-12 col-xl-6">
                                                <label for="gender" class="form-label ">Gender</label>
                                                <span class="required">*</span>
                                                <select name="gender" id="gender" wire:model="gender" class="form-select" aria-label="Gender">
                                                    <option selected="">Select Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                    <option value="Other">Other</option>
                                                </select>
                                                @error('gender')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="cast"
                                                    placeholder="Cast"
                                                />
                                                </div>
                                                <div class="col-md-12 col-xl-6">
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
                                                    <div class="mb-3">
                                                        <label for="phone" class="form-label @error('phone') text-danger @enderror">Phone</label>
                                                        <span class="required">*</span>
                                                        <div class="input-group">
                                                            <span class="input-group-text" id="basic-addon1">+91</span>
                                                            <input type="text" name="phone" id="phone" wire:model="phone" class="form-control @error('phone') is-invalid @enderror" placeholder="Phone Number" autocomplete="off" value="">
                                                        </div>
                                                        @error('phone')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-xl-6">
                                                <label for="gender" class="form-label ">Blood Group</label>
                                                <select name="bg" id="bg" wire:model="bg" class="form-select" aria-label="Blood Group">
                                                    <option selected="">Select Blood Group</option>
                                                    <option value="A+">A+</option>
                                                    <option value="A-">A-</option>
                                                    <option value="B+">B+</option>
                                                    <option value="B-">B-</option>
                                                    <option value="AB+">AB+</option>
                                                    <option value="AB-">AB-</option>
                                                    <option value="O+">O+</option>
                                                    <option value="O-">O-</option>
                                                </select>
                                                @error('gender')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header"><h5>Present Address</h5></div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 col-xl-6">
                                                <label for="name" class="form-label ">State</label>
                                                <span class="required">*</span>
                                                <select name="state_t" id="state_t" wire:model="state_t" wire:change="state_change_t" class="form-select" aria-label="State">
                                                    <option selected="">Select State</option>
                                                    @foreach ($state_names as $state_name)
                                                    <option value="{{ $state_name->state_name }}">{{ $state_name->state_name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('state_t')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                </div>
                                                <div class="col-md-12 col-xl-6">
                                                <label for="name" class="form-label ">District </label>
                                                <span class="required">*</span>
                                                <select name="district_t" id="district_t" wire:model="district_t" class="form-select" aria-label="District">
                                                    <option selected="">Select District</option>
                                                    @foreach ($state_districts_t as $state_district)
                                                    <option value="{{ $state_district['district_name'] }}">{{ $state_district['district_name'] }}</option>
                                                    @endforeach
                                                </select>
                                                @error('district_t')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="city_t"
                                                    label="City/Village"
                                                    placeholder="City/Village"
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
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="po_t"
                                                    label="Post Office"
                                                    placeholder="Post Office"
                                                />
                                                </div>
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="ps_t"
                                                    label="Police Station"
                                                    placeholder="Police Station"
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
                                                <label for="name" class="form-label ">State</label>
                                                <span class="required">*</span>
                                                <select name="state_p" id="state_p" wire:model="state_p" wire:change="state_change_p" class="form-select" aria-label="State">
                                                    <option selected="">Select State</option>
                                                    @foreach ($state_names as $state_name)
                                                    <option value="{{ $state_name->state_name }}">{{ $state_name->state_name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('state_p')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                </div>
                                                <div class="col-md-12 col-xl-6">
                                                <label for="name" class="form-label ">District</label>
                                                <span class="required">*</span>
                                                <select name="district_p" id="district_p" wire:model="district_p" class="form-select" aria-label="District">
                                                    <option selected="">Select District</option>
                                                    @foreach ($state_districts_p as $state_district)
                                                    <option value="{{ $state_district['district_name'] }}">{{ $state_district['district_name'] }}</option>
                                                    @endforeach
                                                </select>
                                                @error('district_p')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="city_p"
                                                    label="City/Village"
                                                    placeholder="City/Village"
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
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="po_p"
                                                    label="Post Office"
                                                    placeholder="Post Office"
                                                />
                                                </div>
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="ps_p"
                                                    label="Police Station"
                                                    placeholder="Police Station"
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
                                                <label for="nature" class="form-label ">AADHAAR</label>
                                                <span class="required">*</span>
                                                <input type="text" name="aadhaar" id="aadhaar" wire:model="aadhaar" class="form-control" placeholder="AADHAAR" autocomplete="off" required="">
                                                @error('aadhaar')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                </div>
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="serial"
                                                    label="Old Registration Number"
                                                    placeholder="Old Registration Number"
                                                    />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="nature"
                                                    label="Nature of work"
                                                    placeholder="Nature of work"
                                                />
                                                </div>
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="pf_no"
                                                    label="ESI/PF numbers"
                                                    placeholder="ESI/PF numbers"
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
                                                    label="Anual income"
                                                    placeholder="0.00"
                                                />
                                                </div>
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="total_years"
                                                    label="Total years of service"
                                                    placeholder="0"
                                                />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header"><h5>Current Employer Details</h5></div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="est_name"
                                                    label="Name"
                                                    placeholder="Establishment name"
                                                />
                                                </div>
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="est_reg_no"
                                                    label="Registration number"
                                                    placeholder="Establishment registration number"
                                                    />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-xl-12">
                                                <x-input-wire name="est_address"
                                                    label="Address"
                                                    placeholder="Establishment address"
                                                />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="employer_name"
                                                    label="Employer Name"
                                                    placeholder="Employer Name"
                                                />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-xl-12">
                                                <x-input-wire name="employer_address"
                                                    label="Employer Address"
                                                    placeholder="Employer Address"
                                                />
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <label>
                                                If the applicant is already a member of any other welfare board, the name of such boards and registration number of the applicant.
                                                </label>

                                                <label>
                                                    <input type="radio" wire:model="other_welfare" value="yes" />
                                                    Yes
                                                </label>
                                                <label>
                                                    <input type="radio" wire:model="other_welfare" value="no" />
                                                    No
                                                </label>

                                                @error('other_welfare')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="welfare_name"
                                                    label="Welfare board name (if yes)"
                                                    placeholder="Welfare board name"
                                                />
                                                </div>
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="welfare_reg_no"
                                                    label="Welfare registration number (if yes)"
                                                    placeholder="Welfare board registration number"
                                                    />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <label>
                                                    Are there more than one BOCW in the family?
                                                </label>

                                                <label>
                                                    <input type="radio" wire:model="more_bocw" value="yes" />
                                                    Yes
                                                </label>
                                                <label>
                                                    <input type="radio" wire:model="more_bocw" value="no" />
                                                    No
                                                </label>

                                                @error('more_bocw')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="number_of_bocw"
                                                    label="Mention ID Numbers of all BoCW in the family (comma separated) (if yes)"
                                                    placeholder="BOCW IDs"
                                                />
                                                </div>
                                                <div class="col-md-12 col-xl-6">
                                                <x-input-wire name="primary_bocw"
                                                    label="Give ID Number of Primary BoCW in the family (if yes)"
                                                    placeholder="BOCW ID"
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
                                    <h4>Nominee</h4>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="table-primary">
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Date of birth</th>
                                                <th>Relation</th>
                                                <th>Address</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                
                                                <td>
                                                    <input type="text" class="form-control" name="nominee_name1" wire:model="nominee_name1" placeholder="Nominee 1 name">
                                                    @error('nominee_name1')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="nominee_dob1" id="nominee_dob1" wire:model="nominee_dob1" placeholder="Nominee 1 DOB (DD/MM/YYYY)">
                                                    <span class="text-primary" id="nomineeAge1"></span>
                                                    @error('nominee_dob1')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="nominee_relation1" wire:model="nominee_relation1" placeholder="Nominee 1 Relation">
                                                    @error('nominee_relation1')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="nominee_address1" wire:model="nominee_address1" placeholder="Nominee 1 Address">
                                                    @error('nominee_address1')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                
                                                <td>
                                                    <input type="text" class="form-control" name="nominee_name2" wire:model="nominee_name2" placeholder="Nominee 2 name">
                                                    @error('nominee_name2')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="nominee_dob2" id="nominee_dob2" wire:model="nominee_dob2" placeholder="Nominee 2 DOB (DD/MM/YYYY)">
                                                    <span class="text-primary" id="nomineeAge2"></span>
                                                    @error('nominee_dob2')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="nominee_relation2" wire:model="nominee_relation2" placeholder="Nominee 2 Relation">
                                                    @error('nominee_relation2')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="nominee_address2" wire:model="nominee_address2" placeholder="Nominee 2 Address">
                                                    @error('nominee_address2')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="d-flex align-items-start gap-3 mt-4">
                                    <button type="button" class="btn btn-light btn-label previestab"
                                        data-previous="steparrow-gen-info-tab"><i
                                            class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back to
                                        General</button>
                                    <button type="button" wire:click="validateNominee()" class="btn btn-success btn-label right ms-auto nexttab nexttab"
                                        data-nexttab="steparrow-employment-info"><i
                                            class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Next</button>
                                </div>
                            </div>


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
                                                <th>Document</th>
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
                                                <td>
                                                    <input type="file" wire:model="employer_document" wire:change="doNothig" accept="image/png, image/jpeg, application/pdf" class="form-select" />
                                                    @error('employer_document')
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
                                                    <td><a target="_blank" href="{{ asset('storage/employer/'.$employer['employer_document_name']) }}">View</a></td>
                                                    <td><button class="btn btn-danger btn-sm" wire:click="removeEmployers({{$loop->index}})">Remove</button></td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td class="align-middle text-center" colspan="6">
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
                                        Nominee</button>
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
                                                    <input type="file" wire:model="uploaded_documents.{{$index}}" wire:change="doNothig" accept="image/png, image/jpeg, application/pdf" class="form-select" />
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
                                            <div>Marital Status :  <strong>{{ $marital }}</strong>
                                                @error('marital')
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
                                            <div>E-mail :  <strong>{{ $email }}</strong>
                                                @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div>Phone Number :  <strong>{{ $phone }}</strong>
                                                @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div>Blood Group :  <strong>{{ $bg }}</strong>
                                                @error('bg')
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
                                                    <div>Post Office :  <strong>{{ $po_t }}</strong>
                                                        @error('po_t')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div>Police Station :  <strong>{{ $ps_t }}</strong>
                                                        @error('ps_t')
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
                                                    <div>Post Office :  <strong>{{ $po_p }}</strong>
                                                        @error('po_p')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div>Police Station :  <strong>{{ $ps_p }}</strong>
                                                        @error('ps_p')
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
                                                    <div>AADHAAR :  <strong>{{ $aadhaar }}</strong>
                                                        @error('aadhaar')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div>Old Registration Number :  <strong>{{ $serial }}</strong>
                                                        @error('serial')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div>Nature of work :  <strong>{{ $nature }}</strong>
                                                        @error('nature')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div>ESI/PF numbers :  <strong>{{ $pf_no }}</strong>
                                                        @error('pf_no')
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
                                                    <div>Anual income :  <strong>{{ $turnover }}</strong>
                                                        @error('turnover')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <h4>Current Employer Details</h4>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div>Establishment name :  <strong>{{ $est_name }}</strong>
                                                        @error('est_name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div>Establishment registration number :  <strong>{{ $est_reg_no }}</strong>
                                                        @error('est_reg_no')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div>Establishment address :  <strong>{{ $est_address }}</strong>
                                                        @error('est_address')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div>Employer Name :  <strong>{{ $employer_name }}</strong>
                                                        @error('employer_name')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div>Employer Address :  <strong>{{ $employer_address }}</strong>
                                                        @error('employer_address')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div>
                                                <label class="mb-0">
                                                If the applicant is already a member of any other welfare board : <strong>{{ $other_welfare }}</strong>
                                                </label>
                                                @error('other_welfare')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                </div>
                                                <div>Welfare board name :  <strong>{{ $welfare_name }}</strong>
                                                    @error('welfare_name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div>Welfare board registration number :  <strong>{{ $welfare_reg_no }}</strong>
                                                    @error('welfare_reg_no')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mt-2">
                                                <div>
                                                <label class="mb-0">
                                                Are there more than one BOCW in the family? : <strong>{{ $more_bocw }}</strong>
                                                </label>
                                                @error('more_bocw')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                </div>
                                                <div>Mention ID Numbers of all BoCW in the family :  <strong>{{ $number_of_bocw }}</strong>
                                                    @error('number_of_bocw')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                <div>Give ID Number of Primary BoCW in the family  :  <strong>{{ $primary_bocw }}</strong>
                                                    @error('primary_bocw')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-md-4 col-sm-6">
                                            @if($finger_name && file_exists(public_path('storage/biometric/') . $finger_name))
                                            <img class="d-block img-fluid mx-auto" src="{{ asset('storage/biometric/'. $finger_name)}}" alt="Biometric">
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <h4>Nominee Details</h4>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="table-primary">
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Date of Birth</th>
                                                        <th>Relation</th>
                                                        <th>Address</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>{{ $nominee_name1 }}</td>
                                                        <td>{{ $nominee_dob1 }}</td>
                                                        <td>{{ $nominee_relation1 }}</td>
                                                        <td>{{ $nominee_address1 }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td>{{ $nominee_name2 }}</td>
                                                        <td>{{ $nominee_dob2 }}</td>
                                                        <td>{{ $nominee_relation2 }}</td>
                                                        <td>{{ $nominee_address2 }}</td>
                                                    </tr>
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
                                                        <th>Document</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($employers as $employer)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $employer['employer_description'] }}</td>
                                                            <td>{{ $employer['employer_name_address'] }}</td>
                                                            <td>{{ $employer['employer_nature'] }}</td>
                                                            <td><a target="_blank" href="{{ asset('storage/employer/'.$employer['employer_document_name']) }}">View</a></td>
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
                                    </div>
                                    <h4>Benefit Details</h4>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr class="table-primary">
                                                        <th>#</th>
                                                        <th>Name of sanctioned Benefit</th>
                                                        <th>Date of sanction</th>
                                                        <th>Amount of sanction</th>
                                                        <th>Cheque no & date</th>
                                                        <th>Name of bank & branch</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @forelse ($benefits as $benefit)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>{{ $benefit['benefit_name'] }}</td>
                                                            <td>{{ $benefit['benefit_date'] }}</td>
                                                            <td>{{ $benefit['benefit_amount'] }}</td>
                                                            <td>{{ $benefit['benefit_cheque'] }}</td>
                                                            <td>{{ $benefit['benefit_bank'] }}</td>
                                                        </tr>
                                                    @empty
                                                        <tr>
                                                            <td class="align-middle text-center" colspan="6">
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
                                                @if(array_key_exists($index,$documents))  
                                                    @php
                                                    $doc_name = $document_head->docs->where('id',$documents[$index])->first();
                                                    @endphp
                                                    @if($doc_name)
                                                    - {{ $doc_name->name }}
                                                    @endif
                                                @endif
                                                @if(array_key_exists($index,$uploaded_document_name) && $uploaded_document_name[$index] != '') 
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
                                    <button type="button" wire:click="@if(!$edit_mode) submitAll() @else updateAll()@endif" class="btn btn-success btn-label right ms-auto nexttab nexttab"
                                        data-nexttab="steparrow-finish-info-tab"><i
                                            class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Complete Enrollment</button>
                                </div>
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane fade" id="steparrow-finish-info" role="tabpanel" wire:ignore.self>
                                <div class="text-center">
                                    @if(isset($_REQUEST['done']))
                                    <div class="avatar-md mt-5 mb-4 mx-auto">
                                        <div class="avatar-title bg-light text-success display-4 rounded-circle">
                                            <i class="ri-checkbox-circle-fill"></i>
                                        </div>
                                    </div>
                                    <h5>Well Done !</h5>
                                    <p class="text-muted">You have Successfully Registered</p>
                                    @elseif(isset($_REQUEST['edit']))
                                    <div class="avatar-md mt-5 mb-4 mx-auto">
                                        <div class="avatar-title bg-light text-warning display-4 rounded-circle">
                                            <i class="ri-checkbox-circle-fill"></i>
                                        </div>
                                    </div>
                                    <h5>Updated Successfully</h5>
                                    @else
                                    <div class="avatar-md mt-5 mb-4 mx-auto">
                                        <div class="avatar-title bg-light text-default display-4 rounded-circle">
                                            <i class="ri-error-warning-line"></i>
                                        </div>
                                    </div>
                                    <p>Go to Review and click Complete Enrollment</p>
                                    @endif
                                    @if($id)
                                        <button type="button" wire:click="sendsms()" class="btn btn-success">
                                            <i class="ri-mail-send-line"></i>
                                            Send SMS
                                        </button>
                                        <p class="text-primary">{{ $smsreply }}</p>
                                        @if(auth()->guard('operator')->check())
                                            <a href="{{ route('operator.createWorker') }}" class="btn btn-success">
                                                Enroll New
                                            </a>
                                        @endif
                                    @endif
                                </div>
                                @if(auth()->guard('district')->check())
                                <div class="card mt-3" style="background-color: beige;">
                                    <div class="card-body">
                                        <h4 class="card-title text-center mb-2">
                                            @if($approval == 1)
                                                <span class="text-success">Approved previously</span>
                                            @elseif($approval == 2)
                                                <span class="text-danger">Rejected previously</span>
                                            @else

                                            @endif
                                        </h4>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <form wire:submit.prevent="approveWorker">
                                                    <div class="row mb-3">
                                                        <h4>Approval</h4>
                                                        <div class="col-12">
                                                            <label for="approvalChecked">
                                                            <input type="checkbox" name="approvalChecked" id="approvalChecked" wire:model="approvalChecked">
                                                            I, RO {{ auth()->user()->name }}, confirm that I have reviewed all submitted data and documents for accuracy and authenticity. I approve the registration for further processing
                                                            </label>
                                                            @error('approvalChecked')
                                                            <div class="invalid-feedback">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                        <button type="submit" class="btn btn-success">
                                                            Approve
                                                        </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="col-lg-6">
                                            <form wire:submit.prevent="rejectWorker">
                                                <div class="row mb-3">
                                                    <h4>Rejection</h4>
                                                    <div class="col-12">
                                                        <label class="form-label">Rejection Reason</label>
                                                        <input type="text" name="rejection_reason" id="rejection_reason" wire:model="rejection_reason" class="form-control">
                                                        @error('rejection_reason')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                    <button type="submit" class="btn btn-danger">
                                                        Reject
                                                    </button>
                                                    </div>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                @endif
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane fade" id="steparrow-benefits-info" role="tabpanel"
                                aria-labelledby="steparrow-benefits-info-tab" wire:ignore.self>
                                <div>
                                    <h4>Benefits Received</h4>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="table-primary">
                                                <th>#</th>
                                                <th>Name of sanctioned Benefit</th>
                                                <th>Date of sanction</th>
                                                <th>Amount of sanction</th>
                                                <th>Cheque no & date</th>
                                                <th>Name of bank & branch</th>
                                                <th>-</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <form wire:submit.prevent="addBenefit">
                                            <tr>
                                                <td></td>
                                                
                                                <td>
                                                    <select name="benefit_name" id="benefit_name" wire:model="benefit_name" class="form-select" aria-label="Benefits">
                                                        <option selected="">Select Benefit</option>
                                                        @foreach ($benefit_names as $benefit_name)
                                                        <option value="{{ $benefit_name->name }}">{{ $benefit_name->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('benefit_name')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="benefit_date" id="benefit_date" wire:model="benefit_date" placeholder="(DD/MM/YYYY)">
                                                    @error('benefit_date')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="benefit_amount" wire:model="benefit_amount" placeholder="if any">
                                                    @error('benefit_amount')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="benefit_cheque" wire:model="benefit_cheque" placeholder="if any">
                                                    @error('benefit_cheque')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control" name="benefit_bank" wire:model="benefit_bank" placeholder="if any">
                                                    @error('benefit_bank')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </td>

                                                <td><button type="submit" class="btn btn-primary">Add</button></td>
                                            </tr>
                                            </form>
                                            @forelse ($benefits as $benefit)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $benefit['benefit_name'] }}</td>
                                                    <td>{{ $benefit['benefit_date'] }}</td>
                                                    <td>{{ $benefit['benefit_amount'] }}</td>
                                                    <td>{{ $benefit['benefit_cheque'] }}</td>
                                                    <td>{{ $benefit['benefit_bank'] }}</td>
                                                    <td><button class="btn btn-danger btn-sm" wire:click="removeBenefit({{$loop->index}})">Remove</button></td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td class="align-middle text-center" colspan="6">
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
                                        Nominee</button>
                                    <button type="button" wire:click="submitBenefits()" class="btn btn-success btn-label right ms-auto nexttab nexttab"
                                        data-nexttab="pills-photo-tab"><i
                                            class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Submit</button>
                                </div>
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane fade" id="steparrow-payment-info" role="tabpanel"
                                aria-labelledby="steparrow-payment-info-tab" wire:ignore.self>
                                @if($id)
                                <div>
                                    @if($renewals)
                                    <div class="card" style="background-color: beige;">
                                        <div class="card-header"><h5>Previous Renewals</h5></div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr class="table-primary">
                                                                <th>Renewal Year(s)</th>
                                                                <th>Paid Amount</th>
                                                                <th>Payment Mode</th>
                                                                <th>Ref. No</th>
                                                                <th>Payment Date</th>
                                                                <th>Entry Date</th>
                                                                <th>Receipt</th>
                                                                <th>Image</th>
                                                                <th>Varification</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
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
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="card">
                                        <div class="card-header"><h5>Payment Details</h5></div>
                                        <div class="card-body">
                                            
                                            <div class="row">
                                                <div class="col-md-12 col-xl-6">
                                                <label for="marital" class="form-label ">Renewal Year(s)</label>
                                                <span class="required">*</span>
                                                <select id="payment_years" wire:model="payment_years" wire:change="payment_year_change()" class="form-select" aria-label="Years">
                                                    <option selected="">Select Renewal Years</option>
                                                    <option value="1" @if(old('payment_years')=='1') selected="selected" @endif>1 Year</option>
                                                    <option value="2" @if(old('payment_years')=='2') selected="selected" @endif>2 Years</option>
                                                    <option value="3" @if(old('payment_years')=='3') selected="selected" @endif>3 Years</option>
                                                </select>
                                                @error('payment_years')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                </div>

                                                <div class="col-md-12 col-xl-6">
                                                <label for="marital" class="form-label ">Payable Amount</label>
                                                <input type="text" id="payment_amount" wire:model="payment_amount" class="form-control" placeholder="{{ $payment_amount }}" autocomplete="off" value="{{ $payment_amount }}" disabled="true">
                                                </div>
                                        </div>
                                            <div class="row">
                                                <div class="col-md-12 col-xl-6">
                                                <label for="marital" class="form-label ">Payment Mode</label>
                                                <span class="required">*</span>
                                                <select id="payment_mode" wire:model="payment_mode" class="form-select" aria-label="Mode">
                                                    <option selected="">Select Payment Mode</option>
                                                    <option value="UPI" @if(old('payment_mode')=='UPI') selected="selected" @endif>UPI (PhonePay, Google Pay etc..)</option>
                                                    <option value="NEFT" @if(old('payment_mode')=='NEFT') selected="selected" @endif>NEFT</option>
                                                    <option value="RTGS" @if(old('payment_mode')=='RTGS') selected="selected" @endif>RTGS</option>
                                                    <option value="Challan" @if(old('payment_mode')=='Challan') selected="selected" @endif>Challan</option>  
                                                </select>
                                                @error('payment_mode')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                </div>

                                                <div class="col-md-12 col-xl-6">
                                                <label for="marital" class="form-label ">Refference Number (UPI transaction ID, Ref. No, Challan number etc..)</label>
                                                <span class="required">*</span>
                                                <input type="text" id="payment_ref_no" wire:model="payment_ref_no" class="form-control" placeholder="Payment Refference Number" autocomplete="off">
                                                @error('payment_ref_no')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12 col-xl-6">
                                                <label for="marital" class="form-label ">Payment Date</label>
                                                <span class="required">*</span>
                                                <input type="text" id="payment_date" wire:model="payment_date" class="form-control flatpickr-input" 
                                                data-provider="flatpickr" data-date-format="d M Y"
                                                readonly="readonly" placeholder="Payment Date" autocomplete="off" readonly="" />
                                                @error('payment_date')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>
                                            <div class="col-md-12 col-xl-6">
                                                <label for="marital" class="form-label ">Upload Payment Receipt</label>
                                                <input type="file" wire:model="payment_document" wire:change="doNothig" accept="image/png, image/jpeg, application/pdf" class="form-select" />
                                                @error('payment_document')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                                @enderror
                                            </div>

                                        </div>
                                        <div class="card">
                                            <div class="card-header"><h5>Take Image</h5></div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <button class="btn btn-primary" id="startWebcamPayment">Start Camera</button>
                                                        <button class="btn btn-danger" id="stoptWebcamPayment">Stop Camera</button>
                                                        <button class="btn btn-warning" id="takePhotoPayment">Take Image</button>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6 col-sm-12">
                                                        <video width=400 height=400 id="videoPayment" controls autoplay></video>
                                                    </div>
                                                    <div class="col-md-6 col-sm-12">
                                                        @error('payment_photo')
                                                        <div class="invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                        <canvas style="border:1px solid black;" id="myCanvasPayment" width="400" height="300"></canvas>  
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>

                                <div class="d-flex align-items-start gap-3 mt-4">
                                    <button type="button" wire:click="submitPayment()" class="btn btn-success btn-label right ms-auto nexttab nexttab"
                                        data-nexttab="pills-photo-tab"><i
                                            class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Submit</button>
                                </div>

                                @else
                                <div class="text-center">
                                    <div class="avatar-md mt-5 mb-4 mx-auto">
                                        <div class="avatar-title bg-light text-default display-4 rounded-circle">
                                            <i class="ri-error-warning-line"></i>
                                        </div>
                                    </div>
                                    <p>Go to Review and click Complete Enrollment</p>
                                </div>
                                @endif
                            </div>
                            <!-- end tab pane -->

                            <div id="messageModals" class="modal fade" tabindex="-1" aria-hidden="true" wire:ignore.self>
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content border-0 overflow-hidden">
                                        <div class="modal-header p-3">
                                            <h4 class="card-title mb-0">Message</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        
                                        <div class="modal-body">
                                            <h4>
                                            @if(session()->has('message'))
                                            {{ session('message') }}
                                            @endif
                                            </h4>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->

                        </div>
                        <!-- end tab content -->
                </div>
                <!-- end card body -->
            </div>
        </div>
    </div>
</div>
@section('css')
<link rel="stylesheet" type="text/css" href="{{ URL::asset('build/libs/toastify-js/src/toastify.css') }}">
@endsection
@section('script')
<script src="{{ URL::asset('build/js/pages/form-wizard.init.js') }}"></script>
<script src="{{ URL::asset('build/libs/cleave.js/cleave.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/flatpickr/flatpickr.min.js') }}"></script>   
<script src="{{ URL::asset('build/libs/toastify-js/src/toastify.js') }}"></script>   
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
    if (document.querySelector("#nominee_dob1")) {
        var cleaveDate = new Cleave('#nominee_dob1', {
            date: true,
            delimiter: '/',
            datePattern: ['d', 'm', 'Y']
        });
    }
    if (document.querySelector("#nominee_dob2")) {
        var cleaveDate = new Cleave('#nominee_dob2', {
            date: true,
            delimiter: '/',
            datePattern: ['d', 'm', 'Y']
        });
    }
    if (document.querySelector("#benefit_date")) {
        var cleaveDate = new Cleave('#benefit_date', {
            date: true,
            delimiter: '/',
            datePattern: ['d', 'm', 'Y']
        });
    }
    $('#nominee_dob1').blur(function () {
        let age = calculateAge($('#nominee_dob1').val());
        if(age > 0){
            $('#nomineeAge1').html(age + ' years')
        }else{
            $('#nomineeAge1').html('')
        }
    });
    $('#nominee_dob2').blur(function () {
        let age = calculateAge($('#nominee_dob2').val());
        if(age > 0){
            $('#nomineeAge2').html(age + ' years')
        }else{
            $('#nomineeAge2').html('')
        }
    });
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
        Livewire.on('move-to-benefits', (event) => {
            setTimeout(() => {
                $("#steparrow-benefits-info-tab").trigger("click");
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
        Livewire.on('validation-error', (event) => {
            Toastify({
                text: "Error found in form, please check and try again.",
                duration: 3000,
                gravity: "top",
                position: 'center',
                backgroundColor: "linear-gradient(to right, #FF5F6D, #FFC371)",
                className: "info",
            }).showToast();
        });
        Livewire.on('payment-done', (event) => {
            $("#messageModals").modal('show');
        });
    });
    
    ////Photo scripts
    navigator.getUserMedia = ( navigator.getUserMedia ||
                             navigator.webkitGetUserMedia ||
                             navigator.mozGetUserMedia ||
                             navigator.msGetUserMedia);

    var video, canvas, ctx;
    var videoPayment,canvasPayment, ctxPayment;

    $(document).ready(function () {
        canvas = document.getElementById("myCanvas");
        ctx = canvas.getContext('2d');
        canvasPayment = document.getElementById("myCanvasPayment");
        ctxPayment = canvasPayment.getContext('2d');
    });
    $('#startWebcam').click(function () {
        if (navigator.getUserMedia) {
           navigator.getUserMedia (
              // constraints
              {
                 video: true,
                 audio: false
              },

              // successCallback
              function(localMediaStream) {
                video = document.getElementById('video');
                 video.srcObject=localMediaStream;
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

    $('#startWebcamPayment').click(function () {
        if (navigator.getUserMedia) {
           navigator.getUserMedia (
              // constraints
              {
                 video: true,
                 audio: false
              },

              // successCallback
              function(localMediaStream) {
                videoPayment = document.getElementById('videoPayment');
                 videoPayment.srcObject=localMediaStream;
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

    $('#stoptWebcamPayment').click(function () {
        videoPayment.srcObject=null;
    });
    $('#takePhotoPayment').click(function () {
        ctxPayment.drawImage(videoPayment, 0, 0, canvasPayment.width, canvasPayment.height);
        var dataURL = canvasPayment.toDataURL();
        @this.set('payment_photo', dataURL);
        videoPayment.srcObject=null;
    });

    //finger print
    $('#captureFinger').click(function () {
        @this.set('finger_captured', true);
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
