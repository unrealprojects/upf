@extends($Template)

@section('Main')
    <section class="Content{{$Upf['Page']['Interface']=='frontend'?' Node':''}}">
        {{--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /// Module navigate
        ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}

        @if(isset($Modules['Navigate']))
        @include($Modules['Navigate']['Template'], [ 'Content' => $Modules['Navigate']['Content'] ])
        @endif

        {{--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}

        <div class="Content-Inner">
            <h3 class="Heading Secondary">Создать</h3>
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


{{--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// Password Field
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}

                    @elseif($Field['type']=='password')
                        <div class="Control-Group">
                            <label class="Node-XXS-3" for="field_{{$Field['relation']}}">{{$Field['title']}}</label>
                            <input class="Node-XXS-9" name="{{$Field['relation']}}" id="field_{{$Field['relation']}}" type="password"/>
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
                                    <span class="Button Info"><span class="Icon Icon-folder-open"></span>Загрузить Файл</span>
                                </label>
                            </div>
                        </div>



{{---------------------------------------------------------------------------------------------------------------------- Photo Field --}}

{{--////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/// Select Field
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}

@elseif($Field['type']=='select')

<div class="Control-Group">
    <label class='Node-XXS-3' for="field_{{$Field['relation']}}">{{$Field['title']}}</label>
    <div class='Input-Select Node-XXS-9'>
        <input type="text" placeholder="Поиск"/>
        <input type="hidden" name="{{$Field['relation']}}" value="" id="field_{{$Field['relation']}}" />
        {{--<span class="Input-Select-Search Icon Icon-search"></span>--}}
        <span class="Input-Select-Clean Icon Icon-close"></span>
        <span class="Input-Select-Toggle Icon Icon-chevron-down"></span>

        <ul class="Input-Select-Content">
            <li data-index="0"><a href="">Нет</a></li>
            @if($Input_Select_Data = $Model::GetFieldValues($Field['values'],$Field['values_type'],$Model))
                @foreach($Input_Select_Data as $key => $value)
                    @if($Field['values_type']=='config' && ( is_int($key) || $Field['relation']=='section' ) )
                        <li data-index="{{$key}}"><a href="">{{$value}}</a></li>
                    @elseif($Field['values_type']=='model' && is_int($key) )
                        <li data-index="{{$value['id']}}"><a href="">{{$value['title']}}</a></li>
                    @endif
                @endforeach
            @endif
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
        <option value="{{$value['id']}}">{{$value['title']}}</option>
        @endforeach
    </select>
</div>

{{--/////////////////////////////////////////////////////////////////////////////////////////////////////////////////--}}
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