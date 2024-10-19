<div>
    <div class="row">
        <div class="col-md-12 col-xl-8 offset-2">
            <div class="card">
                <div class="card-body">
                    <form action="#" class="form-steps" autocomplete="off">
                        
                        <div class="step-arrow-nav mb-4">

                            <ul class="nav nav-pills custom-nav nav-justified" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="steparrow-gen-info-tab" data-bs-toggle="pill"
                                        data-bs-target="#steparrow-gen-info" type="button" role="tab"
                                        aria-controls="steparrow-gen-info" aria-selected="false">General</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="steparrow-family-info-tab"
                                        data-bs-toggle="pill" data-bs-target="#steparrow-family-info" type="button"
                                        role="tab" aria-controls="steparrow-family-info"
                                        aria-selected="false">Family</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="steparrow-employment-info-tab"
                                        data-bs-toggle="pill" data-bs-target="#steparrow-employment-info" type="button"
                                        role="tab" aria-controls="steparrow-employment-info"
                                        aria-selected="false">Employment</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="steparrow-photo-info-tab"
                                        data-bs-toggle="pill" data-bs-target="#steparrow-photo-info" type="button"
                                        role="tab" aria-controls="steparrow-photo-info"
                                        aria-selected="false">Photo</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="steparrow-biometric-info-tab"
                                        data-bs-toggle="pill" data-bs-target="#steparrow-biometric-info" type="button"
                                        role="tab" aria-controls="steparrow-biometric-info"
                                        aria-selected="false">Biometric</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="steparrow-document-info-tab"
                                        data-bs-toggle="pill" data-bs-target="#steparrow-document-info" type="button"
                                        role="tab" aria-controls="steparrow-document-info"
                                        aria-selected="false">Document</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="steparrow-review-info-tab"
                                        data-bs-toggle="pill" data-bs-target="#steparrow-review-info" type="button"
                                        role="tab" aria-controls="steparrow-review-info"
                                        aria-selected="false">Review</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="steparrow-finish-info-tab"
                                        data-bs-toggle="pill" data-bs-target="#steparrow-finish-info" type="button"
                                        role="tab" aria-controls="steparrow-finish-info"
                                        aria-selected="false">Finish</button>
                                </li>
                            </ul>
                        </div>

                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="steparrow-gen-info" role="tabpanel"
                                aria-labelledby="steparrow-gen-info-tab">
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
                                                <select name="gender" id="gender" class="form-select" aria-label="Gender">
                                                    <option  selected="" disabled="">Select Gender</option>
                                                    <option value="Male" @if(old('gender')=='Male') selected="selected" @endif>Male</option>
                                                    <option value="Female" @if(old('gender')=='Female') selected="selected" @endif>Female</option>
                                                    <option value="Other" @if(old('gender')=='Other') selected="selected" @endif>Other</option>
                                                </select>
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
                                                    placeholder="Pin number"
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
                                            <input type="checkbox" id="same_address" name="same_address" value="same">
                                            <label for="vehicle3"> Same as present address</label>
                                            </div>
                                        </div>
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
                                                    placeholder="Pin number"
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
                                        <div class="card-header"><h5>Nomini details</h5></div>
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
                                    <button type="button" class="btn btn-success btn-label right ms-auto nexttab nexttab"
                                        data-nexttab="steparrow-description-info-tab"><i
                                            class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Next</button>
                                </div>
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane fade" id="steparrow-family-info" role="tabpanel"
                                aria-labelledby="steparrow-family-info-tab">
                                <div>
                                    <h4>Family</h4>
                                </div>
                                <div class="d-flex align-items-start gap-3 mt-4">
                                    <button type="button" class="btn btn-light btn-label previestab"
                                        data-previous="steparrow-gen-info-tab"><i
                                            class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back to
                                        General</button>
                                    <button type="button" class="btn btn-success btn-label right ms-auto nexttab nexttab"
                                        data-nexttab="steparrow-employment-info"><i
                                            class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Next</button>
                                </div>
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane fade" id="steparrow-employment-info" role="tabpanel"
                                aria-labelledby="steparrow-employment-info-tab">
                                <div>
                                    <h4>Employer Details</h4>
                                </div>
                                <div class="d-flex align-items-start gap-3 mt-4">
                                    <button type="button" class="btn btn-light btn-label previestab"
                                        data-previous="steparrow-family-info-tab"><i
                                            class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back to
                                        Family</button>
                                    <button type="button" class="btn btn-success btn-label right ms-auto nexttab nexttab"
                                        data-nexttab="pills-photo-tab"><i
                                            class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Submit</button>
                                </div>
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane fade" id="steparrow-photo-info" role="tabpanel"
                                aria-labelledby="steparrow-photo-info-tab">
                                <div>
                                    <h4>Photo capture</h4>
                                </div>
                                <div class="d-flex align-items-start gap-3 mt-4">
                                    <button type="button" class="btn btn-light btn-label previestab"
                                        data-previous="steparrow-employment-info-tab"><i
                                            class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back to
                                            Employment</button>
                                    <button type="button" class="btn btn-success btn-label right ms-auto nexttab nexttab"
                                        data-nexttab="steparrow-biometric-info"><i
                                            class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Submit</button>
                                </div>
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane fade" id="steparrow-biometric-info" role="tabpanel"
                                aria-labelledby="steparrow-biometric-info-tab">
                                <div>
                                    <h4>Biometric Capture</h4>
                                </div>
                                <div class="d-flex align-items-start gap-3 mt-4">
                                    <button type="button" class="btn btn-light btn-label previestab"
                                        data-previous="steparrow-photo-info-tab"><i
                                            class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back to
                                            Photo</button>
                                    <button type="button" class="btn btn-success btn-label right ms-auto nexttab nexttab"
                                        data-nexttab="steparrow-document-info-tab"><i
                                            class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Submit</button>
                                </div>
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane fade" id="steparrow-document-info" role="tabpanel"
                                aria-labelledby="steparrow-document-info-tab">
                                <div>
                                    <h4>Upload documents</h4>
                                </div>
                                <div class="d-flex align-items-start gap-3 mt-4">
                                    <button type="button" class="btn btn-light btn-label previestab"
                                        data-previous="steparrow-biometric-info-tab"><i
                                            class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back to
                                            Biometric</button>
                                    <button type="button" class="btn btn-success btn-label right ms-auto nexttab nexttab"
                                        data-nexttab="steparrow-review-info-tab"><i
                                            class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Submit</button>
                                </div>
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane fade" id="steparrow-review-info" role="tabpanel"
                                aria-labelledby="steparrow-review-info-tab">
                                <div>
                                    <h4>Review</h4>
                                </div>
                                <div class="d-flex align-items-start gap-3 mt-4">
                                    <button type="button" class="btn btn-light btn-label previestab"
                                        data-previous="steparrow-upload-info-tab"><i
                                            class="ri-arrow-left-line label-icon align-middle fs-16 me-2"></i> Back to
                                            Upload</button>
                                    <button type="button" class="btn btn-success btn-label right ms-auto nexttab nexttab"
                                        data-nexttab="steparrow-finish-info-tab"><i
                                            class="ri-arrow-right-line label-icon align-middle fs-16 ms-2"></i>Submit</button>
                                </div>
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane fade" id="steparrow-finish-info" role="tabpanel">
                                <div class="text-center">

                                    <div class="avatar-md mt-5 mb-4 mx-auto">
                                        <div class="avatar-title bg-light text-success display-4 rounded-circle">
                                            <i class="ri-checkbox-circle-fill"></i>
                                        </div>
                                    </div>
                                    <h5>Well Done !</h5>
                                    <p class="text-muted">You have Successfully Signed Up</p>
                                </div>
                            </div>
                            <!-- end tab pane -->

                        </div>
                        <!-- end tab content -->
                    </form>
                </div>
                <!-- end card body -->
            </div>
        </div>
    </div>
</div>
@section('script')
<script src="{{ URL::asset('build/js/pages/form-wizard.init.js') }}"></script>
@endsection