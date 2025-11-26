<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('components.head')
</head>

<body id="page-top">
    @include('components.navbar')

    @yield('content')

    @include('components.footer')
    @include('components.notification')

    @include('components.scripts')
</body>
</html>