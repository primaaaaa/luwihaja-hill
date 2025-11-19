@extends('layouts.admin-layout')
@props(['header' => 'Detail Kamar'])
@section('admin-content')

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
                <input type="text" class="form-control" value="{{ $kamar->kapasitas }} Orang" readonly>
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
                    <input type="text" class="form-control" value="{{ $kamar->formatted_harga_weekday }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Harga Weekend</label>
                    <input type="text" class="form-control" value="{{ $kamar->formatted_harga_weekend }}" readonly>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kategori Kamar</label>
                    <input type="text" class="form-control" value="{{ $kamar->kategori }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Foto Kamar</label>
                    @if($kamar->foto_kamar)
                        <input type="text" class="form-control text-primary" 
                            value="{{ basename($kamar->foto_kamar) }}" 
                            readonly
                            style="cursor: pointer; text-decoration: underline;"
                            data-bs-toggle="modal" 
                            data-bs-target="#previewModal"
                            title="Klik untuk melihat preview">
                    @else
                        <input type="text" class="form-control" value="Tidak ada foto" readonly>
                    @endif
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">Deskripsi Kamar</label>
                <textarea class="form-control" rows="3" readonly>{{ $kamar->deskripsi ?? 'Tidak ada deskripsi' }}</textarea>
            </div>

            {{-- <a href="{{ route('admin.kamar') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a> --}}
        </form>
    </div>
</div>

<!-- Modal Preview Foto -->
@if($kamar->foto_kamar)
<div class="modal fade cms-detail-modal" id="previewModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header cms-modal-header">
                <h5 class="modal-title cms-modal-title">Preview Foto Kamar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <img src="{{ asset('storage/' . $kamar->foto_kamar) }}" 
                    alt="{{ $kamar->nama_unit }}" 
                    class="cms-detail-image img-fluid rounded w-100"
                    style="object-fit: contain; max-height: 500px;">
            </div>
        </div>
    </div>
</div>
@endif

@endsection