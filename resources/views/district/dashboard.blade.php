@extends('layouts.district.' . DEFAULT_THEME)
@section('title') {{ __('Dashboard') }} @endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Dashboard @endslot
        @slot('title') Dashboard  @endslot
    @endcomponent

<div class="row">
    
    <div class="col-xl-3 col-md-6">
        <div class="card card-animate bg-success">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="fw-medium text-white-50 mb-0">Enrolements</p>
                        <h2 class="mt-4 ff-secondary fw-semibold text-white">{{ $entries }}</h2>
                        <a href="{{ route('district.workersReport') }}" class="btn btn-secondary btn-sm">View</a>
                    </div>
                    <div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-white bg-opacity-25 rounded-circle fs-2 material-shadow">
                                <i class="bx bxs-user-badge text-white"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 

    <div class="col-xl-3 col-md-6">
        <div class="card card-animate bg-warning">
            <div class="card-body">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="fw-medium text-white-50 mb-0">Pending Approvals</p>
                        <h2 class="mt-4 ff-secondary fw-semibold text-white">{{ $approvals }}</h2>
                        <a href="{{ route('district.workersReportApproval') }}" class="btn btn-secondary btn-sm">View</a>
                    </div>
                    <div>
                        <div class="avatar-sm flex-shrink-0">
                            <span class="avatar-title bg-white bg-opacity-25 rounded-circle fs-2 material-shadow">
                                <i class="bx bxs-user-badge text-white"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> 

</div>

@endsection
@section('script')

@endsection
