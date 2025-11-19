<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGaleriTable extends Migration
{
    public function up()
    {
        Schema::create('galeri', function (Blueprint $table) {
            $table->increments('id_galeri');                 
            $table->string('kode_galeri', 10);              
            $table->string('file', 255);                     
            $table->date('tgl_upload');                     
        });
    }

    public function down()
    {
        Schema::dropIfExists('galeri');
    }
}

