<div class="Comment Node">

    {{-- Comments Body --}}
        <h4 class="Heading Primary">Комментарии</h4>
        <ul class="Comments Separated">
            @if(!empty($Comments) && count($Comments)>0)
                @foreach($Comments as $Comment)
                    <li class="Comment Grid Split" comment_id="{{$Comment['id']}}">

                        <div class="Comment-Content Node-XS-10">
                            <header>
                                <h5>{{$Comment['author']}}</h5>
                                    <time>{{$Comment['created_at']}}</time>
                            </header>
                            <p>{{$Comment['post']}}</p>
                        </div>
                        <ul class="Item-Vote Node-XXS-3 Node-XS-2">
                            <li><a href="#" title="Понизить рейтинг"><span class="Icon Icon-minus"></span></a></li>
                            <li><span title="Рейтинг">{{ $Item['meta']['rating'] }}</span></li>
                            <li><a href="#" title="Повысить рейтинг"><span class="Icon Icon-plus"></span></a></li>
                        </ul>
                    </li>
                @endforeach
            @endif
        </ul>
    {{-- End Comments Body --}}



    {{-- Comments Form --}}
    <h4 class="Section-Subheader">Написать комментарий</h4>
        <form class="Form-Horizontal action="">
            <input name="list_id" value="{{isset( $Comments[0]['wall_id'] )?$Comments[0]['wall_id']:''}}" type="hidden">

            <div class="Control-Group">
                <label class="Node-XS-3" for="Comment-New-Name">Имя</label>
                <input class="Node-XS-9" id="Comment-New-Name" name="name" type="text"/>
            </div>

            <div class="Control-Group">
                <label class="Node-XS-3" for="Comment-New">Текст комментария</label>
                <textarea class="Node-XS-9" name="comment" id="Comment-New-Text" rows="5"></textarea>
            </div>

            <div class="Control-Group">
                <label class="Node-XS-3" for="Comment-New">Введите код</label>
                <div class="Input-Group Node-XS-9">
                    {{Form::captcha()}}
                </div>
            </div>

            <div class="Control-Group Offset">
                <input class="Node-XS-3 Push-3 Primary" type="submit" value="Написать"/>
            </div>
        </form>
    {{-- End Comments Form --}}

</div>

@section('scripts')
    @parent
    <script src="/js/frontend/Comments.js" type="text/javascript"></script>
@endsection