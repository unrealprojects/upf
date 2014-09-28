@extends('frontend.site_techonline.'.$content['template'])

@section('main')
<section class="Node">
    <div class="Snippet-Item Row Merge" itemscope itemtype="http://data-vocabulary.org/Product">
        <header>
            <h3 class="Heading Primary">
                <span itemprop="brand">{{$content['item']['brand']['name']}}</span>
                    {{$content['item']['model']}}
                <span class="Item-Subtitle" itemprop="category">{{$content['item']['category']['name']}}</span>
            </h3>

        </header>

            @include('frontend.site_techonline.layouts.elements.Photos',
                      [
                         'photos'=>$content['item']['photos'],
                         'class_wrap'=>'Item-Gallery Grid-XS-5'
                    ])

        <div class="Item-Content Grid XS-7">
            <p itemprop="description">{{$content['item']['description']}}</p>

        <!-- Параметры товара -->
        <h6>Характеристики</h6>
        <table>
            @foreach($content['item']['params_values'] as $param)
            <tr>
                <td>{{$param['param_data']['name']}}</td>
                <td>{{$param['value']}}</td>
                <td>{{$param['param_data']['dimension']}}</td>
            </tr>
            @endforeach
        </table>
    </div>

</section>

@include('frontend.standard.layouts.comments.List')
@endsection