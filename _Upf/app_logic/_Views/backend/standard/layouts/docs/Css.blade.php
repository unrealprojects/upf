@extends($template)

@section('main')
<section class="Content">
    <div class="Content-Inner Short">
        <h3 class="Heading Secondary">Сетка</h3>
        <p>
            В версии 1.0 UP Framework поддерживает только резиновую 12&ndash;колоночную сетку.
            Сетка полностью адаптивная и позволяет менять свою структуру исходя из разрешения экрана.
        </p>
        <p>
            Существует два вида сеток: с отступами между элементами <code class="Inline">class="Row Split"</code> и без <code class="Inline">class="Row Merge"</code>.
        </p>


        <pre><code class="html">
        </code></pre>

        <h4 class="Heading Secondary">Сетка с отсутпами</h4>
        <div class="Row Split Demo">
            <div class="Grid-XS-1">1/12</div>
            <div class="Grid-XS-1">1/12</div>
            <div class="Grid-XS-1">1/12</div>
            <div class="Grid-XS-1">1/12</div>
            <div class="Grid-XS-1">1/12</div>
            <div class="Grid-XS-1">1/12</div>
            <div class="Grid-XS-1">1/12</div>
            <div class="Grid-XS-1">1/12</div>
            <div class="Grid-XS-1">1/12</div>
            <div class="Grid-XS-1">1/12</div>
            <div class="Grid-XS-1">1/12</div>
            <div class="Grid-XS-1">1/12</div>
        </div>
        <div class="Row Split Demo">
            <div class="Grid-XS-2">2/12</div>
            <div class="Grid-XS-2">2/12</div>
            <div class="Grid-XS-2">2/12</div>
            <div class="Grid-XS-2">2/12</div>
            <div class="Grid-XS-2">2/12</div>
            <div class="Grid-XS-2">2/12</div>

        </div>
        <div class="Row Split Demo">
            <div class="Grid-XS-3">3/12</div>
            <div class="Grid-XS-3">3/12</div>
            <div class="Grid-XS-3">3/12</div>
            <div class="Grid-XS-3">3/12</div>
        </div>
        <div class="Row Split Demo">
            <div class="Grid-XS-4">4/12</div>
            <div class="Grid-XS-4">4/12</div>
            <div class="Grid-XS-4">4/12</div>
        </div>

        <h4 class="Heading Secondary">Сетка без отступов</h4>
        <div class="Row Merge Demo">
            <div class="Grid-XS-1">1/12</div>
            <div class="Grid-XS-11">11/12</div>
        </div>
        <div class="Row Merge Demo">
            <div class="Grid-XS-2">2/12</div>
            <div class="Grid-XS-10">10/12</div>
        </div>
        <div class="Row Merge Demo">
            <div class="Grid-XS-3">3/12</div>
            <div class="Grid-XS-5">5/12</div>
            <div class="Grid-XS-4">4/12</div>
        </div>

        <h4 class="Heading Secondary">Последний элемент сетки</h4>
        <div class="Row Merge Demo">
            <div class="Grid-XS-3">3/12</div>
            <div class="Grid-XS-5">5/12</div>
            <div class="Grid-XS-3 End">3/12 End</div>
        </div>

        <h4 class="Heading Secondary">Отступы в сетке</h4>
        <div class="Row Merge Demo">
            <div class="Grid-XS-2">2/12</div>
            <div class="Grid-XS-2">2/12</div>
            <div class="Grid-XS-2 Push-2">2/12 Push-2</div>
            <div class="Grid-XS-2">2/12</div>
            <div class="Grid-XS-2">2/12</div>
        </div>
    </div>
</section>
@endsection