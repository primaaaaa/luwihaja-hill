@extends('layouts.admin-layout')
@props(['header' => 'Pembayaran'])
@section('admin-content')

@php
$payments = [
    [
        'nama_tamu' => 'Prima',
        'kode_reservasi' => 'V101',
        'tanggal_pembayaran' => '2025-09-12',
        'tanggal_checkin' => '2025-09-12',
        'status' => 'Menunggu'
    ],
    [
        'nama_tamu' => 'Alhamid',
        'kode_reservasi' => 'V104',
        'tanggal_pembayaran' => '2025-09-16',
        'tanggal_checkin' => '2025-09-16',
        'status' => 'Lunas'
    ],
    [
        'nama_tamu' => 'Rafi',
        'kode_reservasi' => 'V105',
        'tanggal_pembayaran' => '2025-09-17',
        'tanggal_checkin' => '2025-09-17',
        'status' => 'Batal'
    ]
];
@endphp

<div class="p-4">
    <x-data-table 
        title="Daftar Pembayaran"
        :headers="['Nama Tamu', 'Kode Reservasi', 'Tanggal Pembayaran', 'Tanggal Check In', 'Status']" 
        :addButton="false"
        :exportButton="true"
        :filterOptions="['Menunggu', 'Lunas', 'Batal']">

        @foreach ($payments as $payment)
        <tr>
            <td>{{ $payment['nama_tamu'] }}</td>
            <td>{{ $payment['kode_reservasi'] }}</td>
            <td>{{ $payment['tanggal_pembayaran'] }}</td>
            <td>{{ $payment['tanggal_checkin'] }}</td>
            <td>
                @php
                    $statusClass = match($payment['status']) {
                        'Menunggu' => 'badge-dipesan',
                        'Lunas' => 'badge-tersedia',
                        'Batal' => 'badge-nonaktif',
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
                        {{ $payment['status'] }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="statusDropdown{{ $loop->index }}">
                        <li><a class="dropdown-item" href="#">Menunggu</a></li>
                        <li><a class="dropdown-item" href="#">Lunas</a></li>
                        <li><a class="dropdown-item" href="#">Batal</a></li>
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