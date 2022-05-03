@extends('layout.main')

@section('title', $title)

@section('content')

    <h3>Редактирование раздела</h3>

    <form action="{{ route('sections.update', ['section'=> $section->id]) }}" method="post">
        @csrf
        @method('PUT')
        <input name="title" type="text" value="{{ $section->title }}"> Название раздела<br><br>
        <textarea name="description" id="" cols="30" rows="10">{{ $section->description }}</textarea> Краткое описание<br><br>
        <input name="button" type="submit" value="Сохранить">

    </form>

@endsection
