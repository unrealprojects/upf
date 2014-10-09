<section class="Node Filter Grid Merge">

    <h3 class="Heading Primary"><span class="fa fa-search"></span>Поиск стройтехники</h3>

    <dl class="Tabs">

        {{-- Regions --}}
            @if( isset($Content['Filters']['regions']) )
                <dt class="Active Tab-Regions"><span>Выбор региона</span></dt>

                <dd class="Active Tab-Regions">
                    <div>

                        <div class="Control-Group">
                            <input class="Autocomplete Autocomplete-Regions" placeholder="Поиск региона ..."/>
                        </div>

                        <ul class="Filter Accordion ">

                            @foreach($Content['Filters']['regions'] as $RegionTab)

                                <li class="Filter-Subheader Accordion-Subheader">
                                    <div class="Accordion-Switch"><span class="fa fa-angle-down"></span></div>
                                    <a class="Accordion-Switch" href="#">{{$RegionTab['title']}}</a>
                                </li>

                                @if( isset($RegionTab['list']) )
                                    <li class="Filter-Subcategory Accordion-Subcategory">
                                        <ul>
                                            @foreach($RegionTab['list'] as $RegionItem)
                                                <li>
                                                    <a href="#" alias="{{$RegionItem['alias']}}">{{$RegionItem['title']}}</a>



                                                    {{-- Cities --}}
                                                        @if(isset($RegionItem['cities']))
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
                                                                    @foreach($RegionItem['cities'] as $City)
                                                                        <li class="List-Params-Item Grid-XS-6 Grid-LR-4">
                                                                            <a href="#" alias="{{$city['alias']}}">{{$city['name']}}</a>
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
        @if(!empty($Content['Filters']['categories']))
        <dt class="Tab-Categories {{(!empty($Content['Filters']['type']) && $Content['Filters']['type']=='catalog')?'inTwo Active':''}}">
            <span>Выбор категории</span>
        </dt>

        <dd class="Tab-Categories
                {{(!empty($Content['Filters']['type']) && $Content['Filters']['type']=='catalog')?'Active':''}}">
            <div>

                <div class="Control-Group">
                    <input class="Autocomplete Autocomplete-Categories" placeholder="Поиск техники ..."/>
                </div>

                <ul class="Filter Accordion">
                    @foreach($Content['Filters']['categories'] as $category)

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
        {{-- End Categories --}}

    </dl>
</section>

{{-- @include('frontend.site_techonline.layouts/filter/FilterScript')  --}}
