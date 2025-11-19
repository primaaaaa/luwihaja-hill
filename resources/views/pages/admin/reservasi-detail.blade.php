@extends('layouts.admin-layout')
@props(['header' => 'Detail Reservasi'])
@section('admin-content')

<div class="p-4">
    <div class="detail-container">
        <h4 class="detail-title">Detail Reservasi</h4>

        <form>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Tamu</label>
                    <input type="text" class="form-control" value="{{ $reservasi->user->nama ?? 'N/A' }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Status Reservasi</label>
                    <input type="text" class="form-control" value="{{ $reservasi->status }}" readonly>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Check-In</label>
                    <input type="text" class="form-control"
                        value="{{ $reservasi->tgl_checkin ? $reservasi->tgl_checkin->format('d M Y') : '-' }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Check-Out</label>
                    <input type="text" class="form-control"
                        value="{{ $reservasi->tgl_checkout ? $reservasi->tgl_checkout->format('d M Y') : '-' }}"
                        readonly>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kode Reservasi</label>
                    <input type="text" class="form-control" value="{{ $reservasi->kode_reservasi }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Unit/Kamar</label>
                    <input type="text" class="form-control" value="{{ $reservasi->kamar->nama_unit ?? 'N/A' }}"
                        readonly>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kode Tipe</label>
                    <input type="text" class="form-control" value="{{ $reservasi->kamar->kode_tipe ?? 'N/A' }}"
                        readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Durasi Menginap</label>
                    <input type="text" class="form-control" value="{{ $reservasi->durasi }} Malam" readonly>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label">Total Harga</label>
                    <input type="text" class="form-control"
                        value="Rp {{ number_format($reservasi->total_harga ?? 0, 0, ',', '.') }}" readonly>
                </div>
                <div class="col-md-6 mb-4">
                    <label class="form-label">Tanggal Reservasi</label>
                    <input type="text" class="form-control"
                        value="{{ $reservasi->tgl_reservasi ? $reservasi->tgl_reservasi->format('d M Y') : '-' }}"
                        readonly>
                </div>
            </div>

        </form>
    </div>
</div>

@endsection