<section class="Node Filter Row Merge">

    <h3 class="Heading Primary"><span class="fa fa-search"></span> Поиск стройтехники</h3>

    <dl class="Tabs">

        @if(!empty($content['filter']['regions']))
        <!-- ФИЛЬТР :: ТАБ 1 :: РЕГИОНЫ-->
        <dt class="Active Tab-Regions"><span>Выбор региона</span></dt>
        <dd class="Active Tab-Regions">
            <div>
                <div class="Control-Group">
                    <input class="Autocomplete Autocomplete-Regions" placeholder="Поиск региона ..."/>
                </div>
                <ul class="Filter Accordion ">
                    @foreach($content['filter']['regions'] as $region)
                    <li class="Filter-Subheader Accordion-Subheader">
                        @if($region['subRegions'])
                        <div class="Accordion-Switch"><span class="fa fa-angle-down"></span></div>
                        @endif
                        <a class="Accordion-Switch" href="#" alias="{{$region['alias']}}">{{$region['name']}}</a>
                    </li>

                    @if($region['subRegions'])
                    <li class="Filter-Subcategory Accordion-Subcategory">
                        <ul>
                            @foreach($region['subRegions'] as $subRegions)
                            <li>
                                <a href="#" alias="{{$subRegions['alias']}}">{{$subRegions['name']}}</a>
                                <!-- Вложенные города -->

                                @if(!empty($subRegions['cities']))
                                <div class="Filter-Cities">
                                    <ul class="List-Group-Actions">
                                        <li class="Item-Group-Actions">
                                            <a class="All-Cities" href="#" alias="{{$subRegions['alias']}}">Все города</a>
                                        </li>
                                        <li class="Item-Group-Actions">
                                            <a class="Icon Back" href="#">Вернуться к выбору региона</a>
                                        </li>
                                    </ul>
                                    <ul class="List-Params Row Merge">
                                        @foreach($subRegions['cities'] as $city)
                                        <li class="List-Params-Item Grid-XS-6 Grid-LR-4"><a href="#" alias="{{$city['alias']}}">{{$city['name']}}</a></li>
                                        @endforeach
                                    </ul>
                                    @endif
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>
        </dd>
        @endif
        <!-- ФИЛЬТР:: ТАБ 2 ::КАТЕГОРИИ -->
        @if(!empty($content['filter']['categories']))
        <dt class="Tab-Categories
        {{(!empty($content['filter']['type']) && $content['filter']['type']=='catalog')?'inTwo Active':''}}
        "><span>Выбор категории</span></dt>
        <dd class="Tab-Categories
        {{(!empty($content['filter']['type']) && $content['filter']['type']=='catalog')?'Active':''}}">
            <div>
                <div class="Control-Group">
                    <input class="Autocomplete Autocomplete-Categories" placeholder="Поиск техники ..."/>
                </div>

                <ul class="Filter Accordion">
                    @foreach($content['filter']['categories'] as $category)
                        <li class="Filter-Subheader Accordion-Subheader">
                            @if($category['subCategories'])
                            <div class="Accordion-Switch"><span class="fa fa-angle-down"></span></div>
                            @endif
                            <a href="#" alias="{{$category['alias']}}">{{$category['name']}}</a>
                        </li>

                        @if($category['subCategories'])
                        <li class="Filter-Subcategory Accordion-Subcategory">
                            <ul>
                                @foreach($category['subCategories'] as $subCategory)
                                    <li><a href="#" alias="{{$subCategory['alias']}}">{{$subCategory['name']}}</a></li>
                                @endforeach
                            </ul>
                        </li>
                        @endif
                    @endforeach
                </ul>
            </div>
        </dd>
        @endif
        <!-- ФИЛЬТР :: ТАБ 3 :: ПАРАМЕТРЫ -->
        @if($content['filter']['has_params'])
        <dt class="Wide Tab-Params
        {{(!empty($content['filter']['type']) && $content['filter']['type']=='catalog')?'inTwo':''}}
        "><span>Дополнительные параметры</span></dt>
        <dd class="Tab-Params">
            <div>
                <form class="Form-Vertical" action="">

                        <div class="Control-Group">
                            @if(!empty($content['filter']['has_price']))
                            <label for="Slider-Range-1">Цена: <span id="Slider-Range-Value-1"></span></label>
                            <div class="Slider-Range" id="Slider-Range-1"></div>
                            @endif
                        </div>
                    @if(!empty($content['filter']['params']))
                        @foreach($content['filter']['params']['filters'] as $key => $param)
                        <div class="Control-Group">
                            <label for="Slider-Range-">{{$param['name']}}: <span id="Slider-Range-Value-{{$param["alias"]}}"></span></label>
                            <div class="Slider-Range" id="Slider-Range-{{$param['alias']}}"></div>
                        </div>
                        @endforeach
                    @endif

                    <!-- Бренды -->
                    <ul class="List-Group-Actions">
                        <li class="Item-Group-Actions">
                            <label class="Control-Group">
                                <input type="checkbox" checked="checked" id="all_brands"/>
                                <span for="all_brands" >Все производители</span>
                            </label>
                        </li>
                        <li class="Item-Group-Actions">
                            <label class="Control-Group">
                                <input type="checkbox" checked="checked" id="native_brands"/>
                                <span for="native_brands" >Отечественные производители</span>
                            </label>
                        </li>
                        <li class="Item-Group-Actions">
                            <label class="Control-Group">
                                <input type="checkbox" checked="checked" id="foreign_brands"/>
                                <span for="foreign_brands" >Зарубежные производители</span>
                            </label>
                        </li>
                    </ul>
                    @if(!empty($content['filter']['brands']))
                    <div class="Spoiler">
                        <a href="#" class="Spoiler-Caption"><span class="fa fa-angle-down"></span>Конкретные производители</a>

                        <ul class="List-Params  Accordion-Brands Spoiler-Content">
                            @foreach($content['filter']['brands'] as $brand)
                            <li class="Item-Group-Actions Grid-XS-6 Grid-LR-4">
                                <label class="Control-Group">
                                    <input type="checkbox" checked="checked" foreign="{{$brand['foreign']}}" name="{{$brand['alias']}}" id="brand_{{$brand['alias']}}"/>
                                    <span for="brand_{{$brand['alias']}}" >{{$brand['name']}}</span>
                                </label>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </form>
            </div>
        </dd>
    </dl>
    <div class="Control-Group Offset">
        <button id="Filter-Search" class="Button">Выполнить поиск</button>
    </div>
    @endif
</section>


@include('frontend.site_techonline.layouts/filter/FilterScript')
