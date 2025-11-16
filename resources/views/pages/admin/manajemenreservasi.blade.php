@extends('layouts.admin-layout')
@props(['header' => 'Reservasi'])
@section('admin-content')

@php
$reservations = [
    [
        'id' => 1,
        'kode_reservasi' => 'RSV001',
        'nama_tamu' => 'Ahmad Rizki',
        'checkin' => '20 Nov 2024',
        'checkout' => '23 Nov 2024',
        'status' => 'Menunggu'
    ],
    [
        'id' => 2,
        'kode_reservasi' => 'RSV002',
        'nama_tamu' => 'Siti Nurhaliza',
        'checkin' => '16 Nov 2024',
        'checkout' => '18 Nov 2024',
        'status' => 'Check In'
    ],
    [
        'id' => 3,
        'kode_reservasi' => 'RSV003',
        'nama_tamu' => 'Budi Santoso',
        'checkin' => '10 Nov 2024',
        'checkout' => '15 Nov 2024',
        'status' => 'Selesai'
    ],
];
@endphp

<div class="p-4">
    <x-data-table 
        title="Daftar Reservasi"
        :headers="$tableHeader"
        :addButton="false"
        :filterOptions="['Menunggu Konfirmasi', 'Check In', 'Selesai', 'Dibatalkan']" 
        :exportButton="true">

        @foreach ($reservations as $reservation)
        <tr>
            <td>{{ $reservation['kode_reservasi'] }}</td>
            <td>{{ $reservation['nama_tamu'] }}</td>
            <td>{{ $reservation['checkin'] }}</td>
            <td>{{ $reservation['checkout'] }}</td>
            <td>
                @php
                    $statusClass = match($reservation['status']) {
                        'Menunggu Konfirmasi' => 'badge-dipesan',
                        'Check In' => 'badge-terisi',
                        'Selesai' => 'badge-tersedia',
                        'Dibatalkan' => 'badge-nonaktif',
                        default => 'badge-dipesan'
                    };
                @endphp
                
                <div class="dropdown">
                    <button class="btn badge-status {{ $statusClass }} dropdown-toggle" 
                            type="button" 
                            id="statusDropdown{{ $loop->index }}" 
                            data-bs-toggle="dropdown" 
                            aria-expanded="false">
                        {{ $reservation['status'] }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="statusDropdown{{ $loop->index }}">
                        <li><a class="dropdown-item" href="#">Menunggu Konfirmasi</a></li>
                        <li><a class="dropdown-item" href="#">Check In</a></li>
                        <li><a class="dropdown-item" href="#">Selesai</a></li>
                        <li><a class="dropdown-item" href="#">Dibatalkan</a></li>
                    </ul>
                </div>
            </td>
            <td>
                <div class="action-buttons">
                        <a href="{{ route('reservasi-detail') }}" class="btn-action btn-detail">
                        <i class="bi bi-eye-fill"></i>
                    </a>
                    <button class="btn-action btn-delete">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </div>
            </td>
        </tr>
        @endforeach

    </x-data-table>
</div>

@endsection