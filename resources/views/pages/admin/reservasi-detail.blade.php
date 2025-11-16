@extends('layouts.admin-layout')
@props(['header' => 'Detail Reservasi'])
@section('admin-content')

@php
$reservasi = [
    'nama_tamu' => 'Prima Yudhistira',
    'status_reservasi' => 'Menunggu',
    'tanggal_checkin' => '2025-09-12',
    'tanggal_checkout' => '2025-09-14',
    'kode_reservasi' => 'V101',
    'kode_tipe' => 'K101',
    'total_harga' => 'Rp500.000'
];
@endphp

<div class="p-4">
    <div class="detail-container">
        <h4 class="detail-title">Detail Reservasi</h4>
        
        <form>
            <!-- Row: Nama Tamu & Status -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Tamu</label>
                    <input type="text" class="form-control" value="{{ $reservasi['nama_tamu'] }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Status Reservasi</label>
                    <input type="text" class="form-control" value="{{ $reservasi['status_reservasi'] }}" readonly>
                </div>
            </div>

            <!-- Row: Tanggal Check-In & Check-Out -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Check-In</label>
                    <input type="text" class="form-control" value="{{ $reservasi['tanggal_checkin'] }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Check-Out</label>
                    <input type="text" class="form-control" value="{{ $reservasi['tanggal_checkout'] }}" readonly>
                </div>
            </div>

            <!-- Kode Reservasi -->
            <div class="mb-3">
                <label class="form-label">Kode Reservasi</label>
                <input type="text" class="form-control" value="{{ $reservasi['kode_reservasi'] }}" readonly>
            </div>

            <!-- Kode Tipe -->
            <div class="mb-3">
                <label class="form-label">Kode Tipe</label>
                <input type="text" class="form-control" value="{{ $reservasi['kode_tipe'] }}" readonly>
            </div>

            <!-- Total Harga -->
            <div class="mb-4">
                <label class="form-label">Total Harga</label>
                <input type="text" class="form-control" value="{{ $reservasi['total_harga'] }}" readonly>
            </div>

            <a href="{{ url('/admin/reservasi') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </form>
    </div>
</div>

@endsection