@extends('layouts.admin-layout')
@props(['header' => 'Detail Kamar'])
@section('admin-content')

@php
$kamar = [
    'nama_unit' => 'Family Room I',
    'kapasitas' => '4',
    'kode_tipe' => 'K104',
    'status' => 'Tersedia',
    'harga_weekday' => 'Rp300.000',
    'harga_weekend' => 'Rp400.000',
    'kategori' => 'Family Room',
    'foto' => 'Foto.jpg',
    'deskripsi' => 'Kamar luas untuk keluarga 3-4 orang, dengan pilihan harga dan pemandangan berbeda.'
];
@endphp

<div class="p-4">
    <div class="detail-container">
        <h4 class="detail-title">Detail Kamar</h4>
        
        <form>
            <div class="mb-3">
                <label class="form-label">Nama Unit</label>
                <input type="text" class="form-control" value="{{ $kamar['nama_unit'] }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Kapasitas Kamar</label>
                <input type="text" class="form-control" value="{{ $kamar['kapasitas'] }}" readonly>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kode Tipe</label>
                    <input type="text" class="form-control" value="{{ $kamar['kode_tipe'] }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Status Kamar</label>
                    <input type="text" class="form-control" value="{{ $kamar['status'] }}" readonly>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Harga Weekday</label>
                    <input type="text" class="form-control" value="{{ $kamar['harga_weekday'] }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Harga Weekend</label>
                    <input type="text" class="form-control" value="{{ $kamar['harga_weekend'] }}" readonly>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kategori Kamar</label>
                    <input type="text" class="form-control" value="{{ $kamar['kategori'] }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Foto Kamar</label>
                    <input type="text" class="form-control" value="{{ $kamar['foto'] }}" readonly>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Deskripsi Kamar</label>
                <textarea class="form-control" rows="3" readonly>{{ $kamar['deskripsi'] }}</textarea>
            </div>

            {{-- <a href="{{ url('/admin/kamar') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a> --}}
        </form>
    </div>
</div>

@endsection