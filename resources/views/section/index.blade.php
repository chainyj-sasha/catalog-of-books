@extends('layout.main')

@section('title', $title)

@section('content')

    <h3>Разделы:</h3>

    <ul>
        @foreach($sections as $section)
            <li>
                <a href="{{ route('authors.index', ['sectionId' => $section->id]) }}">{{ $section->title }}</a>
                | {{ $section->description }}
            </li>
            @if(auth()->check() && auth()->user()->admin)
                <form action="{{ route('sections.edit', ['section' => $section->id]) }}" method="">
                    <button style="width: 110px; height: 20px">Редактировать</button>
                </form>
                <form action="{{ route('sections.update', ['section' => $section->id]) }}" method="post">
                    @csrf
                    @method('PUT')
                    @if($section->active)
                        <input name="active" type="hidden" value="0">
                        <input name="button" type="submit" value="Скрыть раздел">
                    @else
                        <input name="active" type="hidden" value="1">
                        <input name="button" type="submit" value="Показать раздел">
                    @endif
                </form>
                <form action="{{ route('sections.destroy', ['section' => $section->id]) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <input name="button" type="submit" value="Удалить">
                </form>
            @endif
        @endforeach
    </ul>

    <p>
        <form action="{{ route('books.showAll') }}">
            <button>Все книги сайта</button>
        </form>
    </p>

    @if(auth()->check() && auth()->user()->admin)
        <form action="{{ route('sections.store') }}" method="post">
            @csrf
            <input name="title" type="text"> Название раздела<br><br>
            <textarea name="description" id="" cols="30" rows="10"></textarea> Краткое описание<br><br>
            <input name="button" type="submit" value="Добавить">
        </form>
    @endif


@endsection
