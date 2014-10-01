@extends($template)

@section('main')
<section class="Content">
    <div class="Content-Inner">
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
            <div class="Node-XXS-6 Node-XS-1-3">1/3</div>
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
    </div>
    <div class="Content-Inner">
        <h3 class="Heading Secondary">
            Классы Visible, Hidden
        </h3>
        <div class="Hidden-XS Demo">Hidden-XS</div>
        <div class="Hidden-SM Demo">Hidden-SM</div>
        <div class="Hidden-MD Demo">Hidden-MD</div>
        <div class="Hidden-LR Demo">Hidden-LR</div>
        <div class="Hidden-HG Demo">Hidden-HG</div>

        <div class="Visible-XS Demo">Visible-XS</div>
        <div class="Visible-SM Demo">Visible-SM</div>
        <div class="Visible-MD Demo">Visible-MD</div>
        <div class="Visible-LR Demo">Visible-LR</div>
        <div class="Visible-HG Demo">Visible-HG</div>
    </div>
</section>
@endsection