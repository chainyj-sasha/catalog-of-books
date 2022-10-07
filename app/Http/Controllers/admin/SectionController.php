<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminSectionStoreRequest;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
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

    public function create()
    {

    }

    public function store(AdminSectionStoreRequest $request)
    {
        Section::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        return redirect()->route('show_all_section')->with('success', 'Раздел добавлен!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Section $section)
    {
        //
    }

    public function edit(Section $section)
    {
        return view('admin.section.edit', [
            'title' => 'Редактирование',
            'section' => $section,
        ]);
    }

    public function update(AdminSectionStoreRequest $request, Section $section)
    {
        $section->title = $request->title;
        $section->description = $request->description;
        $section->active = $request->active;
        $section->save();

        return redirect()->route('sections.edit', ['section' => $section])->with('success', 'Раздел обновлен!');
    }

    public function destroy(Section $section)
    {
        $section->delete();

        return redirect()->route('show_all_section')->with('success', 'Раздел удален!');
    }
}
