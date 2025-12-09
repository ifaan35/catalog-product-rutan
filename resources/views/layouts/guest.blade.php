<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'RUTAN SHOP') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
       

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden" 
             style="background: linear-gradient(135deg, #0a1628 0%, #0f2744 50%, #1a3a5c 100%);">
            
            <!-- Animated Background Shapes -->
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <!-- Large Circle Top Right -->
                <div class="absolute -top-40 -right-40 w-96 h-96 rounded-full opacity-10" 
                     style="background: radial-gradient(circle, #ECBF62 0%, transparent 70%);"></div>
                
                <!-- Medium Circle Bottom Left -->
                <div class="absolute -bottom-32 -left-32 w-80 h-80 rounded-full opacity-8" 
                     style="background: radial-gradient(circle, #ECBF62 0%, transparent 70%);"></div>
                
                <!-- Small Circle Top Left -->
                <div class="absolute top-20 left-20 w-32 h-32 rounded-full opacity-5" 
                     style="background: radial-gradient(circle, #ECBF62 0%, transparent 70%);"></div>
                
                <!-- Dots Pattern -->
                <div class="absolute inset-0" style="background-image: radial-gradient(rgba(236, 191, 98, 0.03) 1px, transparent 1px); background-size: 30px 30px;"></div>
            </div>

            <!-- Logo and Title -->
            <div class="text-center mb-8 relative z-10">
                <a href="{{ route('home') }}" class="inline-block">
                    <img src="{{ asset('images/logo/FA_Logo_Kementrian_Imigrasi_dan_Pemasyarakatan.png') }}" 
                         alt="Logo Kementerian Imigrasi dan Pemasyarakatan" 
                         class="h-20 w-auto mx-auto mb-4">
                    <h1 class="text-4xl font-bold text-white tracking-tight mb-2">
                        RUTAN SHOP
                    </h1>
                </a>
                <p class="text-gray-300 mt-2 text-sm">Produk Berkualitas Hasil Karya Warga Binaan</p>
            </div>

            <!-- Form Container -->
            <div class="w-full sm:max-w-md mt-6 px-8 py-8 bg-white shadow-2xl overflow-hidden sm:rounded-lg relative z-10 backdrop-blur-sm" 
                 style="background: rgba(255, 255, 255, 0.98);">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
