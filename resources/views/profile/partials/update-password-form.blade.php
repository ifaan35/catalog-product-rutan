<form method="post" action="{{ route('password.update') }}">
    @csrf
    @method('put')

    <div class="form-row">
        <!-- Current Password Field -->
        <div class="form-group">
            <label class="form-label" for="current_password">Password Saat Ini</label>
            <input 
                id="current_password" 
                name="current_password" 
                type="password" 
                class="form-input"
                autocomplete="current-password" />
            @error('current_password', 'updatePassword')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- New Password Field -->
        <div class="form-group">
            <label class="form-label" for="password">Password Baru</label>
            <input 
                id="password" 
                name="password" 
                type="password" 
                class="form-input"
                autocomplete="new-password" />
            @error('password', 'updatePassword')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password Field -->
        <div class="form-group">
            <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
            <input 
                id="password_confirmation" 
                name="password_confirmation" 
                type="password" 
                class="form-input"
                autocomplete="new-password" />
            @error('password_confirmation', 'updatePassword')
                <p class="form-error">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="form-actions">
        <button type="submit" class="btn btn-primary">
            🔒 Perbarui Password
        </button>

        @if (session('status') === 'password-updated')
            <div class="success-msg">
                ✅ Password berhasil diperbarui!
            </div>
        @endif
    </div>
</form>
