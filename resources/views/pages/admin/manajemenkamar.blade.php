@extends('layouts.admin-layout')
@props(['header' => 'Kamar'])
@section('admin-content')

@if(session('success'))
<div class="container-fluid px-4 pt-3">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill me-2"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
</div>
@endif

@if($errors->any())
<div class="container-fluid px-4 pt-3">
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle-fill me-2"></i>
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
</div>
@endif

<div class="p-4">
    <x-data-table title="Daftar Kamar" :headers="$tableHeader"
        :filterOptions="['Tersedia', 'Terisi', 'Dipesan', 'Nonaktif']" :addButton="true" :actionColumn="false"
        data-bs-target="#addModal" data-bs-toggle="modal">

        @foreach ($rooms as $room)
        <tr>
            <td>{{ $room->kode_tipe }}</td>
            <td>{{ $room->nama_unit }}</td>
            <td>{{ $room->kapasitas }} Orang</td>
            <td>{{ $room->kategori }}</td>
            <td>
                @php
                $statusClass = match($room->status) {
                    'Nonaktif' => 'badge-nonaktif',
                    'Tersedia' => 'badge-tersedia',
                    'Terisi' => 'badge-terisi',
                    'Dipesan' => 'badge-dipesan',
                    default => 'badge-tersedia'

                };
                @endphp

                {{-- Hanya Tersedia dan Nonaktif yang bisa diubah --}}
                @if(in_array($room->status, ['Tersedia', 'Nonaktif']))
                <form action="{{ route('admin.kamar.status', $room->id_tipe_villa) }}" method="POST" class="d-inline">
                    @csrf
                    @method('PATCH')
                    <div class="dropdown">
                        <button class="btn badge-status {{ $statusClass }} dropdown-toggle" type="button"
                            data-bs-toggle="dropdown">
                            {{ $room->status }}
                        </button>

                        <ul class="dropdown-menu">
                            <li>
                                <button class="dropdown-item" type="submit" name="status" value="Nonaktif">
                                    Nonaktif
                                </button>
                            </li>
                            <li>
                                <button class="dropdown-item" type="submit" name="status" value="Tersedia">
                                    Tersedia
                                </button>
                            </li>
                        </ul>
                    </div>
                </form>
                @else
                {{-- Status Terisi dan Dipesan hanya badge biasa --}}
                <span class="badge badge-status {{ $statusClass }}">
                    {{ $room->status }}
                </span>
                @endif
            </td>

            <td>
                <div class="action-buttons">
                    <button class="btn-action btn-edit" data-bs-toggle="modal"
                        data-bs-target="#editModal{{ $room->id_tipe_villa }}">
                        <i class="bi bi-pencil-fill"></i>
                    </button>


                    <a href="{{ route('admin.kamar-detail', $room->kode_tipe) }}" class="btn-action btn-detail">
                        <i class="bi bi-eye-fill"></i>
                    </a>

                    <button class="btn-action btn-delete" data-bs-toggle="modal"
                        data-bs-target="#deleteModal{{ $room->id_tipe_villa }}">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </div>
            </td>
        </tr>

        <div class="modal fade" id="editModal{{ $room->id_tipe_villa }}" tabindex="-1">
            <div class="modal-dialog" style="max-width: 600px;">
                <div class="modal-content kamar-modal">
                    <form action="{{ route('admin.kamar.update', $room->id_tipe_villa) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="modal-header border-0">
                            <h5 class="modal-title text-success fw-bold text-center w-100"
                                style="color:#3A6E3A !important;">
                                Edit Kamar
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Unit Kamar</label>
                                    <input type="text" class="form-control kamar-input" name="nama_unit"
                                        value="{{ $room->nama_unit }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Kapasitas</label>
                                    <input type="number" class="form-control kamar-input" name="kapasitas"
                                        value="{{ $room->kapasitas }}" required>
                                </div>
                            </div>

                            <div class="row g-3 mt-1">
                                <div class="col-md-6">
                                    <label class="form-label">Harga Weekday</label>
                                    <input type="number" class="form-control kamar-input" name="harga_weekday"
                                        value="{{ $room->harga_weekday }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Harga Weekend</label>
                                    <input type="number" class="form-control kamar-input" name="harga_weekend"
                                        value="{{ $room->harga_weekend }}" required>
                                </div>
                            </div>

                            <div class="mt-3">
                                <label class="form-label">Kategori</label>
                                <div class="select-wrapper">
                                    <select class="form-select kamar-input custom-select" name="kategori" required>
                                        <option value="Deluxe Bed" {{ $room->kategori == 'Deluxe Bed' ? 'selected' : '' }}>Deluxe Bed</option>
                                        <option value="Queen Bed" {{ $room->kategori == 'Queen Bed' ? 'selected' : '' }}>Queen Bed</option>
                                        <option value="Twin Bed" {{ $room->kategori == 'Twin Bed' ? 'selected' : '' }}>Twin Bed</option>
                                        <option value="Super Deluxe" {{ $room->kategori == 'Super Deluxe' ? 'selected' : '' }}>Super Deluxe</option>
                                        <option value="Family Room" {{ $room->kategori == 'Family Room' ? 'selected' : '' }}>Family Room</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mt-3">
                                <label class="form-label">Status</label>
                                <div class="select-wrapper">
                                    <select class="form-select kamar-input custom-select" name="status" required>
                                        <option value="Tersedia" {{ $room->status == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                                        <option value="Terisi" {{ $room->status == 'Terisi' ? 'selected' : '' }}>Terisi</option>
                                        <option value="Dipesan" {{ $room->status == 'Dipesan' ? 'selected' : '' }}>Dipesan</option>
                                        <option value="Nonaktif" {{ $room->status == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mt-3">
                                <label class="form-label">Deskripsi Kamar</label>
                                <textarea class="form-control kamar-input" name="deskripsi"
                                    rows="3">{{ $room->deskripsi }}</textarea>
                            </div>

                            <div class="row g-3 mt-1">
                                <div class="col-md-6">
                                    <label class="form-label">Foto Kamar</label>
                                    <label class="upload-wrapper">
                                        <input type="file" name="foto_kamar" accept="image/*" hidden class="file-input-edit">
                                        <span class="file-name-display">{{ $room->foto_kamar ? basename($room->foto_kamar) : 'Upload foto' }}</span>
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            style="width: 22px; height: 22px; color: #198754;">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Kode Tipe</label>
                                    <input type="text" class="form-control kamar-input" name="kode_tipe"
                                        value="{{ $room->kode_tipe }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer border-0 d-flex justify-content-center">
                            <button type="submit" class="btn btn-success w-100 py-2 tombol-simpan">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        {{-- Delete Modal for each room --}}
        <x-delete-modal :id="$room->id_tipe_villa" :nama="$room->nama_unit" :route='kamar.delete'></x-delete-modal>
        @endforeach

    </x-data-table>
</div>

<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog" style="max-width: 600px;">
        <div class="modal-content kamar-modal">
            <form action="{{ route('admin.kamar.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-header border-0">
                    <h5 class="modal-title text-success fw-bold text-center w-100" style="color:#3A6E3A !important;">
                        Tambah Kamar
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Kode Tipe</label>
                            <input type="text" class="form-control kamar-input" name="kode_tipe"
                                value="{{ $nextKodeTipe }}" readonly style="background-color: #e9ecef;">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Unit Kamar</label>
                            <input type="text" class="form-control kamar-input" name="nama_unit"
                                placeholder="Masukkan nama unit kamar" required>
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-md-6">
                            <label class="form-label">Kapasitas</label>
                            <input type="number" class="form-control kamar-input" name="kapasitas"
                                placeholder="Masukkan kapasitas" min="1" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kategori</label>
                            <div class="select-wrapper">
                                <select class="form-select kamar-input custom-select" name="kategori" required>
                                    <option selected disabled>Pilih kategori kamar</option>
                                    <option value="Deluxe Bed">Deluxe Bed</option>
                                    <option value="Queen Bed">Queen Bed</option>
                                    <option value="Twin Bed">Twin Bed</option>
                                    <option value="Super Deluxe">Super Deluxe</option>
                                    <option value="Family Room">Family Room</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-md-6">
                            <label class="form-label">Harga Weekday</label>
                            <input type="number" class="form-control kamar-input" name="harga_weekday"
                                placeholder="Masukkan harga weekday" min="0" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Harga Weekend</label>
                            <input type="number" class="form-control kamar-input" name="harga_weekend"
                                placeholder="Masukkan harga weekend" min="0" required>
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <div class="select-wrapper">
                                <select class="form-select kamar-input custom-select" name="status" required>
                                    <option value="Tersedia" selected>Tersedia</option>
                                    <option value="Nonaktif">Nonaktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Foto Kamar</label>
                            <label class="upload-wrapper">
                                <input type="file" name="foto_kamar" accept="image/*" hidden class="file-input-add">
                                <span class="file-name-display">Upload foto</span>
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    style="width: 22px; height: 22px; color: #198754;">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                            </label>
                        </div>
                    </div>

                    <div class="mt-3">
                        <label class="form-label">Deskripsi Kamar</label>
                        <textarea class="form-control kamar-input" name="deskripsi" rows="3"
                            placeholder="Masukkan deskripsi kamar"></textarea>
                    </div>
                </div>

                <div class="modal-footer border-0 d-flex justify-content-center">
                    <button type="submit" class="btn btn-success w-100 py-2 tombol-simpan">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    setTimeout(function() {
        let alerts = document.querySelectorAll('.alert');
        alerts.forEach(function(alert) {
            let bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        });
    }, 5000);

    document.querySelectorAll('.file-input-add').forEach(input => {
        input.addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name || 'Upload foto';
            const span = this.parentElement.querySelector('.file-name-display');
            if (span) span.textContent = fileName;
        });
    });

    document.querySelectorAll('.file-input-edit').forEach(input => {
        input.addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name || 'Upload foto';
            const span = this.parentElement.querySelector('.file-name-display');
            if (span) span.textContent = fileName;
        });
    });
</script>

@endsection