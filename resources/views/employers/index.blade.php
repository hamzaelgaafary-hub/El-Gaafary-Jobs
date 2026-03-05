<x-layout>
    <div class="space-y-10">
        <x-page-heading>Employers & Job Seekers</x-page-heading>

        <x-forms.form action="/employers" method="GET" class="max-w-md">
            <x-forms.input :label="false" name="q" placeholder="Search..." :value="$query" />
        </x-forms.form>

        <section class="mt-8">
            <x-section-heading>Employers</x-section-heading>
            @if($employers->isEmpty())
                <p class="mt-4 text-gray-400">No employers found.</p>
            @else
                <div class="mt-6 grid lg:grid-cols-3 gap-8">
                    @foreach($employers as $employer)
                        <x-profile-card :model="$employer" type="employer" />
                    @endforeach
                </div>
            @endif
            {{ $employers->links() }}
        </section>

        <section class="mt-10">
            <x-section-heading>Job Seekers</x-section-heading>
            @if($seekers->isEmpty())
                <p class="mt-4 text-gray-400">No job seekers found.</p>
            @else
                <div class="mt-6 grid lg:grid-cols-3 gap-8">
                    @foreach($seekers as $seeker)
                        <x-profile-card :model="$seeker" type="seeker" />
                    @endforeach
                </div>
                {{ $seekers->links() }}
            @endif

        </section>
    </div>
</x-layout>