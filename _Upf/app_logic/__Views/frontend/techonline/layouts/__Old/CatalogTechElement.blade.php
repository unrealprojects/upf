@extends('frontend.site_techonline.'.$content['template'])

@section('main')

<section class="Node">
    <div class="Snippet-Item Row Split" itemscope itemtype="http://data-vocabulary.org/Product">
        <header>
            <h3 class="Heading Primary">
                {{$content['item']['name']}}
                <p class="Item-Subtitle">{{$content['item']['model']['category']['name']}}</p>
            </h3>
            <h5 class="Item-Price">
                {{$content['item']['price']}} <span>руб/час</span>
            </h5>
        </header>

        @include('frontend.site_techonline.layouts.elements.Photos',
            [
                'photos'=>$content['item']['photos'],
                'class_wrap'=>'Item-Gallery Grid-XS-5'
            ])
        <div class="Item-Additional-Info">
            Арендатор
            <a href="/admin/{{$content['item']['admin']['metadata']['alias']}}">{{$content['item']['admin']['name']}}</a>
        </div>
        <div class="Item-Content Grid-XS-7">
            <p itemprop="description">{{$content['item']['description']}}</p>

            <!-- Параметры товара -->
            <h6>Характеристики</h6>
            <table>
                <tr>
                    <td>Бренд:</td>
                    <td>{{$content['item']['model']['brand']['name']}}</td>
                </tr>
                <tr>
                    <td>Модель:</td>
                    <td><a itemprop="category" href="/catalog/{{$content['item']['model']['metadata']['alias']}}">{{$content['item']['model']['model']}}</a></td>
                </tr>
                <tr>
                    <td>Регион:</td>
                    <td>{{$content['item']['region']['name']}}</td>
                </tr>
                @foreach($content['item']['model']['params_values'] as $param)
                <tr>
                    <td>{{$param['param_data']['name']}}</td>
                    <td>{{$param['value']}} {{$param['param_data']['dimension']}}</td>
                </tr>
                @endforeach
            </table>

    </div>

</section>
@include('frontend.standard.layouts.comments.List')


@endsection