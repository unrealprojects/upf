<div class="{{$class_wrap}}">
    @foreach(json_decode($photos,true) as $i=>$photo)
    @if($i==0)
    <a href="{{$photo['src']}}" rel="Gallery" class="fancybox"><img class="Item-Main-Photo" src="{{$photo['src']}}" alt="{{$photo['name']}}"></a>

    <ul>
        @elseif($i>0 && $i<4)
            <li>
                <a href="{{$photo['src']}}" rel="Gallery" class="fancybox"><img src="{{$photo['src']}}" alt="{{$photo['name']}}"></a>
            </li>
            @elseif($i>=4)
            <li style="display: none">
                <a href="{{$photo['src']}}" rel="Gallery" class="fancybox"><img src="{{$photo['src']}}" alt="{{$photo['name']}}"></a>
            </li>
            @endif
        @endforeach
    </ul>
</div>