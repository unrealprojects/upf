@extends('backend.standard.start')

@section('head')
    @include('backend.site_techonline.head')
@endsection

@section('content')
@include('backend.site_techonline.parts.navigation')
    <div data-role="header" class="ui-header-fixed">
        @include('backend.site_techonline.parts.header')
    </div>
    <div role="main" class="ui-content">
        @yield('main')
    </div>
    <div data-role="footer">

    </div>
@endsection


@section('template_scripts')
    @include('backend.site_techonline.scripts')
@endsection