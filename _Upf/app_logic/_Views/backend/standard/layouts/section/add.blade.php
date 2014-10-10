@extends($template)

@section('main')
<section class="Content">
    <h3 class="Heading Secondary">Создать</h3>
    <div class="Content-Inner">
        <form class="Wide" id="Add-Item" enctype="multipart/form-data">
            <div class="Form-Group">
            @foreach($content['data']['fields'] as $field)
{{---------------------------------------------------------------------------------------------------------------------- Text Field --}}
                @if($field['type']=='text')
                    <div class="Control-Group">
                        <label class="Node-XXS-3" for="field_{{$field['relation']}}">{{$field['title']}}</label>
                        <input class="Node-XXS-9" name="{{$field['relation']}}" id="field_{{$field['relation']}}" type="text" value=""/>
                    </div>
{{---------------------------------------------------------------------------------------------------------------------- Password Field --}}
                @elseif($field['type']=='text')
                    <div class="Control-Group">
                        <label class="Node-XXS-3" for="field_{{$field['relation']}}">{{$field['title']}}</label>
                        <input class="Node-XXS-9" name="{{$field['relation']}}" id="field_{{$field['relation']}}" type="password" value=""/>
                    </div>
{{---------------------------------------------------------------------------------------------------------------------- Text Area Field --}}
                @elseif($field['type']=='textarea')
                    <div class="Control-Group">
                        <label class="Node-XXS-3" for="field_{{$field['relation']}}">{{$field['title']}}</label>
                        <textarea class="Node-XXS-9" name="{{$field['relation']}}" id="field_{{$field['relation']}}" type="text"></textarea>
                    </div>
{{---------------------------------------------------------------------------------------------------------------------- Photo Field --}}
                @elseif($field['type']=='photo')
                    <div class="Control-Group">
                        <label class="Node-XXS-3" for="field_{{$field['relation']}}">{{$field['title']}}</label>
                        <div class="Input-Group Node-XXS-9 Grid Upload">
                            <label class="File-Upload">
                                <input  name="{{$field['relation']}}" id="field_{{$field['relation']}}" type="file"/>
                                <span class="Button Info"><span class="fa fa-folder-open"></span>Загрузить Файл</span>
                            </label>
                        </div>
                    </div>
{{---------------------------------------------------------------------------------------------------------------------- Photo Field --}}
                @endif
            @endforeach
            </div>
            <div class="Form-Group">
                <div class="Control-Group">
                    <input class="Node-XS-12" type="submit" value="Создать" />
                </div>
            </div>
        </form>
    </div>
</section>
@endsection