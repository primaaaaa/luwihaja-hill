<?php

namespace App\Models;

use App\Models\Kamar;
use App\Models\Pembayaran;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservasi extends Model
{
    use HasFactory;

    protected $table = 'reservasi';
    protected $primaryKey = 'id_reservasi';

    protected $fillable = [
        'kode_reservasi',
        'id_user',
        'id_tipe_villa',
        'tgl_checkin',
        'tgl_checkout',
        'total_harga',
        'status',
        // 'tgl_reservasi' Dihapus dari fillable karena diisi otomatis oleh DB (useCurrent() di migration)
    ];

    protected $casts = [
        'tgl_checkin' => 'datetime',
        'tgl_checkout' => 'datetime',
        'tgl_reservasi' => 'datetime',
        'total_harga' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function kamar()
    {
        return $this->belongsTo(Kamar::class, 'id_tipe_villa', 'id_tipe_villa');
    }

     public function ulasan()
    {
        return $this->hasOne(Ulasan::class, 'id_reservasi', 'id_reservasi');
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'Menunggu' => 'warning',
            'Dikonfirmasi' => 'info',
            'Selesai' => 'success',
            'Dibatalkan' => 'danger',
        ];

        return $badges[$this->status] ?? 'secondary';
    }

    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function scopeAktif($query)
    {
        return $query->whereIn('status', ['Menunggu', 'Dikonfirmasi']);
    }
    
    public function getDurasiAttribute()
    {
        if ($this->tgl_checkin && $this->tgl_checkout) {
            return $this->tgl_checkin->diffInDays($this->tgl_checkout);
        }
        return 0;
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'id_reservasi', 'id_reservasi');
    }
}