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
        Schema::create('villa_types', function (Blueprint $table) {
            $table->id();
            
            $table->string('name');
            $table->string('main_image')->nullable();
            $table->integer('quantity');

            $table->decimal('price_per_night', 10, 2);

            $table->integer('capacity');
            $table->text('description')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('villa_types');
    }
};
