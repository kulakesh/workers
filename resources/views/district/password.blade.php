@extends('layouts.district.' . DEFAULT_THEME)
@section('title') {{ __('Change Password') }} @endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') Settings @endslot
        @slot('title') Change Password @endslot
    @endcomponent

<div class="row">
    <div class="col-12 col-md-6">

        <x-alert />

        <div class="card">
            
            <div class="card-body">
                <form action="{{ route('district.ChangePasswordCreate') }}" enctype="multipart/form-data" method="post">
                    @csrf
                    
                    <x-input-horizontal name="current_password"
                        id="current_password"
                        type="password"
                        label="Current Password"
                        placeholder="Current Password"
                    />

                    <x-input-horizontal name="password"
                        id="password"
                        type="password"
                        label="New Password"
                        placeholder="New Password"
                    />
                    
                    <x-input-horizontal name="password_confirmation"
                        id="password_confirmation"
                        type="password"
                        label="Confirm Password"
                        placeholder="Confirm Password"
                    />

                    <div class="text-end">
                        <x-button.save type="submit">
                            {{ __('Submit') }}
                        </x-button.save>
                    </div>

                </form>
            </div>
        </div>
    </div>
    
</div>

@endsection
@section('script')

@endsection
