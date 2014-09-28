@extends('backend.standard.content')

@section('main')
<section class="Content">
    <h3 class="Heading Secondary">Создание новой публикации</h3>
    <section class="Content-Inner">

        <table class="Solid Lines Stripped Edit Adaptive">
            <thead>
                <tr>
                    <th><input type="checkbox"/></th>
                    <th>№</th>
                    <th>Заголовок</th>
                    <th>Содержание</th>
                    <th>Опубликовано</th>
                    <th>Действия</th>
                </tr>
            </thead>
            <tbody>
            <tr>
                <td class="Checkbox"><input type="checkbox"/></td>
                <td class="Number">01</td>
                <td class="Title" >
                    <div class="Caption">Заголовок</div>
                    <div contenteditable="true">Заголовок статьи или страницы</div>
                </td>
                <td class="Main">
                    <div class="Caption">Текст</div>
                    <div contenteditable="true">Строительство качественных автомагистралей, областных и городских дорог не может выполняться без использования грейдеров.</div>
                </td>
                <td class="Date" >
                    <div class="Caption">Дата</div>
                    <div contenteditable="true">16 августа 2014</div>
                </td>
                <td class="Actions">
                    <div class="Caption">Действия</div>
                    <ul>
                        <li><a title="Принять изменения" href="#"><span class="fa fa-check"></span></a></li>
                        <li><a title="Редактировать ..." href="#"><span class="fa fa-pencil"></span></a></li>
                        <li><a title="Удалить ..." href="#"><span class="fa fa-remove"></span></a></li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td class="Checkbox"><input type="checkbox"/></td>
                <td class="Number">01</td>
                <td class="Title" >
                    <div class="Caption">Заголовок</div>
                    <div contenteditable="true">Заголовок статьи или страницы</div>
                </td>
                <td class="Main">
                    <div class="Caption">Текст</div>
                    <div contenteditable="true">Строительство качественных автомагистралей, областных и городских дорог не может выполняться без использования грейдеров.</div>
                </td>
                <td class="Date" >
                    <div class="Caption">Дата</div>
                    <div contenteditable="true">16 августа 2014</div>
                </td>
                <td class="Actions">
                    <div class="Caption">Действия</div>
                    <ul>
                        <li><a title="Принять изменения" href="#"><span class="fa fa-check"></span></a></li>
                        <li><a title="Редактировать ..." href="#"><span class="fa fa-pencil"></span></a></li>
                        <li><a title="Удалить ..." href="#"><span class="fa fa-remove"></span></a></li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td class="Checkbox"><input type="checkbox"/></td>
                <td class="Number">01</td>
                <td class="Title" >
                    <div class="Caption">Заголовок</div>
                    <div contenteditable="true">Заголовок статьи или страницы</div>
                </td>
                <td class="Main">
                    <div class="Caption">Текст</div>
                    <div contenteditable="true">Строительство качественных автомагистралей, областных и городских дорог не может выполняться без использования грейдеров.</div>
                </td>
                <td class="Date" >
                    <div class="Caption">Дата</div>
                    <div contenteditable="true">16 августа 2014</div>
                </td>
                <td class="Actions">
                    <div class="Caption">Действия</div>
                    <ul>
                        <li><a title="Принять изменения" href="#"><span class="fa fa-check"></span></a></li>
                        <li><a title="Редактировать ..." href="#"><span class="fa fa-pencil"></span></a></li>
                        <li><a title="Удалить ..." href="#"><span class="fa fa-remove"></span></a></li>
                    </ul>
                </td>
            </tr>
            <tr>
                <td class="Checkbox"><input type="checkbox"/></td>
                <td class="Number">01</td>
                <td class="Title" >
                    <div class="Caption">Заголовок</div>
                    <div contenteditable="true">Заголовок статьи или страницы</div>
                </td>
                <td class="Main">
                    <div class="Caption">Текст</div>
                    <div contenteditable="true">Строительство качественных автомагистралей, областных и городских дорог не может выполняться без использования грейдеров.</div>
                </td>
                <td class="Date" >
                    <div class="Caption">Дата</div>
                    <div contenteditable="true">16 августа 2014</div>
                </td>
                <td class="Actions">
                    <div class="Caption">Действия</div>
                    <ul>
                        <li><a title="Принять изменения" href="#"><span class="fa fa-check"></span></a></li>
                        <li><a title="Редактировать ..." href="#"><span class="fa fa-pencil"></span></a></li>
                        <li><a title="Удалить ..." href="#"><span class="fa fa-remove"></span></a></li>
                    </ul>
                </td>
            </tr>
            </tbody>
        </table>
    </section>
</section>
@endsection