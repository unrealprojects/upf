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
                <button class="Button Info  Dropdown">
                   asd <span class="fa fa-caret-down Dropdown-Toggle"></span>
                    <ul class="Dropdow-Content">

                    </ul>
                </button>
            </section>
        </section>
    </div>

    <div class="Content-Inner">
        <h3 class="Heading Secondary">Формы</h3>
        <form class="" action="">
            <div class="Form-Group">
                <div class="Control-Group">
                    <label class="Node-XXS-3" for="">Input</label>
                    <input class="Node-XXS-9" type="text" value="Just an ordinary input. Nothing to see here"/>
                </div>
                <div class="Control-Group">
                    <label class="Node-XS-3" for="">Input Error</label>
                    <div class="Input-Group Error Node-XS-9">
                        <input class="Error" type="text" value="Error"/>
                    </div>
                </div>
                <div class="Control-Group">
                    <label class="Node-XS-3" for="">Input Warning</label>
                    <div class="Input-Group Warning Node-XS-9">
                        <input class="Warning" type="text" value="Warning"/>
                    </div>
                </div>
                <div class="Control-Group">
                    <label class="Node-XS-3" for="">Input Success</label>
                    <div class="Input-Group Warning Node-XS-9">
                        <input class="Success" type="text" value="Success"/>
                    </div>
                </div>
                <div class="Control-Group">
                    <label class="Node-XS-3" for="">Input Info</label>
                    <div class="Input-Group Warning Node-XS-9">
                        <input class="Info" type="text" value="Info"/>
                    </div>
                </div>
                <div class="Control-Group">
                    <label class="Node-XS-3" for="">Disabled Input</label>
                    <input class="Node-XS-9" type="text" value="Disabled Input" disabled/>
                </div>
                <div class="Control-Group">
                    <label class="Node-XS-3" for="">Ghost Input</label>
                    <input class="Node-XS-9 Ghost" type="text" readonly value="Ghost input"/>
                </div>

                <div class="Control-Group">
                    <label class="Node-XS-3" for="">Default Select</label>
                    <select class="Node-XS-9">
                        <option value="">Option 1</option>
                        <option value="">Option 2</option>
                    </select>
                </div>
                <div class="Control-Group">
                    <label class="Node-XS-3" for="">Dropdown</label>
                    <div class="Dropdown Node-XS-9">
                        <div class="Dropdown-Title">
                            <span class="Icon fa fa-bars"></span>Menu
                            <span class="Dropdown-Toggle fa fa-caret-down"></span>
                        </div>
                        <ul class="Dropdown-Content">
                            <li><a href="#"><span class="Icon fa fa-file"></span>Open The Goddamn File</a></li>
                            <li><a href="#"><span class="Icon fa fa-save"></span>Save File</a></li>
                            <li><a href="#"><span class="Icon fa fa-cog"></span>Settings</a></li>
                            <li class="Divide"></li>
                            <li><a href="#"><span class="Icon fa fa-close"></span>Exit</a></li>
                        </ul>
                    </div>
                </div>
                <div class="Control-Group">
                    <label class="Node-XS-3" for="">Dropdown</label>
                    <div class="Dropdown Invert Node-XS-9">
                        <div class="Dropdown-Title">
                            <span class="Icon fa fa-bars"></span>Menu
                            <span class="Dropdown-Toggle fa fa-caret-down"></span>
                        </div>
                        <ul class="Dropdown-Content">
                            <li><a href="#"><span class="Icon fa fa-file"></span>Open The Goddamn File</a></li>
                            <li><a href="#"><span class="Icon fa fa-save"></span>Save File</a></li>
                            <li><a href="#"><span class="Icon fa fa-cog"></span>Settings</a></li>
                            <li class="Divide"></li>
                            <li><a href="#"><span class="Icon fa fa-close"></span>Exit</a></li>
                        </ul>
                    </div>
                </div>

                <div class="Control-Group">
                    <label class="Node-XS-3" for="">Default Textarea</label>
                    <textarea class="Node-XS-9">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa eius, modi. Consequuntur, quos adipisci harum, ad, dolorem vero excepturi eveniet eum minus dignissimos consequatur vel. Dolore voluptatibus voluptatum quaerat saepe.</textarea>
                </div>

            </div>



            <div class="Form-Group">
                <div class="Control-Group">
                    <label for="" class="Node-XS-3">Input-Group Split</label>
                    <div class="Input-Group Node-XS-9 Grid Split">
                        <input type="text" class="Node-XXS-4" />
                        <input type="text" class="Node-XXS-4" />
                        <input type="text" class="Node-XXS-4" />
                    </div>
                </div>
                <div class="Control-Group">
                    <label for="" class="Node-XS-3">Input-Group Merge</label>
                    <div class="Input-Group Node-XS-9 Grid Merge">
                        <input type="text" class="Node-XXS-4" />
                        <input type="text" class="Node-XXS-4" />
                        <input type="text" class="Node-XXS-4" />
                    </div>
                </div>
                <div class="Control-Group">
                    <label class="Node-XS-3" for="">Input-Group Vertical</label>
                    <div class="Input-Group Vertical Node-XS-9">
                        <input type="text" />
                        <input type="text" />
                        <input type="text" />
                    </div>
                </div>
            </div>



            <div class="Form-Group">
                <div class="Control-Group">
                    <label for="" class="Node-XS-3">Input-Group Prefix</label>
                    <div class="Input-Group Prefix Node-XS-9 Grid Merge">
                        <span class="Node-XXS-1">@</span>
                        <input type="text" class="Node-XXS-11" />
                    </div>
                </div>

                <div class="Control-Group">
                    <label for="demo-1" class="Node-XS-3">Input-Group Postfix</label>
                    <div class="Input-Group Postfix Node-XS-9 Grid Merge">
                        <input id="demo-1" type="text" class="Node-XXS-11" />
                        <label for="demo-1" class="Node-XXS-1">.00</label>
                    </div>
                </div>
            </div>



            <div class="Form-Group">
                <div class="Control-Group">
                    <label for="" class="Node-XS-3">Input-Group Button 1</label>
                    <div class="Input-Group Button Node-XS-9 Grid Merge">
                        <input type="text" class="Node-XXS-10" />
                        <input type="button" class="Node-XXS-2" value="Check"/>
                    </div>
                </div>
                <div class="Control-Group">
                    <label for="" class="Node-XS-3">Input-Group Button 2</label>
                    <div class="Input-Group Button Node-XS-9 Grid Merge">
                        <input type="button" class="Node-XXS-2" value="Check"/>
                        <input type="text" class="Node-XXS-10" />
                    </div>
                </div>
            </div>
            <div class="Form-Group">
                <div class="Control-Group">
                    <label for="" class="Node-XS-3">File upload</label>
                    <div class="Input-Group Upload Node-XS-9">
                        <input class="" type="file" />
                        <ul class="Grid Split">
                            <li class="Node-XS-3"><a href="#" class="Link-Delete">Удалить</a><img src="http://lorempixel.com/300/300/sports/5" alt="" /></li>
                            <li class="Node-XS-3"><a href="#" class="Link-Delete">Удалить</a><img src="http://lorempixel.com/300/300/sports/5" alt="" /></li>
                            <li class="Node-XS-3"><a href="#" class="Link-Delete">Удалить</a><img src="http://lorempixel.com/300/300/sports/5" alt="" /></li>
                            <li class="Node-XS-3"><a href="#" class="Link-Delete">Удалить</a><img src="http://lorempixel.com/300/300/sports/5" alt="" /></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="Form-Group">
                <div class="Control-Group">
                    <input class="Node-XS-3 Push-3" type="submit" />
                </div>
            </div>

        </form>
    </div>
    <div class="Content-Inner">
        <div class="Grid Split">
            <div class="Panel Node-XS-4">
                На выставку IFA 2014 компания Samsung привезла шлем виртуальной реальности Gear VR. Правда, шлемом в прямом смысле слова это устройство назвать нельзя, так как для превращения в оный необходим смартфон Galaxy Note 4.
            </div>
            <div class="Panel Invert Node-XS-4">
                На выставку IFA 2014 компания Samsung привезла шлем виртуальной реальности Gear VR. Правда, шлемом в прямом смысле слова это устройство назвать нельзя, так как для превращения в оный необходим смартфон Galaxy Note 4.
            </div>
            <div class="Panel Invert Simple Shadow Node-XS-4">
                На выставку IFA 2014 компания Samsung привезла шлем виртуальной реальности Gear VR. Правда, шлемом в прямом смысле слова это устройство назвать нельзя, так как для превращения в оный необходим смартфон Galaxy Note 4.
            </div>
        </div>
        <div class="Grid Split">
            <div class="Panel Info Node-XS-4">
                На выставку IFA 2014 компания Samsung привезла шлем виртуальной реальности Gear VR. Правда, шлемом в прямом смысле слова это устройство назвать нельзя, так как для превращения в оный необходим смартфон Galaxy Note 4.
            </div>
            <div class="Panel Info Invert Node-XS-4">
                На выставку IFA 2014 компания Samsung привезла шлем виртуальной реальности Gear VR. Правда, шлемом в прямом смысле слова это устройство назвать нельзя, так как для превращения в оный необходим смартфон Galaxy Note 4.
            </div>
            <div class="Panel Info Invert Simple Shadow Node-XS-4">
                На выставку IFA 2014 компания Samsung привезла шлем виртуальной реальности Gear VR. Правда, шлемом в прямом смысле слова это устройство назвать нельзя, так как для превращения в оный необходим смартфон Galaxy Note 4.
            </div>
        </div>
        <div class="Grid Split">
            <div class="Panel Primary Node-XS-4">
                На выставку IFA 2014 компания Samsung привезла шлем виртуальной реальности Gear VR. Правда, шлемом в прямом смысле слова это устройство назвать нельзя, так как для превращения в оный необходим смартфон Galaxy Note 4.
            </div>
            <div class="Panel Primary Invert Node-XS-4">
                На выставку IFA 2014 компания Samsung привезла шлем виртуальной реальности Gear VR. Правда, шлемом в прямом смысле слова это устройство назвать нельзя, так как для превращения в оный необходим смартфон Galaxy Note 4.
            </div>
            <div class="Panel Primary Invert Simple Shadow Node-XS-4">
                На выставку IFA 2014 компания Samsung привезла шлем виртуальной реальности Gear VR. Правда, шлемом в прямом смысле слова это устройство назвать нельзя, так как для превращения в оный необходим смартфон Galaxy Note 4.
            </div>
        </div>
        <div class="Grid Split">
            <div class="Panel Success Node-XS-4">
                На выставку IFA 2014 компания Samsung привезла шлем виртуальной реальности Gear VR. Правда, шлемом в прямом смысле слова это устройство назвать нельзя, так как для превращения в оный необходим смартфон Galaxy Note 4.
            </div>
            <div class="Panel Success Invert Node-XS-4">
                На выставку IFA 2014 компания Samsung привезла шлем виртуальной реальности Gear VR. Правда, шлемом в прямом смысле слова это устройство назвать нельзя, так как для превращения в оный необходим смартфон Galaxy Note 4.
            </div>
            <div class="Panel Success Invert Simple Shadow Node-XS-4">
                На выставку IFA 2014 компания Samsung привезла шлем виртуальной реальности Gear VR. Правда, шлемом в прямом смысле слова это устройство назвать нельзя, так как для превращения в оный необходим смартфон Galaxy Note 4.
            </div>
        </div>
        <div class="Grid Split">
            <div class="Panel Warning Node-XS-4">
                На выставку IFA 2014 компания Samsung привезла шлем виртуальной реальности Gear VR. Правда, шлемом в прямом смысле слова это устройство назвать нельзя, так как для превращения в оный необходим смартфон Galaxy Note 4.
            </div>
            <div class="Panel Warning Invert Node-XS-4">
                На выставку IFA 2014 компания Samsung привезла шлем виртуальной реальности Gear VR. Правда, шлемом в прямом смысле слова это устройство назвать нельзя, так как для превращения в оный необходим смартфон Galaxy Note 4.
            </div>
            <div class="Panel Warning Invert Simple Shadow Node-XS-4">
                На выставку IFA 2014 компания Samsung привезла шлем виртуальной реальности Gear VR. Правда, шлемом в прямом смысле слова это устройство назвать нельзя, так как для превращения в оный необходим смартфон Galaxy Note 4.
            </div>
        </div>
        <div class="Grid Split">
            <div class="Panel Error Node-XS-4">
                На выставку IFA 2014 компания Samsung привезла шлем виртуальной реальности Gear VR. Правда, шлемом в прямом смысле слова это устройство назвать нельзя, так как для превращения в оный необходим смартфон Galaxy Note 4.
            </div>
            <div class="Panel Error Invert Node-XS-4">
                На выставку IFA 2014 компания Samsung привезла шлем виртуальной реальности Gear VR. Правда, шлемом в прямом смысле слова это устройство назвать нельзя, так как для превращения в оный необходим смартфон Galaxy Note 4.
            </div>
            <div class="Panel Error Invert Simple Shadow Node-XS-4">
                На выставку IFA 2014 компания Samsung привезла шлем виртуальной реальности Gear VR. Правда, шлемом в прямом смысле слова это устройство назвать нельзя, так как для превращения в оный необходим смартфон Galaxy Note 4.
            </div>
        </div>
    </div>

</section>
@endsection