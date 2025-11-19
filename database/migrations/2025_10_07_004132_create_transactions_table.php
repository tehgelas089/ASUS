<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            // ✅ perbaikan di sini
            $table->foreignId('product_id')
                ->nullable() // harus diletakkan sebelum constrained()
                ->constrained('products')
                ->onDelete('set null');
            $table->string('product_name');
            $table->integer('price');
            $table->integer('money_received');
            $table->integer('change');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
