@if(!empty($breadCrumbs))
<div class="Breadcrumbs">
    <ul class="Breadcrumb-List">
        @foreach($breadCrumbs as $crumb)
        @if($crumb['link'])
        <li class="Breadcrumb-Item"itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
            <a href="{{$crumb['link']}}" itemprop="url">
                <span itemprop="title">{{$crumb['title']}}</span>
            </a>
        </li>
        @else
        <li class="Breadcrumb-Item">
            <span>{{$crumb['title']}}</span>
        </li>
        @endif
        @endforeach
    </ul>
</div>
@endif