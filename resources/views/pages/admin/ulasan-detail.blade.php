@extends('layouts.admin-layout')
@props(['header' => 'Detail Ulasan'])
@section('admin-content')

<div class="p-4">
    <div class="detail-container">
        <h4 class="detail-title">Detail Ulasan</h4>

        <form>
            {{-- Row: Nama Tamu & Tanggal Ulasan --}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Tamu</label>
                    <input type="text" class="form-control" 
                           value="{{ $ulasan->user->nama ?? '-' }}" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Ulasan</label>
                    <input type="text" class="form-control" 
                           value="{{ $ulasan->tgl_ulasan->format('d M Y') }}" readonly>
                </div>
            </div>

            {{-- Row: Check-In & Check-Out --}}
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Check-In</label>
                    <input type="text" class="form-control" 
                           value="{{ $ulasan->reservasi->tgl_checkin->format('d M Y') }}" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Check-Out</label>
                    <input type="text" class="form-control" 
                           value="{{ $ulasan->reservasi->tgl_checkout->format('d M Y') }}" readonly>
                </div>
            </div>

            {{-- Kode Reservasi --}}
            <div class="mb-3">
                <label class="form-label">Kode Reservasi</label>
                <input type="text" class="form-control" 
                       value="{{ $ulasan->reservasi->kode_reservasi }}" readonly>
            </div>

            {{-- Rating --}}
            <div class="mb-3">
                <label class="form-label">Rating</label>
                <input type="text" class="form-control" 
                       value="{{ $ulasan->rating }}" readonly>
            </div>

            {{-- Isi Ulasan --}}
            <div class="mb-4">
                <label class="form-label">Ulasan</label>
                <textarea class="form-control" rows="4" readonly>{{ $ulasan->isi_ulasan }}</textarea>
            </div>
        </form>
    </div>
</div>

@endsection
