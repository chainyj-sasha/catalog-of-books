@extends('layout.main')

@section('title', $title)

@section('content')

    <h3>Список книг:</h3>

    <ol>
        @foreach($books as $book)
            <li>
                <a href="{{ route('books.show', ['id' => $book->id]) }}">{{ $book->name }}</a>

                @if(auth()->check() && (auth()->user()->admin || auth()->user()->id == $book->user_id))
                    <form action="{{ route('books.edit', ['id' => $book->id]) }}" method="">
                        <button style="width: 110px; height: 20px">Редактировать</button>
                    </form>
                @endif

                @if(auth()->check() && auth()->user()->admin)
                    <form action="{{ route('books.update', ['id' => $book->id]) }}" method="post">
                        @csrf
                        @if($book->active)
                            <input name="active" type="hidden" value="0">
                            <input name="button" type="submit" value="Скрыть">
                        @else
                            <input name="active" type="hidden" value="1">
                            <input name="button" type="submit" value="Активировать">
                        @endif
                    </form>

                    <form action="{{ route('books.destroy', ['id' => $book->id]) }}" method="post">
                        @csrf
                        @method('delete')
                        <input name="authorId" type="hidden" value="{{ $book->author_id }}">
                        <input type="submit" value="удалить">
                    </form>
                @endif
            </li>

        @endforeach
    </ol>


    {{ $books->links() }}


    @if(auth()->check())

        <h4>Добавить книгу</h4>

        <form action="{{ route('books.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input name="authorId" type="hidden" value="{{ $authorId }}">
            <input name="name" type="text"> название книги<br><br>
            <p>
                <select name="year" id="">
                    @for($i = 1930; $i <= 2022; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select> год издания
            </p>
            <textarea name="description" id="" cols="30" rows="10"></textarea> описание<br><br>
            <input name="picture" type="file"> обложка<br><br>
            <input name="button" type="submit">
        </form>
    @endif

@endsection
