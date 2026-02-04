<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />      
    <form method="POST" action="{{ route('login') }}" class="space-y-8">
        @csrf

        <!-- Email Address -->
        <div class="relative">
            <label for="email" class="block text-sm font-medium mb-4 tracking-wide" style="color: #07213C;">Alamat Email</label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" 
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
                <input id="password" type="password" name="password" required autocomplete="current-password"
                       class="block w-full px-3 py-2 pr-10 border rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-2 sm:text-sm"
                       style="border-color: #E1E2E4; color: #07213C;"
                       onfocus="this.style.borderColor='#ECBF62'; this.style.boxShadow='0 0 0 3px rgba(236, 191, 98, 0.1)'"
                       onblur="this.style.borderColor='#E1E2E4'; this.style.boxShadow='none'"
                       placeholder="Masukkan kata sandi">
                <button type="button" onclick="togglePassword('password')" 
                        class="absolute right-5 top-1/2 transform -translate-y-1/2 hover:text-gray-600 focus:outline-none transition duration-200 w-6 h-6 flex items-center justify-center"
                        style="color: #6B7280;">
                    <i id="password-eye" class="fas fa-eye text-base"></i>
                </button>
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-3" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center justify-between pt-2">
            <label for="remember_me" class="inline-flex items-center group cursor-pointer">
                <input id="remember_me" type="checkbox" name="remember" 
                       class="rounded-lg border shadow-sm focus:ring-2 transition duration-300 w-4 h-4"
                       style="border-color: #E1E2E4; color: #ECBF62;">
                <span class="ml-3 text-sm font-medium group-hover:text-gray-600 transition-colors duration-200" style="color: #07213C;">Ingat saya</span>
            </label>
            
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-sm font-medium hover:underline transition duration-300" style="color: #ECBF62;">
                    Lupa kata sandi?
                </a>
            @endif
        </div>

        <!-- Login Button -->
        <button type="submit" class="w-full text-white font-bold py-4 px-6 rounded-lg transition duration-300 shadow-lg hover:shadow-xl hover:opacity-90" style="background-color: #ECBF62; color: #07213C;">
            Masuk ke Akun
        </button>
        
        <!-- Register Link -->
        <div class="text-center pt-8 mt-4" style="border-top: 1px solid #E1E2E4;">
            <p class="text-base font-light" style="color: #6B7280;">
                Belum memiliki akun? 
                <a href="{{ route('register') }}" class="font-semibold hover:underline transition duration-300 ml-1" style="color: #ECBF62;">
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
