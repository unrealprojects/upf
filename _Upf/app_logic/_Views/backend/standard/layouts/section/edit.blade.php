@extends($template)

@section('main')
<section class="Content">
    <h3 class="Heading Secondary">Редактирование</h3>
    <div class="Content-Inner">
        <form class="Wide" id="Edit-Item" enctype="multipart/form-data">

            @foreach($content['data']['fields'] as $alias => $field)

                <!-- Input Text Field -->
                @if($field['type']=='text')
                    <div class="Control-Group">
                        <label for="field_{{$alias}}">{{$field['title']}}</label>
                        @if($field['editable']==true)
                            <input name="{{$alias}}" id="field_{{$alias}}" type="text" value="{{\UpfHelpers\View::RelationToArray($content['data']['item'],$field['relation'])}}"/>
                        @else
                            <p>{{\UpfHelpers\View::RelationToArray($content['data']['item'],$field['relation'])}}</p>
                        @endif
                    </div>
                @endif

                <!-- Input Text Area Field -->
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

                <!-- Input Photo Field -->
                @if($field['type']=='photo')
                    <div class="Control-Group">
                        <label for="field_{{$alias}}">{{$field['title']}}</label>
                        @if($field['editable']==true)
                            <input name="{{$alias}}" id="field_{{$alias}}" type="file"/>
                            <img src="{{\UpfHelpers\View::RelationToArray($content['data']['item'],$field['relation'])}}" title="Изображение"/>
                        @else
                            <img src="{{\UpfHelpers\View::RelationToArray($content['data']['item'],$field['relation'])}}" title="Изображение"/>
                        @endif
                    </div>
                @endif

                <!-- Input Multiple Photos Field -->
                @if($field['type']=='photos')
                    <div class="Control-Group">
                        <label for="field_{{$alias}}">{{$field['title']}}</label>
                        @if($field['editable']==true)
                        <input name="{{$alias}}[]" multiple="multiple" id="field_{{$alias}}" type="file"/>

                             @foreach(\UpfHelpers\View::RelationToArray($content['data']['item'],$field['relation']) as $photos)
                                <img src="{{$photos['src']}}" item_img_id="{{$photos['src']}}" title="Изображения"/>
                             @endforeach
                        @endif
                    </div>
                @endif

                <!-- Input Select Field -->
                @if($field['type']=='select')
                    <div class="Control-Group">
                        <label for="field_{{$alias}}">{{$field['title']}}</label>
                        <select  name="{{$alias}}" id="field_{{$alias}}">
                            <option value="0">Нет</option>
                            @foreach($field['values'] as $value)
                                <option value="{{$value['id']}}"
                            {{(\UpfHelpers\View::RelationToArray($content['data']['item'],$field['relation'])==$value['id'])?'selected="selected"':''}}>{{$value['title']}}</option>
                            @endforeach
                        </select>
                    </div>
                @endif

                <!-- Input Select Field -->
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
            @endforeach
            <input class="Button Round" type="submit" value="Обновить"/>
        </form>
    </div>
</section>
@endsection

<!--
                 <div class="Control-Group">
                    <label for="">Категория</label>
                    <select name="" id="">
                        <option value="">1</option>
                    </select>
                </div>
                <div class="Control-Group Checkbox">
                    <label>Включить комментарии</label>
                    <input type="checkbox"/>
                </div>
                <ul class="Control-Group Radio">
                    <li>
                        <label for="">Опция 1</label>
                        <input type="radio" name="a"/>
                    </li>
                    <li>
                        <label for="">Опция 2</label>
                        <input type="radio" name="a"/>
                    </li>
                </ul>

                            <div class="Control-Group Offset">
                <input class="Button Round" type="submit"/>
            </div>-->