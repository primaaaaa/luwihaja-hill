<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran');

            // FK ke reservasi
            $table->unsignedBigInteger('id_reservasi');
            $table->foreign('id_reservasi')->references('id_reservasi')->on('reservasi')->onDelete('cascade');

            $table->string('kode_pembayaran', 10)->unique();
            $table->date('tgl_pembayaran')->nullable();

            $table->string('bukti_pembayaran', 255)->nullable();

            $table->string('nomor_rekening', 30)->nullable();
            $table->string('nama_pemilik', 100)->nullable();
            $table->string('nama_bank', 50)->nullable();

            $table->enum('metode_pembayaran', [
                'Transfer Bank',
                'Kartu Kredit',
                'E-Wallet'
            ]);

            $table->enum('status', [
                'Menunggu',
                'Lunas',
                'Batal'
            ])->default('Menunggu');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
