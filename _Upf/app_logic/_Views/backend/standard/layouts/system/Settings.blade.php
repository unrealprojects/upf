@extends($Template)

@section('Main')
<section class="Content">
    <div class="Content-Inner">
        <h3 class="Heading Secondary">Редактирование</h3>
        <form class="Wide" id="Edit-Item" enctype="multipart/form-data">
            <div class="Form-Group">
                @foreach($Content as $Relation => $Setting)
                    {{---------------------------------------------------------------------------------------------------------------------- Text Field --}}
                    @if($Setting['type']=='text')
                        <div class="Control-Group">
                            <label class="Node-XXS-3" for="field_{{$Relation}}">{{$Setting['title']}}</label>
                            <input class="Node-XXS-9" name="{{$Relation}}" id="field_{{$Relation}}" type="text" value="{{$Setting['content']}}"/>
                        </div>
                    {{---------------------------------------------------------------------------------------------------------------------- Text Field --}}
                    @elseif($Setting['type']=='numeric')
                        <div class="Control-Group">
                            <label class="Node-XXS-3" for="field_{{$Relation}}">{{$Setting['title']}}</label>
                            <input class="Node-XXS-9" name="{{$Relation}}" id="field_{{$Relation}}" type="number" value="{{$Setting['content']}}"/>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="Form-Group">
                <div class="Control-Group">
                    <input class="Button Round" type="submit" value="Обновить"/>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection