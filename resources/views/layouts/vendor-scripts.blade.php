@yield('script')
<script src="{{ URL::asset('build/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
<script src="{{ URL::asset('build/js/plugins.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
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
@yield('script-bottom')
