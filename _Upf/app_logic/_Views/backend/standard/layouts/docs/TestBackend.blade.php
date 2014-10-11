@extends($Template)

@section('main')
<section class="Content">
<section class="Content-Inner">
    <h3 class="Heading Secondary">Box</h3>
    <p>Box &mdash; универсальный модуль.</p>
    <p>При необходимости может быть снабжен интерактивными функциями:</p>
    <ul>
        <li>Свернуть контент: Box-Drop-Down</li>
        <li>Удалить себя со страницы: Box-Delete</li>
        <li>Скрыть себя на страницы: Box-Hide</li>
    </ul>
    <section class="Node-Wrap">
<pre><code class="html">&lt;article class=&quot;Box&quot;&gt;
     &lt;header&gt;
        &lt;h4 class=&quot;Box-Title&quot;&gt;Заголовок&lt;/h4&gt;
        &lt;ul class=&quot;Box-Tools&quot;&gt;
           &lt;li&gt;&lt;a href=&quot;&quot;&gt;&lt;span class=&quot;Box-Drop-Down fa fa-chevron-down&quot;&gt;&lt;/span&gt;&lt;/a&gt;&lt;/li&gt;
           &lt;li&gt;&lt;a href=&quot;&quot;&gt;&lt;span class=&quot;Box-Delete fa fa-close&quot;&gt;&lt;/span&gt;&lt;/a&gt;&lt;/li&gt;
        &lt;/ul&gt;
     &lt;/header&gt;
     &lt;div class=&quot;Box-Content&quot;&gt;
        Содержимое
     &lt;/div&gt;
&lt;/article&gt;</code>
</pre>
    </section>
    <section class="Node-Wrap Grid Split">
        <article class="Box Grid-XS-6">
            <header>
                <h4 class="Box-Title">Box</h4>
                <ul class="Box-Tools">
                    <li><a href="#"><span class="Box-Drop-Down fa fa-chevron-down"></span></a></li>
                    <li><a href="#"><span class="Box-Hide fa fa-close"></span></a></li>
                </ul>
            </header>
            <div class="Box-Content">
                Содержимое
            </div>
        </article>
        <article class="Box Outlined Grid-XS-6">
            <header>
                <h4 class="Box-Title">Box с границей</h4>
            </header>
            <div class="Box-Content">
                <p>Класс: <strong>.Outlined</strong></p>
                <p>Этот Box стилизован при помощи рамки.</p>
                <p>Также у него отсутствуют элементы интерактива</p>
            </div>
        </article>
    </section>
    <section class="Node-Wrap Grid Split">
        <article class="Box Solid Grid-XS-6">
            <header>
                <h4 class="Box-Title">Box с акцентом на заголовке</h4>
                <ul class="Box-Tools">
                    <li><a href="#"><span class="Box-Drop-Down fa fa-chevron-down"></span></a></li>
                    <li><a href="#"><span class="Box-Delete fa fa-close"></span></a></li>
                </ul>
            </header>
            <div class="Box-Content">
                <p>Класс: <strong>Solid</strong></p>
                <p>Этот Box имеет выделенный заголовок</p>
                <p>Цвет фона заголовка берется из переменной $Clr-Main</p>
            </div>
        </article>
        <article class="Box Gradient Info Grid-XS-6">
            <header>
                <h4 class="Box-Title">Box с градиентом и особым цветом</h4>
            </header>
            <div class="Box-Content">
                <p>Класс: <strong>.Gradient .Info</strong></p>
                <p>Цвет градиента берется из переменной $Clr-Info</p>
            </div>
        </article>
    </section>
    <section class="Node-Wrap Grid Split">
        <article class="Box Outlined Grid-XS-6">
            <header>
                <h4 class="Box-Title">Box с градиентом и особым цветом</h4>
            </header>
            <div class="Box-Content">
                <p>Класс: <strong>.Gradient .Info</strong></p>
                <p>Цвет градиента берется из переменной $Clr-Info</p>
            </div>
            <footer>
                <button disabled class="Button">Отменить</button>
                <button class="Button">Принять</button>
            </footer>
        </article>
        <article class="Box Grid-XS-6">
            <header>
                <h4 class="Box-Title">Box с градиентом и особым цветом</h4>
            </header>
            <div class="Box-Content">
                <p>Класс: <strong>.Gradient .Info</strong></p>
                <p>Цвет градиента берется из переменной $Clr-Info</p>
            </div>
            <footer>
                <button class="Button">Отменить</button>
                <button class="Button Primary">Принять</button>
            </footer>
        </article>
    </section>
</section>
</section>

@endsection