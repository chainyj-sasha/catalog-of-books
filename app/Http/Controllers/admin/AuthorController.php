<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminAuthorStoreRequest;
use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    public function store(AdminAuthorStoreRequest $request)
    {
        Author::create([
            'name' => $request->name,
            'country' => $request->country,
            'comment' => $request->comment,
            'section_id' => $request->sectionId,
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        //
    }

    public function edit(Author $author)
    {
        return view('admin.author.edit', [
            'title' => 'Редактирование автора',
            'author' => $author,
        ]);
    }

    public function update(AdminAuthorStoreRequest $request, Author $author)
    {
        $author->name = $request->name;
        $author->country = $request->country;
        $author->comment = $request->comment;
        $author->save();

        return redirect()->route('authors.edit', ['author' => $author])->with('success', 'Сохранено!');
    }

    public function destroy(Author $author)
    {
        $author->delete();
        Book::where('author_id', $author->id)->delete();

        return redirect()->route('show_all_authors', ['sectionId' => $author->section->id])->with('success', 'Автор удален!');
    }
}
