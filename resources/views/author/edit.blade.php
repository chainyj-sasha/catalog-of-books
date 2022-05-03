@extends('layout.main')

@section('title', $title)

@section('content')

    <h3>Редактирование автора:</h3>

    <form action="{{ route('authors.update', ['id' => $author->id]) }}" method="post">
        @csrf
        <input name="name" type="text" value="{{ $author->name }}"> ФИО<br><br>
        <input name="country" type="text" value="{{ $author->country }}"> Стана рождения<br><br>
        <textarea name="annotation" id="" cols="30" rows="10">{{ $author->annotation }}</textarea> Примечание<br><br>
        <input name="button" type="submit" value="Редактировать">
    </form>

@endsection
