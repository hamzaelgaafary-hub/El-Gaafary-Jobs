<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Tag;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /*
        $jobs = Job::latest()->with(['Employer', 'Tags'])->get()->groupBy('featured');

        return view('jobs.index', [
            'Tags' => Tag::all(),
            'featuredJobs' => Job::where('featured', 1)
                ->latest()
                ->with(['Employer', 'Tags'])
                ->get(),
            'jobs' => Job::where('featured', 0)
                ->latest()
                ->with(['Employer', 'Tags'])
                ->get(),

        ]);
        */
        $jobs = Job::latest()
            ->with(['Employer', 'Tags'])
            ->get()
            ->groupBy('featured');

        return view('jobs.index', [
            'featuredJobs' => $jobs->get(1, collect()),
            'jobs'         => $jobs->get(0, collect()),
            'Tags'         => Tag::all(),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate([
            'title' => ['required'],
            'salary' => ['required'],
            'location' => ['required'],
            'type' => ['required', Rule::in(['Part Time', 'Full Time', 'Remote', 'Freelance'])],
            'url' => ['required', 'active_url'],
            'Tags' => ['nullable'],
        ]);

        $attributes['featured'] = $request->has('featured');

        $job = Auth::user()->Employer->job()->create(Arr::except($attributes, 'Tags'));

        if ($attributes['Tags'] ?? false) {
            foreach (explode(',', $attributes['Tags']) as $Tag) {
                $job->Tag($Tag);
            }
        }

        return redirect('/');

    }
}