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

                <li class="Snippet-Item Grid Split">




                    {{-- Group :: Main --}}

                        <header class="Grid Split">
                            @if( isset($Item['title']) )
                                <h4 class="Item-Title {{ (strlen($Item['title'])>20) ? 'Item-Title-Long' : ''}} Node-XS-6">
                                    <a href="{{ $BaseUrl . $Item['meta']['alias'] }}">
                                        {{ $Item['title'] }}
                                    </a>

                                    @if( isset($Item['meta']) && isset($Content['Fields']['date']['meta-created_at']) )
                                        <span class="Item-Subtitle">{{ $Item['meta']['created_at'] }}</span>
                                    @endif

                                </h4>
                            @endif

                            @if( isset($Item['price']) && isset($Content['Fields']['statuses']['price']) )
                                <div class="Item-Price Node-XS-2">
                                    <span>{{$Item['price']}}</span>
                                    <span>руб.</span>
                                </div>
                            @endif

                            @if( isset($Item['meta']) )


                                {{-- Group :: Statuses --}}

                                    @if(isset($Item['meta']['views']))
                                        <div class="Item-Views Node-XS-2" title="Просмотров записи: {{ $Item['meta']['views'] }}">
                                            <span class="fa fa-eye"></span><span>{{ $Item['meta']['views'] }}</span>
                                        </div>
                                    @endif

                                    @if(isset($Item['meta']['rating']))
                                    <ul class="Item-Vote Node-XS-2 End">
                                        <li><a href="#"><span class="fa fa-chevron-left"></span></a></li>
                                        <li><span>{{ $Item['meta']['rating'] }}</span></li>
                                        <li><a href="#"><span class="fa fa-chevron-right"></span></a></li>
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

                        @if( isset($Item['intro']) )
                            <div class="Item-Content Node-XS-10" >
                                <p>{{ $Item['intro'] }}</p>

                                {{-- More Info --}}
                                @if( isset($Content['Fields']['more']) )
                                    <div class="More-Info">
                                        <h6 class=" Toggle-Next-Item"><a href="#">Подробная информация</a></h6>
                                        <table class="Toggled-Next-Item">
                                            @foreach( $Content['Fields']['more'] as $FieldMore )
                                                @if($SubItem = \UpfHelpers\View::RelationToArray( $Item, $FieldMore['relation'] ))
                                                    @if($FieldMore['type']=='link')
                                                         <tr>
                                                             <td>{{ $FieldMore['title'] }}</td>
                                                             <td>
                                                                 <a href="{{$FieldMore['values'] . '/' .( isset($SubItem['alias'])?$SubItem['alias']
                                                                                                                                  :$SubItem['login'] ) }}">
                                                                     {{ $SubItem['title'] }}
                                                                 </a>
                                                             </td>
                                                         </tr>
                                                    @elseif($FieldMore['type']=='config')
                                                        <tr>
                                                            <td>{{ $FieldMore['title'] }}</td>
                                                            <td>{{ \Config::get('models/Fields.' . $FieldMore['values'] . '.' . $SubItem) }}</td>
                                                        </tr>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </table>
                                     </div>
                                @endif
                            </div>
                        @endif

                    {{-- End Group :: Content --}}




                    {{-- Group :: Relation --}}

                        <footer>
                            {{-- Tags --}}
                            @if( isset($Item['meta']['tags']) )
                                <ul class="Tag-List">
                                    @foreach($Item['meta']['tags'] as $Tag)
                                        <li class="Tag-Item">
                                            <a href="{{$BaseUrl}}?tag={{$Tag['alias']}}">{{$Tag['title']}}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                            {{-- Categories --}}

                        </footer>

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