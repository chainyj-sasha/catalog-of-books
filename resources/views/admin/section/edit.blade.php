@extends('layouts.admin')

@section('title', $title)

@section('content')

    <h3>Редактирование раздела</h3>

    <form action="{{ route('sections.update', ['section' => $section]) }}" method="post">
        @csrf
        @method('PUT')
        <input name="title" type="text" value="{{ $section->title }}"><br><br>
        <textarea name="description" id="" cols="30" rows="10">{{ $section->description }}</textarea><br><br>
        @if($section->active)
            <input name="active" type="radio" value="1" checked> Активен<br>
            <input name="active" type="radio" value="0"> НЕ активен<br>
        @else
            <input name="active" type="radio" value="1"> Активен<br>
            <input name="active" type="radio" value="0" checked> НЕ активен<br>
        @endif
        <input type="submit" value="Сохранить">
    </form><br>

    <form action="{{ route('sections.destroy', ['section' => $section]) }}" method="post">
        @csrf
        @method('DELETE')
        <input type="submit" value="Удалить">
    </form>

@endsection
