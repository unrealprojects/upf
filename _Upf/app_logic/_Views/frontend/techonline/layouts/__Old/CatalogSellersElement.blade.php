@extends('frontend.site_techonline.'.$content['template'])

@section('main')
<section class="Node">
    <div class="Snippet-Item Row Split" itemscope itemtype="http://data-vocabulary.org/Product">
        <header>
            <h3 class="Heading Primary">
                {{$content['item']['name']}}
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
            <h6>Контактная информация</h6>
            <table>
                <tr>
                    <td>Телефоны:</td>
                    <td>{{$content['item']['phone']}}</td>
                </tr>
                <tr>
                    <td>Регион:</td>
                    <td> {{$content['item']['region']['name']}}</td>
                </tr>
                <tr>
                    <td>Адрес:</td>
                    <td> {{$content['item']['adress']}}</td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td><a href="mailto:{{$content['item']['email']}}">{{$content['item']['email']}}</a></td>
                </tr>
                <tr>
                    <td>Skype:</td>
                    <td><a href="callto:{{$content['item']['skype']}}">{{$content['item']['skype']}}</a></td>
                </tr>
                <tr>
                    <td>Site:</td>
                    <td><a href="{{$content['item']['website']}}">{{$content['item']['website']}}</a></td>
                </tr>
            </table>
        </div>



        <!-- Список Техники -->
        <div class="Snippet-Item Row Split CatalogTech">
            <header>
                <h3 class="Heading Primary">
                    Аренда стройтехники
                </h3>
            </header>

            @foreach($content['item']['tech_list'] as $tech)
            <div class="Element Row Merge">
                @include('frontend.site_techonline.layouts.elements.Photos',
                    [
                        'photos'=>$tech['photos'],
                        'class_wrap'=>'Item-Gallery Grid-XS-3'
                    ])
                <h4> <a href="/rent/{{$tech['metadata']['alias']}}">{{$tech['name']}}</a></h4>
                <p>{{$tech['description']}}</p>
                <p>{{$tech['price']}} <span>руб/час</span></p>
            </div>
            @endforeach
        </div>

        <!-- Список Запчастей -->
        <div class="Snippet-Item Row Split CatalogParts">
            <header>
                <h3 class="Heading Primary">
                    Запчасти и сервис
                </h3>
            </header>
            @foreach($content['item']['parts_list'] as $part)
            <div class="Element">
                @include('frontend.site_techonline.layouts.elements.Photos',
                    [
                        'photos'=>$tech['photos'],
                        'class_wrap'=>'Item-Gallery Grid-XS-4'
                    ])
                <h4> <a href="/parts/{{$part['metadata']['alias']}}">{{$part['name']}}</a></h4>
                <p>{{$part['description']}}</p>
                <p>{{$part['price']}}</p>
            </div>
            @endforeach
        </div>
</section>
@include('frontend.standard.layouts.comments.List')

@endsection