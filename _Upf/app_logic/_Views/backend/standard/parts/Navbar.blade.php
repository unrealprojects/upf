<nav class="Userbar">
    <ul>
        <li><a href="#" id="Nav-Menu"><span class="Icon Icon-bars Icon-lg"></span></a></li>
        <li><a href="/backend" id="Nav-Home"><span class="Icon Icon-home Icon-lg"></span></a></li>
        {{--<li><a href="#" id="Nav-Favorite"><span class="Icon Icon-star Icon-lg"></span></a></li>--}}
    </ul>

    <div class="Dropdown">
        <div class="Dropdown-Title">{{$AdministratorLogin}}<span class="Dropdown-Toggle Icon Icon-angle-down"></span></div>
        <ul class="Dropdown-Content">
            <li class="Icon"><a href="/backend/system/administrator/{{$AdministratorLogin}}/edit"><span class="Icon Icon-user"></span>Кабинет</a></li>
            <li class="Icon"><a href="/backend/logout"><span class="Icon Icon-close"></span>Выйти</a></li>
        </ul>
    </div>
</nav>

<nav class="Breadcrumbs">
    <ul class="Breadcrumb-List">
    @foreach($BreadCrumbs as $BreadCrumb)
        <li class="Breadcrumb-Item" itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
            <a href="{{{!empty($BreadCrumb['link'])?$BreadCrumb['link']:'#'}}}" itemprop="url">
                <span itemprop="title">{{{$BreadCrumb['title']}}}</span>
            </a>
        </li>
    @endforeach
    </ul>
</nav>