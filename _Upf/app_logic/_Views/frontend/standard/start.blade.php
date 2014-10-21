<!doctype HTML>
<html>

    <head>
        @include('general.head')
        @yield('head')
    </head>

    <body upf-page-interface="{{$Upf['Page']['Interface']}}"
          upf-page-component="{{$Upf['Page']['Component']}}"
          upf-page-section="{{$Upf['Page']['Section']}}"
          upf-page-alias="{{$Upf['Page']['Alias']}}"
          upf-page-type="{{$Upf['Page']['Action']}}">

        @yield('content')

        @include('general.scripts')
        @include('general.scripts_ie8')
        @yield('scripts')
        @yield('scripts_ie8')
    </body>
</html>