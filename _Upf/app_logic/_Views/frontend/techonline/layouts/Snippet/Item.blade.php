@extends($Template)

@section('Main')
<section class="Node">
    <h3 class="Heading Primary">{{-- $Title --}}</h3>
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

                        @if(isset($Item['meta']['rating']))
                        <ul class="Item-Vote Node-XS-2 End">
                            <li><a href="#"><span class="Icon Icon-chevron-left"></span></a></li>
                            <li><span>{{ $Item['meta']['rating'] }}</span></li>
                            <li><a href="#"><span class="Icon Icon-chevron-right"></span></a></li>
                        </ul>
                        @endif

                    {{-- End Group :: Statuses --}}


                    @endif
                </header>

                {{-- End Group :: Main --}}




                {{-- Group :: Media --}}

                @if( isset($Item['logotype']) || isset($Item['photos']) )
                @include( $TemplateLayouts . 'Snippet.Elements.Media', [ 'MediaClass' => 'Node-XS-5' ])
                @endif

                {{-- End Group :: Media --}}




                {{-- Group :: Content --}}

                @if( isset($Item['intro']) || isset($Item['about']) )
                <div class="Item-Content Node-XS-7" >
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
                            <span>Пользователь:</span>
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


                                @if( isset($Rent['meta']) && isset($Rent['meta']['created_at']) )
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

                            @if(isset($Rent['meta']['rating']))
                            <ul class="Item-Vote Node-XS-2 End">
                                <li><a href="#"><span class="Icon Icon-chevron-left"></span></a></li>
                                <li><span>{{ $Rent['meta']['rating'] }}</span></li>
                                <li><a href="#"><span class="Icon Icon-chevron-right"></span></a></li>
                            </ul>
                            @endif

                            {{-- End Group :: Statuses --}}


                            @endif
                        </header>
                    </li>
                @endforeach

        </ul>
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

                    @if(isset($Parts['meta']['rating']))
                    <ul class="Item-Vote Node-XS-2 End">
                        <li><a href="#"><span class="Icon Icon-chevron-left"></span></a></li>
                        <li><span>{{ $Parts['meta']['rating'] }}</span></li>
                        <li><a href="#"><span class="Icon Icon-chevron-right"></span></a></li>
                    </ul>
                    @endif

                    {{-- End Group :: Statuses --}}


                    @endif
                </header>
            </li>
            @endforeach

        </ul>
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