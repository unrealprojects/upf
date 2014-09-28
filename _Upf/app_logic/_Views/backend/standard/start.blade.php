<!doctype HTML>
<html>

<head>
    @include('general.head')
    @yield('head')
</head>

<body>
    <div data-role="page">
        @yield('content')
    </div>

    @include('general.scripts')
    @yield('template_scripts')
    @yield('scripts')

    @yield('scripts_ie8')
</body>

</html>
