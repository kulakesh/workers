@extends('layouts.operator.' . DEFAULT_THEME)

@section('title') {{ __('Create Category') }} @endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') {{ $params['page_group'] }} @endslot
        @slot('title') {{ $params['page_name'] }} @endslot
    @endcomponent

    @if($params['page_id'] == 'worker')
    <livewire:create-worker />
    @elseif($params['page_id'] == 'item')
    <livewire:create-item />
    @elseif($params['page_id'] == 'variety')
    <livewire:create-variety  :item_id="$item_id"/>
    @endif

@endsection
@section('script')

@endsection
