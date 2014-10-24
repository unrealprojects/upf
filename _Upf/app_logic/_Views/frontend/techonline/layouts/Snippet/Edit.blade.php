@extends($Template)

@section('Main')
<section class="Node">
    {{--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /// Module navigate
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}

    @if(isset($Modules['Navigate']))
    @include($Modules['Navigate']['Template'], [ 'Content' => $Modules['Navigate']['Content'] ])
    @endif

    {{--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}

    <h3 class="Heading Primary">Ваш профиль, {{$Content['Item']['login']}}</h3>
    {{--@include($TemplateParts . 'BreadCrumbs')--}}

    <article>
        <ul class="Snippet-List">

            {{-- Each Item --}}
            @if( $Item = $Content['Item'])

            <li class="Snippet-Item Grid Merge">

                {{-- Group :: Main --}}

                <header class="Grid Split">
                    @if( isset($Item['title']) )
                    <h4 class="Item-Title {{ (strlen($Item['title'])>20) ? 'Item-Title-Long' : ''}} Node-XS-8">
                            {{ $Item['title'] }}


                        @if( isset($Item['meta']['created_at']) )
                        <span class="Item-Subtitle">{{ $Item['meta']['created_at'] }}</span>
                        @endif

                    </h4>
                    @endif



                    @if( isset($Item['meta']) )

                    {{-- Group :: Statuses --}}


                        @if( isset($Item['price']) )
                        <div class="Item-Price Node-XS-2">
                            <span>{{$Item['price']}}</span>
                            <span class="Icon Icon-rub"></span>
                        </div>
                        @endif

                        <ul class="Actions Node-XS-2 Item-Edit End">
                            <li><a class="Item-Edit" title="Редактировать ..."
                                   href="/cabinet/profile">
                                    <span class="Icon Icon-pencil Button"></span></a></li>
                        </ul>

                    {{-- End Group :: Statuses --}}


                    @endif
                </header>

                {{-- End Group :: Main --}}




                {{-- Group :: Media --}}

                @if( isset($Item['logotype']) || isset($Item['photos']) )
                @include( $TemplateLayouts . 'Snippet.Elements.Media', [ 'MediaClass' => 'Node-XS-4' ])
                @endif

                {{-- End Group :: Media --}}




                {{-- Group :: Content --}}

                @if( isset($Item['intro']) || isset($Item['about']) )
                <div class="Item-Content Node-XS-8" >
                    @if( isset($Item['intro']) )
                        <p>{{ $Item['intro'] }}</p>
                    @elseif( isset($Item['about']))
                        <p>{{ $Item['about'] }}</p>
                    @endif


                    <ul class="_Inline Item-Details">
                        @if(isset($Item['users']['phones']))
                        <li class="Item-User ">
                            <span>Телефоны:</span>
                            <strong>{{ $Item['users']['phones'] }}</strong>
                        </li>
                        @elseif(isset($Item['phones']))
                        <li class="Item-User">
                            <span>Телефоны:</span>
                            <strong>{{ $Item['phones'] }}</strong>
                        </li>
                        @endif


                        @if( isset($Item['users']) )
                        <li>
                            <span>Компания:</span>
                            <strong>
                                <a href="/users/{{$Item['users']['login']}}">
                                    {{ $Item['users']['title'] }}
                                </a>
                            </strong>
                        </li>
                        @endif

                        @if(isset($Item['meta']['categories']['title']))
                        <li class="Item-User">
                            <span>Категория:</span>
                            <strong>{{ $Item['meta']['categories']['title'] }}</strong>
                        </li>
                        @endif

                        @if(isset($Item['meta']['regions']['title']))
                        <li class="Item-Region">
                            <span>Регион:</span>
                            <strong>{{ $Item['meta']['regions']['title'] }}</strong>
                        </li>
                        @endif
                    </ul>



                    {{-- More Info --}}
                    @if(!empty($Item['meta']['paramsvalues'])  || !empty($Item['catalog']['meta']['paramsvalues']) )
                    <div>
                        <h6>Подробная информация</h6>
                        <table>
                            @if( isset($Item['meta']['paramsvalues']) )
                                @foreach($Item['meta']['paramsvalues'] as $Param)
                                <tr>
                                    <td>{{$Param['param_data']['title']}}</td>
                                    <td>{{$Param['value']}} {{$Param['param_data']['dimension']}}</td>
                                </tr>
                                @endforeach
                            @endif

                            @if( isset($Item['catalog']['meta']['paramsvalues']) )
                                @foreach($Item['catalog']['meta']['paramsvalues'] as $Param)
                                <tr>
                                    <td>{{$Param['param_data']['title']}}</td>
                                    <td>{{$Param['value']}} {{$Param['param_data']['dimension']}}</td>
                                </tr>
                                @endforeach
                            @endif
                        </table>
                    </div>
                    @endif
                </div>
                @endif

                {{-- End Group :: Content --}}




                {{-- Group :: Relation --}}

                @if( !empty($Item['meta']['tags']) )
                <footer>
                    {{-- Tags --}}

                    <ul class="Tag-List">
                        @foreach($Item['meta']['tags'] as $Tag)
                        <li class="Tag-Item">
                            <a href="{{$BaseUrl}}?tag={{$Tag['alias']}}">{{$Tag['title']}}</a>
                        </li>
                        @endforeach
                    </ul>



                </footer>
                @endif
                {{-- End Group :: Relation --}}



            </li>
            @endif
        </ul>
    </article>

</section>


@if( !empty($Item['rent']) )
<section class="Node">
    <h3 class="Heading Primary">Аренда</h3>
    <article>
        <ul class="Snippet-List">

                @foreach($Item['rent'] as $Rent)
                    <li class="Snippet-Item Grid Merge" style="margin-bottom: 20px">
                        <header class="Grid Split" style="margin-bottom: 0px">
                            @if( isset($Rent['title']) )
                            <h4 class="Item-Title {{ (strlen($Rent['title'])>20) ? 'Item-Title-Long' : ''}} Node-XS-8">
                                <a href="/rent/{{$Rent['meta']['alias'] }}">{{ $Rent['title'] }}</a>


                                @if( isset($Rent['meta']) )
                                     <span class="Item-Subtitle">{{ $Item['meta']['created_at'] }}</span>
                                @endif

                            </h4>
                            @endif



                            @if( isset($Rent['meta']) )

                            {{-- Group :: Statuses --}}


                            @if( isset($Rent['price']) )
                            <div class="Item-Price Node-XS-2">
                                <span>{{$Rent['price']}}</span>
                                <span class="Icon Icon-rub"></span>
                            </div>
                            @endif


                            <ul class="Actions Node-XS-2 Item-Edit End">
                                <li><a class="Item-Edit" title="Редактировать ..."
                                       href="@if(isset($Rent['meta']['alias'])){{Request::url().'/rent/'.$Rent['meta']['alias'].'/edit'}}@endif">
                                        <span class="Icon Icon-pencil Button"></span></a></li>
                                <li><a class="Item-Remove" data-remove-link="{{'/cabinet/rent/'.$Rent['meta']['alias'].'/remove'}}"  title="Удалить ..." href="#"><span class="Icon Icon-remove Button"></span></a></li>
                            </ul>

                            {{-- End Group :: Statuses --}}


                            @endif
                        </header>
                    </li>
                @endforeach

        </ul>
        <a class="Button Large" style="float: left;" href="/cabinet/rent/add">Добавить технику</a>
    </article>
</section>
@endif


@if( !empty($Item['parts']) )
<section class="Node">
    <h3 class="Heading Primary">Запчасти и сервис</h3>
    <article>
        <ul class="Snippet-List">

            @foreach($Item['parts'] as $Parts)
            <li class="Snippet-Item Grid Merge" style="margin-bottom: 20px">
                <header class="Grid Split" style="margin-bottom: 0px">
                    @if( isset($Parts['title']) )
                    <h4 class="Item-Title {{ (strlen($Parts['title'])>20) ? 'Item-Title-Long' : ''}} Node-XS-8">
                        <a href="/parts/{{$Parts['meta']['alias'] }}">{{ $Parts['title'] }}</a>


                        @if( isset($Parts['meta']) && isset($Parts['meta']['created_at']) )
                        <span class="Item-Subtitle">{{ $Item['meta']['created_at'] }}</span>
                        @endif

                    </h4>
                    @endif



                    @if( isset($Parts['meta']) )

                    {{-- Group :: Statuses --}}


                    @if( isset($Parts['price']) )
                    <div class="Item-Price Node-XS-2">
                        <span>{{$Parts['price']}}</span>
                        <span class="Icon Icon-rub"></span>
                    </div>
                    @endif

                        <ul class="Actions Node-XS-2 Item-Edit End">
                            <li><a class="Item-Edit" title="Редактировать ..."
                                   href="@if(isset($Parts['meta']['alias'])){{Request::url().'/parts/'.$Parts['meta']['alias'].'/edit'}}@endif">
                                    <span class="Icon Icon-pencil Button"></span></a></li>
                            <li><a class="Item-Remove" data-remove-link="{{'/cabinet/parts/'.$Parts['meta']['alias'].'/remove'}}" title="Удалить ..." href="#"><span class="Icon Icon-remove Button"></span></a></li>
                        </ul>

                    {{-- End Group :: Statuses --}}


                    @endif
                </header>
            </li>
            @endforeach

        </ul>
        <a class="Button Large" style="float: left;" href="/cabinet/parts/add">Добавить запчасти</a>
    </article>
</section>
@endif


    {{-- Comments --}}
          @include($TemplateLayouts . 'Snippet.Comments.List',
            [ 'Comments' => isset($Content['Item']['meta']['comments'])?$Content['Item']['meta']['comments']:[] ] )
    {{-- End Comments --}}


@endsection



{{-- Include Scripts --}}
@section('scripts')
    @parent
    <script src="/js/frontend/Accordion.js" type="text/javascript"></script>
@endsection