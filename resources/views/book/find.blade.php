@extends('layout.main')

@section('title', $title)

@section('content')

    <h3>Результат поиска:</h3>

    <ol>
        @foreach($books as $book)
            <li><a href="{{ route('books.show', ['id' => $book->id]) }}">{{ $book->name }}</a></li>
        @endforeach
    </ol>

@endsection
