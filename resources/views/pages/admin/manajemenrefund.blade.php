@extends('layouts.admin-layout')
@props(['header' => 'Refund'])
@section('admin-content')

@php
$refunds = [
    ['id' => 1, 'kode_refund' => 'RF01', 'kode_reservasi' => 'V101', 'nama_tamu' => 'Prima', 'tanggal_pengajuan' => '2025-09-14', 'status' => 'Menunggu'],
    ['id' => 2, 'kode_refund' => 'RF03', 'kode_reservasi' => 'V103', 'nama_tamu' => 'Aretta', 'tanggal_pengajuan' => '2025-09-14', 'status' => 'Disetujui'],
    ['id' => 3, 'kode_refund' => 'RF04', 'kode_reservasi' => 'V104', 'nama_tamu' => 'Alhamid', 'tanggal_pengajuan' => '2025-09-14', 'status' => 'Ditolak'],
];
@endphp

<div class="p-4">
    <x-data-table 
        title="Daftar Pengajuan Refund"
        :headers="$tableHeader"
        :addButton="false"
        :exportButton="false"
        :filterOptions="['Menunggu', 'Disetujui', 'Ditolak']">

        @foreach ($refunds as $refund)
        <tr>
            <td>{{ $refund['kode_refund'] }}</td>
            <td>{{ $refund['kode_reservasi'] }}</td>
            <td>{{ $refund['nama_tamu'] }}</td>
            <td>{{ $refund['tanggal_pengajuan'] }}</td>
            <td>
                @php
                    $statusClass = match($refund['status']) {
                        'Menunggu' => 'badge-dipesan',
                        'Disetujui' => 'badge-tersedia',
                        'Ditolak' => 'badge-nonaktif',
                        default => 'badge-dipesan'
                    };
                @endphp
                
                <div class="dropdown">
                    <button class="btn badge-status {{ $statusClass }} dropdown-toggle" 
                            type="button" 
                            id="statusDropdown{{ $loop->index }}" 
                            data-bs-toggle="dropdown" 
                            aria-expanded="false">
                        {{ $refund['status'] }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="statusDropdown{{ $loop->index }}">
                        <li><a class="dropdown-item" href="#">Menunggu</a></li>
                        <li><a class="dropdown-item" href="#">Disetujui</a></li>
                        <li><a class="dropdown-item" href="#">Ditolak</a></li>
                    </ul>
                </div>
            </td>
            <td>
                <div class="action-buttons">
                    <a href="{{ route('refund-detail') }}" class="btn-action btn-detail">
                        <i class="bi bi-eye-fill"></i>
                    </a>
                </div>
            </td>
        </tr>
        @endforeach

    </x-data-table>
</div>

@endsection