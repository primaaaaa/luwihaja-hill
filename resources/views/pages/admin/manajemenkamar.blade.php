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
        :data="$rooms" data-bs-target="#addModal" data-bs-toggle="modal">

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
                <span class="badge badge-status {{ $statusClass }}" title="Status otomatis berdasarkan reservasi">
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

        <!-- Modal Edit -->
        <x-edit-modal :id="$room->id_tipe_villa" route="admin.kamar.update" title="Edit Kamar">
            <div class="row g-3">
                <div class="col-md-6">
                    <x-input-field label="Unit Kamar" type="text" name="nama_unit" value="{{ $room->nama_unit }}">
                    </x-input-field>
                </div>
                <div class="col-md-6">
                    <x-input-field label="Kapasitas" type="number" name="kapasitas" value="{{ $room->kapasitas }}"
                        required="true"></x-input-field>
                </div>
            </div>
            <div class="row g-3 mt-1">
                <div class="col-md-6">
                    <x-input-field label="Harga Weekday" type="number" name="harga_weekday"
                        value="{{ $room->harga_weekday }}" required="true"></x-input-field>
                </div>
                <div class="col-md-6">
                    <x-input-field label="Harga Weekend" type="number" name="harga_weekend"
                        value="{{ $room->harga_weekend }}" required="true"></x-input-field>
                </div>
            </div>

            <div class="mt-3">
                <x-select-field label="Kategori" name="kategori" required="true"
                    :option="['Deluxe Bed', 'Queen Bed', 'Twin Bed', 'Super Deluxe', 'Family Room']"
                    value="{{ $room->kategori }}"></x-select-field>
            </div>

            <div class="mt-3">
                <x-select-field label="Status" name="status" required="true"
                    :option="['Tersedia', 'Terisi', 'Dipesan', 'Nonaktif']" value="{{ $room->status }}">
                </x-select-field>
            </div>

            <div class="mt-3">
                <x-text-area label="Deskripsi Kamar" name="deskripsi" rows="3" value="{{ $room->deskripsi }}">
                </x-text-area>
            </div>

            <div class="row g-3 mt-1">
                <div class="col-md-6">
                    <x-file-upload label="Foto Kamar" name="foto_kamar" type="file"
                        value="{{$room->foto_kamar ? basename($room->foto_kamar) : 'Tidak ada Foto' }}"></x-file-upload>
                </div>
                <div class="col-md-6">
                    <x-input-field label="Kode Tipe" name="kode_tipe" type="text" value="{{ $room->kode_tipe }}"
                        required="true"></x-input-field>
                </div>
            </div>
        </x-edit-modal>

        <!-- Modal Delete -->
        <x-delete-modal :id="$room->id_tipe_villa" :nama="$room->nama_tipe" route="admin.kamar.delete" page="kamar">
        </x-delete-modal>
        @endforeach

    </x-data-table>
</div>

<x-add-modal route="admin.kamar.store" title="Tambah Kamar">
    <div class="row g-3">
        <div class="col-md-6">
            <x-input-field type="text" label="Kode Tipe" name="kode_tipe" :value="$nextKodeTipe" readonly="true">
            </x-input-field>
        </div>
        <div class="col-md-6">
            <x-input-field type="text" label="Nomor Unit" name="nama_unit" placeholder="Masukkan nomor unit kamar"
                required="true"></x-input-field>
        </div>
    </div>
    <div class="row g-3 mt-1">
        <div class="col-md-6">
            <x-input-field type="number" label="Kapasitas" name="kapasitas" placeholder="Masukkan kapasitas" min="1"
                required="true"></x-input-field>
        </div>
        <div class="col-md-6">
            <x-select-field label="Kategori" name="kategori" required="true"
                :option="['Deluxe Bed', 'Queen Bed', 'Twin Bed', 'Super Deluxe', 'Family Room']"
                placeholder="Pilih Kategori Kamar"></x-select-field>
        </div>
    </div>

    <div class="row g-3 mt-1">
        <div class="col-md-6">
            <x-input-field type="number" label="Harga Weekday" name="harga_weekday" placeholder="Masukkan harga weekday"
                min="0" required="true"></x-input-field>
        </div>
        <div class="col-md-6">
            <x-input-field type="number" label="Harga Weekend" name="harga_weekend" placeholder="Masukkan harga weekend"
                min="0" required="true"></x-input-field>
        </div>
    </div>

    <div class="row g-3 mt-1">
        <div class="col-md-6">
            <x-select-field label="Status" name="status" required="true" :option="['Tersedia', 'Nonaktif']">
            </x-select-field>
        </div>
        <div class="col-md-6">
            <x-file-upload label="Foto Kamar" name="foto_kamar"></x-file-upload>
        </div>
    </div>

    <div class="mt-3">
        <x-text-area label="Deskripsi Kamar" name="deskripsi" rows="3" placeholder="Masukkan deskripsi kamar">
        </x-text-area>
    </div>
</x-add-modal>

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