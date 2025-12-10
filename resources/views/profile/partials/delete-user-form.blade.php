<p style="color: var(--text-light); margin-bottom: 1.5rem;">
    Setelah akun dihapus, semua data dan sumber daya akan dihapus secara permanen. 
    Harap unduh atau simpan data apa pun yang ingin Anda pertahankan sebelum menghapus akun.
</p>

<button
    type="button"
    class="btn btn-danger"
    x-data=""
    x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
>
    🗑️ Hapus Akun Saya
</button>

<x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
    <div style="padding: 2rem;">
        <!-- Modal Header -->
        <div style="display: flex; align-items: flex-start; gap: 1rem; margin-bottom: 1.5rem;">
            <span style="font-size: 3rem; line-height: 1;">⚠️</span>
            <div>
                <h3 style="font-size: 1.5rem; font-weight: 700; color: var(--danger); margin: 0 0 0.5rem 0;">
                    Yakin ingin menghapus akun?
                </h3>
                <p style="color: var(--text-light); margin: 0;">
                    Tindakan ini tidak dapat diurungkan. Semua data akan hilang selamanya.
                </p>
            </div>
        </div>

        <!-- Modal Form -->
        <form method="post" action="{{ route('profile.destroy') }}" style="margin-top: 1.5rem;">
            @csrf
            @method('delete')

            <!-- Password Field -->
            <div class="form-group" style="margin-bottom: 1.5rem;">
                <label class="form-label" for="password">Masukkan Password untuk Konfirmasi</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="form-input"
                    placeholder="Password Anda"
                    autofocus
                    required
                />
                @error('password', 'userDeletion')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            <!-- Modal Actions -->
            <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid var(--border-color);">
                <button
                    type="button"
                    class="btn btn-secondary"
                    x-on:click="$dispatch('close')"
                >
                    ❌ Batal
                </button>

                <button
                    type="submit"
                    class="btn btn-danger"
                >
                    🗑️ Hapus Permanen
                </button>
            </div>
        </form>
    </div>
</x-modal>
