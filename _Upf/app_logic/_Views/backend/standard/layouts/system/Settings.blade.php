@extends($Template)

@section('Main')
<section class="Content">
    <h3 class="Heading Secondary">Редактирование</h3>
    <div class="Content-Inner">
        <form class="Wide" id="Edit-Item" enctype="multipart/form-data">
            @foreach($Content['Settings'] as $Relation => $Setting)
                {{---------------------------------------------------------------------------------------------------------------------- Text Field --}}
                @if($Setting['type']=='text')
                    <div class="Control-Group">
                        <label for="field_{{$Relation}}">{{$Setting['title']}}</label>
                        <input name="{{$Relation}}" id="field_{{$Relation}}" type="text" value="{{$Setting['content']}}"/>
                    </div>
                {{---------------------------------------------------------------------------------------------------------------------- Text Field --}}
                @elseif($Setting['type']=='numeric')
                    <div class="Control-Group">
                        <label for="field_{{$Relation}}">{{$Setting['title']}}</label>
                        <input name="{{$Relation}}" id="field_{{$Relation}}" type="number" value="{{$Setting['content']}}"/>
                    </div>
                @endif
            @endforeach
            <input class="Button Round" type="submit" value="Обновить"/>
        </form>
    </div>
</section>
@endsection