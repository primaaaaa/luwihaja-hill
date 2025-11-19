@extends('layouts.admin-layout')
@props(['header' => 'Detail Pembayaran'])
@section('admin-content')

<div class="p-4">
    <div class="detail-container">
        <h4 class="detail-title">Detail Pembayaran</h4>
        
        <form>
            <!-- Row: Nama Pemesan & Kode Pembayaran -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Pemesan</label>
                    <input type="text" class="form-control" value="{{ $pembayaran->reservasi->user->nama ?? 'N/A' }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kode Pembayaran</label>
                    <input type="text" class="form-control" value="{{ $pembayaran->kode_pembayaran ?? 'INV-' . $pembayaran->id_pembayaran }}" readonly>
                </div>
            </div>

            <!-- Row: Kode Reservasi & Tanggal Pembayaran -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kode Reservasi</label>
                    <input type="text" class="form-control" value="{{ $pembayaran->reservasi->kode_reservasi ?? 'N/A' }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Pembayaran</label>
                    <input type="text" class="form-control" value="{{ $pembayaran->tgl_pembayaran ? $pembayaran->tgl_pembayaran->format('d M Y') : '-' }}" readonly>
                </div>
            </div>

            <!-- Row: Tanggal Check-In & Check-Out -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Check-In</label>
                    <input type="text" class="form-control" value="{{ $pembayaran->reservasi->tgl_checkin ? $pembayaran->reservasi->tgl_checkin->format('d M Y') : '-' }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Check-Out</label>
                    <input type="text" class="form-control" value="{{ $pembayaran->reservasi->tgl_checkout ? $pembayaran->reservasi->tgl_checkout->format('d M Y') : '-' }}" readonly>
                </div>
            </div>

            <!-- Row: Nominal Pembayaran & Bukti Pembayaran -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nominal Pembayaran</label>
                    <input type="text" class="form-control" value="Rp {{ number_format($pembayaran->reservasi->total_harga ?? 0, 0, ',', '.') }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Bukti Pembayaran</label>
                    @if($pembayaran->bukti_pembayaran)
                        <input type="text" class="form-control text-primary" 
                            value="{{ basename($pembayaran->bukti_pembayaran) }}" 
                            readonly
                            style="cursor: pointer; text-decoration: underline;"
                            data-bs-toggle="modal" 
                            data-bs-target="#previewModal"
                            title="Klik untuk melihat preview">
                    @else
                        <input type="text" class="form-control" value="Belum ada bukti pembayaran" readonly>
                    @endif
                </div>
            </div>

            <!-- Row: Metode Pembayaran & Nama Bank -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Metode Pembayaran</label>
                    <input type="text" class="form-control" value="{{ $pembayaran->metode_pembayaran ?? '-' }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Bank</label>
                    <input type="text" class="form-control" value="{{ $pembayaran->nama_bank ?? '-' }}" readonly>
                </div>
            </div>

            <!-- Row: Nomor Rekening & Nama Pemilik -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nomor Rekening</label>
                    <input type="text" class="form-control" value="{{ $pembayaran->nomor_rekening ?? '-' }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Pemilik Rekening</label>
                    <input type="text" class="form-control" value="{{ $pembayaran->nama_pemilik ?? '-' }}" readonly>
                </div>
            </div>

            <!-- Row: Status Pembayaran & Nama Unit -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Status Pembayaran</label>
                    <input type="text" class="form-control" value="{{ $pembayaran->status }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Unit/Kamar</label>
                    <input type="text" class="form-control" value="{{ $pembayaran->reservasi->kamar->nama_unit ?? 'N/A' }}" readonly>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Preview Bukti Pembayaran -->
@if($pembayaran->bukti_pembayaran)
<div class="modal fade cms-detail-modal" id="previewModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header cms-modal-header">
                <h5 class="modal-title cms-modal-title">Preview Bukti Pembayaran</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <img src="{{ asset($pembayaran->bukti_pembayaran) }}" 
                    alt="Bukti Pembayaran {{ $pembayaran->reservasi->kode_reservasi ?? '' }}" 
                    class="cms-detail-image img-fluid rounded w-100"
                    style="object-fit: contain; max-height: 500px;"
                    onerror="this.src='{{ asset('images/no-image.png') }}'">
            </div>
        </div>
    </div>
</div>
@endif

@endsection