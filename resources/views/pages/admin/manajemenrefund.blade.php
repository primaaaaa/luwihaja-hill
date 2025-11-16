@extends('layouts.admin-layout')
@props(['header' => 'Refund'])
@section('admin-content')

@php
$refunds = [
    [
        'nama_tamu' => 'Prima',
        'kode_reservasi' => 'V101',
        'kode_refund' => 'RF01',
        'tanggal_pengajuan' => '2025-09-14',
        'status' => 'Menunggu'
    ],
    [
        'nama_tamu' => 'Aretta',
        'kode_reservasi' => 'V103',
        'kode_refund' => 'RF03',
        'tanggal_pengajuan' => '2025-09-14',
        'status' => 'Disetujui'
    ],
    [
        'nama_tamu' => 'Alhamid',
        'kode_reservasi' => 'V104',
        'kode_refund' => 'RF04',
        'tanggal_pengajuan' => '2025-09-14',
        'status' => 'Ditolak'
    ]
];
@endphp

<div class="p-4">
    <x-data-table 
        title="Daftar Pengajuan Refund"
        :headers="['Nama Tamu', 'Kode Reservasi', 'Kode Refund', 'Tanggal Pengajuan', 'Status']" 
        :addButton="false"
        :exportButton="false"
        :filterOptions="['Menunggu', 'Disetujui', 'Ditolak']">

        @foreach ($refunds as $refund)
        <tr>
            <td>{{ $refund['nama_tamu'] }}</td>
            <td>{{ $refund['kode_reservasi'] }}</td>
            <td>{{ $refund['kode_refund'] }}</td>
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
                
                <!-- Status Dropdown -->
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
                    <button class="btn-action btn-detail" title="Lihat Detail">
                        <i class="bi bi-eye-fill"></i>
                    </button>
                </div>
            </td>
        </tr>
        @endforeach

    </x-data-table>
</div>

@endsection