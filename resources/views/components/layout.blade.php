<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>El Gaafary Jobs</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hanken+Grotesk:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-black text-white font-hanken-grotesk pb-20">
    <div class="px-10">
        <nav class="flex justify-between items-center py-4 border-b border-white/10">
            <div>
                <a href="/">
                    <img src="{{ Vite::asset('resources/images/logo.svg') }}" alt="El Gaafary Jobs Logo" width="100"
                        height="40">
                </a>
            </div>
            <div class="space-x-6 font-bold">
                <a href="/" class="text-gray-300 hover:text-blue-600">{{ __('layouts.jobs') }}</a>

                <a href="/about" class=" text-gray-300 hover:text-blue-600 ">{{ __('layouts.about') }}</a>

                <a href="/employers" class="text-gray-300 hover:text-blue-600 ">{{ __('layouts.employers') }}</a>
            </div>
            @auth
                <div class="space-x-6 font-bold flex">
                    <a href="{{ auth()->user()->getDashboardUrl() }}" class="text-gray-50 hover:text-green-600">
                        My Dashboard
                    </a>

                    <a href="/jobs/create" class="text-gray-300 hover:text-blue-600">{{ __('layouts.post_a_job') }}</a>


                    <form method="POST" class="text-gray-50 hover:text-red-600" action="/logout">
                        @csrf
                        @method('DELETE')

                        <button>Log Out</button>
                    </form>
                </div>
            @endauth

            @guest
                <div class="space-x-6 font-bold">
                    <a href="/register" class="text-gray-100 hover:text-blue-600">{{ __('layouts.sign_up') }}</a>
                    <a href="/login" class="text-gray-300 hover:text-blue-600">
                        {{ __('layouts.log_in') }}
                    </a>
                </div>
            @endguest
            <div class="hidden md:block">
                <div class="font-bold">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li class=" text-gray-300 hover:text-blue-600">
                            <a rel="alternate" hreflang="{{ $localeCode }}"
                                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                {{ $properties['native'] }}
                            </a>
                        </li>
                    @endforeach
                </div>
            </div>
        </nav>
        <main class="mt-10 max-w-[986px] mx-auto">
            {{ $slot }}
        </main>
    </div>

</body>

</html>