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
        
        <style>
            .gradient-bg {
                background: linear-gradient(135deg, #072138 0%, #0f3a5c 25%, #1a4b73 50%, #0f3a5c 75%, #072138 100%);
                position: relative;
                overflow: hidden;
            }
            .gradient-bg::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: radial-gradient(circle at 20% 50%, rgba(243, 195, 42, 0.1) 0%, transparent 50%),
                           radial-gradient(circle at 80% 20%, rgba(243, 195, 42, 0.08) 0%, transparent 50%),
                           radial-gradient(circle at 40% 80%, rgba(243, 195, 42, 0.06) 0%, transparent 50%);
                animation: float 8s ease-in-out infinite;
            }
            @keyframes float {
                0%, 100% { transform: translate(0px, 0px) rotate(0deg); }
                33% { transform: translate(30px, -30px) rotate(120deg); }
                66% { transform: translate(-20px, 20px) rotate(240deg); }
            }
            .form-container {
                backdrop-filter: blur(20px);
                background: linear-gradient(135deg, 
                    rgba(255, 255, 255, 0.98) 0%, 
                    rgba(248, 250, 252, 0.95) 25%, 
                    rgba(254, 252, 232, 0.9) 50%, 
                    rgba(248, 250, 252, 0.95) 75%, 
                    rgba(255, 255, 255, 0.98) 100%);
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15), 
                           0 0 0 1px rgba(243, 195, 42, 0.08),
                           inset 0 1px 0 rgba(255, 255, 255, 0.8);
                border: 1px solid rgba(243, 195, 42, 0.1);
                border-radius: 24px;
            }
            .elegant-input {
                background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(248, 250, 252, 0.9) 100%);
                border: 1px solid rgba(203, 213, 225, 0.6);
                border-radius: 16px;
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05), inset 0 1px 0 rgba(255, 255, 255, 0.8);
            }
            .elegant-input:focus {
                background: linear-gradient(135deg, rgba(255, 255, 255, 1) 0%, rgba(254, 249, 195, 0.3) 100%);
                border-color: rgba(243, 195, 42, 0.4);
                box-shadow: 0 0 0 4px rgba(243, 195, 42, 0.1), 0 8px 25px -8px rgba(243, 195, 42, 0.2), inset 0 1px 0 rgba(255, 255, 255, 0.9);
                transform: translateY(-2px);
            }
            .elegant-button {
                background: linear-gradient(135deg, #F3C32A 0%, #e6b800 100%);
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                position: relative;
                overflow: hidden;
            }
            .elegant-button:hover {
                background: linear-gradient(135deg, #e6b800 0%, #d4a500 100%);
                transform: translateY(-2px);
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }
            .elegant-button:active {
                transform: translateY(-1px);
            }
            .floating-elements {
                position: absolute;
                width: 100%;
                height: 100%;
                overflow: hidden;
            }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen gradient-bg flex flex-col justify-center items-center px-4 sm:px-6 lg:px-8">
            <!-- Floating decorative elements -->
            <div class="floating-elements pointer-events-none">
                <div class="absolute top-20 left-16 w-32 h-32 rounded-full opacity-5 animate-pulse" style="background: radial-gradient(circle, #F3C32A, transparent);"></div>
                <div class="absolute top-40 right-24 w-20 h-20 rounded-full opacity-10 animate-bounce" style="background: radial-gradient(circle, #F3C32A, transparent); animation-delay: 2s; animation-duration: 3s;"></div>
                <div class="absolute bottom-32 left-1/4 w-16 h-16 rounded-full opacity-8" style="background: radial-gradient(circle, #F3C32A, transparent); animation: float 6s ease-in-out infinite;"></div>
                <div class="absolute bottom-48 right-16 w-28 h-28 rounded-full opacity-6" style="background: radial-gradient(circle, #F3C32A, transparent); animation: float 4s ease-in-out infinite reverse;"></div>
                <div class="absolute top-1/2 left-8 w-12 h-12 rounded-full opacity-8" style="background: radial-gradient(circle, #F3C32A, transparent); animation: float 5s ease-in-out infinite;"></div>
                <div class="absolute top-1/3 right-12 w-14 h-14 rounded-full opacity-7" style="background: radial-gradient(circle, #F3C32A, transparent); animation: float 7s ease-in-out infinite reverse;"></div>
            </div>
            
            <!-- Logo and Title -->
            <div class="text-center mb-12 relative z-10">
                <a href="{{ route('home') }}" class="inline-block group">
                    <h1 class="text-5xl sm:text-6xl font-extrabold text-white mb-4 tracking-tight">
                        <span style="color: #F3C32A; text-shadow: 0 0 30px rgba(243, 195, 42, 0.3);">RUTAN</span> 
                        <span class="ml-2" style="text-shadow: 0 0 20px rgba(255, 255, 255, 0.2);">SHOP</span>
                    </h1>
                </a>
                <div class="space-y-2">
                    <p class="text-white text-xl opacity-95 font-light tracking-wide">Produk Berkualitas Hasil Karya Warga Binaan</p>
                    <div class="w-24 h-1 mx-auto rounded-full" style="background: linear-gradient(90deg, transparent, #F3C32A, transparent);"></div>
                </div>
            </div>

            <!-- Form Container -->
            <div class="w-full sm:max-w-md form-container mx-auto p-10 sm:p-14 relative z-10 
                        bg-white dark:bg-gray-800 shadow-2xl rounded-[40px] 
                        transform transition-all duration-500"> 
                
                <div class="absolute inset-4 opacity-30 rounded-2xl hidden" style="background: radial-gradient(circle at 30% 20%, rgba(243, 195, 42, 0.1), transparent 50%), radial-gradient(circle at 70% 80%, rgba(7, 33, 56, 0.05), transparent 50%);"></div>
                
                <div class="relative z-10 px-0">
                    {{-- Karena sudah ada padding besar di div atas, kita set padding inner menjadi 0 --}}
                    {{ $slot }}
                </div>
            </div>
            
            <!-- Back to Home -->
            <div class="mt-8 text-center relative z-10">
                <a href="{{ route('home') }}" class="inline-flex items-center text-white hover:text-yellow-300 transition-all duration-300 group">
                    <svg class="w-5 h-5 mr-3 transform group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    <span class="text-lg font-medium tracking-wide">Kembali ke Beranda</span>
                </a>
            </div>
        </div>
    </body>
</html>
