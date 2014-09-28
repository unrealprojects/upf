<!-- Фильтрация :: По параметрам -->
@if($content['filters'])
    @foreach($content['filters']['filters'] as $key => $filter)
        <div class="Control-Group Ajax-Params">
            <label for="Slider-Range-">{{$filter['name']}}: <span id="Slider-Range-Value-{{$filter["alias"]}}"></span></label>
            <div class="Slider-Range" id="Slider-Range-{{$filter['alias']}}"></div>
        </div>
    @endforeach
@endif
