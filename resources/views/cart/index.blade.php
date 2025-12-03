{{-- resources/views/cart/index.blade.php --}}

<x-app-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-8" style="background-color: #DFE1E3;">
        {{-- Tampilkan Notifikasi Sukses/Error --}}
        @if(session('success'))
            <div class="border-l-4 p-4 mb-4 rounded-md" style="background-color: #d4edda; border-color: #28a745; color: #155724;">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="border-l-4 p-4 mb-4 rounded-md" style="background-color: #f8d7da; border-color: #dc3545; color: #721c24;">{{ session('error') }}</div>
        @endif
        
        <h1 class="text-3xl font-bold mb-8" style="color: #072138;">Keranjang Belanja Anda</h1>

        @if(empty($cartItems))
            <div class="border-l-4 p-4 rounded-md" role="alert" style="background-color: #fff3cd; border-color: #F3C32A; color: #856404;">
                <p class="font-bold">Keranjang Kosong</p>
                <p>Silakan jelajahi produk kami dan tambahkan item untuk memulai belanja.</p>
                <a href="{{ route('home') }}" class="hover:underline mt-2 inline-block" style="color: #072138;">Kembali ke Home</a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                {{-- KOLOM KIRI: Daftar Item Keranjang --}}
                <div class="lg:col-span-2 space-y-4">
                    @foreach ($cartItems as $cartKey => $item)
                        <div class="flex flex-col md:flex-row items-start md:items-center bg-white p-4 rounded-lg shadow-md gap-4">
                            <div class="w-16 h-16 rounded-lg overflow-hidden flex-shrink-0" style="background-color: #DFE1E3;">
                                @if($item['image'])
                                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color: #072138; opacity: 0.5;">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            
                            <div class="flex-grow">
                                <h2 class="font-semibold" style="color: #072138;">{{ $item['name'] }}</h2>
                                <p class="text-sm" style="color: #072138; opacity: 0.6;">Ukuran: {{ $item['size'] }}</p>
                                <p class="text-sm" style="color: #F3C32A;">Harga Satuan: Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                            </div>
                            
                            <div class="flex flex-col md:flex-row items-center gap-4">
                                
                                {{-- FORM UPDATE KUANTITAS --}}
                                <form action="{{ route('cart.update') }}" method="POST" class="flex items-center space-x-2">
                                    @csrf
                                    <input type="hidden" name="cart_key" value="{{ $cartKey }}">
                                    <label class="text-sm font-medium" style="color: #072138;">Qty:</label>
                                    <input type="number" 
                                           name="quantity" 
                                           value="{{ $item['quantity'] }}" 
                                           min="1" 
                                           class="border rounded-md px-2 py-1 w-16 text-center focus:outline-none focus:ring-2"
                                           style="border-color: #DFE1E3; focus:ring-color: #F3C32A;"
                                           onchange="this.form.submit()">
                                </form>

                                <span class="text-lg font-extrabold" style="color: #F3C32A;">
                                    Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}
                                </span>
                                
                                {{-- TOMBOL HAPUS --}}
                                <form action="{{ route('cart.destroy') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="cart_key" value="{{ $cartKey }}">
                                    <button type="submit" class="text-red-500 hover:text-red-700 transition duration-150 p-1" title="Hapus Item">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- KOLOM KANAN: Ringkasan Total --}}
                <div class="bg-white p-6 rounded-lg shadow-xl h-fit">
                    <h2 class="text-xl font-bold border-b pb-3 mb-3" style="color: #072138; border-color: #DFE1E3;">Ringkasan Pesanan</h2>
                    <div class="flex justify-between mb-2" style="color: #072138; opacity: 0.7;">
                        <span>Subtotal:</span>
                        <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between mb-4 border-b pb-4" style="color: #072138; opacity: 0.7; border-color: #DFE1E3;">
                        <span>Estimasi Pengiriman:</span>
                        <span>Rp 0 (Gratis)</span>
                    </div>
                    <div class="flex justify-between text-2xl font-extrabold" style="color: #072138;">
                        <span>Total:</span>
                        <span style="color: #F3C32A;">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    
                    <a href="{{ route('checkout.index') }}" class="block w-full text-center font-bold py-3 rounded-lg mt-6 transition duration-300 hover:opacity-90" style="background-color: #F3C32A; color: #072138;">
                        🔒 PROCEED TO CHECKOUT
                    </a>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>