@extends($template)

@section('main')
<section class="Content">
    <h3 class="Heading Secondary">Редактирование</h3>
    <div class="Content-Inner">
        <form class="Wide" id="Edit-Item" enctype="multipart/form-data">
            @foreach($content['data']['fields'] as $alias => $field)
{{---------------------------------------------------------------------------------------------------------------------- Text Field --}}
                @if($field['type']=='text')
                    <div class="Control-Group">
                        <label for="field_{{$alias}}">{{$field['title']}}</label>
                        @if($field['editable']==true)
                            <input name="{{$alias}}" id="field_{{$alias}}" type="text"
                                   value="{{\UpfHelpers\View::RelationToArray($content['data']['item'],$field['relation'])}}"/>
                        @else
                            <p>{{\UpfHelpers\View::RelationToArray($content['data']['item'],$field['relation'])}}</p>
                        @endif
                    </div>
                @endif
{{---------------------------------------------------------------------------------------------------------------------- Text Area Field --}}
                @if($field['type']=='textarea')
                    <div class="Control-Group">
                        <label for="field_{{$alias}}">{{$field['title']}}</label>
                        @if($field['editable']==true)
                        <textarea name="{{$alias}}" id="field_{{$alias}}" type="text">{{\UpfHelpers\View::RelationToArray($content['data']['item'],$field['relation'])}}</textarea>
                        @else
                        <p>{{\UpfHelpers\View::RelationToArray($content['data']['item'],$field['relation'])}}</p>
                        @endif
                    </div>
                @endif
{{---------------------------------------------------------------------------------------------------------------------- Photo Field --}}
                @if($field['type']=='photo')
                    <div class="Control-Group">
                        <label for="field_{{$alias}}">{{$field['title']}}</label>
                        @if($field['editable']==true)
                            <input name="{{$alias}}" id="field_{{$alias}}" type="file"/>
                            <img class="Field-Img-{{$alias}}" src="{{
                                    \UpfHelpers\View::RelationToArray($content['data']['item'],$field['relation'])
                                }}" title="Изображение"/>
                        @else
                            <img src="{{\UpfHelpers\View::RelationToArray($content['data']['item'],$field['relation'])}}" title="Изображение"/>
                        @endif
                    </div>
                @endif
{{---------------------------------------------------------------------------------------------------------------------- Multiple Photos Field --}}
                @if($field['type']=='photos')
                    <div class="Control-Group">
                        <label for="field_{{$alias}}">{{$field['title']}}</label>
                        @if($field['editable']==true)
                        <input name="{{$alias}}[]" multiple="multiple" id="field_{{$alias}}" type="file"/>

                             @foreach(\UpfHelpers\View::RelationToArray($content['data']['item'],$field['relation']) as $photos)
                                <img class="Field-Img-{{$alias}}" src="{{$photos['src']}}" item_img_id="{{$photos['src']}}" title="Изображения"/>
                             @endforeach
                        @endif
                    </div>
                @endif
{{---------------------------------------------------------------------------------------------------------------------- Select Field --}}
                @if($field['type']=='select')
                    <div class="Control-Group">
                        <label for="field_{{$alias}}">{{$field['title']}}</label>
                        <select  name="{{$alias}}" id="field_{{$alias}}">
                            <option value="0">Нет</option>
                            @foreach($field['values'] as $key => $value)
                                @if($field['values_type']=='config' && is_int($key))
                                    <option value="{{$key}}"
                                    {{(\UpfHelpers\View::RelationToArray($content['data']['item'],$field['relation'])==$key)?'selected="selected"':''}}>{{$value}}</option>
                                @elseif($field['values_type']=='model' && is_int($key))
                                    <option value="{{$value['id']}}"
                                    {{(\UpfHelpers\View::RelationToArray($content['data']['item'],$field['relation'])==$value['id'])?'selected="selected"':''}}>{{$value['title']}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                @endif
{{---------------------------------------------------------------------------------------------------------------------- Select Field --}}
                @if($field['type']=='multi-select')
                    <div class="Control-Group">
                        <label  for="field_{{$alias}}">{{$field['title']}}</label>
                        <select multiple="multiple" name="{{$alias}}[]" id="field_{{$alias}}">
                            @foreach($field['values'] as $value)
                            <option value="{{$value['id']}}"
                                    @if(\UpfHelpers\View::RelationToArray($content['data']['item'],$field['relation']))
                                        @foreach(\UpfHelpers\View::RelationToArray($content['data']['item'],$field['relation']) as $selected)
                                            {{($selected['id']==$value['id'])?'selected="selected"':''}}
                                        @endforeach
                                    @endif
                                >{{$value['title']}}</option>
                            @endforeach
                        </select>
                    </div>
                @endif
{{---------------------------------------------------------------------------------------------------------------------- Checkbox Filed --}}
                @if($field['type']=='radio')
                    <div class="Control-Group">
                        <label  for="field_{{$alias}}">{{$field['title']}}</label>
                        <ul>
                            @foreach($field['values'] as $key => $value)
                                <li>
                                    <label for="field_{{$alias}}">{{$value}}</label>
                                    <input type="radio" name="{{$alias}}" value="{{$key}}"
                                    {{($key==\UpfHelpers\View::RelationToArray($content['data']['item'],$field['relation']))?'checked':''}}>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
{{---------------------------------------------------------------------------------------------------------------------- Checkbox End Fields --}}
            @endforeach
            <input class="Button Round" type="submit" value="Обновить"/>
        </form>
    </div>
</section>
@endsection