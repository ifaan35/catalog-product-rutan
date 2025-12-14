# 🧪 Testing Guide - Manajemen Produk CRUD

## Pre-Test Setup

```bash
# Make sure database is migrated and seeded
php artisan migrate
php artisan db:seed

# Or if you want fresh database
php artisan migrate:fresh --seed
```

## Test Case 1: Admin Login & Dashboard Access

### Steps:
1. **Open browser** → http://localhost:8000
2. **Click Login** (pojok kanan atas)
3. **Enter credentials:**
   - Email: `admin@gmail.com` (or `admin@rutaroshop.com`)
   - Password: (password untuk admin@gmail.com or `admin123` untuk admin@rutaroshop.com)
4. **Click "Log in"**

### Expected Results:
- ✅ Redirect ke `/admin/dashboard`
- ✅ See dashboard with stats (Pesanan Menunggu, Total Penjualan, etc.)
- ✅ Navigation bar shows user email in dropdown

### Status: [ ] Pass / [ ] Fail

---

## Test Case 2: Access Products Management Page

### Steps:
1. **From Dashboard**, scroll down or look for "Manajemen Produk" link
2. **Click "Manajemen Produk"** or navigate to `/admin/products`
3. **Should see list of existing products**

### Expected Results:
- ✅ URL: `http://localhost:8000/admin/products`
- ✅ Table shows columns: Gambar, Nama Produk, Harga, Stok, Aksi
- ✅ Pagination shows at bottom
- ✅ Button "+ Tambah Produk Baru" visible at top right
- ✅ Edit & Hapus buttons for each product

### Status: [ ] Pass / [ ] Fail

---

## Test Case 3: Create New Product (Without Image)

### Steps:
1. Click **"+ Tambah Produk Baru"**
2. Fill form:
   ```
   Nama Produk: Sabun Batik Organik
   Deskripsi: Sabun tradisional dari kayu randu dan lilin tawon asli
   Kategori: Pertanian (or other)
   Harga: 25000
   Stok: 50
   Gambar: (leave empty)
   ```
3. Click **"Simpan Produk"**

### Expected Results:
- ✅ Redirect to `/admin/products`
- ✅ Success message: "Produk baru berhasil ditambahkan!"
- ✅ New product appears in table
- ✅ "No Image" placeholder shown in Gambar column

### Status: [ ] Pass / [ ] Fail

---

## Test Case 4: Create New Product (With Image)

### Steps:
1. Click **"+ Tambah Produk Baru"**
2. Fill form:
   ```
   Nama Produk: Ikan Nila Premium
   Deskripsi: Ikan nila segar hasil budidaya dengan kualitas terjamin
   Kategori: Perikanan
   Harga: 85000
   Stok: 30
   Gambar: (upload ikan.jpg or similar)
   ```
3. Click **"Simpan Produk"**

### Expected Results:
- ✅ Redirect to `/admin/products`
- ✅ Success message shown
- ✅ Product appears in table
- ✅ Image thumbnail visible in Gambar column
- ✅ File saved to `storage/app/public/products/`

### Verify Image:
```bash
ls -la storage/app/public/products/
# Should show the uploaded image file
```

### Status: [ ] Pass / [ ] Fail

---

## Test Case 5: Validate Image Upload Constraints

### Steps (Try uploading invalid file):
1. Go to `/admin/products/create`
2. Try upload file > 2MB (should fail)
3. Try upload non-image file like .txt or .pdf (should fail)

### Expected Results:
- ✅ Error message shows: "Gambar Saat Ini: image | max:2048"
- ✅ Form doesn't submit
- ✅ Error highlighted in red below image input

### Status: [ ] Pass / [ ] Fail

---

## Test Case 6: Validate Required Fields

### Steps:
1. Go to `/admin/products/create`
2. Try submit form with empty fields (name, price, stock)

### Expected Results:
- ✅ Error message for each required field
- ✅ Fields highlighted in red
- ✅ Form not submitted

### Errors should be:
- "Nama Produk is required"
- "Deskripsi is required"
- "Harga is required" (min 1000)
- "Stok is required"

