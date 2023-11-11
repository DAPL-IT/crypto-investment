<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('page_title')</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/base_template/vendor/toastr/css/toastr.css') }}">
    <link href="{{ asset('assets/base_template/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}"
        rel="stylesheet">
    @yield('extra_css_plugin')
    <link href="{{ asset('assets/base_template/css/style.css') }}" rel="stylesheet">
    <style>
        html,
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 100vh;
            background: #f3f2f6 !important
        }

        ::placeholder {
            color: rgba(128, 128, 128, 0.5) !important;
            font-size: 9pt !important;
        }

        .password-field {
            padding-right: 40px;
        }

        .password-eye-icon {
            position: absolute;
            top: 52%;
            right: 30px;
        }

        .error-text {
            font-size: 8pt;
            color: rgb(247, 95, 95) !important;
            padding: 0px 25px 15px 25px !important;
            display: none
        }
    </style>
    @yield('extra_css')
</head>

<body>
    <div>
        <div class="container ">
            <div class="row justify-content-center  align-items-center">
                <div class="col-md-6 col-12 py-3">
                    <div class="authincation-content">
                        @yield('main_content')
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Scripts -->
    <script src="{{ asset('assets/base_template/vendor/global/global.min.js') }}"></script>
    <script src="{{ asset('assets/base_template/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('assets/base_template/vendor/toastr/js/toastr.min.js') }}"></script>
    <script src="{{ asset('assets/base_template/js/toastr-setup.js') }}"></script>
    @yield('extra_js_plugin')
    <script src="{{ asset('assets/base_template/js/custom.min.js') }}"></script>
    <script src="{{ asset('assets/base_template/js/deznav-init.js') }}"></script>
    <script src="{{ asset('assets/base_template/js/helper-utilites.js') }}"></script>
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
</body>

</html>
