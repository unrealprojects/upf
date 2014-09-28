@extends('frontend.site_techonline.'.$content['template'])

@section('main')
<!-- ФИЛЬТР -->
@include('frontend.site_techonline.layouts.filter.MainPageFilter');
<section class="Node">
    <h3 class="Heading Primary">Каталог строительной техники</h3>
    @include('frontend.site_techonline.parts.breadcrumbs')

        <article>
            <ul class="Snippet-List">
            @foreach($content['list'] as $item_key => $list_elem)
                <li class="Snippet-Item Row Merge">

                    <header class="Row Merge">
                        <h4 class="Item-Title Grid-XS-6">
                            <a href="/rent/{{$list_elem['metadata']['alias']}}">
                                {{$list_elem['name']}}
                            </a>
                            <span class="Item-Location">
                                {{$list_elem['model']['category']['name']}}
                            </span>
                        </h4>
                        <ul class="Item-Values Grid-XS-6">
                            <li><h6>Статус:</h6>{{$list_elem['status']['name']}}</li>
                            <li><h6>Состояние:</h6>{{$list_elem['opacity']['name']}}</li>
                            <li><h6>Телефоны:</h6>{{$list_elem['admin']['phone']}}</li>
                            <li><h6>Цена:</h6>{{$list_elem['price']}} <span>руб/час</span></li>
                        </ul>
                    </header>

                    @include('frontend.site_techonline.layouts.elements.Photos',
                        [
                            'photos'=>$list_elem['photos'],
                            'class_wrap'=>'Item-Gallery Grid-XS-3'
                        ])

                    <div class="Item-Content Grid-XS-9">
                        {{$list_elem['description']}}

                        <!-- Параметры товара -->
                        <h6 class="Toggle-Next-Item"><a href="#">Подробная информация</a></h6>
                        <table class="Toggled-Next-Item">
                            <tr>
                                <td>Арендодатель:</td>
                                <td><a href="/sellers/{{$list_elem['admin']['metadata']['alias']}}">{{$list_elem['admin']['name']}}</a></td>
                            </tr>
                            <tr>
                                <td>Телефон:</td>
                                <td>{{$list_elem['admin']['phone']}}</td>
                            </tr>
                            <tr>
                                <td>Бренд:</td>
                                <td>{{$list_elem['model']['brand']['name']}}</td>
                            </tr>
                            <tr>
                                <td>Модель:</td>
                                <td>{{$list_elem['model']['model']}}</td>
                            </tr>
                            <tr>
                                <td>Регион:</td>
                                <td>{{$list_elem['region']['name']}}</td>
                            </tr>
                        @foreach($list_elem['model']['params_values'] as $param)
                            <tr>
                                <td>{{$param['param_data']['name']}}</td>
                                <td>{{$param['value']}} {{$param['param_data']['dimension']}}</td>
                            </tr>
                        @endforeach
                        </table>
                    </div>

                </li>
            @endforeach
            </ul>
        </article>
<!-- Пагинация -->
{{$content['pagination']}}
</section>


@endsection

@section('scripts')
    @parent
    <script src="/js/frontend/Accordion.js" type="text/javascript"></script>
@endsection