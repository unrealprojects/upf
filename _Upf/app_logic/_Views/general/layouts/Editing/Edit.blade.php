@extends($Template)

@section('Main')

<section class="Content{{$Upf['Page']['Interface']=='frontend'?' Node':''}}">

<div class="Content-Inner">



{{--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// Module navigate
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}

    @if(isset($Modules['Navigate']))
    @include($Modules['Navigate']['Template'], [ 'Content' => $Modules['Navigate']['Content'] ])
    @endif

{{--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}



    <h3 class="Heading Secondary">Редактирование</h3>

    <form class="Wide" id="Edit-Item" enctype="multipart/form-data">
        {{-- Each Field --}}
        @foreach($Content['Fields'] as $Field)
        <div class="Form-Group">






{{--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// Text Field
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}

@if($Field['type']=='text')

    <div class="Control-Group">
        <label class="Node-XXS-3" for="field_{{$Field['relation']}}">{{$Field['title']}}</label>
        @if($Field['editable']==true)
        <input class="Node-XXS-9" name="{{$Field['relation']}}" id="field_{{$Field['relation']}}" type="text"
               value="{{\UpfHelpers\View::RelationToArray($Content['Item'],$Field['relation'])}}"/>
        @else
        <input class="Node-XXS-9" name="{{$Field['relation']}}" id="field_{{$Field['relation']}}" type="text"
               disabled
               value="{{\UpfHelpers\View::RelationToArray($Content['Item'],$Field['relation'])}}"/>
        @endif
    </div>

{{--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}





{{--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// Password Field
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}

@elseif($Field['type']=='password')
<div class="Control-Group">
    <label class="Node-XXS-3" for="field_{{$Field['relation']}}">{{$Field['title']}}</label>
    <input class="Node-XXS-9" name="{{$Field['relation']}}" id="field_{{$Field['relation']}}" type="password"/>
</div>


{{--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// Password Field
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}

@elseif($Field['type']=='divider')
<div class="Control-Group">
    <h5 class="Heading Secondary" style="margin-top:40px;">{{$Field['title']}}</h5>
</div>


{{--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}





{{--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// Text Field
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}

@elseif($Field['type']=='textarea')

<div class="Control-Group">
    <label class="Node-XXS-3" for="field_{{$Field['relation']}}">{{$Field['title']}}</label>
    @if($Field['editable']==true)
    <textarea class="Node-XXS-9" name="{{$Field['relation']}}" id="field_{{$Field['relation']}}"
              type="text">{{\UpfHelpers\View::RelationToArray($Content['Item'],$Field['relation'])}}</textarea>
    @else
    <p>{{\UpfHelpers\View::RelationToArray($Content['Item'],$Field['relation'])}}</p>
    @endif
</div>

{{--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}





{{--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// Photo Field
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}

@elseif($Field['type']=='photo')
<div class="Control-Group  Control-Photo">
    <label class="Node-XXS-3" for="field_{{$Field['relation']}}">{{$Field['title']}}</label>
    @if($Field['editable']==true)
    <div class="Input-Group Node-XXS-9 Grid Upload">

        <label class="File-Upload">
            <input name="{{$Field['relation']}}" id="field_{{$Field['relation']}}" type="file"/>
            <span class="Button Info"><span class="Icon Icon-folder-open"></span>Загрузить Файл</span>
        </label>
        @if($Src = \UpfHelpers\View::RelationToArray($Content['Item'],$Field['relation']))
        <ul class="Grid Split">
            <li class="Node-XS-6">
                <a href="#" class="Link-Delete">Удалить</a>
                <img class="Field-Img-{{$Field['relation']}} Uploaded" src="{{$Src}}" title="Изображение"/>
            </li>
        </ul>
        @endif
    </div>
    @else
    <div class="Input-Group">
        <img src="{{\UpfHelpers\View::RelationToArray($Content['Item'],$Field['relation'])}}"
             title="Изображение"/>
    </div>
    @endif
</div>


{{--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}






{{--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// Multiple Photo Field
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}

@elseif($Field['type']=='photos')

<div class="Control-Group Control-Photos">
    <label class='Node-XXS-3' for="field_{{$Field['relation']}}">{{$Field['title']}}</label>
    @if($Field['editable']==true)
    <div class="Input-Group Upload Node-XXS-9">
        <label class="File-Upload">
            <input class="" name="{{$Field['relation']}}[]" multiple="multiple"
                   id="field_{{$Field['relation']}}" type="file"/>
            <span class="Button Info"><span class="Icon Icon-folder-open"></span>Загрузить Файл</span>
        </label>
        <ul class="Grid Split">
            @foreach(\UpfHelpers\View::RelationToArray($Content['Item'],$Field['relation']) as $photos)
            <li class="Node-XS-3">
                <a href="#" class="Link-Delete">Удалить</a>
                <img class="Field-Img-{{$Field['relation']}} Uploaded" src="{{$photos['src']}}"
                     Item_img_id="{{$photos['id']}}" title="Изображения"/>
            </li>
            @endforeach
        </ul>
    </div>
    @endif
</div>

{{--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}





{{--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// Select Field
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}

@elseif($Field['type']=='select')

<div class="Control-Group">
    <label class='Node-XXS-3' for="field_{{$Field['relation']}}">{{$Field['title']}}</label>
    <div class='Input-Select Node-XXS-9'>
    <input type="text" placeholder="Поиск"/>
    <input type="hidden" name="{{$Field['relation']}}" id="field_{{$Field['relation']}}"/>
    <span class="Input-Select-Clean Icon Icon-close"></span>
    <span class="Input-Select-Toggle Icon Icon-chevron-down"></span>

    <ul class="Input-Select-Content">
        <li data-index="0"><a href="">Нет</a></li>
        @foreach($Model::GetFieldValues($Field['values'],$Field['values_type'],$Model) as $key => $value)
            @if($Field['values_type']=='config' && ( is_int($key) || $Field['relation']=='section' ) )
                <li data-index="{{$key}}"
                {{(\UpfHelpers\View::RelationToArray($Content['Item'],$Field['relation'])==$key)?'selected="selected"':''}}><a href="">{{$value}}</a></li>
            @elseif($Field['values_type']=='model' && is_int($key) )
                <li data-index="{{$value['id']}}"
                {{(\UpfHelpers\View::RelationToArray($Content['Item'],$Field['relation'])==$value['id'])?'selected="selected"':''}}><a href="">{{$value['title']}}</a></li>
            @endif
        @endforeach
    </ul>
    </div>
</div>
{{--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}






{{--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// Multi Select Field
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}

@elseif($Field['type']=='multi-select')

<div class="Control-Group">
    <label class='Node-XXS-3' for="field_{{$Field['relation']}}">{{$Field['title']}}</label>
    <select class='Node-XXS-9' multiple="multiple" name="{{$Field['relation']}}[]"
            id="field_{{$Field['relation']}}">
        @foreach($Model::GetFieldValues($Field['values'],$Field['values_type'],$Model) as $value)
        <option value="{{$value['id']}}"
        @if(\UpfHelpers\View::RelationToArray($Content['Item'],$Field['relation']))
            @foreach(\UpfHelpers\View::RelationToArray($Content['Item'],$Field['relation']) as $selected)
                {{($selected['id']==$value['id'])?'selected="selected"':''}}
            @endforeach
        @endif
        >{{$value['title']}}</option>
        @endforeach
    </select>
</div>

{{--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}





{{--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// Radio Field
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}

@elseif($Field['type']=='radio')

<ul class="Control-Group Radio">
    {{--<label class='Node-XXS-3' for="field_{{$Field['relation']}}">{{$Field['title']}}</label>--}}

    @foreach($Model::GetFieldValues($Field['values'],$Field['values_type']) as $key => $value)
    <li class='Node-XXS-9'>
        <label for="field_{{$Field['relation']}}">{{$value}}</label>
        <input type="radio" name="{{$Field['relation']}}" value="{{$key}}"
        {{($key==\UpfHelpers\View::RelationToArray($Content['Item'],$Field['relation']))?'checked':''}}>
    </li>
    @endforeach
</ul>

{{--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}






{{--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// Params Field
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}

@elseif($Field['type']=='params')

@if($Relation = \UpfHelpers\View::RelationToArray($Content['Item'],$Field['relation']))

<div class="Control-Group">
    <label class="Node-XXS-3" for="field_{{$Field['relation']}}">{{$Field['title']}}</label>

    <div class="Input-Group Vertical Node-XS-9">
        @foreach($Relation as $ParamKey => $Param)
        <input class="Node-XXS-9" name="params[{{$Param['alias']}}]" id="field_{{$Field['relation']}}"
               type="text" type="numeric"
        @foreach($Content['Item']['meta']['paramsvalues'] as $ParamValue)
        @if($ParamValue['param_id'] == $Param['id'])
        value="{{$ParamValue['value']}}"
        @endif
        @endforeach
        placeholder="{{$Param['title']}}"/>
        @endforeach
    </div>
</div>

@endif
{{--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}


            @endif
            </div>
        {{-- End Each Field --}}
        @endforeach

        <div class="Form-Group">
            <div class="Control-Group">
                <input class="Node-XS-12" type="submit" value="Сохранить"/>
            </div>
        </div>
    </form>

</div>
</section>
@endsection