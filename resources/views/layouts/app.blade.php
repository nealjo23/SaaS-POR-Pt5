<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>John Ass 5</title>

        <!-- Styles -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">

    </head>
    <body class="antialiased">
        <div class="relative min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">
            <div class="max-w-7xl mx-auto ">
                @if (Route::has('login'))
                    <div class="text-left bg-transparent">
                        <a href="{{ url('/') }}" class="text-xs pr-2 text-gray-600 hover:text-gray-900">Home</a>
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/profile') }}" class="text-xs pr-2 text-gray-600 hover:text-gray-900">Profile</a>
                                <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                                    @csrf
                                    <a href="route('logout')"
                                       onclick="event.preventDefault(); this.closest('form').submit();"
                                       class="text-xs pr-2 text-gray-600 hover:text-gray-900">
                                        Log Out
                                    </a>
                                </form>
                            @else
                                <a href="{{ route('login') }}" class="text-xs pr-2 text-gray-600 hover:text-gray-900">Log in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="text-xs pr-2 text-gray-600 hover:text-gray-900">Register</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                @endif
                    <div class="rounded-lg bg-white my-4 mx-auto p-4 w-full sm:w-4/5">
                        <div class="flex items-center gap-4">
                            <img src="{{ asset('docs/images/library-icon.svg') }}" alt="Library Icon" class="h-10 w-auto">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">John's SaaS S1 2023 Library System</h3>
                        </div>
                    </div>

                    @yield('content')

                <div class="flex justify-center mt-16 px-0 sm:items-center sm:justify-between">
                    <div class="text-center text-sm text-gray-500 dark:text-gray-400 sm:text-left">

                    </div>

                    <div class="ml-4 text-center text-sm text-gray-500 dark:text-gray-400 sm:text-right sm:ml-0">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
