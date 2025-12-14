<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;

class ShowProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:show';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Tampilkan daftar produk RUTARO SHOP';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info('=== RUTARO SHOP PRODUCTS ===');
        $this->line('');

        $products = Product::orderBy('name')->get();
        
        $this->info('Total Produk: ' . $products->count());
        $this->line('');

        foreach ($products as $product) {
            $trending = $product->is_trending ? ' [TRENDING]' : '';
            $this->line('• ' . $product->name . $trending);
            $this->line('  Harga: Rp ' . number_format($product->price, 0, ',', '.'));
            $this->line('  Kategori: ' . $product->category);
            $this->line('  Stok: ' . $product->stock . ' unit');
            $this->line('');
        }

        return Command::SUCCESS;
    }
}
