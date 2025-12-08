<x-guest-layout>
    <div class="text-center mb-12">
        <h2 class="text-3xl font-bold text-gray-900 dark:text-white mb-4 tracking-tight">Bergabung dengan RUTAN SHOP</h2>
        <p class="text-gray-500 text-base font-light">Mulai perjalanan Anda dengan produk berkualitas hasil karya warga binaan</p>
        <div class="w-16 h-1 bg-pink-600 dark:bg-pink-400 mx-auto mt-5 rounded-full"></div>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-8">
        @csrf

        <!-- Name -->
        <div class="relative">
            <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-4 tracking-wide">Nama Lengkap</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                   class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-pink-500 focus:border-pink-500 dark:bg-gray-900 dark:text-gray-300 sm:text-sm"
                   placeholder="Contoh: Ahmad Budi Santoso">
            <x-input-error :messages="$errors->get('name')" class="mt-3" />
        </div>

        <!-- Email Address -->
        <div class="relative">
            <label for="email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-4 tracking-wide">Alamat Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                   class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-pink-500 focus:border-pink-500 dark:bg-gray-900 dark:text-gray-300 sm:text-sm"
                   placeholder="name@example.com">
            <x-input-error :messages="$errors->get('email')" class="mt-3" />
        </div>

        <!-- Password -->
        <div class="relative">
            <label for="password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-4 tracking-wide">Kata Sandi</label>
            <div class="relative">
                <input id="password" type="password" name="password" required autocomplete="new-password"
                       class="block w-full px-3 py-2 pr-10 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-pink-500 focus:border-pink-500 dark:bg-gray-900 dark:text-gray-300 sm:text-sm"
                       placeholder="Minimal 8 karakter">
                <button type="button" onclick="togglePassword('password')" 
                        class="absolute right-5 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none transition duration-200 w-6 h-6 flex items-center justify-center">
                    <i id="password-eye" class="fas fa-eye text-base"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-3" />
        </div>

        <!-- Confirm Password -->
        <div class="relative">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-4 tracking-wide">Konfirmasi Kata Sandi</label>
            <div class="relative">
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                       class="block w-full px-3 py-2 pr-10 border border-gray-300 dark:border-gray-700 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-pink-500 focus:border-pink-500 dark:bg-gray-900 dark:text-gray-300 sm:text-sm"
                       placeholder="Ulangi kata sandi">
                <button type="button" onclick="togglePassword('password_confirmation')" 
                        class="absolute right-5 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 focus:outline-none transition duration-200 w-6 h-6 flex items-center justify-center">
                    <i id="password_confirmation-eye" class="fas fa-eye text-base"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-3" />
        </div>

        <!-- Register Button -->
        <div class="pt-6">
            <button type="submit" class="w-full bg-pink-600 hover:bg-pink-700 dark:bg-pink-600 dark:hover:bg-pink-700 text-white font-bold py-4 px-6 rounded-lg transition duration-300 shadow-lg hover:shadow-xl">
                Daftar Sekarang
            </button>
        </div>
        
        <!-- Login Link -->
        <div class="text-center pt-8 mt-4 border-t border-gray-100">
            <p class="text-base text-gray-500 font-light">
                Sudah memiliki akun? 
                <a href="{{ route('login') }}" class="font-semibold text-pink-600 dark:text-pink-400 hover:text-pink-500 dark:hover:text-pink-300 hover:underline transition duration-300 ml-1">
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
                eyeButton.classList.add('text-pink-600');
                eyeButton.title = 'Sembunyikan password';
            } else {
                passwordField.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
                eyeButton.classList.remove('text-pink-600');
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
