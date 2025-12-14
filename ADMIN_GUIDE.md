# 🎯 Quick Start Guide - Admin Panel RUTARO SHOP

## Login Admin

### Opsi 1: Gunakan Akun Yang Sudah Dibuat
- **Email**: `admin@gmail.com`
- **Password**: (Password yang Anda buat saat registrasi)

### Opsi 2: Gunakan Seeder Credentials
- **Email**: `admin@rutaroshop.com`
- **Password**: `admin123`

## Akses Admin Panel

1. **Buka Browser**: http://localhost:8000
2. **Klik Login** (pojok kanan atas)
3. **Masukkan Email & Password**
4. **Klik Login**
5. **Redirect otomatis ke**: http://localhost:8000/admin/dashboard

---

## 📊 Admin Dashboard

Setelah login, Anda akan melihat dashboard dengan:
- 📦 **Pesanan Menunggu**: Jumlah pesanan yang perlu diproses
- 💰 **Total Penjualan**: Total penjualan produk yang delivered
- 📋 **Pesanan Terbaru**: 5 pesanan terakhir dari customer
- 🏪 **Total Produk**: Jumlah produk di toko

---

## 📦 Manajemen Produk

### Akses Menu Manajemen Produk
1. Dari Dashboard, cari menu **"Manajemen Produk"** (atau klik link di sidebar)
2. URL: http://localhost:8000/admin/products

### Tampilan List Produk
Anda akan melihat tabel dengan kolom:
- **Gambar**: Thumbnail gambar produk
- **Nama Produk**: Nama dari produk
- **Harga**: Harga dalam Rupiah
- **Stok**: Jumlah stok (merah jika < 10, hijau jika ≥ 10)
- **Aksi**: Tombol Edit & Hapus

### ➕ Tambah Produk Baru

**Langkah-langkah:**
1. Klik tombol **"+ Tambah Produk Baru"** (pojok kanan atas)
2. URL: http://localhost:8000/admin/products/create

**Form yang perlu diisi:**
```
┌─────────────────────────────────┐
│ Nama Produk *                   │ (contoh: Telur Ayam Organik)
├─────────────────────────────────┤
│ Deskripsi Produk *              │ (contoh: Telur segar dari ayam...)
├─────────────────────────────────┤
│ Kategori                        │ [Pilih dari dropdown ▼]
├──────────────────┬──────────────┤
│ Harga (Rp) *     │ Stok *       │ (contoh: 25000 | 100)
├─────────────────────────────────┤
│ Gambar Produk    │ [Browse...]  │ (Opsional, max 2MB)
└─────────────────────────────────┘
        [Batal]  [Simpan Produk]
```

**Contoh pengisian:**
| Field | Isi |
|-------|-----|
| Nama Produk | Ikan Nila Segar |
| Deskripsi | Ikan nila berkualitas premium, segar, dari peternakan terpercaya |
| Kategori | Perikanan |
| Harga | 75000 |
| Stok | 50 |
| Gambar | ikan.jpg |

3. Klik **"Simpan Produk"**
4. Akan redirect ke list produk dengan notifikasi "Produk baru berhasil ditambahkan!"

---

### ✏️ Edit Produk

**Langkah-langkah:**
1. Di list produk, klik tombol **"Edit"** pada produk yang ingin diubah
2. URL: http://localhost:8000/admin/products/{id}/edit

**Pilihan:**
- **Edit Data**: Ubah nama, deskripsi, kategori, harga, stok
- **Ganti Gambar**: Upload gambar baru (gambar lama otomatis dihapus)
- **Tetap Gunakan Gambar Lama**: Jangan upload file baru

3. Klik **"Perbarui Produk"**
4. Akan redirect ke list produk dengan notifikasi "Produk berhasil diperbarui!"

**Preview Gambar Saat Ini:**
Jika produk sudah punya gambar, akan ditampilkan preview di bawah input file.

---

### 🗑️ Hapus Produk

