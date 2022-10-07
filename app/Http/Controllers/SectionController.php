<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function show_all_section()
    {
        $sections = Section::all();

        return view('section.showAllSection', [
            'title' => 'Разделы книг',
            'sections' => $sections,
        ]);
    }
}
