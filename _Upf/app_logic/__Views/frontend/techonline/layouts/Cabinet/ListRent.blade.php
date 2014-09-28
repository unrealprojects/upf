@extends('frontend.site_techonline.'.$content['template'])

@section('main')
<!-- Личный Кабинет :: Стройтехникка -->
<article class="Node">
    <h4 class="Section-Header">Стройтехника</h4>
    <ul class="Snippet-List">
        @foreach($content['item']['tech_list'] as $list_elem)
        <li class="Snippet-Item Row Split">
            <header>
                    <h4 class="Item-Title"><a href="/rent/{{$list_elem['metadata']['alias']}}">
                            {{$list_elem['name']}}</a>
                        <p class="Item-Category">
                            {{$list_elem['model']['category']['name']}}
                        </p>
                    </h4>
                    <ul class="Item-Values">
                        <li><h6>Статус:</h6>{{$list_elem['status']['name']}}</li>
                        <li><h6>Состояние:</h6>{{$list_elem['opacity']['name']}}</li>
                        <li><h6>Цена:</h6>{{$list_elem['rate']}}</li>
                    </ul>
            </header>
            <div class="Item-Gallery Grid Four">
                @foreach(json_decode($list_elem['photos'],true) as $i=>$photo)
                @if($i==0)
                <img class="Item-Main-Photo" src="{{$photo['src']}}" alt="{{$photo['name']}}">

                <ul>
                    @elseif($i>0 && $i<4)
                    <li><img src="{{$photo['src']}}" alt="{{$photo['name']}}"></li>
                    @elseif($i>=4)
                    <li style="display: none">
                        <img src="{{$photo['src']}}" alt="{{$photo['name']}}">
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>

            <div class="Item-Content Grid Eight">
                {{$list_elem['description']}}

                <!-- Параметры товара -->
                <h6>Характеристики</h6>
                <table>
                    <tr>
                        <td>Категория:</td>
                        <td>{{$list_elem['model']['category']['name']}}</td>
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
                    <tr>
                        <td>Cтатус:</td>
                        <td>{{$list_elem['status']['name']}}</td>
                    </tr>
                    <tr>
                        <td>Состояние:</td>
                        <td> {{$list_elem['opacity']['name']}}</td>
                    </tr>
                </table>
            </div>

        </li>
        @endforeach
    </ul>
</article>


@include('frontend.standard.layouts.comments.List')
@endsection

