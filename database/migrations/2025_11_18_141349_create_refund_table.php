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
        Schema::create('refund', function (Blueprint $table) {
            $table->id('id_refund'); // PK int(11)

            $table->string('kode_refund', 10); // RF101

            $table->unsignedBigInteger('id_reservasi');
            $table->foreign('id_reservasi')
                ->references('id_reservasi')
                ->on('reservasi')
                ->onDelete('cascade');

            $table->date('tgl_pengajuan'); 

            $table->text('alasan_refund')->nullable(); 
            $table->decimal('nominal_refund', 10, 2); 

            $table->string('bukti_pendukung', 255)->nullable(); 

            $table->string('nama_bank_tujuan', 50)->nullable();
            $table->string('norek_tujuan', 30)->nullable(); 
            $table->string('pemilik_tujuan', 100)->nullable();

            $table->enum('status', [
                'Menunggu',
                'Disetujui',
                'Ditolak',
                'Dibayar'
            ])->default('Menunggu');

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('refund');
    }
};
