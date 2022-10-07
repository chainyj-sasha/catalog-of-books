@extends('layouts.main')

@section('title', $title)

@section('content')

    <form action="{{ route('books.update', ['book' => $book->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        Обложка: <img src="{{ asset('storage/' . $book->image) }}" alt=""><br><br>
        Новая обложка: <input name="image" type="file"><br><br>
        <input name="oldImage" type="hidden" value="{{ $book->image }}">
        Название: <input name="title" type="text" value="{{ $book->title }}"><br><br>
        Год издания: <input name="year" type="number" value="{{ $book->year }}"><br><br>
        Описание: <textarea name="description" id="" cols="30" rows="10">{{ $book->description }}</textarea><br><br>
        <input type="submit" value="Сохранить">
    </form>

@endsection
