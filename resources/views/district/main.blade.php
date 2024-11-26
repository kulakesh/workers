@extends('layouts.district.' . DEFAULT_THEME)

@section('title') {{ __('Create Category') }} @endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') {{ $params['page_group'] }} @endslot
        @slot('title') {{ $params['page_name'] }} @endslot
    @endcomponent

    @if($params['page_id'] == 'oparator')
    <livewire:create-operator />
    @elseif($params['page_id'] == 'worker_report_all')
    <livewire:workers-report-all for="district"/>
    @endif

@endsection
@section('script')

@endsection