### Status: [ ] Pass / [ ] Fail

---

## Test Case 7: Edit Product (Change Data Only)

### Steps:
1. Go to `/admin/products`
2. Find a product, click **"Edit"**
3. Change:
   ```
   Nama Produk: [Update nama ke versi baru]
   Harga: [Ubah harga]
   Stok: [Ubah stok]
   ```
4. Leave image empty (keep old image)
5. Click **"Perbarui Produk"**

### Expected Results:
- ✅ Redirect to `/admin/products`
- ✅ Success message: "Produk berhasil diperbarui!"
- ✅ Table shows updated data
- ✅ Old image still exists (not deleted)

### Status: [ ] Pass / [ ] Fail

---

## Test Case 8: Edit Product (Change Image)

### Steps:
1. Go to `/admin/products`
2. Find a product with image, click **"Edit"**
3. Current image preview shows
4. Upload new image (different file)
5. Click **"Perbarui Produk"**

### Expected Results:
- ✅ Redirect to `/admin/products`
- ✅ Success message shown
- ✅ New image displayed in thumbnail
- ✅ Old image file deleted from `storage/app/public/products/`
- ✅ New image file appears in storage

### Verify:
```bash
# Check storage folder - old image should be gone
ls -la storage/app/public/products/
```

### Status: [ ] Pass / [ ] Fail

---

## Test Case 9: Stock Indicator Color

### Steps:
1. Go to `/admin/products`
2. Look at Stok column

### Expected Results:
- ✅ Stock < 10 → **Red text** (warning)
- ✅ Stock ≥ 10 → **Green text** (normal)
- ✅ Example: "5" in red, "50" in green

### Status: [ ] Pass / [ ] Fail

---

## Test Case 10: Delete Product

### Steps:
1. Go to `/admin/products`
2. Find product to delete, click **"Hapus"**
3. Confirmation popup: "Yakin ingin menghapus [nama produk]?"
4. Click **"OK"**

### Expected Results:
- ✅ Redirect to `/admin/products`
- ✅ Success message: "Produk berhasil dihapus!"
- ✅ Product no longer in table
- ✅ Associated image deleted from storage

### Verify:
```bash
# Image should be removed
ls -la storage/app/public/products/
```

### Status: [ ] Pass / [ ] Fail

---

## Test Case 11: Cancel Delete

