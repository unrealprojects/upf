<div class="Item-Gallery {{$MediaClass}}">

    {{-- Logotype --}}
    @if( isset($Item['meta']['files']) )
        <a href="{{ $Item['logotype'] }}" rel="Gallery-{{$Item['id']}}" class="fancybox">
            <img class="Item-Main-Photo" src="{{ $Item['logotype'] }}" alt="{{$Item['title']}}">
        </a>
    @endif

    <ul>
        @if( isset($Item['meta']['files']) )

            {{-- Each Photo --}}
            @foreach( $Item['meta']['files'] as $PhotoKey => $Photo)

                {{-- Visible Photos --}}
                @if( $PhotoKey >= 0 && $PhotoKey < 4 )
                    <li>
                        <a href="{{$Photo['src']}}" rel="Gallery-{{$Item['id']}}" class="fancybox">
                            <img src="{{$Photo['src']}}" alt="{{$Photo['title']}}">
                        </a>
                    </li>

                {{-- Hidden Photos --}}
                @elseif( $PhotoKey >= 4 )
                    <li style="display: none">
                        <a href="{{$Photo['src']}}" rel="Gallery" class="fancybox">
                            <img src="{{$Photo['src']}}" alt="{{$Photo['title']}}">
                        </a>
                    </li>
                @endif

            @endforeach
        @endif
    </ul>
</div>