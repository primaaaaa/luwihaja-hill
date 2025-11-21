<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';
    protected $primaryKey = 'id_pembayaran';

    protected $fillable = [
        'id_reservasi',
        'kode_pembayaran',
        'tgl_pembayaran',
        'bukti_pembayaran',
        'nomor_rekening',
        'nama_pemilik',
        'nama_bank',
        'metode_pembayaran',
        'status',
    ];

    protected $casts = [
        'tgl_pembayaran' => 'date',
    ];

    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'id_reservasi', 'id_reservasi');
    }

    public function refund()
    {
        return $this->hasOne(Refund::class, 'id_reservasi', 'id_reservasi');
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'Menunggu' => 'warning',
            'Lunas' => 'success',
            'Batal' => 'danger',
        ];

        return $badges[$this->status] ?? 'secondary';
    }
}
