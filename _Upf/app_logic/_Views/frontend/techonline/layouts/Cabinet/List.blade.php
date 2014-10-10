@extends($Template)

@section('Main')
<section class="Node">
    <h3 class="Heading Secondary">{{--$Meta['title']--}}</h3>

    <section>
        <table class="Solid Lines Stripped Edit Adaptive">
            <thead>
                <tr>
                    <th><input id='Select-All' type="checkbox"/></th>
                    <th>Id </th>
                    @foreach($Content['Fields'] as $Field)
                        <th>{{$Field['title']}}</th>
                    @endforeach
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
                @if( isset($Content['List']) )
                    @foreach($Content['List'] as $Item)
                        <tr item-id="{{$Item['id']}}"
                            item-alias="@if(isset($Item['meta']['alias'])){{$Item['meta']['alias']}}@elseif(isset($Item['alias'])){{$Item['alias']}}@elseif(isset($Item['login'])){{$Item['login']}}@endif">
                            <td class="Checkbox"><input class="Selected-Items" type="checkbox"/></td>
                            <td class="Number">{{$Item['id']}}</td>
                            @foreach($Content['Fields'] as $Field)
                                <td class="{{$Field['class']}}">
                                    @if($Field['type']=='text')
                                        <div class="Caption">{{$Field['title']}}</div>
                                        <div {{$Field['editable']?'contenteditable="true"':''}} item-field="{{$Field['relation']}}">{{\UpfHelpers\View::RelationToArray($Item,$Field['relation'])}}</div>
                                    @endif
                                </td>
                            @endforeach
                            <td class="Actions">
                                <div class="Caption">Действия</div>
                                <ul>
                                    <li><a class="Item-Update" title="Принять изменения" href="#"><span class="fa fa-check"></span></a></li>
                                    <li><a class="Item-Edit" title="Редактировать ..."
                                        href="{{(isset($Item['meta']['alias']))?$BaseUrl.$Item['meta']['alias']:''.'/edit'}}">
                                            <span class="fa fa-pencil"></span></a></li>
                                    <li><a class="Item-Remove" title="Удалить ..." href="#"><span class="fa fa-remove"></span></a></li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        {{$Content['Pagination']}}
    </section>
</section>
@endsection