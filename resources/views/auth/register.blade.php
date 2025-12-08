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
