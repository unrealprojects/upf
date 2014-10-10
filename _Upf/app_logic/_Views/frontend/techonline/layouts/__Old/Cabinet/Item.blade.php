@extends('frontend.site_techonline.'.$content['template'])

@section('main')
<!-- Личный Кабинет -->
<div class="Node Row Split" xmlns="http://www.w3.org/1999/html">
    <aside class="XS-3">
        <h4 class="Section-Header">Личный Кабинет</h4>

        <nav class="Menu-List">
            <ul>
                <li><a href="/cabinet/{{\Route::current()->parameter('alias')}}/" title="Каталог стройтехники">Редактировать данные</a></li>
                <li><a href="/cabinet/{{\Route::current()->parameter('alias')}}/rent" title="Взять стройтехнику в аренду">Стройтехника</a></li>
                <li><a href="/cabinet/{{\Route::current()->parameter('alias')}}/parts">Запчасти и сервис</a></li>
            </ul>
        </nav>
    </aside>

    <form class="Form-Horizontal XS-9">
        <h4 class="Header-Column">Редактировать данные</h4>

        <div class="Control-Group">
            <label for="Cabinet-Name">Название организации</label>
            <input id="Cabinet-Name" name="name" type="text" value="{{$content['item']['name']}}"/>
        </div>

        <div class="Control-Group">
            <label for="Cabinet-Description">Описание организации</label>
            <textarea name="description" id="Cabinet-Description" rows="5">{{$content['item']['description']}}</textarea>
        </div>

        <div class="Control-Group">
            <label for="Cabinet-Adress">Адрес организации</label>
            <input id="Cabinet-Adress" name="adress" type="text" value="{{$content['item']['adress']}}"/>
        </div>

        <div class="Control-Group">
            <label for="Cabinet-Phone">Телефон организации</label>
            <input id="Cabinet-Phone" name="phone" type="tel" value="{{$content['item']['phone']}}"/>
        </div>

        <div class="Control-Group">
            <label for="Cabinet-Email">Email организации</label>
            <input id="Cabinet-Email" name="email" type="email" value="{{$content['item']['email']}}"/>
        </div>

        <div class="Control-Group">
            <label for="Cabinet-Skype">Skype организации</label>
            <input id="Cabinet-Skype" name="skype" type="text" value="{{$content['item']['skype']}}"/>
        </div>

        <div class="Control-Group Smart">
            <label for="Cabinet-Website">Вебсайт организации</label>
            <div class="Input-Smart Row Merge">
                <span class="XS-2 Prefix">http://</span>
                <input class="XS-10" id="Cabinet-Website" name="website" type="text" value="{{$content['item']['website']}}"/>
            </div>
        </div>

        <div class="Control-Group">
            <label for="Cabinet-Region">Регион</label>
            <select id="Cabinet-Region" name="website" type="text" value="{{$content['item']['region_id']}}">
                @foreach($content['regions'] as $region)
                    @if($region['id']==$content['item']['region_id'])
                        <option selected="selected" value="{{$region['id']}}">{{$region['name']}}</option>
                    @else
                        <option value="{{$region['id']}}">{{$region['name']}}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="Control-Group">
            <label for="Cabinet-Active">Опубликовать</label>
            <input id="Cabinet-Active" name="active" type="checkbox" {{($content['item']['active'])?'checked=checked':''}}"/>
        </div>

        <div class="Control-Group">
            <label for="Cabinet-Rating">Рейтинг</label>
            <input id="Cabinet-Rating" name="active" type="text" disabled="true" value="{{$content['item']['rating']}}"/>
        </div>
        <div class="Control-Group">
            <label for="Cabinet-Created">Аккаунт создан</label>
            <input id="Cabinet-Created" name="created" type="text" disabled="true" value="{{$content['item']['created_at']}}"/>
        </div>

        <div class="Control-Group Offset">
            <input type="submit" value="Обновить Информацию"/>
        </div>

    </form>
</div>



<article class="Node">
    <h4 class="Section-Header">Стройтехника</h4>
    <ul class="Snippet-List">
        @foreach($content['item']['tech_list'] as $list_elem)
        <li class="Snippet-Item Row Split">
            <header>
                    <h4 class="Item-Title"><a href="/rent/{{$list_elem['metadata']['alias']}}">
                            {{$list_elem['name']}}</a>
                        <p class="Item-Category">
                            {{$list_elem['model']['category']['name']}}
                        </p>
                    </h4>
                    <ul class="Item-Values">
                        <li><h6>Статус:</h6>{{$list_elem['status']['name']}}</li>
                        <li><h6>Состояние:</h6>{{$list_elem['opacity']['name']}}</li>
                        <li><h6>Цена:</h6>{{$list_elem['rate']}}</li>
                    </ul>
            </header>
            <div class="Item-Gallery Grid Four">
                @foreach(json_decode($list_elem['photos'],true) as $i=>$photo)
                @if($i==1)
                <img class="Item-Main-Photo" src="{{$photo['src']}}" alt="{{$photo['name']}}">

                <ul>
                    @elseif($i>1 && $i<5)
                    <li><img src="{{$photo['src']}}" alt="{{$photo['name']}}"></li>
                    @elseif($i>5)
                    <li style="display: none">
                        <img src="{{$photo['src']}}" alt="{{$photo['name']}}">
                    </li>
                    @endif
                    @endforeach
                </ul>
            </div>

            <div class="Item-Content Grid Eight">
                {{$list_elem['description']}}

                <!-- Параметры товара -->
                <h6>Характеристики</h6>
                <table>
                    <tr>
                        <td>Категория:</td>
                        <td>{{$list_elem['model']['category']['name']}}</td>
                    </tr>
                    <tr>
                        <td>Бренд:</td>
                        <td>{{$list_elem['model']['brand']['name']}}</td>
                    </tr>
                    <tr>
                        <td>Модель:</td>
                        <td>{{$list_elem['model']['model']}}</td>
                    </tr>
                    <tr>
                        <td>Регион:</td>
                        <td>{{$list_elem['region']['name']}}</td>
                    </tr>
                    <tr>
                        <td>Cтатус:</td>
                        <td>{{$list_elem['status']['name']}}</td>
                    </tr>
                    <tr>
                        <td>Состояние:</td>
                        <td> {{$list_elem['opacity']['name']}}</td>
                    </tr>
                </table>
            </div>

        </li>
        @endforeach
    </ul>
</article>


@include('frontend.standard.layouts.comments.List')
@endsection

