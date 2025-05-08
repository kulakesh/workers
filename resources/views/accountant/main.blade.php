@extends('layouts.accountant.' . DEFAULT_THEME)

@section('title') {{ __('Accountant') }} @endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') {{ $params['page_group'] }} @endslot
        @slot('title') {{ $params['page_name'] }} @endslot
    @endcomponent

    @if($params['page_id'] == 'payment_unverified')
    <livewire:payment-varification varified="0"/>
    @elseif($params['page_id'] == 'payment_verified')
    <livewire:payment-varification varified="1"/>
    @elseif($params['page_id'] == 'payment_rejected')
    <livewire:payment-varification varified="2"/>
    @elseif($params['page_id'] == 'payment_all')
    <livewire:payment-varification/>
    @endif

@endsection
@section('script')

@endsection
