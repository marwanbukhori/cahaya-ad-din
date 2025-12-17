<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-emerald-50 relative">
        <!-- Star Pattern Overlay -->
        <div class="absolute inset-0 z-0 opacity-10 pointer-events-none"
            style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath d=\'M30 0l2.5 10 7.5-7.5-2.5 10 10-2.5-7.5 7.5 10 2.5-10 2.5 7.5 7.5-10-2.5-2.5 10-2.5-10-10 2.5 7.5-7.5-10-2.5 10-2.5-7.5-7.5 10 2.5z\' fill=\'%2310b981\' fill-opacity=\'0.2\' fill-rule=\'evenodd\'/%3E%3C/svg%3E');">
        </div>

        <div class="relative z-10 font-sans text-gray-900 antialiased">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <footer class="py-6 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} Cahaya Ad Din
            </footer>
        </div>
    </div>
</body>

</html>
