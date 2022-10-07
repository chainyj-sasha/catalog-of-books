@extends('layouts.main')

@section('title', $title)

@section('content')

    <h3>Список книг. Автор {{ $author->name }}</h3>

    <ul>
        @foreach($books as $book)

            <li>
                @if($book->image)
                    <img src="{{ asset('storage/' . $book->image) }}" alt=""><br>
                @else
                    <img src="" alt="Картинка"><br>
                @endif

                Название: <a href="{{ route('books.show', ['book' => $book->id]) }}">{{ $book->title }}</a><br><br>
            </li>

        @endforeach
    </ul>

    @if(auth()->check())

        <h3>Добавить новую книгу</h3>

        <form action="{{ route('books.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input name="authorId" type="hidden" value="{{ $author->id }}">
            Название: <input name="title" type="text" placeholder="максимум 150 символов"><br><br>
            Год издания: <input name="year" type="number" placeholder="4 символа"><br><br>
            Описание:<textarea name="description" id="" cols="30" rows="10" placeholder="максимум 2000 символов. Необязательное поле"></textarea><br><br>
            Обложка: <input name="image" type="file"><br><br>
            <input type="submit" value="Сохранить"><br><br>
        </form>

    @else

        <p>Только зарегистрированные пользователи могут добавлять книги</p>

    @endif

@endsection
