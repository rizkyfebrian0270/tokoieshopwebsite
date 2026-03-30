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
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->foreignId('categories_id')->constrained(); // Sesuai query-mu
        $table->string('nama');
        $table->integer('harga');
        
        // Tambahkan ->nullable() pada kolom yang boleh dikosongkan saat input
        $table->string('ukuran')->nullable();
        $table->string('warna')->nullable();
        $table->text('detail')->nullable(); // <--- INI KUNCI UTAMANYA
        $table->string('foto')->nullable();
        
        $table->string('ketersediaan_stok')->default('tersedia');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
