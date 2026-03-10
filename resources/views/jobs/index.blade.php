<x-layout>
    <div class="space-y-10">
        <section class="text-center pt-6">
            <h1 class="font-bold text-4xl">{{ __('layouts.find_jobs') }}</h1>

            <x-forms.form action="/search" class="mt-6">
                <x-forms.input :label="false" name="q" placeholder="Web Developer..." />
            </x-forms.form>
        </section>

        <section class="pt-10">
            <x-section-heading>{{ __('layouts.featured_jobs') }}</x-section-heading>

            <div class="grid lg:grid-cols-3 gap-8 mt-6">
                @foreach($featuredJobs as $job)
                    <x-job-card :$job />
                @endforeach
            </div>
        </section>

        <section>
            <x-section-heading>{{ __('layouts.tags') }}</x-section-heading>

            <div class="mt-6 space-x-1">
                @foreach($Tags as $Tag)
                    <x-Tag :$Tag />
                @endforeach
            </div>
        </section>

        <section>
            <x-section-heading>{{ __('layouts.recent_jobs') }}</x-section-heading>

            <div class="mt-6 space-y-6">
                @foreach($jobs as $job)
                    <x-job-card-wide :$job />
                @endforeach
            </div>
        </section>
    </div>
    <div class="mt-6">

    </div>
</x-layout>