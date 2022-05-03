@extends('layout.main')

@section('title', $title)

@section('content')

    <h3>Редактирование книги:</h3>

    <form action="{{ route('books.update', ['id' => $book->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        <input name="authorId" type="hidden" value="{{ $book->author_id }}">
        <input name="name" type="text" value="{{ $book->name }}"> название книги<br><br>
        <img src="{{ asset('storage/' . $book->picture) }}" alt="" height="50"> обложка книги<br><br>
        <input name="year" type="number" value="{{ $book->year }}"> год издания<br><br>
        <textarea name="description" id="" cols="30" rows="10">{{ $book->description }}</textarea> описание<br><br>
        <input name="picture" type="file"> обложка<br><br>
        <input name="button" type="submit" value="редактировать">
    </form>

@endsection
