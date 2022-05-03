<?php

namespace App\Http\Controllers;

use App\Http\Requests\SectionStoreRequest;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index()
    {
        if (auth()->check() && auth()->user()->admin){
            $sections = Section::all();
        } else {
            $sections = Section::where('active', '1')->get();
        }

        return view('section.index', [
            'title' => 'Разделы',
            'sections' => $sections,
        ]);
    }

    public function create()
    {

    }

    public function store(SectionStoreRequest $request)
    {
        if (auth()->user()->admin){
            if ($request->has(['title', 'description'])){

                $section = new Section();
                $section->title = $request->title;
                $section->description = $request->description;
                $section->save();

                return redirect()->route('sections.index');
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
     *
     */
    public function edit($id)
    {
        if (auth()->user()->admin){
            $section = Section::find($id);

            return view('section.edit', [
                'title' => 'Редактирование раздела',
                'section' => $section,
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     */
    public function update(SectionStoreRequest $request, $id)
    {
        if (auth()->user()->admin){
            $section = Section::find($id);

            if ($request->has('active')){
                $section->active = $request->active;
                $section->save();

                return redirect()->route('sections.index');
            }

            $section->title = $request->title;
            $section->description = $request->description;
            $section->save();

            return redirect()->route('sections.edit', ['section' => $section->id]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
        if (auth()->user()->admin){
            $section = Section::find($id);
            $section->delete();

            return redirect()->route('sections.index');
        }
    }
}
