<x-layout>
    <x-slot:title>
        {{ $job['title'] }} - {{ __('layouts.job_details') }}
    </x-slot:title>
    <x-slot:heading class="text-3xl font-bold tracking-tight text-white">
        {{ __('layouts.job_details') }}
    </x-slot:heading>
    <li class="mb-4 p-4 border border-gray-300 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
        <h2 class="text-lg font-bold">{{ $job['title'] }}</h2>
        <p>{{ __('layouts.job_salary') }}: $ {{ $job['salary'] }} {{ __('layouts.job_per_year') }}</p>
        <p class="text-sm text-gray-300">{{ __('layouts.job_location') }}: {{ $job['location'] }}</p>
        <p class="text-sm text-gray-600">{{ __('layouts.job_id') }}: {{ $job['id'] }}</p>
        <p class="text-sm text-gray-500">{{ __('layouts.employer_name') }}:
            <a href="/jobs/{{ $job->Employer->id }}" class="text-blue-500 hover:underline">
                {{ $job->Employer->name }}
            </a>
        </p>
    </li>

</x-layout>