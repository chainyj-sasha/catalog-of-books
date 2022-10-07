@extends('layouts.main')

@section('title', $title)

@section('content')

    <h3>Список доступных авторов раздела {{ $section->title }}</h3>

    <ul>
        @foreach($authors as $author)

            <li>
                Имя: <a href="{{ route('show_all_books', ['authorId' => $author->id]) }}">{{ $author->name }}</a><br>
                Страна: {{ $author->country }}<br>
                Описание: {{ $author->comment }}<br>

                @if(auth()->check() && auth()->user()->admin)
                    <a href="{{ route('authors.edit', ['author' => $author]) }}">Редактировать</a><br><br>
                @endif

            </li>

        @endforeach
    </ul>

    @if(auth()->check() && auth()->user()->admin)

        <h3>Создать нового автора</h3>

        <form action="{{ route('authors.store') }}" method="post">
            @csrf
            <input name="sectionId" type="hidden" value="{{ $section->id }}">
            <input name="name" type="text" placeholder="максимум 150 символов"> ФИО автора<br><br>
            <input name="country" type="text" placeholder="максимум 100 символов"> Страна рождения<br><br>
            <textarea name="comment" id="" cols="30" rows="10" placeholder="максимум 500 символов"></textarea> Комметнарий<br><br>
            <input name="" type="submit" value="Сохранить"><br><br>
        </form>

    @endif

@endsection
