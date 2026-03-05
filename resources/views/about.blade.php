<x-layout>
    <div class="space-y-10">
        <x-page-heading>About & Contact</x-page-heading>

        <section class="space-y-6">
            <p>El Gaafary Jobs is a dedicated job board connecting developers with top companies. Our mission is to make
                job hunting fast, transparent, and fair for everyone.</p>
            <p>We believe in empowering job seekers and giving employers the tools they need to find great talent. Our
                values are simplicity, transparency, and community.</p>
        </section>

        <section class="space-y-4">
            <x-section-heading>Platform Statistics</x-section-heading>
            <div class="flex gap-8">
                <div>{{ $jobCount }} jobs posted</div>
                <div>{{ $employerCount }} employers</div>
                <div>{{ $seekerCount }} job seekers</div>
            </div>
        </section>

        <section class="space-y-4">
            <x-section-heading>Contact Us</x-section-heading>

            @if(session('success'))
                <div class="bg-green-800 text-white p-4 rounded">{{ session('success') }}</div>
            @endif

            <div class="space-y-2 text-sm">
                <div>Email: <a href="mailto:hamzaelgafaary@Gmail.com" class="text-blue-800">
                        hamzaelgafaary@Gmail.com</a>
                </div>
                <div>Phone: <a href="tel:+201142221396" class="text-blue-800">+20 114 222 1396</a></div>
                <div>Address: 123 Main Street, City, Country</div>
            </div>

            <x-forms.form action="/contact" method="POST" class="mt-6">
                <x-forms.input name="name" label="Name" />
                <x-forms.input name="email" label="Email" type="email" />
                <x-forms.field name="message" label="Message">
                    <textarea name="message" rows="4"
                        class="rounded-xl bg-white/10 border border-white/10 px-5 py-4 w-full">{{ old('message') }}</textarea>
                </x-forms.field>

                <x-forms.button>Send Message</x-forms.button>
            </x-forms.form>
        </section>
    </div>
</x-layout>