@extends('frontend.site_techonline.'.$content['template'])

@section('main')

<section class="Node">

    <h3 class="Heading Primary">Каталог строительной техники</h3>
    @include('frontend.site_techonline.parts.breadcrumbs')
        <article>
            <ul class="Snippet-List">
                @foreach($content['list'] as $item_key => $list_elem)
                <li class="Snippet-Item Row Merge">
                    <header>
                            <h4 class="Item-Title">
                                <a href="/sellers/{{$list_elem['metadata']['alias']}}">
                                    {{$list_elem['name']}}
                                </a>
                            </h4>
                    </header>

                    @include('frontend.site_techonline.layouts.elements.Photos',
                        [
                            'photos'=>$list_elem['photos'],
                            'class_wrap'=>'Item-Gallery Grid-XS-5'
                        ])

                    <div class="Item-Content Grid-XS-7">
                        {{$list_elem['description']}}
                        <h6>Контактные данные</h6>
                        <table>
                            <tr>
                                <td>Телефоны:</td>
                                <td>{{$list_elem['phone']}}</td>
                            </tr>
                            <tr>
                                <td>Адрес:</td>
                                <td> {{$list_elem['adress']}}</td>
                            </tr>
                            <tr>
                                <td>Email:</td>
                                <td> {{$list_elem['email']}}</td>
                            </tr>
                            <tr>
                                <td>Skype:</td>
                                <td> {{$list_elem['skype']}}</td>
                            </tr>
                            <tr>
                                <td>Site:</td>
                                <td> {{$list_elem['website']}}</td>
                            </tr>
                            <tr>
                                <td>Регион:</td>
                                <td> {{$list_elem['region']['name']}}</td>
                            </tr>
                        </table>
                    </div>

                </li>

            @endforeach
            </ul>
        </article>
    </div>
<!-- Пагинация -->
{{$content['pagination']}}
</section>

@endsection