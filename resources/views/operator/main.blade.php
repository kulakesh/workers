@extends('layouts.operator.' . DEFAULT_THEME)

@section('title') {{ __('Create Category') }} @endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') {{ $params['page_group'] }} @endslot
        @slot('title') {{ $params['page_name'] }} @endslot
    @endcomponent

    @if($params['page_id'] == 'worker')
    <livewire:create-worker />
    @elseif($params['page_id'] == 'worker_report_all')
    <livewire:workers-report-all for="operator"/>
    @elseif($params['page_id'] == 'worker-edit')
    <livewire:create-worker :worker_id="$worker_id"/>
    @endif

@endsection
@section('script')

@endsection
