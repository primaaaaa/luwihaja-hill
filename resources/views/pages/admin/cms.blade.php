@extends('layouts.admin-layout')
@props(['header' => 'CMS'])
@section('admin-content')

@php
$galleries = [
    ['id' => 1, 'kode_galeri' => 'G101', 'file' => 'Foto.jpg', 'tanggal_upload' => '2025-09-14'],
    ['id' => 2, 'kode_galeri' => 'G101', 'file' => 'Foto.jpg', 'tanggal_upload' => '2025-09-14'],
    ['id' => 3, 'kode_galeri' => 'G101', 'file' => 'Foto.jpg', 'tanggal_upload' => '2025-09-14'],
];
@endphp

<div class="p-4">
    <x-data-table 
        title="CMS Galeri"
        :headers="$tableHeader"
        :addButton="true"
        :exportButton="false"
        :filterOptions="[]">

        @foreach ($galleries as $gallery)
        <tr>
            <td>{{ $gallery['kode_galeri'] }}</td>
            <td>{{ $gallery['file'] }}</td>
            <td>{{ $gallery['tanggal_upload'] }}</td>
            <td>
                <div class="action-buttons">
                    <a href="{{ route('cms-detail') }}" class="btn-action btn-detail">
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