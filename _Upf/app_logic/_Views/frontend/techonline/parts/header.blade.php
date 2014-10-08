<!-- СЕКЦИЯ: Верхнее меню сайта (Логотип + Вход) -->
<section class="Site-Header">

    <div class="Site-Header-Inner Grid Merge" role="banner">

        <div href="http://hardcore/catalog" class="Site-Logo Node-SM-3 Node-LR-3">
            <div>
                <img class="Logo-Img" src="/img/techonline/logo.png"/>
                <h2>Стройтехника
                    <small><span class="Visible-MD">.</span>Онлайн</small>
                </h2>
            </div>
            <a class="Link-Home" href="/">Вернуться на главную страницу</a>
        </div>

        <div id="Menu-Toggle">
            <span class="fa fa-2x fa-bars"></span>
        </div>
        <nav id="Menu" class="Site-Navigation Primary Row Split Node-SM-5 Node-LR-6">
            <ul class="Menu-List">
                <li><a class="Menu-Link" href="/catalog" title="Каталог стройтехники">Каталог</a></li>
                <li><a class="Menu-Link" href="/rent" title="Взять стройтехнику в аренду">Аренда</a></li>
                <li><a class="Menu-Link" href="/parts">Запчасти и сервис</a></li>
                <li><a class="Menu-Link" href="/sellers">Арендодатели</a></li>
            </ul>
        </nav>

        <div class="Page-Auth Node-SM-4 Node-LR-3 Grid Split">
            <button class="Button Error Sign-In Node-XS-6"><span class="fa fa-sign-in"></span> Войти</button>
            <button class="Button Error Sign-Up Node-XS-6"><span class="fa fa-user"></span> Регистрация</button>

            <div class="Sign-In-UI">
                <form class="Form-Horizontal" action="">
                    <h4>Вход на сайт</h4>
                    <div class="Control-Group">
                        <label class="Node-XS-3" for="Sign-In-Username">E-mail</label>
                        <input class="Node-XS-9" id="Sign-In-Username" type="text"/>
                    </div>

                    <div class="Control-Group">
                        <label class="Node-XS-3" for="Sign-In-Password">Пароль</label>
                        <input class="Node-XS-9" id="Sign-In-Password" type="password"/>
                    </div>

                    <div class="Control-Group Row Merge" for="Sign-In-Remember-Me">
                        <label for="Sign-In-Remember-Me" class="Input-Group Checkbox">
                            <input class="Slide Node-XS-3" id="Sign-In-Remember-Me" type="checkbox"/>
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
                    <h4>Регистрация</h4>
                    <div class="Control-Group">
                        <label class="Node-XS-3" for="Sign-Up-Username">E-mail</label>
                        <input class="Node-XS-9" id="Sign-Up-Username" type="text"/>
                    </div>

                    <div class="Control-Group">
                        <label class="Node-XS-3" for="Sign-Up-Password">Пароль</label>
                        <input class="Node-XS-9" id="Sign-Up-Password" type="password"/>
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

    </div>

</section>