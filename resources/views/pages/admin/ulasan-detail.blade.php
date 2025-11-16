@extends('layouts.admin-layout')
@props(['header' => 'Detail Ulasan'])
@section('admin-content')

@php
$ulasan = [
    'nama_tamu' => 'Prima Yudhistira',
    'tanggal_ulasan' => '2025-09-14',
    'tanggal_checkin' => '2025-09-12',
    'tanggal_checkout' => '2025-09-14',
    'kode_reservasi' => 'V1091',
    'rating' => '5.0',
    'ulasan' => 'Family Room nyaman dan bersih, cocok untuk liburan bersama keluarga. Pelayanan staf ramah dan suasana villa tenang membuat pengalaman menginap menjadi tak terlupakan.'
];
@endphp

<div class="p-4">
    <div class="detail-container">
        <h4 class="detail-title">Detail Ulasan</h4>
        
        <form>
            <!-- Row: Nama Tamu & Tanggal Ulasan -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Tamu</label>
                    <input type="text" class="form-control" value="{{ $ulasan['nama_tamu'] }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Ulasan</label>
                    <input type="text" class="form-control" value="{{ $ulasan['tanggal_ulasan'] }}" readonly>
                </div>
            </div>

            <!-- Row: Tanggal Check-In & Check-Out -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Check-In</label>
                    <input type="text" class="form-control" value="{{ $ulasan['tanggal_checkin'] }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Check-Out</label>
                    <input type="text" class="form-control" value="{{ $ulasan['tanggal_checkout'] }}" readonly>
                </div>
            </div>

            <!-- Kode Reservasi -->
            <div class="mb-3">
                <label class="form-label">Kode Reservasi</label>
                <input type="text" class="form-control" value="{{ $ulasan['kode_reservasi'] }}" readonly>
            </div>

            <!-- Rating -->
            <div class="mb-3">
                <label class="form-label">Rating</label>
                <input type="text" class="form-control" value="{{ $ulasan['rating'] }}" readonly>
            </div>

            <!-- Ulasan -->
            <div class="mb-4">
                <label class="form-label">Ulasan</label>
                <textarea class="form-control" rows="4" readonly>{{ $ulasan['ulasan'] }}</textarea>
            </div>
        </form>
    </div>
</div>

@endsection