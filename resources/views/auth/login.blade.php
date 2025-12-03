<x-guest-layout>
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold mb-4 tracking-tight text-gray-900 dark:text-white">Selamat Datang Kembali</h2>
        <p class="text-gray-500 text-base font-light">Silakan masuk ke akun RUTAN SHOP Anda</p>
        <div class="w-16 h-1 mx-auto mt-5 rounded-full" style="background: linear-gradient(90deg, transparent, #EC4899, transparent);"></div>
    </div>

    <form method="POST" action="{{ route('login') }}" class="space-y-12">
        @csrf

        <div class="relative">
            <label for="email" class="block text-base font-medium mb-5 tracking-wide text-gray-900 dark:text-gray-200">Alamat Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
                    class="elegant-input w-full px-7 py-5 focus:outline-none text-gray-700 dark:text-gray-300 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl focus:border-pink-500 focus:ring-pink-500 text-lg"
                    placeholder="name@example.com">
            <x-input-error :messages="$errors->get('email')" class="mt-3" />
        </div>

        <div class="relative">
            <label for="password" class="block text-base font-medium mb-5 tracking-wide text-gray-900 dark:text-gray-200">Kata Sandi</label>
            <div class="relative">
                <input id="password" type="password" name="password" required autocomplete="current-password"
                        class="elegant-input w-full px-7 py-5 pr-14 focus:outline-none text-gray-700 dark:text-gray-300 dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-xl focus:border-pink-500 focus:ring-pink-500 text-lg"
                        placeholder="Masukkan kata sandi">
                <button type="button" onclick="togglePassword('password')" 
                        class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none transition duration-200 p-2">
                    <i id="password-eye" class="fas fa-eye-slash text-base"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-3" />
        </div>

        <div class="flex items-center justify-between pt-2">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <input id="remember_me" type="checkbox" name="remember" 
                        class="rounded-lg border-gray-300 shadow-sm focus:ring-2 transition duration-300 w-4 h-4 text-pink-600 focus:ring-pink-600" 
                        style="color: #EC4899; focus:ring-color: #EC4899;">
                <span class="ml-3 text-sm font-medium group-hover:text-gray-600 transition-colors duration-200 text-gray-900 dark:text-gray-400">Ingat saya</span>
            </label>
            
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm font-medium hover:underline transition duration-300 hover:opacity-80 text-pink-600">
                    Lupa kata sandi?
                </a>
            @endif
        </div>

        <button type="submit" class="elegant-button w-full py-5 px-8 rounded-xl font-bold text-white shadow-xl text-lg bg-pink-600 hover:bg-pink-700 transition duration-300">
            <span>Masuk ke Akun</span>
        </button>
        
        <div class="text-center pt-8 mt-4 border-t border-gray-100 dark:border-gray-700">
            <p class="text-base text-gray-500 font-light">
                Belum memiliki akun? 
                <a href="{{ route('register') }}" class="font-semibold hover:underline transition duration-300 ml-1 text-pink-600">
                    Bergabung sekarang
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
                // Mengubah warna tombol mata saat di-klik (Sesuai warna pink/pink-600)
                eyeButton.style.color = '#EC4899'; 
                eyeButton.title = 'Sembunyikan password';
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
                // Mengembalikan warna default saat disembunyikan
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
