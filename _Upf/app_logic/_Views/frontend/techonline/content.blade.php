@extends('frontend.standard.start')

@section('head')
    @include('frontend.techonline.head')
@endsection

@section('content')
<div id="Page-Wrap">
    @include('frontend.techonline.parts.header')
    <main>
        @yield('main')
    </main>
    <div id="Page-Wrap-Stop"></div>
</div>

<div title="Вернуться наверх" id="Scroll-Top"></div>

<footer>
    @include('frontend.techonline.parts.footer')
</footer>
@endsection

@section('scripts')
    @include('frontend.techonline.script')
@endsectiondsa