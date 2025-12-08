<nav x-data="{ open: false }" class="navbar" style="background-color: #07213C; border-bottom: 3px solid #ECBF62;">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-xl font-bold" style="color: #ECBF62;">
                        🛍️ RUTAN SHOP
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <a href="{{ route('home') }}" class="text-white hover:text-yellow-400 px-1 py-2 text-sm font-medium transition duration-300" style="color: white;">
                        Beranda
                    </a>
                    <a href="{{ route('products.index') }}" class="text-white hover:text-yellow-400 px-1 py-2 text-sm font-medium transition duration-300" style="color: white;">
                        Katalog Produk
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            @auth
            <div class="hidden sm:flex sm:items-center sm:ml-6 gap-4">
                <!-- Cart Icon -->
                <a href="{{ route('cart.index') }}" class="transition duration-300" style="color: #ECBF62;">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m10-9l2 9m-10 0h14m-5-9v2m-2-2v2m-2-2v2"></path>
                    </svg>
                </a>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md focus:outline-none transition ease-in-out duration-150" style="color: #ECBF62;">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profil') }}
                        </x-dropdown-link>

                        @if(Auth::user()->isAdmin())
                        <x-dropdown-link :href="route('admin.dashboard')">
                            {{ __('Admin Dashboard') }}
                        </x-dropdown-link>
                        @endif

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            @else
            <div class="hidden sm:flex sm:items-center sm:ml-6 gap-4">
                <a href="{{ route('login') }}" class="text-white px-4 py-2 text-sm font-medium transition duration-300" style="color: white;">
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="btn-primary" style="background-color: #ECBF62; color: #07213C;">
                    Daftar
                </a>
            </div>
            @endauth

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md transition duration-150 ease-in-out" style="color: #ECBF62;">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden" style="background-color: #07213C;">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('home') }}" class="block pl-3 pr-4 py-2 text-sm font-medium" style="color: white;">
                Beranda
            </a>
            <a href="{{ route('products.index') }}" class="block pl-3 pr-4 py-2 text-sm font-medium" style="color: white;">
                Katalog Produk
            </a>
        </div>

        <!-- Responsive Settings Options -->
        @auth
        <div class="pt-4 pb-1 border-t" style="border-color: rgba(236, 191, 98, 0.3);">
            <div class="px-4">
                <div class="font-medium text-base" style="color: #ECBF62;">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm" style="color: rgba(255, 255, 255, 0.7);">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="block pl-3 pr-4 py-2 text-sm font-medium" style="color: white;">
                    Profil
                </a>

                @if(Auth::user()->isAdmin())
                <a href="{{ route('admin.dashboard') }}" class="block pl-3 pr-4 py-2 text-sm font-medium" style="color: white;">
                    Admin Dashboard
                </a>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="block pl-3 pr-4 py-2 text-sm font-medium"
                            style="color: white;">
                        Log Out
                    </a>
                </form>
            </div>
        </div>
        @else
        <div class="pt-4 pb-1 border-t" style="border-color: rgba(236, 191, 98, 0.3);">
            <a href="{{ route('login') }}" class="block pl-3 pr-4 py-2 text-sm font-medium" style="color: white;">
                Masuk
            </a>
            <a href="{{ route('register') }}" class="block pl-3 pr-4 py-2 text-sm font-medium" style="color: white;">
                Daftar
            </a>
        </div>
        @endauth
    </div>
</nav>
