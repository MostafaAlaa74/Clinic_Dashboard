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
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div class="mb-4">
                <a href="/">
                    <x-application-logo class="w-24 h-24" />
                </a>
                <h1 class="text-3xl font-bold text-center mt-4 text-primary-color">Doctor Clinic</h1>
                <p class="text-center text-gray-600"><i class="fas fa-heartbeat mr-1"></i> Your Health, Our Priority</p>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg border-t-4 border-primary-color">
                {{ $slot }}
            </div>
            
            <div class="mt-8 text-center text-sm text-gray-600">
                <p>&copy; {{ date('Y') }} Doctor Clinic. All rights reserved.</p>
                <div class="mt-2 flex justify-center space-x-4">
                    <a href="#" class="text-gray-600 hover:text-primary-color"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-gray-600 hover:text-primary-color"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-gray-600 hover:text-primary-color"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </body>
</html>
