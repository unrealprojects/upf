@extends($Template)

@section('Main')
    <section class="Content{{$Upf['Page']['Interface']=='frontend'?' Node':''}}">
        <section class="Toolbar Grid Merge Inline">
            {{--<h3 class="Heading Secondary">$Meta['title']</h3>--}}
            <!--
            <div class="Control-Group Node-XS-1">
                <a href="{{$BaseUrl}}add"><button class="Button Primary Fluid"><span class="Visible-XS">Добавить</span></button></a>
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
            -->
        </section>


            <table class="Solid Lines Stripped Edit Adaptive">
                <thead>
                    <tr>
                        {{--<th><input id='Select-All' type="checkbox"/></th>--}}
                        <th>Id </th>
                        @foreach($Content['Fields'] as $Field)
                            <th>{{$Field['title']}}</th>
                        @endforeach
                        <th>Действия</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($Content['List'] as $Item)
                        <tr item-id="{{$Item['id']}}"
                            item-alias="@if(isset($Item['meta']['alias'])){{$Item['meta']['alias']}}@elseif(isset($Item['alias'])){{$Item['alias']}}@elseif(isset($Item['login'])){{$Item['login']}}@endif">
                            {{--<td class="Checkbox"><input class="Selected-Items" type="checkbox"/></td>--}}
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
                                    <li><a class="Item-Update" title="Принять изменения" href="#"><span class="Icon Icon-check Button"></span></a></li>
                                    <li><a class="Item-Edit" title="Редактировать ..."
                                        href="@if(isset($Item['meta']['alias'])){{$BaseUrl.$Item['meta']['alias'].'/edit'}}
                                              @elseif(isset($Item['alias'])){{$BaseUrl.$Item['alias'].'/edit'}}
                                              @elseif(isset($Item['login'])){{$BaseUrl.$Item['login'].'/edit'}}@endif">
                                            <span class="Icon Icon-pencil Button"></span></a></li>
                                    <li><a class="Item-Remove" title="Удалить ..." href="#"><span class="Icon Icon-remove Button"></span></a></li>
                                </ul>
                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
            {{$Content['Pagination']}}
        </section>
    </section>
@endsection