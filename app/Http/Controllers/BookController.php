<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookStoreRequest;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function show_all_books($authorId)
    {
        $books = Book::where('author_id', $authorId)->get();

        return view('book.showAllBooks', [
            'title' => 'Список книг',
            'books' => $books,
            'author' => Author::find($authorId),
        ]);
    }

    public function find_books(Request $request)
    {
        if (!empty($request->title)){
            $books = Book::where('title', 'like', "%$request->title")->simplePaginate(5);

            return view('book.findBooks', [
                'title' => 'Результат поиска',
                'books' => $books,
            ]);
        }
    }

    public function show($id)
    {
        $book = Book::find($id);

        return view('book.show', [
            'title' => $book->title,
            'book' => $book,
        ]);
    }

    public function store(BookStoreRequest $request)
    {
        $image = Storage::disk('public')->putFile('/cover', $request->file('image'));

        Book::create([
            'title' => $request->title,
            'year' => $request->year,
            'description' => $request->description,
            'image' => $image,
            'author_id' => $request->authorId,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->back()->with('success', 'Книга добавлена успешно!');
    }

    public function edit($id)
    {
        $book = Book::find($id);

        return view('book.edit', [
            'title' => 'Редактировать',
            'book' => $book,
        ]);
    }

    public function update(Request $request, $id)
    {
        if ($request->has('year')){
            $year = $request->year;
        }
        if ($request->has('description')){
            $description = $request->description;
        }
        if ($request->has('image')){
            $image = Storage::disk('public')->putFile('/cover', $request->file('image'));
        }

        $book = Book::find($id);
        $book->title = $request->title;
        $book->year = $year ?? null;
        $book->description = $description ?? null;
        $book->image = $image ?? $request->oldImage;
        $book->save();

        return redirect()->back()->with('success', 'Сохранено!');
    }

    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();

        return redirect()->route('show_all_books', ['authorId' => $book->author_id])->with('success', 'Книга удалена!');
    }
}
