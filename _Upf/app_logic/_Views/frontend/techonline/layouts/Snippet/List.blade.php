@extends($Template)

@section('Main')
<section class="Node">
    <h3 class="Heading Primary">{{-- $Title --}}</h3>
    {{--@include($TemplateParts . 'BreadCrumbs')--}}

    <article>
        <ul class="Snippet-List">

            {{-- Each Item--}}
            @foreach( $Content['List'] as $ItemKey => $Item )

                <li class="Snippet-Item Grid Merge">




                    {{-- Group :: Main --}}

                        <header>
                            @if( isset($Item['title']) )
                                <h4 class="Item-Title">
                                    <a href="{{ $BaseUrl . $Item['meta']['alias'] }}">
                                        {{ $Item['title'] }}
                                    </a>

                                    @if( isset($Item['meta']) )
                                        <span class="Item-Subtitle">{{ $Item['meta']['created_at'] }}</span>
                                    @endif

                                </h4>
                            @endif

                            @if( isset($Item['meta']) )
                                <ul class="Vote">
                                    <li><a class="Vote-Down" href="#"></a></li>
                                    <li><span>{{ $Item['meta']['rating'] }}</span></li>
                                    <li><a class="Vote-Up" href="#"></a></li>
                                </ul>


                                {{-- Group :: Statuses --}}




                                {{-- End Group :: Statuses --}}


                            @endif
                        </header>

                    {{-- End Group :: Main --}}




                    {{-- Group :: Media --}}

                        @if( isset($Item['logotype']) || isset($Item['photos']) )
                            @include( $TemplateLayouts . 'Snippet.Elements.Media', [ 'MediaClass' => 'Node-XS-3' ])
                        @endif

                    {{-- End Group :: Media --}}




                    {{-- Group :: Content --}}

                        @if( isset($Item['intro']) )
                            <div class="Item-Content Node-XS-9" >
                                <p>{{ $Item['intro'] }}</p>

                                {{-- More Info --}}
                                <div class="">
                                    <h6 class=" Toggle-Next-Item"><a href="#">Подробная информация</a></h6>
                                    <table class="Toggled-Next-Item">

                                        @if( isset($Item['price']) )
                                            <tr>
                                                <td>Цена:</td>
                                                <td>{{ $Item['price'] }}руб.</td>
                                            </tr>
                                        @endif
                                    </table>
                                 </div>
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