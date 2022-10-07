<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
</head>
<body>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <h3>Регистрация нового пользователя</h3>

    <form action="{{ route('users.store') }}" method="post">
        @csrf
        <input name="name" type="text" value="{{ old('name') }}"> Ваше имя<br><br>
        <input name="email" type="email" value="{{ old('email') }}"> Логин<br><br>
        <input name="password" type="password"> Пароль<br><br>
        <input name="password_confirmation" type="password"> Повторите пароль<br><br>
        <input name="button" type="submit"><br><br>
    </form>

</body>
</html>
