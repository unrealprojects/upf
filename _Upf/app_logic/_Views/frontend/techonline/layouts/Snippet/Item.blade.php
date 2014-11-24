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
                            @include( $TemplateLayouts . 'Snippet.Elements.Vote', [ 'Item' => $Item['meta'] , 'Action' => 'section'])
                        @endif

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

                <div class="Item-Content Node-XS-8" >
                    @if( isset($Item['intro']) )
                    <p>{{ $Item['intro'] }}</p>
                    @elseif( isset($Item['about']) )
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

                        @if( isset($Item['catalog']) )
                        <li>
                            <span>Модель:</span>
                            <strong>
                                <a href="/catalog/{{$Item['catalog']['meta']['alias']}}">
                                    {{ $Item['catalog']['meta']['alias'] }}
                                </a>
                            </strong>
                        </li>
                        @endif

                        @if(isset($Item['meta']['categories']['title']))
                        <li class="Item-User">
                            <span>Категория:</span>
                            <strong>{{ $Item['meta']['categories']['title'] }}</strong>
                        </li>
                        @elseif(isset($Item['catalog']['meta']['categories']['title']))
                        <li class="Item-User">
                            <span>Категория:</span>
                            <strong>{{ $Item['catalog']['meta']['categories']['title'] }}</strong>
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
                    @if(!empty($Item['meta']['paramsvalues'])  || !empty($Item['catalog']['meta']['paramsvalues']) || !empty($Item['login']) )
                    <div>
                        <h6>Подробная информация</h6>
                        <table>

                            @if( isset($Item['meta']['regions']) )
                            <tr>
                                <td>Регион</td>
                                <td>{{$Item['meta']['regions']['title']}}</td>
                            </tr>
                            @endif

                            @if( isset($Item['address']) )
                            <tr>
                                <td>Адрес</td>
                                <td>{{$Item['address']}}</td>
                            </tr>
                            @endif

                            @if( isset($Item['email']) )
                            <tr>
                                <td>Email</td>
                                <td>{{$Item['email']}}</td>
                            </tr>
                            @endif

                            @if( isset($Item['website']) )
                            <tr>
                                <td>Website</td>
                                <td>{{$Item['website']}}</td>
                            </tr>
                            @endif

                            @if( isset($Item['skype']) )
                            <tr>
                                <td>Skype</td>
                                <td>{{$Item['skype']}}</td>
                            </tr>
                            @endif


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

                {{-- End Group :: Content --}}




                {{-- Group :: Relation --}}

                @if( !empty($Item['meta']['tags']) )
                <footer>
                    {{-- Tags --}}

                    <ul class="Tag-List">
                        @foreach($Item['meta']['tags'] as $Tag)
                        <li class="Tag-Item">
                            <a href="{{$BaseUrl}}?tags[0]={{$Tag['alias']}}">{{$Tag['title']}}</a>
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

                            @if(isset($Rent['meta']['rating']))
                                @include( $TemplateLayouts . 'Snippet.Elements.Vote', [ 'Item' => $Rent['meta'] , 'Action' => 'section'])
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
                        @include( $TemplateLayouts . 'Snippet.Elements.Vote', [ 'Item' => $Parts['meta'] , 'Action' => 'section'])
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