@extends($template)

@section('main')
<section class="Content">
    <h3 class="Heading Secondary">Редактирование</h3>
    <div class="Content-Inner">
        <form class="Wide" action="">
            <div class="Control-Group">
                <label for="">Заголовок</label>
                <input type="text"/>
            </div>
            <div class="Control-Group">
                <label for="">Содержание</label>
                <textarea name="" id=""></textarea>
            </div>
            <div class="Control-Group">
                <label for="">Категория</label>
                <select name="" id="">
                    <option value="">1</option>
                </select>
            </div>
            <div class="Control-Group Checkbox">
                <label>Включить комментарии</label>
                <input type="checkbox"/>
            </div>
            <ul class="Control-Group Radio">
                <li>
                    <label for="">Опция 1</label>
                    <input type="radio" name="a"/>
                </li>
                <li>
                    <label for="">Опция 2</label>
                    <input type="radio" name="a"/>
                </li>
            </ul>
            <div class="Control-Group Offset">
                <input class="Button Round" type="submit"/>
            </div>
        </form>
    </div>
</section>
@endsection