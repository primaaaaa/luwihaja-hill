@extends('layouts.admin-layout')
@props(['header' => 'Ulasan'])
@section('admin-content')

@php
$reviews = [
    [
        'nama_tamu' => 'Prima Yudhistira',
        'kode_reservasi' => 'V101',
        'rating' => '5.0',
        'komentar' => 'Bagus, Mantap, dan...',
        'tanggal' => '2025-09-14'
    ],
    [
        'nama_tamu' => 'Eko Prasetyo',
        'kode_reservasi' => 'V106',
        'rating' => '4.8',
        'komentar' => 'Nyaman dan bersih...',
        'tanggal' => '2025-09-09'
    ],
    [
        'nama_tamu' => 'Rina Wati',
        'kode_reservasi' => 'V107',
        'rating' => '5.0',
        'komentar' => 'Pemandangan indah...',
        'tanggal' => '2025-09-08'
    ]
];
@endphp

<div class="p-4">
    <x-data-table 
        title="Daftar Ulasan"
        :headers="['Nama Tamu', 'Kode Reservasi', 'Rating', 'Komentar', 'Tanggal Ulasan']" 
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
                    <button class="btn-action btn-detail" title="Detail">
                        <i class="bi bi-eye-fill"></i>
                    </button>
                    <button class="btn-action btn-delete" title="Hapus">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </div>
            </td>
        </tr>
        @endforeach

    </x-data-table>
</div>

@endsection