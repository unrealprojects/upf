<ul class="Item-Vote {{isset($Class)?$Class:'Node-XXS-2'}} End"
    data-action="{{ $Action }}"
    data-alias="{{ isset($Item['alias'])?$Item['alias']:'' }}"
    data-section="{{ !empty($Item['section'])?$Item['section']:$Action }}"
    data-comment-id="{{ isset($Item['id'])?$Item['id']:'' }}">

    <li><a href="#" data-direct="down" title="Понизить рейтинг"><span class="Icon Icon-minus"></span></a></li>
    <li><span class="Rating {{ $Item['rating']>0?'Positive':'' }}{{ $Item['rating']<0?'Negative':'' }}" title="Рейтинг">{{ $Item['rating'] }}</span></li>
    <li><a href="#" data-direct="up" title="Повысить рейтинг"><span class="Icon Icon-plus"></span></a></li>
</ul>
