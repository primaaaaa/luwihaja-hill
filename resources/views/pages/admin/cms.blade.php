@extends('layouts.admin-layout')
@props(['header' => 'CMS'])
@section('admin-content')

@php
$galleries = [
    [
        'kode_galeri' => 'G101',
        'file' => 'Foto.jpg',
        'tanggal_upload' => '2025-09-14'
    ],
    [
        'kode_galeri' => 'G101',
        'file' => 'Foto.jpg',
        'tanggal_upload' => '2025-09-14'
    ]
];
@endphp

<div class="p-4">
    <x-data-table 
        title="CMS Galeri"
        :headers="['Kode Galeri', 'File', 'Tanggal Upload']" 
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
                    <button class="btn-action btn-edit" title="Edit">
                        <i class="bi bi-pencil-fill"></i>
                    </button>
                    <button class="btn-action btn-detail" title="Detail">
                        <i class="bi bi-eye-fill"></i>
                    </button>
                </div>
            </td>
        </tr>
        @endforeach

    </x-data-table>
</div>

<!-- Modal Tambah Galeri -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Foto Galeri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Kode Galeri</label>
                        <input type="text" class="form-control" placeholder="Masukkan kode galeri">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Upload File</label>
                        <input type="file" class="form-control" accept="image/*">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </div>
</div>

@endsection