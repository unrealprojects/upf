@extends($template)

@section('main')
<section class="Content">
    <h3 class="Heading Secondary">{{$meta['title']}}</h3>
    <section class="Content-Inner">
        <section class="Toolbar Grid Split Inline">
            <div class="Control-Group Node-XS-1">
                <button class="Button Ghost Fluid"><span class="fa fa-plus"></span><span class="Hidden-XS">Добавить ...</span></button>
            </div>
            <div class="Control-Group Node-XS-3">
                <select name="" id="">
                    <option value="">Элементов на странице</option>
                    <option value="">10</option>
                    <option value="">20</option>
                    <option value="">50</option>
                    <option value="">все</option>
                </select>
            </div>
            <div class="Control-Group Node-XS-3">
                <select name="" id="">
                    <option value="">Категория</option>
                </select>
            </div>
            <div class="Control-Group Node-XS-3">
                <select name="" id="">
                    <option value="">Регион</option>
                </select>
            </div>
            <div class="Control-Group Node-XS-2">
                <select name="" id="">
                    <option value="">Тег</option>
                </select>
            </div>
        </section>
        <table class="Solid Lines Stripped Edit Adaptive">
            <thead>
                <tr>
                    <th><input id='Select-All' type="checkbox"/></th>
                    <th>Id </th>
                    @foreach($content['data']['fields'] as $field)
                        <th>{{$field['title']}}</th>
                    @endforeach
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @foreach($content['data']['list'] as $item)
                    <tr item-id="{{$item['id']}}" item-alias="
                    @if(isset($item['meta']['alias']))
                        {{$item['meta']['alias']}}
                    @elseif(isset($item['alias']))
                        {{$item['alias']}}
                    @elseif(isset($item['login']))
                        {{$item['login']}}
                    @endif
                    ">
                        <td class="Checkbox"><input class="Selected-Items" type="checkbox"/></td>
                        <td class="Number">{{$item['id']}}</td>
                        @foreach($content['data']['fields'] as $field)
                            <td class="{{$field['class']}}">
                                @if($field['type']=='text')
                                    <div class="Caption">{{$field['title']}}</div>
                                    <div {{$field['editable']?'contenteditable="true"':''}} item-field="{{$field['name']}}">{{\UpfHelpers\View::RelationToArray($item,$field['relation'])}}</div>
                                @endif
                            </td>
                        @endforeach
                        <td class="Actions">
                            <div class="Caption">Действия</div>
                            <ul>
                                <li><a class="Item-Update" title="Принять изменения" href="#"><span class="fa fa-check"></span></a></li>
                                <li><a class="Item-Edit" title="Редактировать ..."
                                    href="@if(isset($item['meta']['alias'])){{$BaseUrl.$item['meta']['alias'].'/edit'}}
                                          @elseif(isset($item['alias'])){{$BaseUrl.$item['alias'].'/edit'}}
                                          @elseif(isset($item['login'])){{$BaseUrl.$item['login'].'/edit'}}@endif">
                                        <span class="fa fa-pencil"></span></a></li>
                                <li><a class="Item-Remove" title="Удалить ..." href="#"><span class="fa fa-remove"></span></a></li>
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$content['data']['pagination']}}
    </section>
</section>
@endsection