<form method="post" action="{{ route('profile.update') }}">
    @csrf
    @method('patch')

    <form id="send-verification" method="post" action="{{ route('verification.send') }}" style="display: none;">
        @csrf
    </form>

    <div class="form-row">
        <!-- Username Field -->
        <div class="form-group">
            <label class="form-label" for="name">Username</label>
            <input 
                id="name" 
                name="name" 
                type="text" 
                class="form-input"
                value="{{ old('name', $user->name) }}" 
                required 
                autofocus />
            @error('name')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Name Field -->
        <div class="form-group">
            <label class="form-label" for="email">Nama</label>
            <input 
                id="email" 
                name="email" 
                type="email" 
                class="form-input"
                value="{{ old('email', $user->email) }}" 
                required />
            <p class="form-helper">Gunakan alamat email yang benar</p>
            @error('email')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>
    </div>

    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
        <div class="alert-info">
            ⚠️ Email Anda belum diverifikasi.
            <button form="send-verification" type="submit" style="background: none; border: none; padding: 0; cursor: pointer; color: #D97706; font-weight: 600; text-decoration: underline;">
                Klik di sini untuk mengirim ulang email verifikasi.
            </button>

            @if (session('status') === 'verification-link-sent')
                <div class="success-msg" style="margin-top: 0.75rem;">
                    ✅ Email verifikasi baru telah dikirim ke alamat email Anda.
                </div>
            @endif
        </div>
    @endif

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">
            💾 Simpan
        </button>

        @if (session('status') === 'profile-updated')
            <div class="success-msg">
                ✅ Profil berhasil diperbarui!
            </div>
        @endif
    </div>
</form>
