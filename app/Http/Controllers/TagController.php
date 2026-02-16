<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagController extends Controller
{
<<<<<<< HEAD
    public function __invoke(Tag $tag)
    {
        return view('results', ['jobs' => $tag->jobs->load(['employer', 'tags'])]);
=======
    public function __invoke(Tag $Tag)
    {
        return view('results', ['jobs' => $Tag->jobs->load(['Employer', 'Tags'])]);
>>>>>>> 328b122 (First commit from New pulled version)
    }
}
