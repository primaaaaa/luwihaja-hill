<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    protected $table = 'ulasan';
    protected $primaryKey = 'id_ulasan';
    public $timestamps = true;

     protected $fillable = [
        'id_reservasi',
        'id_user',
        'rating',
        'isi_ulasan',
        'tgl_ulasan',
    ];

    protected $casts = [
        'rating' => 'decimal:1',
        'tgl_ulasan' => 'date',
    ];

   public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'id_reservasi', 'id_reservasi');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
