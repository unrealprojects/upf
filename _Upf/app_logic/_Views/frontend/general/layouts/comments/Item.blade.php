<li class="Comment-List-Element" comment_id="{{$comment['id']}}">
    <div class="Comment-List-Element-Rating">
        <span class="Default">
            <span class="Arrow Up">
                <img title="Проголосовать за этот комментарий" src="/img/techonline/arrow-up.png">
            </span>
            <span class="Value">{{$comment['rating']}}</span>
            <span class="Arrow Down">
                <img title="Проголосовать против этого комментария" src="/img/techonline/arrow-down.png">
            </span>
        </span>
    </div>
    <div class="Comment-List-Element-Content">
        <header>
            <h5>{{$comment['name']}}</h5>
            <small class="Date">{{$comment['created_at']}}</small>
        </header>
        <p>{{$comment['comment']}}</p>
    </div>
</li>
