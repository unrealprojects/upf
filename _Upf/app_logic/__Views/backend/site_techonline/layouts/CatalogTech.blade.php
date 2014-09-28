@extends('backend.site_techonline.'.$content['template'])

@section('main')
<div class="ui-content">
    <div class="massage"></div>

    <div class="ui-body ui-body-a create_wrap" style="margin-bottom:1em;margin-top:2em;">
        <h2>Добавить новую запись:</h2>
        <input type="text" name="name" data-clear-btn="true" class="ui-input-clear"/>
        <textarea name="description" data-clear-btn="true"></textarea>
        <div class="ui-btn ui-btn-inline ui-btn-icon-left ui-icon-plus create">Добавить
        </div>
    </div>

    @foreach($content['category_list'] as $category_item)
        <div class="ui-body ui-body-a" style="margin-bottom:1em;" id="id{{$category_item['id']}}">
            <h2 contenteditable="true">{{$category_item['model']}}</h2>
            <p contenteditable="true">{{$category_item['description']}}</p>
            <span class="ui-btn ui-btn-inline ui-btn-icon-right ui-icon-delete delete" >Удалить</span>
            <span class="ui-btn ui-btn-inline  ui-btn-icon-right ui-icon-edit update">Обновить</span>
        </div>
    @endforeach

</div>

@endsection

@section('scripts')
<script src="/js/backend/techonline/Catalog.js" type="text/javascript"></script>
@endsection