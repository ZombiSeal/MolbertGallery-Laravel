<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>

    <title>Document</title>
</head>
<style>
</style>
<body>
<div class="container container_center">
    <div class="login">
        <h1 class="title title_margin">Вход</h1>
        <form action="{{route('login')}}" method="post" class="login-form form">
            @csrf
            <div class="form__item">
                <label for="log-email">E-mail</label>
                <input id="log-email" class="input email" type="text" name="email" placeholder="email">
                @error('email')
                <span class="error login-err">{{$message}}</span>
                @enderror
            </div>


            <div class="form__item">
                <label for="log-password">Пароль</label>
                <input id="log-password" class="input password" type="password" name="password" placeholder="password">
                @error('password')
                <span class="error login-err">{{$message}}</span>
                @enderror
            </div>

            @error('error')
            <span class="error login-err">{{$message}}</span>
            @enderror

            <input class="btn btn_log-size" type="submit" value="Войти">

        </form>
        <div class="back">
            <a class="back__link" href="{{route('registration')}}">Зарегистрироваться</a>
            <p>или</p>
            <a class="back__link" href="{{route('catalog')}}">Продолжить как гость</a>
        </div>
        <div class="bg"></div>

    </div>

</div>
</body>

{{--<script src="js/login.js" ></script>--}}
</html>
