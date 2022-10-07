@extends('layouts.main')

@section('title', $title)

@section('content')

    <h3>{{ $title }}</h3>

    <ul>
        @if(!empty($books[0]))
            @foreach($books as $book)
                <li>
                    <p>{{ $book->author->name }}: </p>
                    <a href="{{ route('books.show', ['book' => $book->id]) }}">{{ $book->title }}</a>
                </li>
            @endforeach
                {{ $books->links() }}
        @else
            <p>Книги не найдены</p>
        @endif
    </ul>

@endsection()
