<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

       
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex flex-col items-center justify-center min-h-screen p-6 lg:p-8">

        
        @if (Route::has('login'))
            <header class="w-full flex justify-center mb-10">
                <nav class="flex gap-6">
                    @auth
                        <a
                            href="{{ url('/dashboard') }}"
                            class="px-5 py-1.5 text-[#1b1b18] dark:text-[#EDEDEC] border border-[#19140035] dark:border-[#3E3E3A] hover:border-[#1915014a] dark:hover:border-[#62605b] rounded-sm text-sm"
                        >
                            Dashboard
                        </a>
                    @else
                        <a
                            href="{{ route('login') }}"
                            class="px-5 py-1.5 text-[#1b1b18] dark:text-[#EDEDEC] border border-transparent hover:border-[#19140035] dark:hover:border-[#3E3E3A] rounded-sm text-sm"
                        >
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a
                                href="{{ route('register') }}"
                                class="px-5 py-1.5 text-[#1b1b18] dark:text-[#EDEDEC] border border-[#19140035] dark:border-[#3E3E3A] hover:border-[#1915014a] dark:hover:border-[#62605b] rounded-sm text-sm"
                            >
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            </header>
        @endif

        
        <main class="flex-grow flex items-center justify-center">
            <h1 class="text-4xl md:text-6xl font-semibold text-center dark:text-white">
                E-goi Challenge
            </h1>
        </main>

    </body>
</html>
