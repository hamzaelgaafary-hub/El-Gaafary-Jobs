<x-layout>
    <x-slot:title>
        Job Details
    </x-slot:title>
    <x-slot:heading class="text-3xl font-bold tracking-tight text-white">
        Job Details
    </x-slot:heading>
    <li class="mb-4 p-4 border border-gray-300 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
        <h2 class="text-lg font-bold">{{ $job['title'] }}</h2>
        <p>This job pays $ {{ $job['salary'] }} per year.</p>
        <p class="text-sm text-gray-900">Location: {{ $job['location'] }}</p>
        <p class="text-sm text-gray-700">Job ID: {{ $job['id'] }}</p>
        <p class="text-sm text-gray-700">Employer name:
            <a href="/jobs/{{ $job->Employer->id }}" class="text-blue-500 hover:underline">
                {{ $job->Employer->name }}
        </p>
    </li>

</x-layout>