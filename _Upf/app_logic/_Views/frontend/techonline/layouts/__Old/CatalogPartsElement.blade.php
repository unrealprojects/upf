@extends('frontend.site_techonline.'.$content['template'])

@section('main')
<section class="Node">
    <div class="Snippet-Item Row Split" itemscope itemtype="http://data-vocabulary.org/Product">
        <header>
            <h3 class="Heading Primary">
                {{$content['item']['name']}}
                <span class="Item-Subtitle Panel Info">Цена: {{$content['item']['price']}}</span>
            </h3>
            <ul class="Vote">
                <li><a class="Vote-Down" href="#"></a></li>
                <li><span> 0 </span></li>
                <li><a class="Vote-Up" href="#"></a></li>
            </ul>
        </header>

        @include('frontend.site_techonline.layouts.elements.Photos',
            [
                'photos'=>$content['item']['photos'],
                'class_wrap'=>'Item-Gallery Grid-XS-5'
            ])

        <div class="Item-Content Grid-XS-7">
            <p>{{$content['item']['description']}}</p>

            <!-- Параметры товара -->
            <h6>Характеристики</h6>
            <table>
                <tr>
                    <td>Категория:</td>
                    <td>{{$content['item']['category']['name']}}</td>
                </tr>
                <tr>
                    <td>Арендодатель:</td>
                    <td><a href="/  sellers/{{$content['item']['admin']['metadata']['alias']}}">{{$content['item']['admin']['name']}}</a></td>
                </tr>
                <tr>
                    <td>Cтатус:</td>
                    <td>{{$content['item']['status']['name']}}</td>
                </tr>
                <tr>
                    <td>Состояние:</td>
                    <td> {{$content['item']['opacity']['name']}}</td>
                </tr>
                <tr>
                    <td>Цена:</td>
                    <td></td>
                </tr>
            </table>
        </div>

</section>
@include('frontend.standard.layouts.comments.List')

@endsection