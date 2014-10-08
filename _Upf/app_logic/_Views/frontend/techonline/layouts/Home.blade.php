@extends($Template)

@section('main')
    <section id="Page-Slider" class="Visible-SM">
        <div class="Slider-Inner">
            <img id="Truck" src="/img/techonline/belaz.png" alt=""/>
            <div id="Slider-Links">
                <a class="Button Large" href="#">Арендовать стройтехнику</a>
                <a class="Button Large" href="#">Разместить стройтехнику</a>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    @parent
    <script src="/js/frontend/Accordion.js" type="text/javascript"></script>
    <script src="/js/frontend/techonline/MainPage.js" type="text/javascript"></script>
@endsection