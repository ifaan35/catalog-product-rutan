<x-guest-layout>
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold mb-4 tracking-tight" style="color: #072138;">Bergabung dengan RUTAN SHOP</h2>
        <p class="text-gray-500 text-base font-light">Mulai perjalanan Anda dengan produk berkualitas hasil karya warga binaan</p>
        <div class="w-16 h-1 mx-auto mt-5 rounded-full" style="background: linear-gradient(90deg, transparent, #F3C32A, transparent);"></div>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-10">
        @csrf

        <!-- Name -->
        <div class="relative">
            <label for="name" class="block text-base font-medium mb-5 tracking-wide" style="color: #072138;">Nama Lengkap</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                   class="elegant-input w-full px-7 py-5 focus:outline-none text-gray-700 text-lg"
                   placeholder="Contoh: Ahmad Budi Santoso">
            <x-input-error :messages="$errors->get('name')" class="mt-3" />
        </div>

        <!-- Email Address -->
        <div class="relative">
            <label for="email" class="block text-base font-medium mb-5 tracking-wide" style="color: #072138;">Alamat Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                   class="elegant-input w-full px-7 py-5 focus:outline-none text-gray-700 text-lg"
                   placeholder="name@example.com">
            <x-input-error :messages="$errors->get('email')" class="mt-3" />
        </div>

        <!-- Password -->
        <div class="relative">
            <label for="password" class="block text-base font-medium mb-5 tracking-wide" style="color: #072138;">Kata Sandi</label>
            <div class="relative">
                <input id="password" type="password" name="password" required autocomplete="new-password"
                       class="elegant-input w-full px-7 py-5 pr-14 focus:outline-none text-gray-700 text-lg"
                       placeholder="Minimal 8 karakter">
                <button type="button" onclick="togglePassword('password')" 
                        class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none transition duration-200 p-2">
                    <i id="password-eye" class="fas fa-eye-slash text-base"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-3" />
        </div>

        <!-- Confirm Password -->
        <div class="relative">
            <label for="password_confirmation" class="block text-base font-medium mb-5 tracking-wide" style="color: #072138;">Konfirmasi Kata Sandi</label>
            <div class="relative">
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                       class="elegant-input w-full px-7 py-5 pr-14 focus:outline-none text-gray-700 text-lg"
                       placeholder="Ulangi kata sandi">
                <button type="button" onclick="togglePassword('password_confirmation')" 
                        class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none transition duration-200 p-2">
                    <i id="password_confirmation-eye" class="fas fa-eye-slash text-base"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-3" />
        </div>

        <!-- Register Button -->
        <div class="pt-8">
            <button type="submit" class="elegant-button w-full py-5 px-8 rounded-xl font-bold text-white shadow-xl text-lg">
                <span style="color: #072138;">Daftar Sekarang</span>
            </button>
        </div>
        
        <!-- Login Link -->
        <div class="text-center pt-8 mt-4 border-t border-gray-100">
            <p class="text-base text-gray-500 font-light">
                Sudah memiliki akun? 
                <a href="{{ route('login') }}" class="font-semibold hover:underline transition duration-300 ml-1" 
                   style="color: #F3C32A;">
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
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
                eyeButton.style.color = '#F3C32A';
                eyeButton.title = 'Sembunyikan password';
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
                eyeButton.style.color = '';
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
