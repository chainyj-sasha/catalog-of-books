@extends('layouts.admin')

@section('title', $title)

@section('content')

    <h3>Редактирование автора</h3>

    <form action="{{ route('authors.update', ['author' => $author]) }}" method="post">
        @csrf
        @method('PUT')
        <input name="name" type="text" value="{{ $author->name }}"> ФИО автора<br><br>
        <input name="country" type="text" value="{{ $author->country }}"> Страна рождения<br><br>
        <textarea name="comment" id="" cols="30" rows="10">{{ $author->comment }}</textarea> Коментарий<br><br>
        <input type="submit" value="Сохранить"><br><br>
    </form>

    <form action="{{ route('authors.destroy', ['author' => $author]) }}" method="post">
        @csrf
        @method('DELETE')
        <input type="submit" value="Удалить">
    </form>

@endsection
