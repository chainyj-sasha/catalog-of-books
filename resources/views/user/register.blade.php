@extends('layout.main')

@section('title', $title)

@section('content')

    <h3>Зарегистрируйтесь</h3>

    <form action="{{ route('users.create') }}" method="post">
        @csrf
        <input name="name" type="text" value="{{ old('name') }}"> Ваше имя<br><br>
        <input name="email" type="email" value="{{ old('email') }}"> Ваш email<br><br>
        <input name="password" type="password"> Придумайте пароль<br><br>
        <input name="password_confirmation" type="password"> Повторите пароль<br><br>
        <input name="button" type="submit" value="Зарегистрировать">
    </form>

@endsection
