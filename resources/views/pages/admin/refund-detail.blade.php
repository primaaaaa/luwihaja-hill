@extends('layouts.admin-layout')
@props(['header' => 'Detail Refund'])
@section('admin-content')

@php
$refund = [
    'nama_pemesan' => 'Prima Yudhistira',
    'kode_refund' => 'RF101',
    'kode_reservasi' => 'V101',
    'tanggal_pengajuan' => '2025-09-14',
    'tanggal_checkin' => '2025-09-12',
    'tanggal_checkout' => '2025-09-14',
    'nominal_refund' => 'Rp900.000',
    'bukti_pendukung' => 'Bukti.jpg',
    'nama_bank' => 'BCA',
    'nomor_rekening' => '92082092',
    'nama_pemilik' => 'Prima Yudhistira',
    'alasan_refund' => 'Berubah Pikiran'
];
@endphp

<div class="p-4">
    <div class="detail-container">
        <h4 class="detail-title">Detail Refund</h4>
        
        <form>
            <!-- Row: Nama Pemesan & Kode Refund -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Pemesan</label>
                    <input type="text" class="form-control" value="{{ $refund['nama_pemesan'] }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kode Refund</label>
                    <input type="text" class="form-control" value="{{ $refund['kode_refund'] }}" readonly>
                </div>
            </div>

            <!-- Row: Kode Reservasi & Tanggal Pengajuan -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kode Reservasi</label>
                    <input type="text" class="form-control" value="{{ $refund['kode_reservasi'] }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Pengajuan</label>
                    <input type="text" class="form-control" value="{{ $refund['tanggal_pengajuan'] }}" readonly>
                </div>
            </div>

            <!-- Row: Tanggal Check-In & Check-Out -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Check-In</label>
                    <input type="text" class="form-control" value="{{ $refund['tanggal_checkin'] }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Check-Out</label>
                    <input type="text" class="form-control" value="{{ $refund['tanggal_checkout'] }}" readonly>
                </div>
            </div>

            <!-- Row: Nominal Refund & Bukti Pendukung -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nominal Refund</label>
                    <input type="text" class="form-control" value="{{ $refund['nominal_refund'] }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Bukti Pendukung</label>
                    <input type="text" class="form-control" value="{{ $refund['bukti_pendukung'] }}" readonly>
                </div>
            </div>

            <!-- Row: Nama Bank, Nomor Rekening, Nama Pemilik -->
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Nama Bank</label>
                    <input type="text" class="form-control" value="{{ $refund['nama_bank'] }}" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Nomor Rekening</label>
                    <input type="text" class="form-control" value="{{ $refund['nomor_rekening'] }}" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Nama Pemilik</label>
                    <input type="text" class="form-control" value="{{ $refund['nama_pemilik'] }}" readonly>
                </div>
            </div>

            <!-- Alasan Refund -->
            <div class="mb-4">
                <label class="form-label">Alasan Refund</label>
                <input type="text" class="form-control" value="{{ $refund['alasan_refund'] }}" readonly>
            </div>

            <a href="{{ url('/admin/refund') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </form>
    </div>
</div>

@endsection