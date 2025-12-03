<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Pastikan ada user untuk testing
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Test User',
                'email' => 'test@rutanshop.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]);
        }

        // Ambil beberapa produk
        $products = Product::take(4)->get();

        // Buat 3 sample order
        for ($i = 1; $i <= 3; $i++) {
            $order = Order::create([
                'order_number' => 'ORD-' . date('Ymd') . '-' . str_pad($i, 3, '0', STR_PAD_LEFT),
                'user_id' => $user->id,
                'recipient_name' => 'John Doe',
                'phone_number' => '08123456789' . $i,
                'address' => 'Jl. Contoh No. ' . $i . ', Jakarta Selatan',
                'total_amount' => 0, // Will be calculated
                'status' => ['pending', 'processing', 'delivered'][($i - 1) % 3],
                'payment_status' => 'paid',
                'created_at' => now()->subDays($i),
                'updated_at' => now()->subDays($i),
            ]);

            $totalAmount = 0;
            // Tambahkan 2-3 item per order
            for ($j = 0; $j < rand(2, 3); $j++) {
                $product = $products->random();
                $quantity = rand(1, 3);
                $itemTotal = $product->price * $quantity;
                
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'quantity' => $quantity,
                    'price' => $product->price,
                ]);

                $totalAmount += $itemTotal;
            }

            // Update total amount
            $order->update(['total_amount' => $totalAmount]);
        }
    }
}
