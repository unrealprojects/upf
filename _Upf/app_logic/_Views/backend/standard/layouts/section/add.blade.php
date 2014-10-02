@extends($template)

@section('main')
<section class="Content">
    <h3 class="Heading Secondary">Создать</h3>
    <div class="Content-Inner">
        <form class="Wide" id="Add-Item" enctype="multipart/form-data">
            @foreach($content['data']['fields'] as $field)
{{---------------------------------------------------------------------------------------------------------------------- Text Field --}}
                @if($field['type']=='text')
                    <div class="Control-Group">
                        <label for="field_{{$field['relation']}}">{{$field['title']}}</label>
                        <input name="{{$field['relation']}}" id="field_{{$field['relation']}}" type="text" value=""/>
                    </div>
{{---------------------------------------------------------------------------------------------------------------------- Text Area Field --}}
                @elseif($field['type']=='textarea')
                    <div class="Control-Group">
                        <label for="field_{{$field['relation']}}">{{$field['title']}}</label>
                        <textarea name="{{$field['relation']}}" id="field_{{$field['relation']}}" type="text"></textarea>
                    </div>
{{---------------------------------------------------------------------------------------------------------------------- Photo Field --}}
                @elseif($field['type']=='photo')
                    <div class="Control-Group">
                        <label for="field_{{$field['relation']}}">{{$field['title']}}</label>
                        <input name="{{$field['relation']}}" id="field_{{$field['relation']}}" type="file"/>
                    </div>
{{---------------------------------------------------------------------------------------------------------------------- Photo Field --}}
                @endif
            @endforeach
            <input class="Button Round" type="submit" value="Создать"/>
        </form>
    </div>
</section>
@endsection