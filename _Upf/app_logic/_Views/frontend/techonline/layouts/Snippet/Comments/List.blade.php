<div class="Comment Node">

    {{-- Comments Body --}}
        <h4 class="Heading Primary">Комментарии</h4>
        <ul class="Comment-List">
            @foreach($Comments as $Comment)
                <li class="Comment-Item" comment_id="{{$Comment['id']}}">

                    <div class="Item-Vote">
                        <ul class="Vote">
                            <li><a class="Vote-Down" href="#"></a></li>
                            <li><span>{{$Comment['rating']}}</span></li>
                            <li><a class="Vote-Up" href="#"></a></li>
                        </ul>
                    </div>

                    <div class="Item-Content">
                        <header>
                            <h5>{{$Comment['author']}}
                                <span class="Date">{{$Comment['created_at']}}</span></h5>
                        </header>
                        <p>{{$Comment['post']}}</p>

                    </div>
                </li>
            @endforeach
        </ul>
    {{-- End Comments Body --}}



    {{-- Comments Form --}}
        <form class="Form-Horizontal action="">
            <h4 class="Section-Subheader">Написать комментарий</h4>
            <input name="list_id" value="{{isset( $Comments[0]['wall_id'] )?$Comments[0]['wall_id']:''}}" type="hidden">

            <div class="Control-Group">
                <label for="Comment-New-Name">Имя</label>
                <input id="Comment-New-Name" name="name" type="text"/>
            </div>

            <div class="Control-Group">
                <label for="Comment-New">Текст комментария</label>
                <textarea name="comment" id="Comment-New-Text" rows="5"></textarea>
            </div>

            <div class="Control-Group">
                <label for="Comment-New">Введите код</label>
                {{Form::captcha()}}
            </div>

            <div class="Control-Group Offset">
                <input type="submit" value="Написать"/>
            </div>
        </form>
    {{-- End Comments Form --}}

</div>

@section('scripts')
    @parent
    <script src="/js/frontend/Comments.js" type="text/javascript"></script>
@endsection