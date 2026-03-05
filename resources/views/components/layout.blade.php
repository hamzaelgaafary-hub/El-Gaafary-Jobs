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
                    <img src="{{ Vite::asset('resources/images/logo.svg') }}" alt="El Gaafary Jobs Logo" width="92"
                        height="29">
                </a>
            </div>

            <div class="space-x-6 font-bold">
                <a href="/" class="text-gray-300 hover:text-blue-600">Jobs</a>
                <a href="/about" class="text-gray-300 hover:text-blue-600">About </a>
                <a href="/employers" class="text-gray-300 hover:text-blue-600">Employers</a>
            </div>

            @auth
                <div class="space-x-6 font-bold flex">
                    <a href="{{ auth()->user()->getDashboardUrl() }}" class="text-gray-50 hover:text-green-600">
                        My Dashboard
                    </a>

                    <a href="/jobs/create" class="text-gray-300 hover:text-blue-600">Post a Job</a>


                    <form method="POST" class="text-gray-50 hover:text-red-600" action="/logout">
                        @csrf
                        @method('DELETE')

                        <button>Log Out</button>
                    </form>
                </div>
            @endauth

            @guest
                <div class="space-x-6 font-bold">
                    <a href="/register" class="text-gray-100 hover:text-blue-600">Sign Up</a>
                    <a href="/login" class="text-gray-300 hover:text-blue-600">
                        Log in
                    </a>
                </div>
            @endguest
        </nav>

        <main class="mt-10 max-w-[986px] mx-auto">
            {{ $slot }}
        </main>
    </div>

</body>

</html>