<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') - Admin RUTARO SHOP</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('images/logo/FA_Logo_Kementrian_Imigrasi_dan_Pemasyarakatan.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* RUTARO SHOP Brand Colors */
        :root {
            --rutan-navy: #072138;
            --rutan-yellow: #F3C32A; 
            --rutan-light: #DFE1E3;
        }
        
        .sidebar-active {
            background-color: var(--rutan-yellow);
            color: var(--rutan-navy);
            border-right: 3px solid var(--rutan-navy);
        }
    </style>
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <div class="w-64 bg-[#072138] shadow-lg">
            <!-- Logo/Header -->
            <div class="p-6 border-b border-gray-700">
                <div class="flex items-center">
                    <div class="w-10 h-10 bg-[#F3C32A] rounded-lg flex items-center justify-center mr-3">
                        <i class="fas fa-shield-alt text-[#072138] text-xl"></i>
                    </div>
                    <div>
                        <h1 class="text-white font-bold text-lg">RUTARO SHOP</h1>
                        <p class="text-[#F3C32A] text-sm">Admin Panel</p>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <nav class="p-4">
                <ul class="space-y-2">
                    <!-- Dashboard -->
                    <li>
                        <a href="{{ route('admin.dashboard') }}" 
                           class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-[#F3C32A] hover:text-[#072138] transition duration-200 {{ request()->routeIs('admin.dashboard') ? 'sidebar-active' : '' }}">
                            <i class="fas fa-tachometer-alt mr-3"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <!-- Products Management -->
                    <li>
                        <a href="{{ route('admin.products.index') }}" 
                           class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-[#F3C32A] hover:text-[#072138] transition duration-200 {{ request()->routeIs('admin.products.*') ? 'sidebar-active' : '' }}">
                            <i class="fas fa-boxes mr-3"></i>
                            <span>Manajemen Produk</span>
                        </a>
                    </li>

                    <!-- Categories Management -->
                    <li>
                        <a href="{{ route('admin.categories.index') }}" 
                           class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-[#F3C32A] hover:text-[#072138] transition duration-200 {{ request()->routeIs('admin.categories.*') ? 'sidebar-active' : '' }}">
                            <i class="fas fa-tags mr-3"></i>
                            <span>Manajemen Kategori</span>
                        </a>
                    </li>

                    <!-- Orders Management -->
                    <li>
                        <a href="{{ route('admin.orders.index') }}" 
                           class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-[#F3C32A] hover:text-[#072138] transition duration-200 {{ request()->routeIs('admin.orders.*') ? 'sidebar-active' : '' }}">
                            <i class="fas fa-shopping-cart mr-3"></i>
                            <span>Manajemen Pesanan</span>
                        </a>
                    </li>

                    <!-- Divider -->
                    <li class="border-t border-gray-700 my-4"></li>

                    <!-- Back to Site -->
                    <li>
                        <a href="{{ route('home') }}" 
                           class="flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-blue-600 hover:text-white transition duration-200">
                            <i class="fas fa-globe mr-3"></i>
                            <span>Lihat Website</span>
                        </a>
                    </li>

                    <!-- Logout -->
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" 
                                    class="w-full flex items-center px-4 py-3 text-gray-300 rounded-lg hover:bg-red-600 hover:text-white transition duration-200">
                                <i class="fas fa-sign-out-alt mr-3"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>

            <!-- User Info -->
            <div class="absolute bottom-0 left-0 right-0 p-4 border-t border-gray-700">
                <div class="flex items-center">
                    <div class="w-8 h-8 bg-[#F3C32A] rounded-full flex items-center justify-center mr-3">
                        <i class="fas fa-user text-[#072138]"></i>
                    </div>
                    <div>
                        <p class="text-white text-sm font-medium">{{ Auth::user()->name }}</p>
                        <p class="text-[#F3C32A] text-xs">Petugas Rutan</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="px-6 py-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-xl font-semibold text-[#072138]">@yield('title', 'Admin Dashboard')</h2>
                            <p class="text-gray-600 text-sm">{{ now()->format('l, d F Y') }}</p>
                        </div>
                        <div class="flex items-center space-x-4">
                            <!-- Notification Bell -->
                            <button class="relative p-2 text-gray-400 hover:text-[#072138] transition duration-200">
                                <i class="fas fa-bell text-xl"></i>
                                <span class="absolute -top-1 -right-1 h-4 w-4 bg-red-500 text-white rounded-full text-xs flex items-center justify-center">3</span>
                            </button>
                            
                            <!-- Quick Actions -->
                            <div class="relative">
                                <button class="flex items-center space-x-2 px-4 py-2 text-[#072138] bg-[#DFE1E3] rounded-lg hover:bg-[#F3C32A] transition duration-200">
                                    <i class="fas fa-plus"></i>
                                    <span class="hidden md:inline">Quick Add</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="flex-1 p-6 overflow-y-auto">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Add any admin-specific JavaScript here
        document.addEventListener('DOMContentLoaded', function() {
            // Auto-hide success messages after 5 seconds
            const successMessages = document.querySelectorAll('.bg-green-100');
            successMessages.forEach(function(message) {
                setTimeout(function() {
                    message.style.display = 'none';
                }, 5000);
            });
        });
    </script>
</body>
</html>