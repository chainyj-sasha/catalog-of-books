<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

@if(session('success'))
    {{ session('success') }}
@endif
@if(session('error'))
    {{ session('error') }}
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(auth()->check())
    Вы вошли как {{ auth()->user()->name }}<br><br>
    <a href="{{ route('logout') }}">разлогин</a>
@else

    <form action="{{ route('login') }}" method="post">
        @csrf
        <input name="email" type="email"> Логин<br><br>
        <input name="password" type="password"> Пароль<br><br>
        <input type="submit" value="Войти">
    </form>

    <p><a href="{{ route('users.create') }}">Регистрация</a></p>

@endif

@yield('content')

@if($_SERVER['REQUEST_URI'] != '/')
    <a href="{{ route('show_all_section') }}">На главную</a>
@endif

</body>
</html>
