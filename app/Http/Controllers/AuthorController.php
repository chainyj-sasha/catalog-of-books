<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Section;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function show_all_authors($sectionId)
    {
        $authors = Author::where('section_id', $sectionId)->get();

        return view('author.showAllAuthors', [
            'title' => 'Список авторов',
            'authors' => $authors,
            'section' => Section::find($sectionId),
        ]);
    }
}
