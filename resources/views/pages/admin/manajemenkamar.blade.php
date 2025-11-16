@extends('layouts.admin-layout')
@props(['header' => 'Kamar'])
@section('admin-content')

<div class="p-4">
    <x-data-table title="Daftar Kamar" :headers="$tableHeader"
        :filterOptions="['Tersedia', 'Terisi', 'Dipesan', 'Nonaktif']" :addButton="true" :actionColumn="false"
        data-bs-target="#addModal" data-bs-toggle="modal">

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
                    <button class="btn badge-status {{ $statusClass }} dropdown-toggle" type="button"
                        data-bs-toggle="dropdown">
                        {{ $room['status'] }}
                    </button>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Nonaktif</a></li>
                        <li><a class="dropdown-item" href="#">Tersedia</a></li>
                        <li><a class="dropdown-item" href="#">Terisi</a></li>
                        <li><a class="dropdown-item" href="#">Dipesan</a></li>
                    </ul>
                </div>
            </td>

            <td>
                <div class="action-buttons">

                    <button class="btn-action btn-edit" data-bs-toggle="modal" data-bs-target="#editModal">
                        <i class="bi bi-pencil-fill"></i>
                    </button>

                    <a href="{{ route('kamar-detail') }}" class="btn-action btn-detail">
                        <i class="bi bi-eye-fill"></i>
                    </a>

                    <button class="btn-action btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </div>
            </td>
        </tr>
        @endforeach

    </x-data-table>
</div>


<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog" style="max-width: 600px;">
        <div class="modal-content kamar-modal">

            <div class="modal-header border-0">
                <h5 class="modal-title text-success fw-bold text-center w-100" style="color:#3A6E3A !important;">
                    Edit Kamar
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <div class="row g-3">

                    <div class="col-md-6">
                        <label class="form-label">Unit Kamar</label>
                        <input type="text" class="form-control kamar-input" value="Kamar Deluxe A1">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Kapasitas</label>
                        <input type="text" class="form-control kamar-input" value="2 Orang">
                    </div>

                </div>

                <div class="row g-3 mt-1">

                    <div class="col-md-6">
                        <label class="form-label">Harga Weekday</label>
                        <input type="text" class="form-control kamar-input" value="Rp 350.000">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Harga Weekend</label>
                        <input type="text" class="form-control kamar-input" value="Rp 450.000">
                    </div>

                </div>

                <div class="mt-3">
                    <label class="form-label">Kategori</label>
                    <div class="select-wrapper">
                        <select class="form-select kamar-input custom-select">
                            <option>Standard</option>
                            <option selected>Deluxe</option>
                            <option>Suite</option>
                        </select>
                    </div>
                </div>


                <div class="mt-3">
                    <label class="form-label">Deskripsi Kamar</label>
                    <textarea class="form-control kamar-input"
                        rows="3">Kamar dengan pemandangan taman, dilengkapi AC, TV, dan kamar mandi dalam</textarea>
                </div>

                <div class="row g-3 mt-1">

                    <div class="col-md-6">
                        <label class="form-label">Foto Kamar</label>

                        <label class="upload-wrapper">
                            <input type="file" hidden>
                            <span>kamar-deluxe.jpg</span>
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                style="width: 22px; height: 22px; color: #198754;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                        </label>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Kode Tipe</label>
                        <input type="text" class="form-control kamar-input" value="DLX-001">
                    </div>

                </div>

            </div>

            <div class="modal-footer border-0 d-flex justify-content-center">
                <button class="btn btn-success w-100 py-2 tombol-simpan">Simpan Perubahan</button>
            </div>

        </div>
    </div>
</div>


<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog" style="max-width: 600px;">
        <div class="modal-content kamar-modal">
            <div class="modal-header border-0">
                <h5 class="modal-title text-success fw-bold text-center w-100" style="color:#3A6E3A !important;">
                    Tambah Kamar
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Unit Kamar</label>
                        <input type="text" class="form-control kamar-input" placeholder="Masukkan nama unit kamar">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Kapasitas</label>
                        <input type="text" class="form-control kamar-input" placeholder="Masukkan kapasitas kamar">
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <label class="form-label">Harga Weekday</label>
                        <input type="text" class="form-control kamar-input" placeholder="Masukkan harga kamar">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Harga Weekend</label>
                        <input type="text" class="form-control kamar-input" placeholder="Masukkan harga kamar">
                    </div>
                </div>
                <div class="mt-3">
                    <label class="form-label">Kategori</label>
                    <div class="select-wrapper">
                        <select class="form-select kamar-input custom-select">
                            <option selected disabled>Pilih kategori kamar</option>
                        </select>
                    </div>
                </div>
                <div class="mt-3">
                    <label class="form-label">Deskripsi Kamar</label>
                    <textarea class="form-control kamar-input" rows="3"
                        placeholder="Masukkan deskripsi kamar"></textarea>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <label class="form-label">Foto Kamar</label>
                        <label class="upload-wrapper">
                            <input type="file" hidden>
                            <span>Upload foto</span>
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                style="width: 22px; height: 22px; color: #198754;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                            </svg>
                        </label>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Kode Tipe</label>
                        <input type="text" class="form-control kamar-input" placeholder="Masukkan kode tipe">
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 d-flex justify-content-center">
                <button class="btn btn-success w-100 py-2 tombol-simpan">Simpan</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered delete-modal-dialog">
        <div class="modal-content delete-modal">
            
            <button type="button" class="btn-close delete-close" data-bs-dismiss="modal"></button>

            <div class="modal-body text-center delete-modal-body">
                <h6 class="fw-bold mb-3 delete-title">
                    Apakah Anda yakin ingin<br>menghapus kamar ini?
                </h6>

                <div class="d-flex gap-2 justify-content-center mt-4">
                    <button class="btn btn-tidak" data-bs-dismiss="modal">Tidak</button>
                    <button class="btn btn-ya">Ya</button>
                </div>
            </div>

        </div>
    </div>
</div>


@endsection