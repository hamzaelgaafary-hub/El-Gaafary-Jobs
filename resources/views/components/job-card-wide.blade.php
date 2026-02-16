@props(['job'])

<x-panel class="flex gap-x-6">
    <div>
<<<<<<< HEAD
        <x-employer-logo :employer="$job->employer" />
    </div>

    <div class="flex-1 flex flex-col">
        <a href="#" class="self-start text-sm text-gray-400 transition-colors duration-300">{{ $job->employer->name }}</a>
=======
        <x-Employer-logo :Employer="$job->Employer" />
    </div>

    <div class="flex-1 flex flex-col">
        <a href="#"
            class="self-start text-sm text-gray-400 transition-colors duration-300">{{ $job->Employer->name }}</a>
>>>>>>> 328b122 (First commit from New pulled version)

        <h3 class="font-bold text-xl mt-3 group-hover:text-blue-800">
            <a href="{{ $job->url }}" target="_blank">
                {{ $job->title }}
            </a>
        </h3>

        <p class="text-sm text-gray-400 mt-auto">{{ $job->salary }}</p>
    </div>

    <div>
<<<<<<< HEAD
        @foreach($job->tags as $tag)
            <x-tag :$tag />
        @endforeach
    </div>
</x-panel>
=======
        @foreach($job->Tags as $Tag)
            <x-Tag :$Tag />
        @endforeach
    </div>
</x-panel>
>>>>>>> 328b122 (First commit from New pulled version)
