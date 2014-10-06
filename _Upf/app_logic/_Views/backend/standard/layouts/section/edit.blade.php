@extends($template)

@section('main')
<section class="Content">
    <h3 class="Heading Secondary">Редактирование</h3>
    <div class="Content-Inner">
        <form class="Wide" id="Edit-Item" enctype="multipart/form-data">
            @foreach($content['data']['fields'] as $field)
{{---------------------------------------------------------------------------------------------------------------------- Text Field --}}
                @if($field['type']=='text')
                    <div class="Control-Group">
                        <label for="field_{{$field['relation']}}">{{$field['title']}}</label>
                        @if($field['editable']==true)
                            <input name="{{$field['relation']}}" id="field_{{$field['relation']}}" type="text"
                                   value="{{\UpfHelpers\View::RelationToArray($content['data']['item'],$field['relation'])}}"/>
                        @else
                            <p>{{\UpfHelpers\View::RelationToArray($content['data']['item'],$field['relation'])}}</p>
                        @endif
                    </div>
{{---------------------------------------------------------------------------------------------------------------------- Text Password --}}
                @elseif($field['type']=='password')
                    <div class="Control-Group">
                        <label for="field_{{$field['relation']}}">{{$field['title']}}</label>
                            <input name="{{$field['relation']}}" id="field_{{$field['relation']}}" type="text" />
                    </div>
{{---------------------------------------------------------------------------------------------------------------------- Text Area Field --}}
                @elseif($field['type']=='textarea')
                    <div class="Control-Group">
                        <label for="field_{{$field['relation']}}">{{$field['title']}}</label>
                        @if($field['editable']==true)
                        <textarea name="{{$field['relation']}}" id="field_{{$field['relation']}}" type="text">{{\UpfHelpers\View::RelationToArray($content['data']['item'],$field['relation'])}}</textarea>
                        @else
                        <p>{{\UpfHelpers\View::RelationToArray($content['data']['item'],$field['relation'])}}</p>
                        @endif
                    </div>
{{---------------------------------------------------------------------------------------------------------------------- Photo Field --}}
                @elseif($field['type']=='photo')
                    <div class="Control-Group">
                        <label for="field_{{$field['relation']}}">{{$field['title']}}</label>
                        @if($field['editable']==true)
                            <div class="Input-Group">
                                <input name="{{$field['relation']}}" id="field_{{$field['relation']}}" type="file"/>
                                <img class="Field-Img-{{$field['relation']}} Uploaded" src="{{
                                    \UpfHelpers\View::RelationToArray($content['data']['item'],$field['relation'])
                                }}" title="Изображение"/>
                            </div>
                        @else
                            <div class="Input-Group">
                                <img src="{{\UpfHelpers\View::RelationToArray($content['data']['item'],$field['relation'])}}" title="Изображение"/>
                            </div>
                        @endif
                    </div>
{{---------------------------------------------------------------------------------------------------------------------- Multiple Photos Field --}}
                @elseif($field['type']=='photos')
                    <div class="Control-Group">
                        <label for="field_{{$field['relation']}}">{{$field['title']}}</label>
                        @if($field['editable']==true)
                        <div class="Input-Group">
                        <input name="{{$field['relation']}}[]" multiple="multiple" id="field_{{$field['relation']}}" type="file"/>

                             @foreach(\UpfHelpers\View::RelationToArray($content['data']['item'],$field['relation']) as $photos)
                                <img class="Field-Img-{{$field['relation']}} Uploaded" src="{{$photos['src']}}" item_img_id="{{$photos['src']}}" title="Изображения"/>
                             @endforeach
                        </div>
                        @endif
                    </div>
{{---------------------------------------------------------------------------------------------------------------------- Select Field --}}
                @elseif($field['type']=='select')
                    <div class="Control-Group">
                        <label for="field_{{$field['relation']}}">{{$field['title']}}</label>
                        <select  name="{{$field['relation']}}" id="field_{{$field['relation']}}">
                            <option value="0">Нет</option>
                            @foreach($Model::GetFieldValues($field['values'],$field['values_type'],$Model) as $key => $value)
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
            {{---------------------------------------------------------------------------------------------------------------------- Select Field --}}
            @elseif($field['type']=='multi-select')
            <div class="Control-Group">
                <label  for="field_{{$field['relation']}}">{{$field['title']}}</label>
                <select multiple="multiple" name="{{$field['relation']}}[]" id="field_{{$field['relation']}}">
                    @foreach($Model::GetFieldValues($field['values'],$field['values_type'],$Model) as $value)
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
            {{---------------------------------------------------------------------------------------------------------------------- Radio Filed --}}
            @elseif($field['type']=='radio')
            <ul class="Control-Group Radio">
                {{--<label  for="field_{{$field['relation']}}">{{$field['title']}}</label>--}}

                    @foreach($Model::GetFieldValues($field['values'],$field['values_type']) as $key => $value)
                    <li>
                        <label for="field_{{$field['relation']}}">{{$value}}</label>
                        <input type="radio" name="{{$field['relation']}}" value="{{$key}}"
                        {{($key==\UpfHelpers\View::RelationToArray($content['data']['item'],$field['relation']))?'checked':''}}>
                    </li>
                    @endforeach
            </ul>
            @endif
            {{---------------------------------------------------------------------------------------------------------------------- End Fields --}}
            @endforeach
            <input class="Button Round" type="submit" value="Обновить"/>
        </form>
    </div>
</section>
@endsection