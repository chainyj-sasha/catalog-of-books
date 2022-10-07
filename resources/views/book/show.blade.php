@extends('layouts.main')

@section('title', $title)

@section('content')

    <h3>{{ $book->title }}</h3>

    @if($book->image)
        <img src="{{ asset('storage/' . $book->image) }}" alt=""><br>
    @else
        <img src="" alt="Картинка"><br>
    @endif
    Год издания: {{ $book->year }}<br><br>
    Описание: {{ $book->description }}<br>

    @if(auth()->check())
        @if(auth()->user()->admin || auth()->user()->id === $book->user_id)
            <a href="{{ route('books.edit', ['book' => $book->id]) }}">редактировать</a>

            <form action="{{ route('books.destroy', ['book' => $book->id]) }}" method="post">
                @csrf
                @method('DELETE')
                <input id="btn" type="submit" value="Удалить">
            </form>

        @endif
    @endif

    <script>
        $(document).ready(function () {
            $('#btn').click(function (event) {
                let answer = confirm('Уверены?');
                if (!answer) {
                    event.preventDefault();
                }
            })
        });
    </script>

@endsection
