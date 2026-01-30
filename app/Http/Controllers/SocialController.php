<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Log;
use Exception;

class SocialController extends Controller
{
    /**
     * Redirect the user to the provider's authentication page.
     *
     * @param string $provider
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        // Validate provider
        if (!in_array($provider, ['google', 'facebook', 'github'])) {
            return redirect()->route('login')->with('error', 'Provider tidak didukung.');
        }

        return Socialite::driver($provider)->stateless()->redirect();
    }

    /**
     * Handle the callback from the provider.
     * Support both {provider} parameter and direct google
     *
     * @param string|null $provider
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider = 'google')
    {
        // Jika provider tidak ada di parameter, cek dari request
        if (!$provider || $provider === 'callback') {
            $provider = 'google'; // Default ke google
        }

        try {
            // Validate provider
            if (!in_array($provider, ['google', 'facebook', 'github'])) {
                return redirect()->route('login')->with('error', 'Provider tidak didukung.');
            }

            Log::info('Getting user from provider: ' . $provider);
            
            $socialUser = Socialite::driver($provider)->stateless()->user();
            
            Log::info('Social user received', [
                'provider' => $provider,
                'id' => $socialUser->getId(),
                'email' => $socialUser->getEmail(),
                'name' => $socialUser->getName()
            ]);

            // Cari user berdasarkan provider_id dan provider
            $user = User::where('provider', $provider)
                        ->where('provider_id', $socialUser->getId())
                        ->first();

            if (!$user) {
                Log::info('User tidak ditemukan, cek berdasarkan email');
                // Cek apakah email sudah terdaftar
                $user = User::where('email', $socialUser->getEmail())->first();

                if ($user) {
                    // Update provider info ke user yang sudah ada
                    Log::info('Update existing user with provider', ['user_id' => $user->id]);
                    $user->update([
                        'provider' => $provider,
                        'provider_id' => $socialUser->getId(),
                    ]);
                } else {
                    // Buat user baru
                    Log::info('Creating new user from social login');
                    $user = User::create([
                        'name' => $socialUser->getName(),
                        'email' => $socialUser->getEmail(),
                        'provider' => $provider,
                        'provider_id' => $socialUser->getId(),
                        'password' => Hash::make(uniqid()), // Password random
                        'email_verified_at' => now(), // Auto verify email untuk social users
                    ]);
                    Log::info('New user created', ['user_id' => $user->id]);
                }
            } else {
                Log::info('User found', ['user_id' => $user->id]);
            }

            // Login user
            Auth::login($user);
            Log::info('User logged in', ['user_id' => $user->id]);

            return redirect()->intended(route('home'))->with('success', "Berhasil login dengan " . ucfirst($provider) . "!");
            
        } catch (Exception $e) {
            Log::error('Social login error', [
                'provider' => $provider,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('login')->with('error', 'Gagal login dengan ' . $provider . '. Error: ' . $e->getMessage());
        }
    }
}
