<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("
            ALTER TABLE refund 
            MODIFY COLUMN status ENUM('Menunggu','Disetujui','Ditolak','Dibayar') 
            NOT NULL DEFAULT 'Menunggu'
        ");
    }

    public function down(): void
    {
        DB::statement("
            ALTER TABLE refund 
            MODIFY COLUMN status ENUM('Menunggu','Disetujui','Ditolak') 
            NOT NULL DEFAULT 'Menunggu'
        ");
    }
};
