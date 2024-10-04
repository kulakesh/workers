@extends(DEFAULT_THEME)

@section('title') {{ __('Create Category') }} @endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') {{ $params['page_group'] }} @endslot
        @slot('title') {{ $params['page_name'] }} @endslot
    @endcomponent

    @if($params['page_id'] == 'district')
    <livewire:create-district />
    @elseif($params['page_id'] == 'item')
    <livewire:create-item />
    @elseif($params['page_id'] == 'variety')
    <livewire:create-variety  :item_id="$item_id"/>
    @endif

@endsection
@section('script')
<script src="{{ URL::asset('build/libs/flatpickr/flatpickr.min.js') }}"></script>
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('close-modal', (event) => {
            setTimeout(() => {
                $('.modal').modal('hide');
                $('.modal').find('.hide-me-after-done').html('');
            }, 2000);
        });
    });
</script>
@endsection
