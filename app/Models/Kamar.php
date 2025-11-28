<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Kamar extends Model
{
    protected $table = 'tipe_villa';
    protected $primaryKey = 'id_tipe_villa';
    
    protected $fillable = [
        'kode_tipe',
        'nama_unit',
        'kapasitas',
        'kategori',
        'deskripsi',
        'harga_weekday',
        'harga_weekend',
        'foto_kamar',
        'status'
    ];

    public function reservasi()
    {
        return $this->hasMany(Reservasi::class, 'id_tipe_villa', 'id_tipe_villa');
    }

    public function reservasiAktif()
    {
        return $this->hasMany(Reservasi::class, 'id_tipe_villa', 'id_tipe_villa')
                    ->whereIn('status', ['Menunggu', 'Dikonfirmasi']);
    }


    public function getFormattedHargaWeekdayAttribute()
    {
        return 'Rp ' . number_format($this->harga_weekday, 0, ',', '.');
    }


    public function getFormattedHargaWeekendAttribute()
    {
        return 'Rp ' . number_format($this->harga_weekend, 0, ',', '.');
    }
}