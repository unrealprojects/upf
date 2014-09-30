<nav class="Userbar">
    <ul>
        <li><a href="#" id="Nav-Menu"><span class="fa fa-bars fa-lg"></span></a></li>
        <li><a href="/backend" id="Nav-Home"><span class="fa fa-home fa-lg"></span></a></li>
        <li><a href="#" id="Nav-Favorite"><span class="fa fa-star fa-lg"></span></a></li>
    </ul>

    <ul class="Right">
        <li><a href="#"><span class="fa fa-plus fa-lg"></span></a></li>
        <li><a href="#"><span class="fa fa-pencil fa-lg"></span></a></li>
        <li><a href="#"><span class="fa fa-trash fa-lg"></span></a></li>
        <li><a href="#"><span class="fa fa-briefcase fa-lg"></span></a></li>
        <li class="User-Menu Icon-Link Right Collapsed">
            <a class="Toggle" href="#">{{$AdministratorLogin}}<span class="fa fa-angle-down"></span></a>
            <ul class="Dropdown">
                <li class="Icon"><a href="/backend/system/administrator/{{$AdministratorLogin}}/edit"><span class="fa fa-user"></span>Кабинет</a></li>
                <li class="Icon"><a href="/backend/logout"><span class="fa fa-close"></span>Выйти</a></li>
            </ul>
        </li>
    </ul>
</nav>
<nav class="Breadcrumbs">
    <ul class="Breadcrumb-List">
        <li class="Breadcrumb-Item"itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
            <a href="/" itemprop="url">
                <span itemprop="title">Главная</span>
            </a>
        </li>
        <li class="Breadcrumb-Item"itemscope itemtype="http://data-vocabulary.org/Breadcrumb">
            <a href="/" itemprop="url">
                <span itemprop="title">Публикации</span>
            </a>
        </li>
        <li class="Breadcrumb-Item">
            <span>Создать</span>
        </li>
    </ul>
</nav>