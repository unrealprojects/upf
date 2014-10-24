@extends($Template)

@section('Main')
    <section class="Error-404 Node Grid Merge">
        <header class="Node-XXS-6 Node-XS-6">
            <h2>Упс!</h2>
            <p>Такой страницы нет</p>
        </header>
        <img src="/img/techonline/404-truck.png" alt=""/>
    </section>
@endsection






@section('scripts')
    @parent
    <script src="/js/frontend/Accordion.js" type="text/javascript"></script>
    <script src="/js/frontend/techonline/MainPage.js" type="text/javascript"></script>
@endsection