@extends('layouts.admin.' . DEFAULT_THEME)

@section('title') {{ __('Create Category') }} @endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') {{ $params['page_group'] }} @endslot
        @slot('title') {{ $params['page_name'] }} @endslot
    @endcomponent

    @if($params['page_id'] == 'district')
    <livewire:create-district />
    @elseif($params['page_id'] == 'document')
    <livewire:document-heads-create />
    @elseif($params['page_id'] == 'worker_report_all')
    <livewire:workers-report-all for="admin"/>
    @elseif($params['page_id'] == 'worker-edit')
    <livewire:create-worker :worker_id="$worker_id"/>
    @endif

@endsection
@section('script')

@endsection
