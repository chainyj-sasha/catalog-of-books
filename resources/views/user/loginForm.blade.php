@extends('layout.main')

@section('title', $title)

@section('content')

    <h3>Форма авторизации</h3>

    <form action="{{ route('login') }}" method="post">
        @csrf
        <input name="email" type="email" value="{{ old('email') }}"> Введите email<br><br>
        <input name="password" type="password"> Пароль<br><br>
        <input name="button" type="submit" value="Вперед">
    </form>

@endsection
