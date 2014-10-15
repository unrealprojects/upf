@extends('frontend.standard.start')

@section('head')
    @include('frontend.techonline.head')
@endsection

@section('content')
<div id="Page-Wrap">
    @include('frontend.techonline.parts.header')
    <main>
        @yield('Main')
    </main>
    <div id="Page-Wrap-Stop"></div>
</div>

<div title="Вернуться наверх" id="Scroll-Top"><span class="Icon Icon-chevron-up"></span></div>

<footer>
    @include('frontend.techonline.parts.footer')
</footer>
@endsection

@section('scripts')
    @include('frontend.techonline.script')
@endsection