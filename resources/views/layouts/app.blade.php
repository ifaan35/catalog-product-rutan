<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'RUTAN SHOP') }}</title>
    
    <!-- Tailwind CSS CDN for quick setup -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        /* Custom responsive improvements */
        @media (max-width: 640px) {
            .hero-title { font-size: 2.5rem !important; }
            .section-padding { padding: 2rem 1rem !important; }
            .card-grid { gap: 1rem !important; }
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen" style="background-color: #DFE1E3;">
        <!-- Navigation Header -->
        <header class="shadow-lg sticky top-0 z-50" style="background-color: #072138;">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center py-4">
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="text-2xl font-bold text-white">
                            <span style="color: #F3C32A;">RUTAN</span> SHOP
                        </a>
                    </div>
                    <nav class="hidden md:flex space-x-8">
                        <a href="{{ route('home') }}" class="font-medium transition duration-300 {{ request()->routeIs('home') ? 'border-b-2 pb-1' : '' }}" style="color: #F3C32A; {{ request()->routeIs('home') ? 'border-color: #F3C32A' : '' }}">Home</a>
                        <a href="{{ route('products.index') }}" class="text-white hover:opacity-80 font-medium transition duration-300 {{ request()->routeIs('products.*') ? 'border-b-2 pb-1' : '' }}" style="{{ request()->routeIs('products.*') ? 'border-color: #F3C32A; color: #F3C32A' : '' }}">Products</a>
                        <a href="#" class="text-white hover:opacity-80 font-medium transition duration-300">About</a>
                        <a href="{{ route('cart.index') }}" class="text-white hover:opacity-80 font-medium transition duration-300 {{ request()->routeIs('cart.*') ? 'border-b-2 pb-1' : '' }}" style="{{ request()->routeIs('cart.*') ? 'border-color: #F3C32A; color: #F3C32A' : '' }}">🛒 Cart</a>
                        
                        @auth
                            <a href="{{ route('checkout.index') }}" class="text-white hover:opacity-80 font-medium transition duration-300">Checkout</a>
                            <a href="{{ route('orders.index') }}" class="text-white hover:opacity-80 font-medium transition duration-300 {{ request()->routeIs('orders.*') ? 'border-b-2 pb-1' : '' }}" style="{{ request()->routeIs('orders.*') ? 'border-color: #F3C32A; color: #F3C32A' : '' }}">Riwayat Pesanan</a>
                            
                            @if(Auth::user() && Auth::user()->role === 'admin')
                                <a href="{{ route('admin.dashboard') }}" class="bg-yellow-400 text-slate-900 px-4 py-2 rounded-lg font-bold hover:bg-yellow-300 transition duration-300 {{ request()->routeIs('admin.*') ? 'ring-2 ring-white' : '' }}">🏢 Admin</a>
                            @endif
                            
                            <form method="POST" action="{{ route('logout') }}" class="inline">
                                @csrf
                                <button type="submit" class="text-white hover:opacity-80 font-medium transition duration-300">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-white hover:opacity-80 font-medium transition duration-300">Login</a>
                            <a href="{{ route('register') }}" class="text-white hover:opacity-80 font-medium transition duration-300">Register</a>
                        @endauth
                    </nav>
                    
                    <!-- Mobile menu button -->
                    <div class="md:hidden">
                        <button id="mobile-menu-button" class="text-white hover:opacity-80 p-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Mobile menu -->
                <div id="mobile-menu" class="md:hidden hidden border-t border-opacity-20 border-white">
                    <div class="px-2 pt-2 pb-3 space-y-1">
                        <a href="{{ route('home') }}" class="block px-3 py-2 text-base font-medium transition duration-300 {{ request()->routeIs('home') ? 'text-yellow-400' : 'text-white hover:text-yellow-400' }}" style="color: {{ request()->routeIs('home') ? '#F3C32A' : 'white' }};">Home</a>
                        <a href="{{ route('products.index') }}" class="block px-3 py-2 text-base font-medium transition duration-300 {{ request()->routeIs('products.*') ? 'text-yellow-400' : 'text-white hover:text-yellow-400' }}" style="color: {{ request()->routeIs('products.*') ? '#F3C32A' : 'white' }};">Products</a>
                        <a href="#" class="block px-3 py-2 text-base font-medium text-white hover:text-yellow-400 transition duration-300">About</a>
                        <a href="{{ route('cart.index') }}" class="block px-3 py-2 text-base font-medium transition duration-300 {{ request()->routeIs('cart.*') ? 'text-yellow-400' : 'text-white hover:text-yellow-400' }}" style="color: {{ request()->routeIs('cart.*') ? '#F3C32A' : 'white' }};">🛒 Cart</a>
                        
                        @auth
                            <a href="{{ route('checkout.index') }}" class="block px-3 py-2 text-base font-medium text-white hover:text-yellow-400 transition duration-300">Checkout</a>
                            <a href="{{ route('orders.index') }}" class="block px-3 py-2 text-base font-medium transition duration-300 {{ request()->routeIs('orders.*') ? 'text-yellow-400' : 'text-white hover:text-yellow-400' }}" style="color: {{ request()->routeIs('orders.*') ? '#F3C32A' : 'white' }};">Riwayat Pesanan</a>
                            <form method="POST" action="{{ route('logout') }}" class="block px-3 py-2">
                                @csrf
                                <button type="submit" class="text-base font-medium text-white hover:text-yellow-400 transition duration-300">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="block px-3 py-2 text-base font-medium text-white hover:text-yellow-400 transition duration-300">Login</a>
                            <a href="{{ route('register') }}" class="block px-3 py-2 text-base font-medium text-white hover:text-yellow-400 transition duration-300">Register</a>
                        @endauth
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main>
            <!-- Success/Error Messages -->
            @if(session('success'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
                    <div class="p-4 rounded-lg border-l-4 mb-4" style="background-color: #d4edda; border-color: #28a745; color: #155724;">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @if(session('error'))
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
                    <div class="p-4 rounded-lg border-l-4 mb-4" style="background-color: #f8d7da; border-color: #dc3545; color: #721c24;">
                        {{ session('error') }}
                    </div>
                </div>
            @endif

            <!-- Page Heading -->
            @if (isset($header))
                <div class="py-6" style="background-color: #072138;">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <h1 class="text-2xl font-bold text-white">{{ $header }}</h1>
                    </div>
                </div>
            @endif

            <!-- Page Content -->
            <div class="flex-grow">
                {{ $slot }}
            </div>
        </main>

        <!-- Footer -->
        <footer class="mt-16 text-white" style="background-color: #072138;">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <div class="text-center">
                    <p class="text-white font-medium">&copy; {{ date('Y') }} <span style="color: #F3C32A;">RUTAN</span> SHOP. All rights reserved.</p>
                    <p class="text-sm mt-2 text-gray-300">Hasil karya berkualitas dari warga binaan</p>
                </div>
            </div>
        </footer>

        <!-- Mobile menu toggle script -->
        <script>
            document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
                const mobileMenu = document.getElementById('mobile-menu');
                mobileMenu.classList.toggle('hidden');
            });
        </script>
    </div>
</body>
</html>
