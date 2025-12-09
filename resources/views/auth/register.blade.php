<x-guest-layout>
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold mb-4 tracking-tight" style="color: #07213C;">Bergabung dengan RUTAN SHOP</h2>
        <p class="text-base font-light" style="color: #6B7280;">Mulai perjalanan Anda dengan produk berkualitas hasil karya warga binaan</p>
        <div class="w-16 h-1 mx-auto mt-5 rounded-full" style="background-color: #ECBF62;"></div>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-8">
        @csrf

        <!-- Name -->
        <div class="relative">
            <label for="name" class="block text-sm font-medium mb-4 tracking-wide" style="color: #07213C;">Nama Lengkap</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                   class="block w-full px-3 py-2 border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 sm:text-sm"
                   style="border-color: #E1E2E4; color: #07213C;"
                   onfocus="this.style.borderColor='#ECBF62'; this.style.boxShadow='0 0 0 3px rgba(236, 191, 98, 0.1)'"
                   onblur="this.style.borderColor='#E1E2E4'; this.style.boxShadow='none'"
                   placeholder="Contoh: Ahmad Budi Santoso">
            <x-input-error :messages="$errors->get('name')" class="mt-3" />
        </div>

        <!-- Email Address -->
        <div class="relative">
            <label for="email" class="block text-sm font-medium mb-4 tracking-wide" style="color: #07213C;">Alamat Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                   class="block w-full px-3 py-2 border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 sm:text-sm"
                   style="border-color: #E1E2E4; color: #07213C;"
                   onfocus="this.style.borderColor='#ECBF62'; this.style.boxShadow='0 0 0 3px rgba(236, 191, 98, 0.1)'"
                   onblur="this.style.borderColor='#E1E2E4'; this.style.boxShadow='none'"
                   placeholder="name@example.com">
            <x-input-error :messages="$errors->get('email')" class="mt-3" />
        </div>

        <!-- Password -->
        <div class="relative">
            <label for="password" class="block text-sm font-medium mb-4 tracking-wide" style="color: #07213C;">Kata Sandi</label>
            <div class="relative">
                <input id="password" type="password" name="password" required autocomplete="new-password"
                       class="block w-full px-3 py-2 pr-10 border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 sm:text-sm"
                       style="border-color: #E1E2E4; color: #07213C;"
                       onfocus="this.style.borderColor='#ECBF62'; this.style.boxShadow='0 0 0 3px rgba(236, 191, 98, 0.1)'"
                       onblur="this.style.borderColor='#E1E2E4'; this.style.boxShadow='none'"
                       placeholder="Minimal 8 karakter">
                <button type="button" onclick="togglePassword('password')" 
                        class="absolute right-5 top-1/2 transform -translate-y-1/2 hover:text-gray-600 focus:outline-none transition duration-200 w-6 h-6 flex items-center justify-center"
                        style="color: #6B7280;">
                    <i id="password-eye" class="fas fa-eye text-base"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-3" />
        </div>

        <!-- Confirm Password -->
        <div class="relative">
            <label for="password_confirmation" class="block text-sm font-medium mb-4 tracking-wide" style="color: #07213C;">Konfirmasi Kata Sandi</label>
            <div class="relative">
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                       class="block w-full px-3 py-2 pr-10 border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 sm:text-sm"
                       style="border-color: #E1E2E4; color: #07213C;"
                       onfocus="this.style.borderColor='#ECBF62'; this.style.boxShadow='0 0 0 3px rgba(236, 191, 98, 0.1)'"
                       onblur="this.style.borderColor='#E1E2E4'; this.style.boxShadow='none'"
                       placeholder="Ulangi kata sandi">
                <button type="button" onclick="togglePassword('password_confirmation')" 
                        class="absolute right-5 top-1/2 transform -translate-y-1/2 hover:text-gray-600 focus:outline-none transition duration-200 w-6 h-6 flex items-center justify-center"
                        style="color: #6B7280;">
                    <i id="password_confirmation-eye" class="fas fa-eye text-base"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-3" />
        </div>

        <!-- Register Button -->
        <div class="pt-6">
            <button type="submit" class="w-full text-white font-bold py-4 px-6 rounded-lg transition duration-300 shadow-lg hover:shadow-xl hover:opacity-90" style="background-color: #ECBF62; color: #07213C;">
                Daftar Sekarang
            </button>
        </div>

        <!-- Divider -->
        <div class="relative flex items-center justify-center py-4">
            <div class="border-t absolute w-full" style="border-color: #E1E2E4;"></div>
            <span class="relative bg-white px-4 text-sm" style="color: #6B7280;">Atau daftar dengan</span>
        </div>

        <!-- Google Sign Up Button -->
        <a href="{{ route('socialite.redirect', ['provider' => 'google']) }}" class="w-full flex items-center justify-center gap-3 bg-white border-2 font-semibold py-4 px-6 rounded-lg transition duration-300 hover:shadow-lg group" style="border-color: #E1E2E4; color: #07213C;">
            <svg class="w-5 h-5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
            </svg>
            <span class="group-hover:text-gray-900">Daftar dengan Google</span>
        </a>
        
        <!-- Login Link -->
        <div class="text-center pt-8 mt-4" style="border-top: 1px solid #E1E2E4;">
            <p class="text-base font-light" style="color: #6B7280;">
                Sudah memiliki akun? 
                <a href="{{ route('login') }}" class="font-semibold hover:underline transition duration-300 ml-1" style="color: #ECBF62;">
                    Masuk di sini
                </a>
            </p>
        </div>
    </form>

    <script>
        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const eyeIcon = document.getElementById(fieldId + '-eye');
            const eyeButton = eyeIcon.parentElement;
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
                eyeButton.style.color = '#ECBF62';
                eyeButton.title = 'Sembunyikan password';
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
                eyeButton.style.color = '#6B7280';
                eyeButton.title = 'Tampilkan password';
            }
        }
        
        // Set initial tooltips
        document.addEventListener('DOMContentLoaded', function() {
            const eyeButtons = document.querySelectorAll('button[onclick*="togglePassword"]');
            eyeButtons.forEach(button => {
                button.title = 'Tampilkan password';
            });
        });
    </script>
</x-guest-layout>
