<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Welcome</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <script src="https://cdn.tailwindcss.com"></script>
        <style>
            body {
                font-family: 'Figtree', sans-serif;
            }
            .bg-dots-dark {
                background-image: url("data:image/svg+xml,%3Csvg width='30' height='30' viewBox='0 0 30 30' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M1.22676 0C1.91374 0 2.45351 0.539773 2.45351 1.22676C2.45351 1.91374 1.91374 2.45351 1.22676 2.45351C0.539773 2.45351 0 1.91374 0 1.22676C0 0.539773 0.539773 0 1.22676 0Z' fill='rgba(255,255,255,0.07)'/%3E%3C/svg%3E");
            }
        </style>
    </head>
    <body class="antialiased min-h-screen bg-dots-dark bg-gray-900 flex items-center justify-center">
        <div class="bg-gray-800/80 rounded-xl shadow-2xl px-8 py-8 flex flex-col items-center w-full max-w-sm text-center">
            <h1 class="text-2xl font-bold text-white mb-8">Welcome</h1>
            <div class="flex flex-col space-y-4 w-full">
                <a href="{{ route('login') }}" class="w-full px-8 py-3 bg-red-400/80 text-white rounded-lg text-lg font-semibold shadow hover:bg-red-600 transition text-center">Log in</a>
                <a href="{{ route('register') }}" class="w-full px-8 py-3 bg-red-300/80 text-white rounded-lg text-lg font-semibold shadow hover:bg-red-500 transition text-center">Register</a>
            </div>
        </div>
    </body>
</html>
