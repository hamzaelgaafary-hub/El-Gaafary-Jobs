@props(['job'])

<x-panel class="flex flex-col text-center">
<<<<<<< HEAD
    <div class="self-start text-sm">{{ $job->employer->name }}</div>
=======
    <div class="self-start text-sm">{{ $job->Employer->name }}</div>
>>>>>>> 328b122 (First commit from New pulled version)

    <div class="py-8">
        <h3 class="group-hover:text-blue-800 text-xl font-bold transition-colors duration-300">
            <a href="{{ $job->url }}" target="_blank">
                {{ $job->title }}
            </a>
        </h3>
        <p class="text-sm mt-4">{{ $job->salary }}</p>
    </div>

    <div class="flex justify-between items-center mt-auto">
        <div>
<<<<<<< HEAD
            @foreach($job->tags as $tag)
                <x-tag :$tag size="small" />
            @endforeach
        </div>

        <x-employer-logo :employer="$job->employer" :width="42" />
    </div>
</x-panel>
=======
            @foreach($job->Tags as $Tag)
                <x-Tag :$Tag size="small" />
            @endforeach
        </div>

        <x-Employer-logo :Employer="$job->Employer" :width="42" />
    </div>
</x-panel>
>>>>>>> 328b122 (First commit from New pulled version)
