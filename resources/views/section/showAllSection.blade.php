@extends('layouts.main')

@section('title', $title)

@section('content')

    <h3>Выберите подходящий раздел</h3>

    <ul>
        @foreach($sections as $section)


                @if(auth()->check() && auth()->user()->admin)
                <li>
                    <a href="{{ route('show_all_authors', ['sectionId' => $section->id]) }}">{{ $section->title }}</a><br>
                    {{ $section->description }}<br>
                    <a href="{{ route('sections.edit', ['section' => $section]) }}">Редактировать</a><br><br>
                </li>
                @else
                    @if($section->active)
                        <li>
                            <a href="{{ route('show_all_authors', ['sectionId' => $section->id]) }}">{{ $section->title }}</a><br>
                            {{ $section->description }}<br>
                        </li>
                    @endif
                @endif


        @endforeach
    </ul>

    <h3>Поиск книг по названию</h3>

    <form action="{{ route('find_books') }}" method="post">
        @csrf
        <input name="title" type="text"> Название книги<br><br>
        <input type="submit" value="Найти">
    </form>

    @if(auth()->check() && auth()->user()->admin)

        <h4>Новый раздел</h4>
        <form action="{{ route('sections.store') }}" method="post">
            @csrf
            <input name="title" type="text" placeholder="Максимум 150 символов"> Название<br><br>
            <textarea name="description" id="" cols="30" rows="10" placeholder="максимум 500 символов"></textarea> Описание<br><br>
            <input type="submit" value="Добавить">
        </form>

    @endif

@endsection
