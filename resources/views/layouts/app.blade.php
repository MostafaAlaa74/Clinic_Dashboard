<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Doctor Clinic') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=nunito:400,500,600,700&display=swap" rel="stylesheet" />
        
        <!-- Font Awesome for medical icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        
        <!-- Custom Doctor Clinic CSS -->
        <link href="{{ asset('css/doctor-clinic.css') }}" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
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
            
            <!-- Footer -->
            <footer class="py-6 text-center">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <p>&copy; {{ date('Y') }} Doctor Clinic. All rights reserved.</p>
                    <div class="mt-2 flex justify-center space-x-6">
                        <a href="#" class="text-light-color hover:text-primary-color"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-light-color hover:text-primary-color"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-light-color hover:text-primary-color"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
