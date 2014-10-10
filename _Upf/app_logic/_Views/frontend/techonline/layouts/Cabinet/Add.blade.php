@extends($Template)

@section('Main')
<section class="Content">
    <h3 class="Heading Secondary">Создать</h3>
    <div class="Content-Inner">
        <form class="Wide" id="Add-Item" enctype="multipart/form-data">
            <div class="Form-Group">
            @foreach($Content['Fields'] as $Field)
{{---------------------------------------------------------------------------------------------------------------------- Text Field --}}
                @if($Field['type']=='text')
                    <div class="Control-Group">
                        <label class="Node-XXS-3" for="field_{{$Field['relation']}}">{{$Field['title']}}</label>
                        <input class="Node-XXS-9" name="{{$Field['relation']}}" id="field_{{$Field['relation']}}" type="text" value=""/>
                    </div>
{{---------------------------------------------------------------------------------------------------------------------- Password Field --}}
                @elseif($Field['type']=='text')
                    <div class="Control-Group">
                        <label class="Node-XXS-3" for="field_{{$Field['relation']}}">{{$Field['title']}}</label>
                        <input class="Node-XXS-9" name="{{$Field['relation']}}" id="field_{{$Field['relation']}}" type="password" value=""/>
                    </div>
{{---------------------------------------------------------------------------------------------------------------------- Text Area Field --}}
                @elseif($Field['type']=='textarea')
                    <div class="Control-Group">
                        <label class="Node-XXS-3" for="field_{{$Field['relation']}}">{{$Field['title']}}</label>
                        <textarea class="Node-XXS-9" name="{{$Field['relation']}}" id="field_{{$Field['relation']}}" type="text"></textarea>
                    </div>
{{---------------------------------------------------------------------------------------------------------------------- Photo Field --}}
                @elseif($Field['type']=='photo')
                    <div class="Control-Group">
                        <label class="Node-XXS-3" for="field_{{$Field['relation']}}">{{$Field['title']}}</label>
                        <div class="Input-Group Node-XXS-9 Grid Upload">
                            <label class="File-Upload">
                                <input  name="{{$Field['relation']}}" id="field_{{$Field['relation']}}" type="file"/>
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