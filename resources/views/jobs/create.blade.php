<x-layout>
    <x-page-heading>{{ __('layouts.post_a_job') }}</x-page-heading>

    <x-forms.form method="POST" action="/jobs">
        <x-forms.input label="Title" name="title" placeholder="CEO Wanted" />
        <x-forms.input label="Salary" name="salary" placeholder="$90,000 USD" />
        <x-forms.input label="Location" name="location" placeholder="{{ __('layout.location_example') }}" />

        <x-forms.select label="Type" name="type">
            @foreach (['full-time', 'part-time', 'contract', 'internship'] as $type)
                <option value="{{ $type }}">{{ ucfirst(str_replace('-', ' ', $type)) }}</option>
            @endforeach
            <option value="">{{ __('layout.select_type') }}</option>
        </x-forms.select>

        <x-forms.input label="URL" name="url" placeholder="https://acme.com/jobs/ceo-wanted" />
        <x-forms.checkbox label="Feature (Costs Extra)" name="featured" />

        <x-forms.divider />

        <x-forms.input label="Tags (comma separated)" name="Tags" placeholder="laracasts, video, education" />

        <x-forms.button>{{ __('layout.publish_job') }}</x-forms.button>
    </x-forms.form>
</x-layout>