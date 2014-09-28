@extends('frontend.standard.start')

@section('content')
<header>
    @yield('header')
</header>

<main>
    @yield('main')
</main>

<footer>
    @yield('footer')
</footer>
@endsection

@section('head')
    <link rel="stylesheet" href="/scss/general/libs/upf/main.css"/>
@endsection