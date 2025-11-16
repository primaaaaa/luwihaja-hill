@extends('layouts.admin-layout')
@props(['header' => 'Kamar'])
@section('admin-content')
<div class="p-4">
    <x-data-table 
        title="Daftar Kamar" 
        :headers="['Kode Tipe', 'Unit', 'Kapasitas', 'Kategori', 'Status']"
        :filterOptions="['Tersedia', 'Terisi', 'Dipesan', 'Nonaktif']"
        :addButton="true">
        
        @foreach ($rooms as $room)
        <tr>
            <td>{{ $room['kode_tipe'] }}</td>
            <td>{{ $room['unit'] }}</td>
            <td>{{ $room['kapasitas'] }}</td>
            <td>{{ $room['kategori'] }}</td>
            <td>
                @php
                    $statusClass = match($room['status']) {
                        'Nonaktif' => 'badge-nonaktif',
                        'Tersedia' => 'badge-tersedia',
                        'Terisi' => 'badge-terisi',
                        'Dipesan' => 'badge-dipesan',
                        default => 'badge-tersedia'
                    };
                @endphp
                
                <!-- Status Dropdown -->
                <div class="dropdown">
                    <button class="btn badge-status {{ $statusClass }} dropdown-toggle" 
                            type="button" 
                            id="statusDropdown{{ $loop->index }}" 
                            data-bs-toggle="dropdown" 
                            aria-expanded="false">
                        {{ $room['status'] }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="statusDropdown{{ $loop->index }}">
                        <li><a class="dropdown-item" href="#">Nonaktif</a></li>
                        <li><a class="dropdown-item" href="#">Tersedia</a></li>
                        <li><a class="dropdown-item" href="#">Terisi</a></li>
                        <li><a class="dropdown-item" href="#">Dipesan</a></li>
                    </ul>
                </div>
            </td>
            <td>
                <div class="action-buttons">
                    <button class="btn-action btn-edit" title="Edit">
                        <i class="bi bi-pencil-fill"></i>
                    </button>
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

<!-- Modal Tambah Kamar -->
<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kamar Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label class="form-label">Kode Tipe</label>
                        <input type="text" class="form-control" placeholder="Masukkan kode tipe">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Unit</label>
                        <input type="text" class="form-control" placeholder="Masukkan nama unit">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kapasitas</label>
                        <input type="number" class="form-control" placeholder="Masukkan kapasitas">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <select class="form-select">
                            <option>Single Bed</option>
                            <option>Twin Bed</option>
                            <option>Queen Bed</option>
                            <option>Family Room</option>
                            <option>Deluxe Room</option>
                        </select>
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