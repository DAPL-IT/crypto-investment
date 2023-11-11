<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width,initial-scale=1" />
<title>
    @yield('page_title')
</title>

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
<link rel="stylesheet"
    href="{{ asset('assets/base_template/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/base_template/vendor/toastr/css/toastr.css') }}">
<link href="{{ asset('assets/base_template/vendor/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet">
@yield('extra_css_plugin')
<link rel="stylesheet"href="{{ asset('assets/base_template/css/style.css') }}" />
@yield('extra_css')
