@extends('frontend.site_techonline.'.$content['template'])

@section('main')
<section class="Node News-Page">

    <h3 class="Heading Primary">Новости</h3>
    <div class="Row Merge">
        <!-- Фильтрация :: Общий блок -->
        <aside class="Sidebar-Filter Grid XS-2">
            <!-- Фильтрация :: По тегам -->
            <h4>Теги</h4>
            <ul class="List-Filter">
                @foreach($content['tags'] as $tag)
                <li><a href="/news/?tag={{$tag['alias']}}&{{\Input::getQueryString()}}">{{$tag['name']}}</a></li>
                @endforeach
            </ul>
        </aside>

        <article class="Grid XS-9 End">
            <ul class="Snippet-List">
            @foreach($content['list'] as $list_elem)
                <li class="Snippet-Item">

                    <header>
                        <h4 class="Item-Title">
                            <a href="/news/{{$list_elem['metadata']['alias']}}">{{$list_elem['name']}}</a>

                            <span class="Item-Subtitle">{{$list_elem['created_at']}}</span>
                        </h4>

                        <ul class="Vote">
                            <li><a class="Vote-Down" href="#"></a></li>
                            <li><span>{{$list_elem['rating']}}</span></li>
                            <li><a class="Vote-Up" href="#"></a></li>
                        </ul>
                    </header>

                    <div class="Item-Photo">
                        <img src="{{$list_elem['logo']}}" alt="{{$list_elem['name']}}" style="width: 100%;">
                    </div>

                    <div class="Item-Content">
                        <p>{{$list_elem['text_preview']}}</p>
                    </div>
                    <footer>
                        <ul class="Tag-List">
                            @foreach($list_elem['tags'] as $tag)
                            <li class="Tag-Item"><a href="/news/?tag={{$tag['alias']}}&{{\Input::getQueryString()}}">{{$tag['name']}}</a></li>
                            @endforeach
                        </ul>
                    </footer>
                </li>

            @endforeach
            </ul>
        </article>
    </div>
<!-- Пагинация -->
{{$content['pagination']}}

</section>

@endsection

@section('scripts')
    @parent
    <script src="/js/frontend/Accordion.js" type="text/javascript"></script>
@endsection
