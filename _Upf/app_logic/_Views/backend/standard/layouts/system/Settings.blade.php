@extends($template)

@section('main')
<section class="Content">
    <h3 class="Heading Secondary">Редактирование</h3>
    <div class="Content-Inner">
        <form class="Wide" id="Edit-Item" enctype="multipart/form-data">
            @foreach($content['data'] as $relation => $setting)
                {{---------------------------------------------------------------------------------------------------------------------- Text Field --}}
                @if($setting['type']=='text')
                    <div class="Control-Group">
                        <label for="field_{{$relation}}">{{$setting['title']}}</label>
                        <input name="{{$relation}}" id="field_{{$relation}}" type="text" value="{{$setting['content']}}"/>
                    </div>
                {{---------------------------------------------------------------------------------------------------------------------- Text Field --}}
                @elseif($setting['type']=='numeric')
                    <div class="Control-Group">
                        <label for="field_{{$relation}}">{{$setting['title']}}</label>
                        <input name="{{$relation}}" id="field_{{$relation}}" type="number" value="{{$setting['content']}}"/>
                    </div>
                @endif
            @endforeach
            <input class="Button Round" type="submit" value="Обновить"/>
        </form>
    </div>
</section>
@endsection