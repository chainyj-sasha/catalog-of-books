@extends('layout.main')

@section('title', $title)

@section('content')

    <h3>Список авторов:</h3>

    <ul>
        @foreach($authors as $author)
            <li>
                <a href="{{ route('books.index', ['id' => $author->id]) }}">{{ $author->name }}</a> | {{ $author->country }} | {{ $author->annotation }}
{{--                TODO Если администратор, то появится кнопка для редактирования автора --}}
                @if(auth()->check() && auth()->user()->admin)
                    <form action="{{ route('authors.edit', ['id' => $author->id]) }}" method="">
                        <button style="width: 110px; height: 20px">Редактировать</button>
                    </form>
                @endif
            </li>
        @endforeach
    </ul>

{{--    TODO только администраторы могут добавлять новых и редактировать авторов--}}
    @if(auth()->check() && auth()->user()->admin)
        <form action="{{ route('authors.store') }}" method="post">
            @csrf
            <input name="sectionId" type="hidden" value="{{ $sectionId }}">
            <input name="name" type="text"> ФИО автора полностью <br><br>
            <input name="country" type="text"> Страна рождения<br><br>
            <textarea name="annotation" id="" cols="30" rows="10"></textarea> Коментарий по желанию<br><br>
            <input name="button" type="submit" value="Добавить">
        </form>
    @endif
@endsection
