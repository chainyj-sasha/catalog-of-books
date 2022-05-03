<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
</head>
<body>


@if(session('success'))
    {{ session('success') }}
@endif
@if(session('error'))
    {{ session('error') }}
@endif

@if(!auth()->check())
    <p>Вы не авторизованы</p>
    <a href="{{ route('login.form') }}">Авторизация</a><br><br>
    <a href="{{ route('register') }}">Регистрация</a>
@else
    {{auth()->user()->name}}
    <a href="{{ route('users.logout') }}"> Разлогин</a>
@endif

    <h1>Приложение для ведения каталога книг</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@yield('header')

@yield('content')


@if($_SERVER['REQUEST_URI'] != '/sections')
    <p>
    <form action="{{ route('sections.index') }}">
        <button>На главную</button>
    </form>
    </p>
@endif

</body>
</html>
