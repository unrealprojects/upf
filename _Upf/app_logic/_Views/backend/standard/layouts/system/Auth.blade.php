@extends('backend.standard.empty')
@section('main')
    <div class="Auth-Wrap">
        <section class="Auth">
            <h3 class="Heading Secondary Icon">Авторизация</h3>
                <form class="Vertical" id="Auth">
                    <div class="Control-Group">
                        <label for="field_login">Логин</label>
                        <div class="Input-Group Icon Postfix">
                            <input name="login" id="field_login" type="text"/>
                            <span class="fa fa-user"></span>
                        </div>
                    </div>
                    <div class="Control-Group">
                        <div class="Label-Group">
                            <label for="field_password">Пароль</label>
                            <a class="SubLabel" href="#">Забыли пароль?</a>
                        </div>
                        <div class="Input-Group Icon Postfix">
                            <input name="password" id="field_password" type="password"/>
                            <span class="fa fa-lock"></span>
                        </div>
                    </div>
                    <div class="Control-Group Checkbox Submit Offset">
                        <input type="checkbox"/><label>Запомнить меня</label>
                        <input class="Button Round" type="submit" value="Войти"/>
                    </div>
                </form>
        </section>
    </div>
@endsection

@section('scripts')

@endsection