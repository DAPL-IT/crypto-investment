<!DOCTYPE html>
<html lang="en">
@php
    $appName = 'App Name';

    if (file_exists('app_configs/app_settings.json')) {
        $appSettingsPath = public_path('app_configs/app_settings.json');
        $getAppName = json_decode(file_get_contents($appSettingsPath), true);
        $appName = $getAppName['app_name'] ?? $appName;
    }

@endphp

<head>
    @include('template.includes.head')
</head>

<body>
    <!-- Preloader start -->
    @include('template.includes.preloader')
    <!-- Preloader end -->

    <!-- Main wrapper start -->
    <div id="main-wrapper">
        <!-- Brand header start -->
        @include('template.includes.brand-header')
        <!-- Brand header end -->

        <!-- Nav header start -->
        @include('template.includes.nav-header')
        <!-- Nav header end -->

        <!--  Sidebar start -->
        @include('template.includes.sidebar')
        <!--  Sidebar end -->

        <!-- Content body start -->
        <div class="content-body">
            <div class="container mt-0 px-2">
                @yield('main_content')
            </div>
        </div>
        <!-- Content body end -->

        <!-- Footer start -->
        @include('template.includes.footer')
        <!-- Footer end -->
    </div>
    <!-- Main wrapper end -->

    <!-- Script Section -->
    @include('template.includes.script')
</body>

</html>
