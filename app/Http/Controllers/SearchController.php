<?php

namespace App\Http\Controllers;

use App\Models\Job;

class SearchController extends Controller
{
    public function __invoke()
    {
        $jobs = Job::query()
            ->with(['Employer', 'Tags'])
            ->whereTranslationLike('title', '%'.request('q').'%')
            ->cursorPaginate(7);

        return view('results', ['jobs' => $jobs]);
    }
}