**Langkah-langkah:**
1. Di list produk, klik tombol **"Hapus"** pada produk yang ingin dihapus
2. Pop-up konfirmasi akan muncul: "Yakin ingin menghapus {nama produk}?"
3. Klik **"OK"** untuk konfirmasi atau **"Batal"** untuk membatalkan
4. Produk dan gambar terkait akan dihapus
5. Akan redirect ke list produk dengan notifikasi "Produk berhasil dihapus!"

---

## 📋 Manajemen Pesanan

Dari admin panel, Anda juga bisa:
1. **Lihat Pesanan**: http://localhost:8000/admin/orders
2. **Detail Pesanan**: http://localhost:8000/admin/orders/{id}
3. **Update Status Pesanan**: Ubah status menjadi:
   - ⏳ **Pending** (Menunggu Konfirmasi)
   - 📦 **Processing** (Sedang Diproses)
   - 🚚 **Shipped** (Dalam Pengiriman)
   - ✅ **Delivered** (Telah Diterima)

---

## 🎨 UI Warna & Styling

**Palet Warna:**
- 🟦 **Navy** (#072138) - Warna utama
- 🟨 **Gold** (#F3C32A) - Warna aksen (tombol, highlight)
- 🔘 **Gray** (#DFE1E3) - Border, divider
- 🔴 **Red** (#EF4444) - Warning, delete
- 🟢 **Green** (#10B981) - Success

**Responsif:**
- ✅ Mobile-friendly (smartphone)
- ✅ Tablet-friendly (iPad)
- ✅ Desktop-friendly (monitor lebar)

---

## ⚠️ Penting!

### File Upload
- **Format**: JPG, JPEG, PNG
- **Ukuran Max**: 2 MB
- **Lokasi**: `/storage/products/`
- **URL Akses**: `/storage/products/{filename}`

### Validasi
- **Nama Produk**: Maksimal 255 karakter (wajib diisi)
- **Deskripsi**: Wajib diisi
- **Harga**: Minimal Rp 1.000 (wajib diisi)
- **Stok**: 0 atau lebih (wajib diisi)
- **Kategori**: Opsional (bisa tidak dipilih)
- **Gambar**: Opsional (bisa tidak diupload)

---

## 🔐 Keamanan

✅ **Login Required**: Hanya user yang login bisa akses admin
✅ **Role-Based**: Hanya user dengan role 'admin' yang bisa akses
✅ **CSRF Protection**: Semua form terlindungi dari CSRF attack
✅ **File Validation**: File divalidasi sebelum disimpan
✅ **Auto Delete**: Gambar lama otomatis dihapus saat update

---

## 🆘 Troubleshooting

### Q: Login gagal?
**A**: 
- Pastikan email dan password benar
- Cek apakah user sudah terdaftar di database
- Jika lupa password, gunakan credentials seeder: admin@rutaroshop.com / admin123

### Q: Akses `/admin` ditolak?
**A**:
- Pastikan Anda sudah login
- Pastikan user Anda punya role='admin'
- Check di database: `SELECT email, role FROM users;`

### Q: Upload gambar gagal?
**A**:
- Verifikasi ukuran file < 2MB
- Pastikan format file: JPG, JPEG, atau PNG
- Check folder permissions: `chmod 777 storage/app/public`

### Q: Gambar tidak muncul?
**A**:
- Verifikasi symbolic link: `public/storage` harus ada
- Run: `php artisan storage:link`
- Clear cache: `php artisan cache:clear`

---

## 📞 Support

Jika menemukan issue atau error:
1. Check error message di form
2. Cek Laravel logs: `storage/logs/laravel-*.log`
3. Open browser console (F12) cek console errors
4. Reset database jika perlu: `php artisan migrate:fresh --seed`

---

## 🎉 Selamat!

Anda siap mengelola produk di **RUTARO SHOP** Admin Panel! 🚀

**Fitur yang tersedia:**
- ✅ Tambah Produk
- ✅ Lihat Daftar Produk
- ✅ Edit Produk & Gambar
- ✅ Hapus Produk
- ✅ Kelola Pesanan
- ✅ Update Status Pesanan
