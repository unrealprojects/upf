@extends('backend.standard.start')

@section('head')
    @include('backend.standard.head')
@endsection


@section('content')
    <main>
        @yield('main')
    </main>
@endsection


@section('scripts')
    @include('backend.standard.scripts')
@endsection