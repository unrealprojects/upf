@extends('frontend.site_techonline.'.$content['template'])

@section('main')
<!-- ФИЛЬТР -->
@include('frontend.site_techonline.layouts.filter.MainPageFilter');

<section class="Node">

    <h3 class="Heading Primary">Каталог строительной техники</h3>

    @include('frontend.site_techonline.parts.breadcrumbs')

        <!--
        <aside class="Sidebar-Filter Grid XS3">
            <h4>Производители</h4>
            <ul class="List-Filter">
                @foreach($content['brands'] as $brand)
                <li><a href="/catalog/?brand={{$brand['alias']}}&{{\Input::getQueryString()}}">{{$brand['name']}}</a></li>
                @endforeach
            </ul>
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
                @foreach($content['list'] as $item_key =>$list_elem)
                <li class="Snippet-Item Row Merge">

                    <header>
                        <h4 class="Item-Title">
                            <a href="/catalog/{{$list_elem['metadata']['alias']}}">
                                {{$list_elem['brand']['name']}}
                            {{$list_elem['model']}}</a>

                            <span class="Item-Subtitle">{{$list_elem['category']['name']}}</span>
                        </h4>
                    </header>

                    @include('frontend.site_techonline.layouts.elements.Photos',
                        [
                            'photos'=>$list_elem['photos'],
                            'class_wrap'=>'Item-Gallery Grid-XS-5'
                        ])

                    <div class="Item-Content Grid-XS-7">
                        {{$list_elem['description']}}

                        <!-- Параметры товара -->
                        @if($list_elem['params_values'])
                        <h6>Характеристики</h6>
                        <table>
                            @foreach($list_elem['params_values'] as $param)
                            <tr>
                                <td>{{$param['param_data']['name']}}</td>
                                <td>{{$param['value']}} {{$param['param_data']['dimension']}}</td>
                            </tr>
                            @endforeach
                        </table>
                        @endif
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
