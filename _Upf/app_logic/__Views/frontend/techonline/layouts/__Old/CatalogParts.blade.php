@extends('frontend.site_techonline.'.$content['template'])

@section('main')

<section class="Node">

    <h3 class="Heading Primary">Запчасти и сервис</h3>
    @include('frontend.site_techonline.parts.breadcrumbs')
    <div class="Row Merge">
        <!--
        <aside class="Sidebar-Filter Grid XS-3">
            <h4>Категории</h4>
            <ul class="List-Filter Accordion">
                @foreach($content['categories'] as $category)
                <li class="List-Filter-Subheader Accordion-Subheader">
                    @if($category['subCategories'])
                    <img class='Accordion-Switch' src="/img/techonline/icon-dropdown.png" alt=""/>
                    @endif
                    <a href="/catalog/?category={{$category['alias']}}&{{\Input::getQueryString()}}">{{$category['name']}}</a>
                </li>

                @if($category['subCategories'])
                <li class="List-Filter-Subcategory Accordion-Subcategory">
                    <ul>
                        @foreach($category['subCategories'] as $subCategory)
                        <li><a href="/catalog/?category={{$subCategory['alias']}}&{{\Input::getQueryString()}}">{{$subCategory['name']}}</a></li>
                        @endforeach
                    </ul>
                </li>
                @endif
                @endforeach
            </ul>
        </aside>
        -->
        <article class="">
            <ul class="Snippet-List">
                @foreach($content['list'] as $item_key => $list_elem)
                <li class="Snippet-Item Row Merge">
                    <header>
                        <h4 class="Item-Title">
                            <a href="/parts/{{$list_elem['metadata']['alias']}}">
                                {{$list_elem['name']}}
                            </a>
                            <span class="Item-Subtitle">
                                {{$list_elem['category']['name']}}
                            </span>
                        </h4>
                        <ul class="Item-Values">
                            <li><h6>Статус:</h6>{{$list_elem['status']['name']}}</li>
                            <li><h6>Цена:</h6>{{$list_elem['price']}}</li>
                        </ul>
                    </header>

                    @include('frontend.site_techonline.layouts.elements.Photos',
                        [
                            'photos'=>$list_elem['photos'],
                            'class_wrap'=>'Item-Gallery Grid-XS-5'
                        ])

                    <div class="Item-Content Grid-XS-7">
                        {{$list_elem['description']}}

                        <!-- Параметры товара -->
                        <h6>Характеристики</h6>
                        <table>
                            <tr>
                                <td>Продавец:</td>
                                <td><a href="/sellers/{{$list_elem['admin']['metadata']['alias']}}">{{$list_elem['admin']['name']}}</a></td>
                            </tr>
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