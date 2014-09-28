@extends('frontend.site_techonline.'.$content['template'])

@section('main')

<section class="Node">
    <div class="Snippet-Item News">

        <header>
            <h3 class="Heading Primary">
                {{$content['item']['name']}}
            </h3>
        </header>

        <div class="Item-Photo">
            <img class="Photo" src="{{$content['item']['logo']}}" alt="{{$content['item']['logo']}}" itemprop="image">
        </div>

        <div class="Item-Content">
            {{$content['item']['text']}}
        </div>

        <footer class="Item-Info">
            <div class="Date">
                Дата публикации: {{$content['item']['created_at']}}
            </div>
            <ul class="Tag-List">
                @foreach($content['item']['tags'] as $tag)
                <li class="Tag-Item">
                    <a href="/news/?tag={{$tag['alias']}}&{{\Input::getQueryString()}}">
                        {{$tag['name']}}
                    </a>
                </li>
                @endforeach
            </ul>
        </footer>

    </div>
</section>
@include('frontend.standard.layouts.comments.List')

@endsection