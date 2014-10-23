@extends($Template)

@section('Main')

    {{-- Filter --}}
        @include($TemplateLayouts.'Filter.HomeFilter')
    {{-- End Filter --}}

<section class="Node">
    <h3 class="Heading Primary">{{-- $Title --}}</h3>
    {{--@include($TemplateParts . 'BreadCrumbs')--}}

    <article>
        <ul class="Snippet-List">

            {{-- Each Item --}}
            @foreach( $Content['List'] as $ItemKey => $Item )

                <li class="Snippet-Item Grid Merge">




                    {{-- Group :: Main --}}

                            <header class="Grid Split">
                            @if( isset($Item['title']) )
                                <h4 class="Item-Title {{ (strlen($Item['title'])>20) ? 'Item-Title-Long' : ''}} Node-XS-8">
                                    <a href="{{ $BaseUrl . $Item['meta']['alias'] }}">
                                        {{ $Item['title'] }}
                                    </a>


{{--                                    @if(isset($Item['meta']['views']))
                                    <span class="Item-Views" title="Просмотров записи: {{ $Item['meta']['views'] }}">
                                        <span class="Icon Icon-eye"></span><span>{{ $Item['meta']['views'] }}</span>
                                    </span>
                                    @endif--}}


                                    @if( isset($Item['meta']) )
                                        <span class="Item-Subtitle">{{ $Item['meta']['created_at'] }}</span>
                                    @endif

                                </h4>
                            @endif



                            @if( isset($Item['meta']) )


                                {{-- Group :: Statuses --}}





                                    @if( isset($Item['price']))
                                        <div class="Item-Price Node-XS-2">
                                            <span>{{$Item['price']}}</span>
                                            <span class="Icon Icon-rub"></span>
                                        </div>
                                    @endif

                                    @if(isset($Item['meta']['rating']))
                                    <ul class="Item-Vote Node-XS-2 End">
                                        <li><a href="#" title="Понизить рейтинг"><span class="Icon Icon-minus"></span></a></li>
                                        <li><span title="Рейтинг">{{ $Item['meta']['rating'] }}</span></li>
                                        <li><a href="#" title="Повысить рейтинг"><span class="Icon Icon-plus"></span></a></li>
                                    </ul>
                                    @endif

                                {{-- End Group :: Statuses --}}


                            @endif
                        </header>

                    {{-- End Group :: Main --}}




                    {{-- Group :: Media --}}

                        @if( isset($Item['logotype']) || isset($Item['photos']) )
                            @include( $TemplateLayouts . 'Snippet.Elements.Media', [ 'MediaClass' => 'Node-XS-2' ])
                        @endif

                    {{-- End Group :: Media --}}




                    {{-- Group :: Content --}}

                        @if( isset($Item['intro']) || isset($Item['about']))
                            <div class="Item-Content Node-XS-10" >
                                @if( isset($Item['intro']) )
                                    <p>{{ $Item['intro'] }}</p>
                                @else
                                    <p>{{ $Item['about'] }}</p>
                                @endif


                                <ul class="_Inline Item-Details">
                                    @if( isset($Item['users']['phones']) )
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
                                                <a href="/users/{{$Item['users']['meta']['alias']}}">
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
                                    <div class="More-Info">
                                        <h6 class=" Toggle-Next-Item"><a href="#">Подробная информация <span class="Icon Icon-caret-down"></span></a></h6>
                                        <div  class="Toggled-Next-Item">
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

                            {{-- Tags --}}
                        </footer>
                    @endif
                    {{-- End Group :: Relation --}}




                </li>
            @endforeach
        </ul>
    </article>

    @if(isset($Content['Pagination']))
        {{$Content['Pagination']}}
    @endif

</section>


@endsection

{{-- Include Scripts --}}
@section('scripts')
    @parent
    <script src="/js/frontend/Accordion.js" type="text/javascript"></script>
@endsection