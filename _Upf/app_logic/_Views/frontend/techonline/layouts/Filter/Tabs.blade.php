<section class="Node Filter Grid Merge">

    <h3 class="Heading Primary"><span class="Icon Icon-search"></span>Поиск стройтехники</h3>
    <dl class="Tabs Grid Merge">

        {{-- Regions --}}
            @if( isset($Content['Filters']['regions'] ) && $HasFilters['Regions'] )
                <dt class="Tab-Regions {{$HasFilters['TabsNode']}}"><span>Выбор региона</span></dt>

                <dd class="Tab-Regions">
                    <div>

                        <div class="Control-Group">
                            <input class="Autocomplete Autocomplete-Regions" placeholder="Поиск региона ..."/>
                        </div>

                        <ul class="Filter Accordion ">

                            @foreach($Content['Filters']['regions'] as $RegionTab)

                                <li class="Filter-Subheader Accordion-Subheader">
                                    <div class="Accordion-Switch"><span class="Icon Icon-angle-down"></span></div>
                                    <a class="Accordion-Switch" href="#">{{$RegionTab['title']}}</a>
                                </li>

                                @if( isset($RegionTab['list']) )
                                    <li class="Filter-Subcategory Accordion-Subcategory">
                                        <ul>
                                            @foreach($RegionTab['list'] as $RegionItem)
                                                <li>
                                                    <a href="#" alias="{{$RegionItem['alias']}}">{{$RegionItem['title']}}</a>

                                                    {{-- Cities --}}
                                                        @if(!empty($RegionItem['cities']))
                                                            <div class="Filter-Cities">

                                                                <ul class="List-Group-Actions Grid">
                                                                    <li class="Item-Group-Actions Node-XS-6">
                                                                        <a class="All-Cities" alias="{{$RegionItem['alias']}}" href="#">{{$RegionItem['title']}}</a>
                                                                    </li>

                                                                    <li class="Item-Group-Actions Node-XS-6">
                                                                        <a class="Back" href="#">Вернуться к выбору региона</a>
                                                                    </li>

                                                                </ul>

                                                                <ul class="List-Params Row Merge">
                                                                    @foreach($RegionItem['cities']['list'] as $City)
                                                                        <li class="List-Params-Item Node-XS-6 Node-LR-4">
                                                                            <a href="#" alias="{{$City['alias']}}">{{$City['title']}}</a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>

                                                            </div>
                                                        @endif
                                                    {{-- End Cities --}}



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
        {{-- End Regions --}}







        {{-- Categories --}}
            @if(!empty($Content['Filters']['categories']) && $HasFilters['Categories'] )
            <dt class="Tab-Categories {{$HasFilters['TabsNode']}}">
                <span>Выбор категории</span>
            </dt>

                <dd class="Tab-Categories">
                    <div>
                        <div class="Control-Group">
                            <input class="Autocomplete Autocomplete-Categories" placeholder="Поиск техники ..."/>
                        </div>

                        <ul class="Filter Accordion">
                            @foreach($Content['Filters']['categories'] as $Category)

                                <li class="Filter-Subheader Accordion-Subheader">
                                    @if($Category['list'])
                                        <div class="Accordion-Switch"><span class="Icon Icon-angle-down"></span></div>
                                    @endif
                                    <a href="#" alias="{{isset($Category['alias'])?$Category['alias']:''}}">{{$Category['title']}}</a>
                                </li>

                                @if($Category['list'])
                                    <li class="Filter-Subcategory Accordion-Subcategory">
                                        <ul>
                                            @foreach($Category['list'] as $SubCategory)
                                                <li><a href="#" alias="{{$SubCategory['alias']}}">{{$SubCategory['title']}}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </dd>
            @endif
        {{-- End Categories --}}



        {{-- Params --}}
        @if($HasFilters['Params'])
        <dt class="Wide Tab-Params {{$HasFilters['TabsNode']}}">
            <span>Дополнительные параметры</span>
        </dt>

        <dd class="Tab-Params">
            <form class="Form-Vertical Grid Split" action="">


                <div class="Control-Group Node-XS-12">

                    <label for="Slider-Range-1">Цена: <span id="Slider-Range-Value-1"></span></label>
                    <div class="Slider-Range" id="Slider-Range-1"></div>

                </div>

                @if($Content['Filters']['params'])
                    @foreach($Content['Filters']['params'] as $ParamKey => $Param)
                        <div class="Control-Group Node-XS-6">
                            <label for="Slider-Range-">{{$Param['title']}}: <span id="Slider-Range-Value-{{$Param["alias"]}}"></span></label>
                            <div class="Slider-Range" id="Slider-Range-{{$Param['alias']}}"></div>
                        </div>
                    @endforeach
                @endif

            </form>
        </dd>
        @endif
        {{-- End Params --}}




        {{-- Tags --}}
            @if(isset($Content['Filters']['tags']) && $HasFilters['Tags'] )
                <dt class="Tab-Tags {{$HasFilters['TabsNode']}}">
                    <span>Теги</span>
                </dt>

                <dd class="Tab-Tags">

                    <ul class="List-Group-Actions">
                        <li class="Item-Group-Actions">
                            <label class="Control-Group">
                                <span class="Node-XXS-8" for="all_params" >Все производители</span>
                                <input class="Node-XXS-4 Slide End" type="checkbox" checked="checked" id="all_tags"/>
                            </label>
                        </li>
                    </ul>

                    <ul class="List-Params  Accordion-tags Spoiler-Content Grid Merge">
                        @foreach($Content['Filters']['tags'] as $Tag)
                        <li class="Item-Group-Actions Node-XS-6 Node-SM-4 Node-LR-3">
                            <label class="Control-Group">
                                <span class="Node-XXS-8" for="tag_{{$Tag['alias']}}" >{{$Tag['title']}}</span>
                                <input class="Node-XXS-4 Slide End {{$Tag['privileges']>0?'Red-Checkbox':''}}" type="checkbox" checked="checked" name="{{$Tag['alias']}}" id="tag_{{$Tag['alias']}}"/>
                            </label>
                        </li>
                        @endforeach
                    </ul>

                </dd>
            @endif
        {{-- End Tags --}}






    </dl>
    <div class="Control-Group Offset">
        <button id="Filter-Search" class="Button Error">Выполнить поиск</button>
    </div>
</section>

@include($TemplateLayouts . '/Filter/Script')
