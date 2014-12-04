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
        @if($HasFilters['Params'] || $HasFilters['Tags'])
        <dt class="Wide Tab-Params {{$HasFilters['TabsNode']}}">
            <span>Дополнительные параметры</span>
        </dt>

        <dd class="Tab-Params">
            <form class="Form-Vertical Grid Split" action="">

                @if(isset($Content['Filters']['tags']) && $HasFilters['Tags'] )
                    <div class='Input-Select'>
                        <input type="text" placeholder="Поиск по тегам"/>
                        <input type="hidden" name="tags" value="" id="field_tag" />
                        <span class="Input-Select-Clean Icon Icon-close"></span>
                        <span class="Input-Select-Toggle Icon Icon-chevron-down"></span>

                        <ul class="Input-Select-Content" name="tag" id="tag">
                            <li data-index="0"><a href="">Сбросить фильтр</a></li>
                                @foreach($Content['Filters']['tags'] as $Tag)
                                    <li data-index="{{$Tag['alias']}}"><a href="">{{$Tag['title']}}</a></li>
                                @endforeach
                        </ul>
                    </div>
                @endif

                @if($HasFilters['Price'])
                <div class="Control-Group Node-XS-12">

                    <label for="Slider-Range-1">Цена: <span id="Slider-Range-Value-1"></span></label>
                    <div class="Slider-Range" id="Slider-Range-1"></div>

                </div>
                @endif

                @if($Content['Filters']['params'])
                    @foreach($Content['Filters']['params'] as $ParamKey => $Param)
                        @if(!empty($Param['alias']) && !empty($Param['param_min']) && !empty($Param['param_max']))
                            <div class="Control-Group Node-XS-6">
                                <label for="Slider-Range-">{{$Param['title']}}: <span id="Slider-Range-Value-{{$Param["alias"]}}"></span></label>
                                <div class="Slider-Range" id="Slider-Range-{{$Param['alias']}}"></div>
                            </div>
                        @endif
                    @endforeach
                @endif


            </form>
        </dd>
        @endif
        {{-- End Params --}}





    </dl>
    <div class="Control-Group Offset">
        <button id="Filter-Search" class="Button Error">Выполнить поиск</button>
    </div>
</section>

@include($TemplateLayouts . '/Filter/Script')
