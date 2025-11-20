@extends('layouts.admin-layout')
@props(['header' => 'Detail Kamar'])
@section('admin-content')

@php
$fotoPath = $kamar->foto_kamar ? public_path('storage/' . $kamar->foto_kamar) : null;
$fotoExists = $fotoPath && file_exists($fotoPath);
$extension = $fotoExists ? pathinfo($kamar->foto_kamar, PATHINFO_EXTENSION) : null;
@endphp

{{-- Tampilkan foto/video hanya jika file benar-benar ada --}}
@if($fotoExists)
    @if(in_array(strtolower($extension), ['jpg','jpeg','png','gif']))
    <img src="{{ asset('storage/' . $kamar->foto_kamar) }}" class="img-fluid" alt="Foto {{ $kamar->nama_unit }}">
    @elseif(strtolower($extension) == 'mp4')
    <video controls class="w-100">
        <source src="{{ asset('storage/' . $kamar->foto_kamar) }}" type="video/mp4">
    </video>
    @endif
@else
    {{-- Placeholder jika foto tidak ada --}}
    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
        <div class="text-center text-muted">
            <i class="bi bi-image fs-1"></i>
            <p class="mt-2">Foto tidak tersedia</p>
        </div>
    </div>
@endif


<div class="p-4">
    <div class="detail-container">
        <h4 class="detail-title">Detail Kamar</h4>

        <form>
            <div class="mb-3">
                <label class="form-label">Nama Unit</label>
                <input type="text" class="form-control" value="{{ $kamar->nama_unit }}" readonly>
            </div>

            <div class="mb-3">
                <label class="form-label">Kapasitas Kamar</label>
                <input type="text" class="form-control" value="{{ $kamar->kapasitas }}" readonly>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kode Tipe</label>
                    <input type="text" class="form-control" value="{{ $kamar->kode_tipe }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Status Kamar</label>
                    <input type="text" class="form-control" value="{{ $kamar->status }}" readonly>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Harga Weekday</label>
                    <input type="text" class="form-control" value="Rp {{ number_format($kamar->harga_weekday, 0, ',', '.') }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Harga Weekend</label>
                    <input type="text" class="form-control" value="Rp {{ number_format($kamar->harga_weekend, 0, ',', '.') }}" readonly>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kategori Kamar</label>
                    <input type="text" class="form-control" value="{{ $kamar->kategori }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Foto Kamar</label>
                    @if($fotoExists)
                    <input type="text" class="form-control" value="{{ $kamar->foto_kamar }}" readonly
                        data-bs-toggle="modal" data-bs-target="#fotoModal{{ $kamar->id }}"
                        style="cursor: pointer;">
                    @else
                    <input type="text" class="form-control" value="Tidak ada foto tersedia" readonly>
                    @endif
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Deskripsi Kamar</label>
                <textarea class="form-control" rows="3" readonly>{{ $kamar->deskripsi }}</textarea>
            </div>
        </form>
    </div>
</div>


{{-- Modal Foto Kamar --}}
@if($fotoExists)
<div class="modal fade" id="fotoModal{{ $kamar->id }}" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Foto Kamar: {{ $kamar->nama_unit }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img src="{{ asset('storage/' . $kamar->foto_kamar) }}" 
                     class="img-fluid" 
                     alt="Foto {{ $kamar->nama_unit }}"
                     onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22200%22 height=%22200%22%3E%3Crect fill=%22%23ddd%22 width=%22200%22 height=%22200%22/%3E%3Ctext fill=%22%23999%22 x=%2250%25%22 y=%2250%25%22 dominant-baseline=%22middle%22 text-anchor=%22middle%22%3ENo Image%3C/text%3E%3C/svg%3E';">
            </div>
        </div>
    </div>
</div>
@endif

@endsection