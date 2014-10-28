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

                        @include( $TemplateLayouts . 'Snippet.Elements.Vote', [ 'Item' => $Comment , 'Action' => 'comments', 'Class' => 'Node-XXS-2'])
                    </li>
                @endforeach
            @endif
        </ul>
    {{-- End Comments Body --}}



    {{-- Comments Form --}}
    <h4 class="Section-Subheader">Написать комментарий</h4>

    <form class="Form-Horizontal Form-Comment"
          data-alias="{{ isset($Content['Item']['meta']['alias'])?$Content['Item']['meta']['alias']:'' }}"
          data-section="{{ !empty($Content['Item']['meta']['section'])?$Content['Item']['meta']['section']:'' }}"
          data-wall-id="{{ !empty($Content['Item']['meta']['comments_id'])?$Content['Item']['meta']['comments_id']:'' }}">

        <div class="Control-Group">
            <label class="Node-XS-3" for="Comment-New-Name">Имя</label>
            <input class="Node-XS-9" id="Comment-New-Name" name="author" type="text"/>
        </div>

        <div class="Control-Group">
            <label class="Node-XS-3" for="Comment-New">Текст комментария</label>
            <textarea class="Node-XS-9" name="post" id="Comment-New-Text" rows="5"></textarea>
        </div>

        <div class="Control-Group">
            <label class="Node-XS-3" for="Comment-New">Введите код</label>
            <div class="Input-Group Node-XS-9">
                {{Form::captcha()}}
            </div>
        </div>

        <div class="Control-Group Offset">
            <input class="Node-XS-3 Push-3 Primary Send-Post" type="submit" value="Написать"/>
        </div>
    </form>
    {{-- End Comments Form --}}
</div>

