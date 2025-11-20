@extends('layouts.admin-layout')
@props(['header' => 'Detail Refund'])
@section('admin-content')

<div class="p-4">
    <div class="detail-container">
        <h4 class="detail-title">Detail Refund</h4>

        <form>

            <!-- Row: Nama Pemesan & Kode Refund -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nama Pemesan</label>
                    <input type="text" class="form-control" 
                        value="{{ $refund->reservasi->user->nama ?? '-' }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kode Refund</label>
                    <input type="text" class="form-control" 
                        value="{{ $refund->kode_refund }}" readonly>
                </div>
            </div>

            <!-- Row: Kode Reservasi & Tanggal Pengajuan -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Kode Reservasi</label>
                    <input type="text" class="form-control" 
                        value="{{ $refund->reservasi->kode_reservasi ?? '-' }}" readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Pengajuan</label>
                    <input type="text" class="form-control" 
                        value="{{ $refund->tgl_pengajuan ? \Carbon\Carbon::parse($refund->tgl_pengajuan)->format('d M Y') : '-' }}" 
                        readonly>
                </div>
            </div>

            <!-- Row: Tanggal Check-In & Check-Out -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Check-In</label>
                    <input type="text" class="form-control" 
                        value="{{ $refund->reservasi->tgl_checkin ? \Carbon\Carbon::parse($refund->reservasi->tgl_checkin)->format('d M Y') : '-' }}" 
                        readonly>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Tanggal Check-Out</label>
                    <input type="text" class="form-control" 
                        value="{{ $refund->reservasi->tgl_checkout ? \Carbon\Carbon::parse($refund->reservasi->tgl_checkout)->format('d M Y') : '-' }}" 
                        readonly>
                </div>
            </div>

            <!-- Row: Nominal Refund & Bukti Pendukung -->
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Nominal Refund</label>
                    <input type="text" class="form-control" 
                        value="Rp {{ number_format($refund->nominal_refund, 0, ',', '.') }}" readonly>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Bukti Pendukung</label>

                    @if($refund->bukti_pendukung)
                        <input type="text" 
                            class="form-control text-primary"
                            value="{{ basename($refund->bukti_pendukung) }}"
                            readonly
                            style="cursor: pointer; text-decoration: underline;"
                            data-bs-toggle="modal"
                            data-bs-target="#refundPreviewModal"
                            title="Klik untuk melihat bukti pendukung">
                    @else
                        <input type="text" class="form-control" value="Tidak ada bukti" readonly>
                    @endif
                </div>
            </div>

            <!-- Row: Nama Bank, Nomor Rekening, Nama Pemilik -->
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label class="form-label">Nama Bank</label>
                    <input type="text" class="form-control" 
                        value="{{ $refund->nama_bank_tujuan ?? '-' }}" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Nomor Rekening</label>
                    <input type="text" class="form-control" 
                        value="{{ $refund->norek_tujuan ?? '-' }}" readonly>
                </div>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Nama Pemilik</label>
                    <input type="text" class="form-control" 
                        value="{{ $refund->pemilik_tujuan ?? '-' }}" readonly>
                </div>
            </div>

            <!-- Alasan Refund -->
            <div class="mb-3">
                <label class="form-label">Alasan Refund</label>
                <input type="text" class="form-control" value="{{ $refund->alasan_refund ?? '-' }}" readonly>
            </div>

            <!-- Status Refund -->
            <div class="mb-3">
                <label class="form-label">Status Refund</label>
                <input type="text" class="form-control" value="{{ $refund->status }}" readonly>
            </div>

        </form>
    </div>
</div>

<!-- Modal Preview Bukti Refund -->
@if($refund->bukti_pendukung)
<div class="modal fade cms-detail-modal" id="refundPreviewModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header cms-modal-header">
                <h5 class="modal-title cms-modal-title">Preview Bukti Refund</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body p-4">
                <img src="{{ asset('storage/' . $refund->bukti_pendukung) }}" 
                    alt="Bukti Refund {{ $refund->kode_refund }}"
                    class="cms-detail-image img-fluid rounded w-100"
                    style="object-fit: contain; max-height: 500px;"
                    onerror="this.src='{{ asset('images/no-image.png') }}'">
            </div>

        </div>
    </div>
</div>
@endif

@endsection
