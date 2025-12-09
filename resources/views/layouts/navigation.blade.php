<nav x-data="{ open: false, cartCount: {{ session('cart_count', 0) }} }" class="navbar shadow-lg" style="background-color: #07213C; border-bottom: 3px solid #ECBF62;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <!-- Logo -->
            <div class="shrink-0 flex items-center gap-2">
                <a href="{{ route('home') }}" class="transition duration-300 hover:opacity-80 flex items-center gap-2">
                    <img src="{{ asset('images/logo/FA_Logo_Kementrian_Imigrasi_dan_Pemasyarakatan.png') }}" alt="RUTAN Logo" class="h-12 w-auto">
                    <span class="text-white font-bold text-lg hidden sm:inline" style="color: #ECBF62;">RUTAN SHOP</span>
                </a>
            </div>

            <!-- Desktop Navigation Links -->
            <div class="hidden md:flex items-center space-x-8">
            </div>

            <!-- Right Menu -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('products.index') }}" class="text-white font-medium hover:text-yellow-300 transition duration-300 px-3 py-2 text-sm">
                    Product
                </a>
                <a href="{{ route('about') }}" class="text-white font-medium hover:text-yellow-300 transition duration-300 px-3 py-2 text-sm">
                    About
                </a>
                <a href="{{ route('cart.index') }}" class="text-white font-medium hover:text-yellow-300 transition duration-300 text-sm flex items-center gap-2 relative">
                    🛒 Cart
                    <span x-show="cartCount > 0" 
                          x-text="cartCount"
                          class="absolute font-bold rounded-full flex items-center justify-center cart-badge"
                          style="top: -15px; right: -15px; width: 28px; height: 28px; font-size: 13px; animation: pulse-badge 0.5s ease-out; color: #ECBF62; "></span>
                </a>
                @auth
                <a href="{{ route('orders.index') }}" class="text-white font-medium hover:text-yellow-300 transition duration-300 text-sm">
                    Orders
                </a>
                @endauth

                @auth
                    @if(Auth::user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="font-bold py-2 px-4 rounded-lg transition duration-300 hover:shadow-lg" style="background-color:  #e6b95f; color: white;">
                            👨‍💼 Admin
                        </a>
                    @endif
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="text-white font-medium hover:text-yellow-300 transition duration-300 text-sm">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="font-bold py-2 px-4 rounded-lg transition duration-300 hover:shadow-lg" style="background-color: #ECBF62; color: #07213C;">
                        Registrasi
                    </a>
                @endguest

                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center gap-2 px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md focus:outline-none transition ease-in-out duration-150 text-white hover:text-yellow-300">
                                <div>{{ Auth::user()->name }}</div>
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profil') }}
                            </x-dropdown-link>

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
                @endauth
            </div>

            <!-- Hamburger Menu -->
            <div class="md:hidden flex items-center">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md transition duration-150 ease-in-out" style="color: #ECBF62;">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden md:hidden" style="background-color: rgba(7, 33, 60, 0.95);">
        <div class="px-2 pt-2 pb-3 space-y-1">
            <a href="{{ route('products.index') }}" class="block px-4 py-3 text-white font-medium hover:bg-white hover:bg-opacity-10 rounded-lg transition duration-300">
                Product
            </a>
            <a href="{{ route('about') }}" class="block px-4 py-3 text-white font-medium hover:bg-white hover:bg-opacity-10 rounded-lg transition duration-300">
                About
            </a>
            <a href="{{ route('cart.index') }}" class="block px-4 py-3 text-white font-medium hover:bg-white hover:bg-opacity-10 rounded-lg transition duration-300 relative">
                🛒 Cart
                <span x-show="cartCount > 0" 
                      x-text="cartCount"
                      class="absolute font-bold rounded-full flex items-center justify-center cart-badge"
                      style="top: -15px; right: -15px; width: 24px; height: 24px; font-size: 12px; animation: pulse-badge 0.5s ease-out; color: #ECBF62;"></span>
            </a>
            @auth
            <a href="{{ route('orders.index') }}" class="block px-4 py-3 text-white font-medium hover:bg-white hover:bg-opacity-10 rounded-lg transition duration-300">
                Orders
            </a>
            @endauth

            @auth
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="block px-4 py-3 font-bold rounded-lg transition duration-300 m-2" style="background-color: #10B981; color: white;">
                        👨‍💼 Admin Dashboard
                    </a>
                @endif
            @endauth
        </div>

        <!-- Mobile Auth Section -->
        @guest
        <div class="border-t" style="border-color: rgba(236, 191, 98, 0.3); padding: 12px 0;">
            <a href="{{ route('login') }}" class="block px-4 py-3 text-white font-medium hover:bg-white hover:bg-opacity-10 rounded-lg transition duration-300">
                Login
            </a>
            <a href="{{ route('register') }}" class="block px-4 py-3 font-bold rounded-lg transition duration-300 m-2" style="background-color: #ECBF62; color: #07213C;">
                Registrasi
            </a>
        </div>
        @endguest

        @auth
        <div class="border-t" style="border-color: rgba(236, 191, 98, 0.3); padding: 12px 0;">
            <div class="px-4 py-2">
                <p class="font-medium" style="color: #ECBF62;">{{ Auth::user()->name }}</p>
                <p class="text-xs opacity-70" style="color: white;">{{ Auth::user()->email }}</p>
            </div>

            <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-white font-medium hover:bg-white hover:bg-opacity-10 rounded-lg transition duration-300">
                Profil
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="block w-full text-left px-4 py-3 text-white font-medium hover:bg-white hover:bg-opacity-10 rounded-lg transition duration-300">
                    Log Out
                </button>
            </form>
        </div>
        @endauth
    </div>
</nav>

