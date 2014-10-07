@extends($template)

@section('main')
<section class="Content">
    <div class="Content-Inner">
        <section class="Grid Merge">
            <aside class="Doc-Nav Node-XS-2">
                <ul>
                    <li><a href="#grid">Сетка</a></li>
                    <li><a href="#forms">Формы</a></li>
                </ul>
            </aside>
            <section class="Node-XS-8 Push-2">
                <a name="grid"></a>
                <h3 class="Heading Secondary">Сетка</h3>
                <p>
                    UPF Grid поддерживает два вида размеров сеток:
                </p>
                <ol>
                    <li>Резиновая сетка c шириной в 100%: <code class="Inline">Grid</code></li>
                    <li>Фиксированная сетка с шириной 960 пиксел: <code class="Inline">Grid-960</code></li>
                </ol>
                <p>
                    Поддерживаются два типа сеток:
                </p>
                <ol>
                    <li>С отступами: <code class="Inline">Grid Merge</code></li>
                    <li>Без отступов: <code class="Inline">Grid Split</code></li>
                </ol>
                <p>
                    Поддерживаются два вида размерностей внутри сетки:
                </p>
                <ol>
                    <li>Дробные значения от 1/2 до 1/7 (расширяется до бесконечности правкой -variables.scss: <code class="Inline">.Node-XS-1-2</code>, <code class="Inline">.Node-XS-1-5</code>, <code class="Inline">.Node-XS-3-7</code></li>
                    <li>Значения от 1 до 12 для стандартной 12&ndash;колоночной сетки <code class="Inline">.Node-XS-1</code>, <code class="Inline">.Node-XS-2</code>, ... , <code class="Inline">.Node-XS-12</code></li>
                </ol>

                <h5>12&ndash;Колоночная сетка без отступов</h5>
                <div class="Grid Merge Demo">
                    <div class="Node-XS-6 Node-LR-4"><span class="Hidden-LR">6</span><span class="Visible-LR">4</span></div>
                    <div class="Node-XS-6 Node-LR-4"><span class="Hidden-LR">6</span><span class="Visible-LR">4</span></div>
                    <div class="Visible-LR Node-LR-4">4</div>
                </div>
                <div class="Grid Merge Demo">
                    <div class="Hidden-LR Node-XS-1">Magic!</div>
                    <div class="Node-XS-2 Node-LR-3">2</div>
                    <div class="Node-XS-3">3</div>
                    <div class="Hidden-LR Node-XS-1">Magic!</div>
                    <div class="Node-XS-2 Node-LR-3">2</div>
                    <div class="Node-XS-3">3</div>
                </div>
                <h5>12&ndash;Колоночная сетка c отступами</h5>
                <div class="Grid Split Demo">
                    <div class="Node-XS-6 Hidden-LR">6</div>
                    <div class="Node-XS-6 Node-LR-12"><span class="Hidden-LR">6</span><span class="Visible-LR">12</span></div>
                </div>
                <div class="Grid Split Demo">
                    <div class="Node-XS-4 Node-LR-10"><span class="Hidden-LR">4</span><span class="Visible-LR">10</span></div>
                    <div class="Node-XS-8 Node-LR-2"><span class="Hidden-LR">8</span><span class="Visible-LR">2</span></div>

                </div>
                <h5>Дробная сетка без отступов</h5>
                <div class="Grid Merge Demo">
                    <div class="Node-LR-1-2 Visible-LR">1/2</div>
                    <div class="Node-XS-2-2 Node-LR-1-2"><span class="Hidden-LR">2/2</span><span class="Visible-LR">1/2</span></div>
                </div>
                <div class="Grid Merge Demo">
                    <div class="Node-XXS-6 Node-XS-1-3 Grid Merge">
                        <div class="Node-XS-6">6</div>
                        <div class="Node-XS-6 Grid Split">
                            <div class="Node-XS-6">6</div>
                            <div class="Node-XS-6">6</div>
                        </div>
                    </div>
                    <div class="Node-XXS-6 Node-XS-1-3">1/3</div>
                    <div class="Visible-XS Node-XS-1-3">1/3</div>
                </div>
                <div class="Grid Merge Demo">
                    <div class="Node-XS-1-4">1/4</div>
                    <div class="Node-XS-1-4">1/4</div>
                    <div class="Node-XS-1-4">1/4</div>
                    <div class="Node-XS-1-4">1/4</div>
                </div>
                <div class="Grid Merge Demo">
                    <div class="Node-XS-1-5">1/5</div>
                    <div class="Node-XS-1-5">1/5</div>
                    <div class="Node-XS-1-5">1/5</div>
                    <div class="Node-XS-1-5">1/5</div>
                    <div class="Node-XS-1-5">1/5</div>
                </div>
                <div class="Grid Merge Demo">
                    <div class="Node-XS-1-6">1/6</div>
                    <div class="Node-XS-1-6">1/6</div>
                    <div class="Node-XS-1-6">1/6</div>
                    <div class="Node-XS-1-6">1/6</div>
                    <div class="Node-XS-1-6">1/6</div>
                    <div class="Node-XS-1-6">1/6</div>
                </div>
                <div class="Grid Merge Demo">
                    <div class="Node-XS-1-7">1/7</div>
                    <div class="Node-XS-1-7">1/7</div>
                    <div class="Node-XS-1-7">1/7</div>
                    <div class="Node-XS-1-7">1/7</div>
                    <div class="Node-XS-1-7">1/7</div>
                    <div class="Node-XS-1-7">1/7</div>
                    <div class="Node-XS-1-7">1/7</div>
                </div>
                <h5>Дробная сетка с отступами</h5>
                <div class="Grid Split Demo">
                    <div class="Node-XS-1-2">1/2</div>
                    <div class="Node-XS-1-2">1/2</div>
                </div>
                <div class="Grid Split Demo">
                    <div class="Node-XS-1-3">1/3</div>
                    <div class="Node-XS-1-3">1/3</div>
                    <div class="Node-XS-1-3">1/3</div>
                </div>
                <div class="Grid Split Demo">
                    <div class="Node-XS-1-4">1/4</div>
                    <div class="Node-XS-1-4">1/4</div>
                    <div class="Node-XS-1-4">1/4</div>
                    <div class="Node-XS-1-4">1/4</div>
                </div>
                <div class="Grid Split Demo">
                    <div class="Node-XS-1-5">1/5</div>
                    <div class="Node-XS-1-5">1/5</div>
                    <div class="Node-XS-1-5">1/5</div>
                    <div class="Node-XS-1-5">1/5</div>
                    <div class="Node-XS-1-5">1/5</div>
                </div>
                <div class="Grid Split Demo">
                    <div class="Node-XS-1-6">1/6</div>
                    <div class="Node-XS-1-6">1/6</div>
                    <div class="Node-XS-1-6">1/6</div>
                    <div class="Node-XS-1-6">1/6</div>
                    <div class="Node-XS-1-6">1/6</div>
                    <div class="Node-XS-1-6">1/6</div>
                </div>
                <div class="Grid Split Demo">
                    <div class="Node-XS-1-7">1/7</div>
                    <div class="Node-XS-1-7">1/7</div>
                    <div class="Node-XS-1-7">1/7</div>
                    <div class="Node-XS-1-7">1/7</div>
                    <div class="Node-XS-1-7">1/7</div>
                    <div class="Node-XS-1-7">1/7</div>
                    <div class="Node-XS-1-7">1/7</div>
                </div>
                <h5>Дробная сетка фиксированной ширины (960 пиксел)</h5>
                <div class="Grid-960 Split Demo">
                    <div class="Node-XS-1-2">1/2</div>
                    <div class="Node-XS-1-2">1/2</div>
                </div>
                <div class="Grid-960 Split Demo">
                    <div class="Node-XS-1-3">1/3</div>
                    <div class="Node-XS-1-3">1/3</div>
                    <div class="Node-XS-1-3">1/3</div>
                </div>
                <div class="Grid-960 Split Demo">
                    <div class="Node-XS-1-4">1/4</div>
                    <div class="Node-XS-1-4">1/4</div>
                    <div class="Node-XS-1-4">1/4</div>
                    <div class="Node-XS-1-4">1/4</div>
                </div>
                <div class="Grid-960 Split Demo">
                    <div class="Node-XS-1-5">1/5</div>
                    <div class="Node-XS-1-5">1/5</div>
                    <div class="Node-XS-1-5">1/5</div>
                    <div class="Node-XS-1-5">1/5</div>
                    <div class="Node-XS-1-5">1/5</div>
                </div>
                <div class="Grid-960 Split Demo">
                    <div class="Node-XS-1-6">1/6</div>
                    <div class="Node-XS-1-6">1/6</div>
                    <div class="Node-XS-1-6">1/6</div>
                    <div class="Node-XS-1-6">1/6</div>
                    <div class="Node-XS-1-6">1/6</div>
                    <div class="Node-XS-1-6">1/6</div>
                </div>
                <div class="Grid-960 Split Demo">
                    <div class="Node-XS-1-7">1/7</div>
                    <div class="Node-XS-1-7">1/7</div>
                    <div class="Node-XS-1-7">1/7</div>
                    <div class="Node-XS-1-7">1/7</div>
                    <div class="Node-XS-1-7">1/7</div>
                    <div class="Node-XS-1-7">1/7</div>
                    <div class="Node-XS-1-7">1/7</div>
                </div>
                <a name="forms"></a>
                <h3>Элементы форм</h3>

                <form class="Vertical" action="">
                    <h5>Форма регистрации</h5>
                    <div class="Control-Group">
                        <label class="Node-XS-2" for="demo-1">Логин</label>
                        <input class="Node-XS-10" id="demo-1" type="text"/>
                    </div>
                    <div class="Control-Group">
                        <label class="Node-XS-2" for="demo-2">Пароль</label>
                        <input class="Node-XS-10" id="demo-2" type="text"/>
                    </div>
                    <div class="Control-Group Checkbox Submit Offset">
                        <div class="Input-Group Grid Merge">
                            <input id="demo-3" class="Slide Node-XXS-2" type="checkbox"/>
                            <label for="demo-3" class="Node-XXS-6">Запомнить меня</label>
                            <input class="Button Primary Node-XXS-3 End" type="submit" value="Войти"/>
                        </div>
                    </div>
                </form>
                <form action="">
                    <h5>Строчные input</h5>
                    <div class="Control-Group">
                        <label class="Node-XS-2" for="">Телефон</label>
                        <div class="Input-Group Node-XS-10 Grid Split">
                            <input class="Node-XS-3" type="text"/>
                            <input class="Node-XS-9" type="text"/>
                        </div>
                    </div>
                </form>asd
                <button class="Button Info Dropdown">
                   asd <span class="fa fa-caret-down Dropdown-Toggle"></span>
                    <ul class="Dropdow-Content">

                    </ul>
                </button>
            </section>
        </section>
    </div>
</section>
@endsection