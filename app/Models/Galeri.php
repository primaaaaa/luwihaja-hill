<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Galeri extends Model
{
    protected $table = 'galeri';
    protected $primaryKey = 'id_galeri';
    public $timestamps = false;

    protected $fillable = [
        'kode_galeri',
        'file',
        'tgl_upload'
    ];

    protected $casts = [
        'tgl_upload' => 'date'
    ];
}