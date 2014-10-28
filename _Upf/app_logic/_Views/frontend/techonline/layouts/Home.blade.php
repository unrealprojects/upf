@extends($Template)

@section('Main')


    {{-- Header --}}
        <section id="Page-Slider" class="Visible-SM">
            <div class="Slider-Inner">
                <img id="Truck" src="/img/techonline/belaz.png" alt=""/>
                <div id="Slider-Links">
                    <a class="Button Large" href="/rent">Арендовать стройтехнику</a>
                    <a class="Button Large" href="/cabinet">Разместить стройтехнику</a>
                </div>
            </div>
        </section>
    {{-- End Header --}}



    {{-- Filter --}}
        @include($TemplateLayouts.'Filter.Tabs')
    {{-- End Filter --}}

    {{-- Main Categories --}}
        <section class="Node">
            <h3 class="Heading Primary">Каталог стройтехники</h3>

            <ul class="Grid Merge List-Categories Icons">
                @foreach($Content['MainCatalogCategories'] as $Category)
                    <li class=" Node-SM-3 Node-XXS-12 Node-XS-6">
                        <a href="/catalog/?category={{$Category['alias']}}" alt="{{$Category['title']}}">
                            <img src="{{$Category['logotype']}}">
                                {{$Category['title']}}
                        </a>
                    </li>
                @endforeach
            </ul>

        </section>
    {{-- Main Categories --}}





    {{-- Main Users --}}
        <section class="Node Renters">

            <h3 class="Heading Primary">Лучшие арендодатели</h3>

            <ul class="Snippet-List Split Grid">
                @foreach($Content['BestUsers'] as $User)
                <li class="Node-XS-6 Node-HG-4 Snippet-Item Grid Merge">
                    <header class="Grid Merge">
                        <h4 class="Item-Title Node-XXS-9">
                            <a href="/users/{{$User['meta']['alias']}}" alt=" {{$User['title']}}">{{$User['title']}}</a>
                            <span class="Item-Subtitle">
                                {{$User['meta']['created_at']}}
                            </span>
                        </h4>

                        @include( $TemplateLayouts . 'Snippet.Elements.Vote', [ 'Item' => $User['meta'] , 'Action' => 'section', 'Class' => 'Node-XXS-3'])
                    </header>

                    <div class="Grid Node-XS-3 Item-Gallery">
                        <a href="{{ $User['logotype'] }}" rel="Gallery" class="fancybox">
                            <img class="Item-Main-Photo" src="{{ $User['logotype'] }}" alt="{{ $User['title'] }}">
                        </a>
                    </div>

                    <div class="Grid Node-XS-9 Item-Content">
                        {{$User['about']}}
                    </div>
                </li>
                @endforeach
            </ul>

        </section>
    {{-- End Users --}}




    {{-- Last Articles --}}
        <section class="Node Articles">

            <h3 class="Heading Primary">Новости</h3>

            <ul class="Snippet-List Split Grid">

                @foreach($Content['LastArticles'] as $Article)
                    <li class="Snippet-Item Node-XS-6">
                        <header class="Grid Merge">

                            <h5 class="Item-Title Node-XXS-9">
                                <a href="/articles/{{$Article['meta']['alias']}}" alt=" {{$Article['title']}}">{{$Article['title']}}</a>
                                <time class="Item-Subtitle">
                                    {{$Article['meta']['updated_at']}}
                                </time>
                            </h5>

                            @include( $TemplateLayouts . 'Snippet.Elements.Vote', [ 'Item' => $Article['meta'] , 'Action' => 'section', 'Class' => 'Node-XXS-3'])

                        </header>
                        <div class="Grid Node-XS-4 Item-Gallery">
                            <img src="{{$Article['logotype']}}" alt="{{$Article['title']}}">
                        </div>
                        <article class="Item-Content Node-XS-8">
                            <div>{{ $Article['intro'] }}</div>
                        </article>

                        @if(isset($Article['meta']['tags']))
                        <footer>
                            <ul class="Tag-List">
                                @foreach( $Article['meta']['tags'] as $Tag )
                                    <li class="Tag-Item">
                                        <a href="{{$BaseUrl}}?tag={{$Tag['alias']}}">{{$Tag['title']}}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </footer>
                        @endif
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