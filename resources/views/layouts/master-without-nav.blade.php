<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-topbar="light" data-sidebar-image="none"
    data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>@yield('title') | {{ config('app.name') }}</title>
    <meta property="og:image" content="https://www.spotbenefit.in/build/images/logo-xxlg.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Join today and achieve your financial goal">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('build/images/logo-sm.png') }}">
    @include('layouts.head-css')
</head>

@yield('body')

@yield('content')

@include('layouts.vendor-scripts')
</body>

</html>
