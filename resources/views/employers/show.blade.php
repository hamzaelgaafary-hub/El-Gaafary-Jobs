<x-layout>
    <div class="space-y-10">
        <x-page-heading>Searching for Employers & jobs you Need </x-page-heading>

        <x-forms.form action="/employers" method="GET" class="max-w-md">
            <x-forms.input :label="false" name="q" placeholder="Search..." :value="$query" />
        </x-forms.form>



        <section class="mt-8">
            <x-section-heading>Employer Profile Details Card</x-section-heading>
            <div class="mb-4 p-4 border border-gray-300 rounded-lg shadow-sm hover:shadow-md transition-shadow
                duration-300">
                <p class="text-sm text-gray-200">- {{ __('layouts.employer_name') }}:
                    {{ $employer['name'] }}
                </p>
                <p class="text-sm text-gray-200">- {{ __('layouts.employer_description') }}:
                    {{ $employer['description'] }}
                </p>
                <p class="text-sm text-gray-200">- {{ __('layouts.employer_webstie') }}: {{ $employer['wibsite'] }}
                </p>
                <p class="text-sm text-gray-200">- {{ __('layouts.employer_logo') }}:
                    {{ $employer['logo'] }}
                </p>
                <p class="text-sm text-gray-200">- {{ __('layouts.employer_created_at') }}:
                    {{ $employer['created_at'] }}
                </p>
                <p class="text-sm text-gray-200">- {{ __('layouts.employer_updated_at') }}:
                    {{ $employer['updated_at'] }}
                </p>
            </div>
        </section>

        <section class="mt-10">
            <x-section-heading>Employer's Jobs</x-section-heading>
            @if($employer->job)
                @foreach ($employer->job as $job)
                    <x-job-card-wide :$job />

                @endforeach
            @else
                <div class="mt-6 grid lg:grid-cols-3 gap-8">
                    <p class="mt-4 text-gray-400">No job for this Employer found.</p>
                </div>
            @endif

        </section>
    </div>
</x-layout>