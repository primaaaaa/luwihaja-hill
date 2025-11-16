@extends('layouts.admin-layout')
@props(['header' => 'Detail Pembayaran'])
@section('admin-content')

@php
$pembayaran = [
    'nama_pemesan' => 'Prima Yudhistira',
    'kode_pembayaran' => 'INV-101',
    'kode_reservasi' => 'V101',
    'tanggal_pembayaran' => '2025-09-12',
    'tanggal_checkin' => '2025-09-12',
    'tanggal_checkout' => '2025-09-14',
    'nominal_pembayaran' => 'Rp800.000',
    'bukti_pembayaran' => 'Bukti.jpg',
    'metode_pembayaran' => 'ATM',
    'nama_bank' => 'BCA',
    'nomor_rekening' => '92082092',
    'nama_pemilik' => 'Prima Yudhistira'
];
@endphp

<div class="p-4">
    <div class="detail-container">
        <h4 class="detail-title">Detail Pembayaran</h4>
        
        <form>
            <!-- Row: Nama Pemesan & Kode Pembayaran -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Pemesan</label>
                    <input type="text" class="form-control" value="{{ $pembayaran['nama_pemesan'] }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kode Pembayaran</label>
                    <input type="text" class="form-control" value="{{ $pembayaran['kode_pembayaran'] }}" readonly>
                </div>
            </div>

            <!-- Row: Kode Reservasi & Tanggal Pembayaran -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kode Reservasi</label>
                    <input type="text" class="form-control" value="{{ $pembayaran['kode_reservasi'] }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Pembayaran</label>
                    <input type="text" class="form-control" value="{{ $pembayaran['tanggal_pembayaran'] }}" readonly>
                </div>
            </div>

            <!-- Row: Tanggal Check-In & Check-Out -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Check-In</label>
                    <input type="text" class="form-control" value="{{ $pembayaran['tanggal_checkin'] }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Check-Out</label>
                    <input type="text" class="form-control" value="{{ $pembayaran['tanggal_checkout'] }}" readonly>
                </div>
            </div>

            <!-- Row: Nominal Pembayaran & Bukti Pembayaran -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nominal Pembayaran</label>
                    <input type="text" class="form-control" value="{{ $pembayaran['nominal_pembayaran'] }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Bukti Pembayaran</label>
                    <input type="text" class="form-control" value="{{ $pembayaran['bukti_pembayaran'] }}" readonly>
                </div>
            </div>

            <!-- Row: Metode Pembayaran & Nama Bank -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Metode Pembayaran</label>
                    <input type="text" class="form-control" value="{{ $pembayaran['metode_pembayaran'] }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Bank</label>
                    <input type="text" class="form-control" value="{{ $pembayaran['nama_bank'] }}" readonly>
                </div>
            </div>

            <!-- Row: Nomor Rekening & Nama Pemilik -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nomor Rekening</label>
                    <input type="text" class="form-control" value="{{ $pembayaran['nomor_rekening'] }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Pemilik</label>
                    <input type="text" class="form-control" value="{{ $pembayaran['nama_pemilik'] }}" readonly>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection