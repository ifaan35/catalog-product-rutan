<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Add hierarchical address columns
            $table->string('province_id')->nullable();
            $table->string('province_name')->nullable();
            $table->string('regency_id')->nullable();
            $table->string('regency_name')->nullable();
            $table->string('district_id')->nullable();
            $table->string('district_name')->nullable();
            $table->string('village_id')->nullable();
            $table->string('village_name')->nullable();
            $table->text('detail_address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'province_id', 'province_name',
                'regency_id', 'regency_name',
                'district_id', 'district_name',
                'village_id', 'village_name',
                'detail_address'
            ]);
        });
    }
};
