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
        Schema::create('ulasan', function (Blueprint $table) {
            $table->id('id_ulasan'); // PK int(11)

            $table->unsignedBigInteger('id_reservasi');
            $table->foreign('id_reservasi')
                ->references('id_reservasi')
                ->on('reservasi')
                ->onDelete('cascade');

            $table->unsignedBigInteger('id_user');
            $table->foreign('id_user')
                ->references('id_user')
                ->on('users')
                ->onDelete('cascade');

            $table->decimal('rating', 2, 1); 

            $table->text('isi_ulasan')->nullable();

            $table->date('tgl_ulasan'); 
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ulasan');
    }
};
