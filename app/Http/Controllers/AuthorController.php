<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorStoreRequest;
use App\Http\Requests\SectionStoreRequest;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index($sectionId)
    {
        $authors = Author::where('section_id', $sectionId)->get();

        return view('author.index', [
            'title' => 'Список авторов',
            'authors' => $authors,
            'sectionId' => $sectionId,
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

    public function store(AuthorStoreRequest $request)
    {
        if (auth()->user()->admin){
            if ($request->has('button')){
                $author = new Author();
                $author->name = $request->name;
                $author->country = $request->country;
                $author->annotation = $request->annotation;
                $author->section_id = $request->sectionId;
                $author->save();

                return redirect()->route('authors.index', ['sectionId' => $request->sectionId]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit($id)
    {
        $author = Author::find($id);

        return view('author.edit', [
            'title' => 'Редактировать автора',
            'author' => $author,
        ]);
    }

    /**
     * @param  int  $id
     *
     */
    public function update(AuthorStoreRequest $request, $id)
    {
        if (auth()->user()->admin){
            if ($request->has('button')){
                $author = Author::find($id);

                $author->name = $request->name;
                $author->country = $request->country;
                $author->annotation = $request->annotation;
                $author->save();

                return redirect()->route('authors.edit', ['id' => $id]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
