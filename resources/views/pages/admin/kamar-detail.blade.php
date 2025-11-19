@extends('layouts.admin-layout')
@props(['header' => 'Detail Kamar'])
@section('admin-content')

<div class="p-4">
    <div class="detail-container">
        <h4 class="detail-title">Detail Kamar</h4>
        
        <form>
            <div class="mb-3">
                <label class="form-label">Nama Unit</label>
<<<<<<< HEAD
                <input type="text" class="form-control" value="{{ $room->name }}" readonly>
=======
                <input type="text" class="form-control" value="{{ $kamar->nama_unit }}" readonly>
>>>>>>> aretta
            </div>

            <div class="mb-3">
                <label class="form-label">Kapasitas Kamar</label>
<<<<<<< HEAD
                <input type="text" class="form-control" value="{{ $room->capacity }}" readonly>
=======
                <input type="text" class="form-control" value="{{ $kamar->kapasitas }}" readonly>
>>>>>>> aretta
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kode Tipe</label>
<<<<<<< HEAD
                    <input type="text" class="form-control" value="{{ $room->kode_tipe }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Status Kamar</label>
                    <input type="text" class="form-control" value="{{ $room->status }}" readonly>
=======
                    <input type="text" class="form-control" value="{{ $kamar->kode_tipe }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Status Kamar</label>
                    <input type="text" class="form-control" value="{{ $kamar->status }}" readonly>
>>>>>>> aretta
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Harga Weekday</label>
<<<<<<< HEAD
                    <input type="text" class="form-control" value="{{ $room->price_per_night }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Harga Weekend</label>
                    <input type="text" class="form-control" value="{{ $room->price_per_night + 100000 }}" readonly>
=======
                    <input type="text" class="form-control" value="{{ $kamar->harga_weekday }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Harga Weekend</label>
                    <input type="text" class="form-control" value="{{ $kamar->harga_weekend }}" readonly>
>>>>>>> aretta
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kategori Kamar</label>
<<<<<<< HEAD
                    <input type="text" class="form-control" value="{{ $room->kategori }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Foto Kamar</label>
                    <input type="text" class="form-control" value="{{ $room->main_image }}" readonly>
=======
                    <input type="text" class="form-control" value="{{ $kamar->kategori }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Foto Kamar</label>
                    <input type="text" class="form-control" value="{{ $kamar->foto_kamar }}" readonly>
>>>>>>> aretta
                </div>
            </div>
 
            <div class="mb-4">
                <label class="form-label">Deskripsi Kamar</label>
<<<<<<< HEAD
                <textarea class="form-control" rows="3" readonly>{{ $room->deskripsi }}</textarea>
=======
                <textarea class="form-control" rows="3" readonly>{{ $kamar->deskripsi }}</textarea>
>>>>>>> aretta
            </div>

            {{-- <a href="{{ url('/admin/kamar') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Kembali
            </a> --}}
        </form>
    </div>
</div>

@endsection