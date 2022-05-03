<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookFindRequest;
use App\Http\Requests\BookStoreRequest;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index($authorId)
    {
        if (auth()->check() && auth()->user()->admin){
            $books = Book::where('author_id', $authorId)->simplePaginate('5');
        } else {
            $books = Book::where([
                ['author_id', '=', $authorId],
                ['active', '=', '1'],
            ])->simplePaginate('5');
        }

        return view('book.index', [
            'title' => 'Список книг',
            'books' => $books,
            'authorId' => $authorId,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function store(BookStoreRequest $request)
    {
       if (auth()->check()){
           $book = new Book();

           $book->name = $request->name;
           $book->year = $request->year;
           $book->description = $request->description;
           $book->picture = $request->file('picture')->store('images');
           $book->author_id = $request->authorId;
           $book->user_id = auth()->user()->id;
           $book->save();

           return redirect()->route('books.index', ['id' => $request->authorId]);
       }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     */
    public function show($id)
    {
        $book = Book::find($id);

        return view('book.show', [
            'title' => 'Просмотр книги',
            'book' => $book,
        ]);
    }

    public function showAll()
    {
        if (auth()->check() && auth()->user()->admin){
            $books = Book::simplePaginate(5);
        } else {
            $books = Book::where('active', '1')->simplePaginate(5);
        }

        return view('book.showAll', [
            'title' => 'Список всех книг',
            'books' => $books,
        ]);
    }

    public function find(BookFindRequest $request)
    {
        $books = Book::where('name', $request->name)->get();

        if (isset($books[0]->name)){
            return view('book.find', [
                'title' => 'Просмотр книги',
                'books' => $books,
            ]);
        }
        session()->flash('error', 'Такой книги нет!');
        return redirect()->route('books.showAll');
    }

    public function sort(Request $request)
    {
        if ($request->has('book')){
            $books = Book::where('active', '1')->orderBy('name', 'asc')->simplePaginate(5);
        }
        if ($request->has('author')){
            $books = Book::where('active', '1')->orderBy('author_id', 'asc')->simplePaginate(5);
        }

        return view('book.showAll', [
            'title' => 'Список всех книг',
            'books' => $books,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $book = Book::find($id);

        return view('book.edit', [
            'title'=> 'Редактировать книгу',
            'book' => $book,
        ]);
    }

    public function update(BookStoreRequest $request, $id)
    {
        $book = Book::find($id);

        if (auth()->user()->admin){
            if ($request->has('active')){
                $book->active = $request->active;
                $book->save();

                return redirect()->route('books.index', ['id' => $book->author_id]);
            }
        }
        if (auth()->user()->admin || auth()->user()->id == $book->user_id){
            if ($request->hasFile('picture')){
                $picture = $request->file('picture')->store('images');
            }
            $book->name = $request->name;
            $book->year = $request->year;
            $book->description = $request->description;
            $book->picture = $picture ?? null;
            $book->author_id = $request->authorId;
            $book->save();

            return redirect()->route('books.edit', ['id' => $id]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy(Request $request, $id)
    {
        if (auth()->user()->admin){
            $book = Book::find($id);
            $book->delete();

            return redirect()->route('books.index', ['id' => $request->authorId]);
        }
    }
}
