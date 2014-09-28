@extends('backend.standard.start')

@section('head')
    @include('backend.standard.head')
@endsection


@section('content')
    @include('backend.standard.parts.Menu')
    <main>
        @include('backend.standard.parts.Navbar')
        @yield('main')
    </main>
@endsection


@section('scripts')
    @include('backend.standard.scripts')
@endsection