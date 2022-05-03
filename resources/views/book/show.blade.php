@extends('layout.main')

@section('title', $title)

@section('content')

    <h3>Информация о книге</h3>

    <ul>
        <li>{{ $book->name }}</li>
        <li><img src="{{ asset('storage/' . $book->picture) }}" alt="" height="40"></li>
        <li>{{ $book->year }}</li>
        <li>{{ $book->description }}</li>
    </ul>

@endsection
