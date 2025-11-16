@extends('layouts.admin-layout')
@props(['header' => 'Pembayaran'])
@section('admin-content')

@php
$payments = [
    ['id' => 1, 'kode_reservasi' => 'V101', 'nama_tamu' => 'Prima', 'tanggal_pembayaran' => '2025-09-12', 'jumlah' => 'Rp 500.000', 'status' => 'Menunggu'],
    ['id' => 2, 'kode_reservasi' => 'V102', 'nama_tamu' => 'Prima', 'tanggal_pembayaran' => '2025-09-13', 'jumlah' => 'Rp 600.000', 'status' => 'Lunas'],
];
@endphp

<div class="p-4">
    <x-data-table 
        title="Daftar Pembayaran"
        :headers="$tableHeader"
        :addButton="false"
        :exportButton="true"
        :filterOptions="['Menunggu', 'Lunas', 'Batal']">

        @foreach ($payments as $payment)
        <tr>
            <td>{{ $payment['kode_reservasi'] }}</td>
            <td>{{ $payment['nama_tamu'] }}</td>
            <td>{{ $payment['tanggal_pembayaran'] }}</td>
            <td>{{ $payment['jumlah'] }}</td>
            <td>
                @php
                    $statusClass = match($payment['status']) {
                        'Menunggu' => 'badge-dipesan',
                        'Lunas' => 'badge-tersedia',
                        'Batal' => 'badge-nonaktif',
                        default => 'badge-dipesan'
                    };
                @endphp
                
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
                    <a href="{{ route('pembayaran-detail') }}" class="btn-action btn-detail">
                        <i class="bi bi-eye-fill"></i>
                    </a>
                </div>
            </td>
        </tr>
        @endforeach

    </x-data-table>
</div>

@endsection