@extends('backend.standard.empty')
@section('main')
    <section class="Content">
        <section class="Content-Inner">
            <h3 class="Heading Secondary">Авторизация</h3>
            <form id="Auth">
                <div class="Control-Group">
                    <label for="field_login">Логин</label>
                    <input name="login" id="field_login" type="text" placeholder="Логин"/>
                </div>
                <div class="Control-Group">
                    <label for="field_password">Пароль</label>
                    <input name="password" id="field_password" type="password" placeholder="Пароль"/>
                </div>
                <input class="Button Huge Round" type="submit" value="Вход"/>
            </form>
        </section>
    </section>
@endsection

@section('scripts')

@endsection