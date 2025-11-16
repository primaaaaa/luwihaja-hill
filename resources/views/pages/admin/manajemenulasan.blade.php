@extends('layouts.admin-layout')
@props(['header' => 'Ulasan'])
@section('admin-content')

@php
$reviews = [
    ['id' => 1, 'nama_tamu' => 'Prima Yudhistira', 'kode_reservasi' => 'V101', 'rating' => '5.0', 'komentar' => 'Bagus, Mantap, dan...', 'tanggal' => '2025-09-14'],
    ['id' => 2, 'nama_tamu' => 'Ahmad Rizki', 'kode_reservasi' => 'V102', 'rating' => '4.5', 'komentar' => 'Pelayanan ramah...', 'tanggal' => '2025-09-13'],
    ['id' => 3, 'nama_tamu' => 'Siti Nurhaliza', 'kode_reservasi' => 'V103', 'rating' => '5.0', 'komentar' => 'Sangat memuaskan!', 'tanggal' => '2025-09-12'],
];
@endphp

<div class="p-4">
    <x-data-table 
        title="Daftar Ulasan"
        :headers="$tableHeader"
        :addButton="false"
        :exportButton="false"
        :filterOptions="[]">

        @foreach ($reviews as $review)
        <tr>
            <td>{{ $review['nama_tamu'] }}</td>
            <td>{{ $review['kode_reservasi'] }}</td>
            <td>{{ $review['rating'] }}</td>
            <td>{{ $review['komentar'] }}</td>
            <td>{{ $review['tanggal'] }}</td>
            <td>
                <div class="action-buttons">
                    <a href="{{ route('ulasan-detail') }}" class="btn-action btn-detail">
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