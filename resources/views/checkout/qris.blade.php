{{-- resources/views/checkout/qris.blade.php --}}

<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12" style="background-color: #F5F6F8; min-height: 100vh;">
        <!-- QRIS Payment Card -->
        <div class="card rounded-lg p-8 shadow-lg" style="background-color: #FFFFFF;">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold mb-2" style="color: #07213C;">Pembayaran QRIS</h1>
                <p class="text-lg" style="color: #6B7280;">Silakan scan QRIS di bawah untuk melakukan pembayaran</p>
            </div>

            <!-- Order Summary -->
            <div class="mb-8 pb-8 border-b" style="border-color: #E1E2E4;">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm font-semibold mb-1" style="color: #6B7280;">NOMOR PESANAN</p>
                        <p class="text-xl font-bold" style="color: #07213C;">{{ $order->order_number }}</p>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-semibold mb-1" style="color: #6B7280;">TOTAL PEMBAYARAN</p>
                        <p class="text-2xl font-bold" style="color: #ECBF62;">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                    </div>
                </div>
            </div>

            <!-- QRIS Code -->
            <div class="mb-8 text-center">
                <div class="inline-block p-6 rounded-lg" style="background-color: #F5F6F8;">
                    <img src="{{ asset('images/qris/qris.jpeg') }}" alt="QRIS Code" class="max-w-sm w-full h-auto mx-auto rounded-lg shadow-md">
                </div>
                <p class="mt-4 text-sm" style="color: #6B7280;">Scan kode QRIS di atas menggunakan aplikasi mobile banking atau e-wallet Anda</p>
            </div>

            <!-- Upload Payment Proof Form -->
            <div class="border-t pt-8" style="border-color: #E1E2E4;">
                <h3 class="text-xl font-bold mb-4" style="color: #07213C;">Upload Bukti Pembayaran</h3>
                <p class="mb-4" style="color: #6B7280;">Setelah melakukan pembayaran, silakan upload bukti transfer/screenshot pembayaran Anda</p>
                
                <form id="payment-proof-form" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-6">
                        <label class="block mb-2 font-medium" style="color: #07213C;">Bukti Pembayaran (JPG, PNG, max 2MB)</label>
                        <input type="file" name="payment_proof" id="payment_proof" accept="image/*" required class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2" style="border-color: #E1E2E4; color: #07213C;">
                        <div id="image-preview" class="mt-4 hidden">
                            <img id="preview-img" class="max-w-xs rounded-lg shadow-md" alt="Preview">
                        </div>
                    </div>

                    <div id="upload-error" class="mb-4 hidden p-4 rounded-lg" style="background-color: #FEE2E2; color: #991B1B;">
                        <p id="error-message"></p>
                    </div>

                    <div class="flex gap-4">
                        <button type="submit" id="upload-btn" class="flex-1 font-bold py-3 px-6 rounded-lg transition duration-300" style="background-color: #ECBF62; color: #07213C;">
                            <span id="upload-btn-text">Upload Bukti Pembayaran</span>
                            <span id="upload-btn-loading" class="hidden">
                                <svg class="animate-spin h-5 w-5 inline-block mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Mengupload...
                            </span>
                        </button>
                        <a href="{{ route('checkout.history') }}" class="flex-1 text-center font-bold py-3 px-6 rounded-lg transition duration-300" style="background-color: #07213C; color: #FFFFFF;">
                            Lihat Riwayat Pesanan
                        </a>
                    </div>
                </form>
            </div>

            <!-- Order Items -->
            <div class="mt-8 pt-8 border-t" style="border-color: #E1E2E4;">
                <h3 class="text-lg font-bold mb-4" style="color: #07213C;">Detail Pesanan</h3>
                <div class="space-y-3">
                    @foreach($order->orderItems as $item)
                    <div class="flex justify-between items-center py-2">
                        <div>
                            <p class="font-semibold" style="color: #07213C;">{{ $item->product_name }}</p>
                            <p class="text-sm" style="color: #6B7280;">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                        </div>
                        <p class="font-bold" style="color: #07213C;">Rp {{ number_format($item->quantity * $item->price, 0, ',', '.') }}</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <script>
        // Image Preview
        document.getElementById('payment_proof').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('preview-img').src = e.target.result;
                    document.getElementById('image-preview').classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });

        // Form Submission
        document.getElementById('payment-proof-form').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const uploadBtn = document.getElementById('upload-btn');
            const uploadBtnText = document.getElementById('upload-btn-text');
            const uploadBtnLoading = document.getElementById('upload-btn-loading');
            const errorDiv = document.getElementById('upload-error');
            const errorMsg = document.getElementById('error-message');
            
            // Hide error
            errorDiv.classList.add('hidden');
            
            // Validate file
            const fileInput = document.getElementById('payment_proof');
            if (!fileInput.files[0]) {
                errorMsg.textContent = 'Silakan pilih file bukti pembayaran';
                errorDiv.classList.remove('hidden');
                return;
            }
            
            // Check file size (max 2MB)
            if (fileInput.files[0].size > 2048 * 1024) {
                errorMsg.textContent = 'Ukuran file maksimal 2MB';
                errorDiv.classList.remove('hidden');
                return;
            }
            
            // Disable button and show loading
            uploadBtn.disabled = true;
            uploadBtnText.classList.add('hidden');
            uploadBtnLoading.classList.remove('hidden');
            
            try {
                const formData = new FormData();
                formData.append('payment_proof', fileInput.files[0]);
                formData.append('_token', '{{ csrf_token() }}');
                
                const response = await fetch('{{ route("checkout.upload-payment", $order->id) }}', {
                    method: 'POST',
                    body: formData
                });
                
                const data = await response.json();
                
                if (data.success) {
                    // Redirect to success page
                    window.location.href = data.redirect_url;
                } else {
                    throw new Error(data.message || 'Terjadi kesalahan');
                }
            } catch (error) {
                console.error('Upload error:', error);
                errorMsg.textContent = error.message || 'Gagal mengupload bukti pembayaran';
                errorDiv.classList.remove('hidden');
                
                // Re-enable button
                uploadBtn.disabled = false;
                uploadBtnText.classList.remove('hidden');
                uploadBtnLoading.classList.add('hidden');
            }
        });
    </script>
</x-app-layout>
