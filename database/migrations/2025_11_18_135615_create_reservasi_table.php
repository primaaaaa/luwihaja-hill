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
        Schema::create('reservasi', function (Blueprint $table) {
            $table->id('id_reservasi');
            $table->string('kode_reservasi', 10)->unique();
            // Foreign key ke users
            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');

            // Foreign key ke tipe villa
            $table->unsignedBigInteger('id_tipe_villa');
            $table->foreign('id_tipe_villa')->references('id_tipe_villa')->on('tipe_villa')->onDelete('cascade');

            $table->date('tgl_checkin');
            $table->date('tgl_checkout');

            $table->decimal('total_harga', 10, 2);

            $table->enum('status', ['Menunggu', 'Dikonfirmasi', 'Selesai', 'Dibatalkan'])
                ->default('Menunggu');

            $table->timestamp('tgl_reservasi')->useCurrent(); // default CURRENT_TIMESTAMP
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reservasi');
    }
};
