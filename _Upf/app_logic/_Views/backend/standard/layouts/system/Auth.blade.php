@extends('backend.standard.empty')
@section('main')
    <div class="Auth-Wrap">
        <section class="Auth">
            <h3 class="Heading Secondary Icon">Авторизация</h3>
                <form class="Vertical" id="Auth">
                    <input name="_token" id="field_token" type="hidden" value="{{csrf_token()}}" />

                    <div class="Control-Group">
                        <label class="" for="field_login">Логин</label>
                        <div class="Input-Group Grid Merge Prefix">
                            <label class="Node-XXS-1 Icon Icon-user" for="field_login"></label>
                            <input class="Node-XXS-11" name="login" id="field_login" type="text" tabindex="1"/>
                        </div>
                    </div>

                    <div class="Control-Group">
                        <div class="Label-Group Grid Merge">
                            <label class="Left" for="field_password">Пароль</label>
                            <a class="Right" href="#">Забыли пароль?</a>
                        </div>
                        <div class="Input-Group Grid Merge Prefix">
                            <label for="field_password" class="Node-XXS-1 Icon Icon-lock"></label>
                            <input class="Node-XXS-11" name="password" id="field_password" type="password" tabindex="2"/>
                        </div>
                    </div>

                    <div class="Control-Group Checkbox Submit Offset">
                        <div class="Input-Group Grid Merge">
                            <input class="Slide Node-XXS-2" type="checkbox"/>
                            <label class="Node-XXS-6">Запомнить меня</label>
                            <input class="Button Primary Node-XXS-3 End" type="submit" value="Войти"/>
                        </div>
                    </div>

                </form>
        </section>
    </div>
@endsection

@section('scripts')
    @parent
        <script src="/js/backend/auth.js" type="text/javascript"></script>
@endsection