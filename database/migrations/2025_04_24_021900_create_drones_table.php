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
        Schema::create('drones', function (Blueprint $table) {
            $table->id();
            $table->string('nama_drone');
            $table->string('gambar')->nullable(); // path file gambar, bisa null
            $table->date('tanggal_pengadaan');
            $table->decimal('harga', 12, 2);
            $table->enum('keterangan', ['bagus', 'rusak']);
            $table->timestamps(); //created_at dan update_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drones');
    }
};
