<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagController extends Controller
{
    public function __invoke(Tag $Tag)
    {
        return view('results', ['jobs' => $Tag->jobs->load(['Employer', 'Tags'])]);
    }
}
