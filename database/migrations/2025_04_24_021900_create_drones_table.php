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
        // Membuat tabel drone_merks
        Schema::create('drone_merks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_merk')->unique(); // nama merk drone
            $table->timestamps();
        });

        // Membuat tabel drone
        Schema::create('drones', function (Blueprint $table) {
            $table->id();
            $table->string('nama_drone');
            $table->string('gambar')->nullable(); // path file gambar, bisa null
            $table->date('tanggal_pengadaan');
            $table->decimal('harga', 12, 2);
            $table->boolean('keterangan')->default(false);
            $table->unsignedBigInteger('merk_id');
            $table->foreign('merk_id')->references('id')->on('drone_merks')->onDelete('cascade');
            $table->timestamps(); //created_at dan update_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Menghapus tabel drones
        Schema::dropIfExists('drones');

        // Menghapus tabel drone_merks
        Schema::dropIfExists('drone_merks');
    }
};
