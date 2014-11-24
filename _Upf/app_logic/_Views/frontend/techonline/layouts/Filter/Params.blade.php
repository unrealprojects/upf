<!-- Фильтрация :: По параметрам -->
@if($Content['filters'])
    @foreach($content['filters']['filters'] as $key => $filter)
        <div class="Control-Group Ajax-Params">
            <label for="Slider-Range-">{{$filter['name']}}: <span id="Slider-Range-Value-{{$filter['alias']}}"></span></label>
            <div class="Slider-Range" id="Slider-Range-{{$filter['alias']}}"></div>
        </div>
    @endforeach
@endif


<!-- Фильтрация :: По параметрам -->
@if($Content['filters'])
@foreach($content['filters']['filters'] as $key => $filter)
    @if(!empty($filter['alias']) && !empty($filter['param_min']) && !empty($filter['param_max']))
    <script>
        $(document).ready(function(){

            $("#Slider-Range-{{$filter['alias']}}").slider({
                range: true,
                min: {{$filter['min_value']}},
                max: {{$filter['max_value']}},
                values: [ {{$filter['min_value']}}, {{$filter['max_value']}} ],
                slide: function( event, ui )
                {
                    $("#Slider-Range-Value-{{$filter["alias"]}}").text(ui.values[ 0 ] + "{{$filter['dimension']}} - " + ui.values[ 1 ] +"{{$filter['dimension']}}");
                    searchArray['params[{{$filter["alias"]}}][min-value]']=ui.values[ 0 ];
                    searchArray['params[{{$filter["alias"]}}][max-value]']= ui.values[ 1 ];
                    searchArray['params[{{$filter["alias"]}}][id]']='{{$filter["id"]}}';
                }
            });

            $("#Slider-Range-Value-{{$filter["alias"]}}").text(
                $( "#Slider-Range-{{$filter["alias"]}}")
                    .slider( "values", 0 ) + " {{$filter['dimension']}} - " + $( "#Slider-Range-{{$filter["alias"]}}" )
                    .slider( "values", 1 ) + ' {{$filter['dimension']}}'
            );

        });
    </script>
    @endif
@endforeach
@endif
