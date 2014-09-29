@extends($template)

@section('main')
<section class="Content">
    <h3 class="Heading Secondary">Редактирование</h3>
    <div class="Content-Inner">
        <form class="Wide" action="">
            @foreach($content['data']['fields'] as $alias => $field)
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