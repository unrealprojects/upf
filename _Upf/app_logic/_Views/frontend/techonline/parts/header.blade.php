{{-- СЕКЦИЯ: Верхнее меню сайта (Логотип + Вход) --}}
<section class="Site-Header">

    <div class="Site-Header-Inner Grid Merge" role="banner">

        <div href="http://hardcore/catalog" class="Site-Logo Node-SM-3 Node-LR-3">
            <div>
                <img class="Logo-Img" src="/img/techonline/logo.png"/>
                <h2>Стройтехника
                    <small><span class="Visible-LR">.</span>Онлайн</small>
                </h2>
            </div>
            <a class="Link-Home" href="/">Вернуться на главную</a>
        </div>

        <div id="Menu-Toggle">
            <span class="Icon Icon-2x Icon-bars"></span>
        </div>
        <nav id="Menu" class="Site-Navigation Primary Row Split Node-SM-6 Hidden-XS Visible-SM">
            <ul class="Menu-List">
                <li><a class="Menu-Link" href="/catalog" title="Каталог стройтехники">Каталог</a></li>
                <li><a class="Menu-Link" href="/rent" title="Взять стройтехнику в аренду">Аренда</a></li>
                <li><a class="Menu-Link" href="/parts">Запчасти и сервис</a></li>
                <li><a class="Menu-Link" href="/users">Арендодатели</a></li>
            </ul>
        </nav>



        @if(!\Auth::users()->check())
            <div class="Page-Auth Node-SM-3 Grid Split">
                <button class="Button Error Sign-In Node-XS-6"><span class="Icon Icon-sign-in"></span> Войти</button>
                <button class="Button Error Sign-Up Node-XS-6"><span class="Icon Icon-user"></span> Регистрация</button>

                <div class="Sign-In-UI">
                    <form class="Form-Horizontal" action="">
                        <input name="_token" id="field_token" type="hidden" value="{{csrf_token()}}" />
                        <h4>Вход на сайт</h4>
                        <div class="Control-Group">
                            <label class="Node-XS-3"  for="Sign-In-Username">Логин</label>
                            <input class="Node-XS-9" id="Sign-In-Username"  name='login' type="text"/>
                        </div>

                        <div class="Control-Group">
                            <label class="Node-XS-3"  for="Sign-In-Password">Пароль</label>
                            <input class="Node-XS-9" id="Sign-In-Password"  name='password' type="password"/>
                        </div>

                        <div class="Control-Group Row Merge" for="Sign-In-Remember-Me">
                            <label for="Sign-In-Remember-Me" class="Input-Group Checkbox">
                                <input class="Slide Node-XS-3" id="Sign-In-Remember-Me" name="remember" type="checkbox"/>
                                <span>Запомнить меня</span>
                            </label>
                        </div>
                        <div class="Control-Group">
                            <input class="Button Node-XS-12" type="submit" value="Авторизоваться"/>
                        </div>
                    </form>
                </div>


                <div class="Sign-Up-UI">
                    <form class="Form-Horizontal" action="">
                        <input name="_token" id="field_token" type="hidden" value="{{csrf_token()}}" />
                        <h4>Регистрация</h4>
                        <div class="Control-Group">
                            <label class="Node-XS-3" for="Sign-Up-Username">Логин</label>
                            <input class="Node-XS-9" id="Sign-Up-Username" name='login' type="text"/>
                        </div>

                        <div class="Control-Group">
                            <label class="Node-XS-3" for="Sign-Up-Password">Пароль</label>
                            <input class="Node-XS-9" id="Sign-Up-Password" name='password' type="password"/>
                        </div>

                        <div class="Control-Group Row Merge" for="Sign-Up-Remember-Me">
                            <label for="Sign-Up-Remember-Me" class="Input-Group Checkbox">
                                <input class="Slide Node-XS-3" id="Sign-Up-Remember-Me" type="checkbox"/>
                                <span>Запомнить меня</span>
                            </label>
                        </div>
                        <div class="Control-Group">
                            <input class="Button Node-XS-12" type="submit" value="Зарегистриваться"/>
                        </div>
                    </form>
                </div>
            </div>
        @else
            <div class="Page-Auth Node-SM-3 Grid Split">
                <div class="Dropdown Node-XS-8 End Collapsed">
                    <div class="Dropdown-Title">Кабинет<span class="Dropdown-Toggle Icon Icon-angle-down"></span></div>
                    <ul class="Dropdown-Content" style="display: none;">
                        <li><a href="/cabinet"><span class="Icon Icon-user"></span>Кабинет</a></li>
                        <li><a href="/cabinet/rent/"><span class="Icon Icon-shopping-cart"></span>Список техники</a></li>
                        <li><a href="/cabinet/parts"><span class="Icon Icon-gears"></span>Список запчастей</a></li>
                        <li class="Divide"></li>
                        <li><a href="/cabinet/rent/add"><span class="Icon Icon-plus"></span>Добавить технику</a></li>
                        <li><a href="/cabinet/parts/add"><span class="Icon Icon-plus"></span>Добавить запчасти</a></li>
                        <li class="Divide"></li>
                        <li><a href="/logout"><span class="Icon Icon-close"></span>Выход</a></li>
                    </ul>
                </div>
            </div>
        @endif
    </div>

</section>