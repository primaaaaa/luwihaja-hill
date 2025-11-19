<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    protected $table = 'refund';
    protected $primaryKey = 'id_refund';
    public $timestamps = true;

    protected $fillable = [
        'kode_refund',
        'id_reservasi',
        'tgl_pengajuan',
        'alasan_refund',
        'nominal_refund',
        'bukti_pendukung',
        'nama_bank_tujuan',
        'norek_tujuan',
        'pemilik_tujuan',
        'status',
    ];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'id_reservasi', 'id_reservasi');
    }
}
