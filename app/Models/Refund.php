<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;

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

    protected $casts = [
        'tgl_pengajuan' => 'date',
        'nominal_refund' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relasi ke Reservasi
     */
    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'id_reservasi', 'id_reservasi');
    }

    public function pembayaran()
    {
        return $this->belongsTo(Pembayaran::class, 'id_reservasi', 'id_reservasi');
    }



    /**
     * Accessor untuk badge status
     */
    public function getStatusBadgeAttribute()
    {
        $badges = [
            'Menunggu' => 'warning',
            'Disetujui' => 'success',
            'Ditolak' => 'danger',
        ];

        return $badges[$this->status] ?? 'secondary';
    }

    /**
     * Accessor untuk format nominal
     */
    public function getNominalFormatAttribute()
    {
        return 'Rp ' . number_format($this->nominal_refund, 0, ',', '.');
    }

    /**
     * Accessor untuk URL bukti pendukung
     */
    public function getBuktiUrlAttribute()
    {
        return $this->bukti_pendukung
            ? asset('storage/' . $this->bukti_pendukung)
            : null;
    }

    /**
     * Scope untuk filter berdasarkan status
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk refund yang menunggu
     */
    public function scopeMenunggu($query)
    {
        return $query->where('status', 'Menunggu');
    }

    /**
     * Scope untuk refund yang disetujui
     */
    public function scopeDisetujui($query)
    {
        return $query->where('status', 'Disetujui');
    }

    public function scopeDitolak($query)
    {
        return $query->where('status', 'Ditolak');
    }

    public function setStatusAttribute($value)
    {
        $allowedStatuses = ['Menunggu', 'Disetujui', 'Ditolak'];

        if (!in_array($value, $allowedStatuses)) {
            throw new \InvalidArgumentException("Status '{$value}' tidak valid. Gunakan: " . implode(', ', $allowedStatuses));
        }

        $this->attributes['status'] = $value;
    }
}
