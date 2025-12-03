<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Cek apakah kolom category_id sudah ada
            if (!Schema::hasColumn('products', 'category_id')) {
                // Tambahkan kolom category_id dan buat foreign key
                $table->foreignId('category_id')->nullable()->after('id')->constrained()->onDelete('set null');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            // Drop foreign key dan kolomnya
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};
