@extends('layout.main')

@section('title', $title)

@section('content')

    <h3>Список всех книг</h3>

    <ol>
        @foreach($books as $book)
            <li>{{ $book->author->name }} | <a href="{{ route('books.show', ['id' => $book->id]) }}">{{ $book->name }}</a></li>
        @endforeach
    </ol>

    {{ $books->links() }}

    <h3>Сортировка:</h3>

    <p>
        <form action="{{ route('books.sort') }}" method="post">
        @csrf
            <input name="author" type="hidden">
            <input type="submit" value="По автору">
        </form>

        <form action="{{ route('books.sort') }}" method="post">
            @csrf
            <input name="book" type="hidden">
            <input type="submit" value="По книге">
        </form>
    </p>

    <h3>Поиск по названию книги:</h3>

    <form action="{{ route('books.find') }}" method="">
        <input name="name" type="text">
        <input name="button" type="submit" value="Искать">
    </form>

@endsection
