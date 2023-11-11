<script src="{{ asset('assets/base_template/vendor/global/global.min.js') }}"></script>
<script src="{{ asset('assets/base_template/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('assets/base_template/vendor/toastr/js/toastr.min.js') }}"></script>
<script src="{{ asset('assets/base_template/vendor/sweetalert2/dist/sweetalert2.min.js') }}"></script>
<script src="{{ asset('assets/base_template/js/toastr-setup.js') }}"></script>
@yield('extra_js_plugin')
<script src="{{ asset('assets/base_template/js/custom.min.js') }}"></script>
<script src="{{ asset('assets/base_template/js/deznav-init.js') }}"></script>
<script>
    @if (session('alert'))
        @if (session('alert')['type'] == 'success')
            toastr.success("{{ session('alert')['msg'] }}")
        @elseif (session('alert')['type'] == 'error')
            toastr.error("{{ session('alert')['msg'] }}")
        @elseif (session('alert')['type'] == 'warning')
            toastr.warning("{{ session('alert')['msg'] }}")
        @elseif (session('alert')['type'] == 'info')
            toastr.info("{{ session('alert')['msg'] }}")
        @endif
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}")
        @endforeach
    @endif
</script>
@yield('extra_script')