### Steps:
1. Go to `/admin/products`
2. Click **"Hapus"** on a product
3. Popup appears
4. Click **"Cancel"** (don't confirm)

### Expected Results:
- ✅ Popup closes
- ✅ Product still exists in table
- ✅ No deletion occurs

### Status: [ ] Pass / [ ] Fail

---

## Test Case 12: Pagination

### Steps:
1. If you have > 10 products, pagination should show
2. Go to `/admin/products`
3. Click next page button

### Expected Results:
- ✅ Pagination links visible (if > 10 products)
- ✅ Click next/previous navigates correctly
- ✅ URL changes to `?page=2`
- ✅ Different products displayed

### Status: [ ] Pass / [ ] Fail

---

## Test Case 13: Unauthorized Access (Non-Admin User)

### Steps:
1. Login with **regular user** (not admin)
2. Try access `/admin/products`

### Expected Results:
- ✅ Redirect to home (`/`)
- ✅ Error message: "Akses ditolak..." (if flash message shown)
- ✅ Regular user cannot see admin panel

### Status: [ ] Pass / [ ] Fail

---

## Test Case 14: Non-Authenticated Access

### Steps:
1. Logout first (clear session)
2. Try access `/admin/products` directly

### Expected Results:
- ✅ Redirect to login page
- ✅ Cannot access admin without login

### Status: [ ] Pass / [ ] Fail

---

## Test Case 15: Image Access via URL

### Steps:
1. Upload product with image
2. Note the filename (e.g., "123456789.jpg")
3. Visit: `http://localhost:8000/storage/products/123456789.jpg`

### Expected Results:
- ✅ Image displays correctly
- ✅ Symbolic link working properly
- ✅ Image accessible from public folder

### Status: [ ] Pass / [ ] Fail

---

## Test Case 16: Form Component Reusability

### Steps:
1. Go to `/admin/products/create` (Create form)
2. Check form fields
3. Go to `/admin/products/{id}/edit` (Edit form)
4. Check form fields

### Expected Results:
- ✅ Create and Edit use same form component
- ✅ Fields identical (name, description, category, price, stock, image)
- ✅ Difference: Edit shows current image preview

### Status: [ ] Pass / [ ] Fail

---

## Test Case 17: Category Integration

### Steps:
1. Go to `/admin/products/create`
2. Click Category dropdown

### Expected Results:
- ✅ Dropdown shows all categories
- ✅ Can select category (optional - can leave empty)
- ✅ Selected category saves with product

### Status: [ ] Pass / [ ] Fail

---

## Test Case 18: Success Flash Messages

### Test all CRUD operations and verify flash messages:

| Operation | Message |
|-----------|---------|
| Create | "Produk baru berhasil ditambahkan!" |
| Update | "Produk berhasil diperbarui!" |
| Delete | "Produk berhasil dihapus!" |

### Expected Results:
- ✅ Green success box shows after each operation
- ✅ Message disappears after page reload or timeout
- ✅ Message contains correct operation text

### Status: [ ] Pass / [ ] Fail

---

## Test Case 19: Error Message Display

### Steps:
1. Try create with price < 1000
2. Try create with empty name/description
3. Try upload file > 2MB

### Expected Results:
- ✅ Error messages show in red below fields
- ✅ Form stays on current page (doesn't submit)
- ✅ User data preserved in form (except files)

### Status: [ ] Pass / [ ] Fail

---

## Test Case 20: Responsive Design

### Steps:
1. Open admin products page on:
   - Desktop (full width)
   - Tablet (iPad size)
   - Mobile (smartphone)

### Expected Results:
- ✅ Desktop: Full table layout
- ✅ Tablet: Table responsive with horizontal scroll if needed
- ✅ Mobile: Table might stack or show minimized version
- ✅ Buttons and inputs readable on all sizes
- ✅ Navigation accessible on mobile

### Status: [ ] Pass / [ ] Fail

---

## Database Verification

### Check Products Table:
```bash
# Connect to database and run:
# SELECT * FROM products LIMIT 5;

# Or via artisan:
php artisan tinker
> Product::with('category')->limit(5)->get()
```

### Expected Results:
- ✅ Products exist in database
- ✅ Fields: id, name, description, price, stock, image, category_id
- ✅ category_id correctly references categories table
- ✅ Timestamps: created_at, updated_at present

---

## File System Verification

### Check Storage:
```bash
# Windows PowerShell:
Get-ChildItem -Path "storage/app/public/products" -Force

# Should show uploaded images
```

### Expected Results:
- ✅ Folder exists: `storage/app/public/products/`
- ✅ Uploaded images stored here
- ✅ Deleted images removed from folder
- ✅ Symbolic link: `public/storage` → `storage/app/public`

---

## Summary Checklist

- [ ] Test 1-20 all passed
- [ ] Database verification successful
- [ ] File system verification successful
- [ ] No console errors (F12)
- [ ] No Laravel errors in logs
- [ ] All CRUD operations working
- [ ] Image handling working correctly
- [ ] Authorization/Authentication working
- [ ] UI responsive on all devices
- [ ] Flash messages displaying correctly

---

## Rollback If Issues Found

```bash
# If need to rollback:
php artisan migrate:rollback --step=1

# Or reset completely:
php artisan migrate:fresh --seed
```

---

## Notes:

- Default admin credentials:
  - Email: `admin@gmail.com` or `admin@rutaroshop.com`
  - Password: (created password or `admin123`)

- All routes require: `['auth', 'admin']` middleware
- Middleware checks: `Auth::check() && Auth::user()->role === 'admin'`
- Storage link must exist: `php artisan storage:link`

---

## Questions?

Refer to:
- CRUD_IMPLEMENTATION.md (detailed documentation)
- ADMIN_GUIDE.md (user guide)
- Laravel logs: `storage/logs/laravel-*.log`
- Browser console (F12) for JavaScript errors
