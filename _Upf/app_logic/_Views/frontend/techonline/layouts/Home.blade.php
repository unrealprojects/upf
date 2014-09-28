@extends('frontend.site_techonline.content')

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

<section class="Error-404 Row Merge">
    <header class="Grid-XXS-6 Grid-XS-6">
        <h2>Упс!</h2>
        <p>Такой страницы нет</p>
    </header>
    <img src="/img/techonline/404-truck.png" alt=""/>
</section>

<!-- ФИЛЬТР -->
@include('frontend.site_techonline.layouts.filter.MainPageFilter');
<!-- КАТАЛОГ СТРОЙТЕХНИКИ::КАТЕГОРИИ C КАРТИНКАМИ-->
<section class="Node">

    <h3 class="Heading Primary">Каталог стройтехники</h3>

    <ul class="Row Split List-Categories Icons">
        @foreach($content['categories'] as $category)
            <li class="Grid-XS-6 Grid-SM-3"><a href="/catalog/?category={{$category['alias']}}" alt="{{$category['name']}}"><img src="{{$category['logo']}}">{{$category['name']}}</a></li>
        @endforeach
    </ul>

</section>


<!-- АРЕНДОДАТЕЛИ::СПИСОК -->
<section class="Node Renters">

    <h3 class="Heading Primary">Лучшие арендодатели</h3>

    <ul class="List Snippets Row Split">
        @foreach($content['sellers'] as $seller)
        <li class="Grid-XS-6 Grid-HG-4 List-Item">
            <header>
                <h5 class="Item-Title">
                    <a href="/sellers/{{$seller['metadata']['alias']}}" alt=" {{$seller['name']}}">{{$seller['name']}}</a>
                    <span class="Item-Subtitle">
                        {{$seller['region']['name']}}
                    </span>
                </h5>

                <ul class="Vote">
                    <li><a class="Vote-Down" href="#"></a></li>
                    <li><span>{{$seller['rating']}}</span></li>
                    <li><a class="Vote-Up" href="#"></a></li>
                </ul>
            </header>
            <div class="Description">
                {{$seller['description']}}
            </div>
        </li>
        @endforeach
    </ul>

</section>

<!-- НОВОСТИ::СПИСОК -->
<section class="Node News">

    <h3 class="Heading Primary">Новости</h3>

    <ul class="List Snippets Row Split">
        @foreach($content['news'] as $new)
        <li class="List-Item Grid-XS-6">
            <header>
                <h5 class="Item-Title">
                    <a href="/news/{{$new['metadata']['alias']}}" alt=" {{$seller['name']}}">{{$new['name']}}</a>
                    <span class="Item-Subtitle">
                        {{$new['updated_at']}}
                    </span>
                </h5>


                <ul class="Vote">
                    <li><a class="Vote-Down" href="#"></a></li>
                    <li><span>{{$seller['rating']}}</span></li>
                    <li><a class="Vote-Up" href="#"></a></li>
                </ul>
            </header>

            <img src="{{$new['logo']}}" alt="{{$new['name']}}">
            <article class="Description">
                <div>{{$new['text_preview']}}</div>
            </article>
        </li>
        @endforeach
    </ul>

</section>

@endsection



@section('scripts')
    @parent
    <script src="/js/frontend/Accordion.js" type="text/javascript"></script>
    <script src="/js/frontend/techonline/MainPage.js" type="text/javascript"></script>
@endsection