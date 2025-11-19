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
        Schema::create('tipe_villa', function (Blueprint $table) {
            $table->id('id_tipe_villa'); // Primary Key, Auto Increment
            $table->string('kode_tipe', 10)->unique();            $table->string('nama_unit', 100);
            $table->integer('kapasitas')->length(2);
            $table->string('kategori', 50);
            $table->text('deskripsi')->nullable();
            $table->decimal('harga_weekday', 10, 2);
            $table->decimal('harga_weekend', 10, 2);
            $table->string('foto_kamar', 255)->nullable();
            $table->enum('status', ['Tersedia', 'Terisi', 'Dipesan', 'Nonaktif'])->default('Tersedia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tipe_villa');
    }
};
