<?php

namespace App\Http\Controllers;

use App\Mail\ContactMessage;
use App\Models\Employer;
use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SiteController extends Controller
{
    public function about()
    {
        // statistics for the platform
        $jobCount = Job::count();
        $employerCount = Employer::count();
        $seekerCount = User::where('type', 'JobSeeker')->count();

        return view('about', [
            'jobCount' => $jobCount,
            'employerCount' => $employerCount,
            'seekerCount' => $seekerCount,
        ]);
    }

    public function contact(Request $request)
    {
        $attributes = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'message' => ['required', 'string'],
        ]);

        Mail::to(config('mail.from.address'))->send(new ContactMessage($attributes));

        return back()->with('success', 'Your message was sent. Thank you!');
    }

    public function directory(Request $request)
    {
        $query = $request->query('q');

        $employers = Employer::query()
            ->when($query, fn ($q) => $q->where('name', 'LIKE', "%{$query}%"))
            ->latest()
            ->simplePaginate(5);
        $seekers = User::query()
            ->where('type', 'JobSeeker')
            ->when($query, fn ($q) => $q->where('name', 'LIKE', "%{$query}%"))
            ->latest()
            ->cursorPaginate(5);
        return view('employers.index', [
            'employers' => $employers,
            'seekers' => $seekers,
            'query' => $query,
        ]);
    }
}
