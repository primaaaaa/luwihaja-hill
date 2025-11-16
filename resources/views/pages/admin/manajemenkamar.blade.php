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

                    <button class="btn-action btn-delete" onclick="confirmDelete()">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </div>
            </td>
        </tr>
        @endforeach

    </x-data-table>
</div>


<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Kamar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                <p>Form edit kamar (nanti diisi).</p>
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-success">Simpan</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Kamar Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">
                {{-- <p>Form tambah kamar (nanti diisi).</p> --}}
            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <button class="btn btn-success">Simpan</button>
            </div>
        </div>
    </div>
</div>


<script>
    function confirmDelete() {
    if (confirm('Apakah Anda yakin ingin menghapus kamar ini?')) {
        alert('Kamar berhasil dihapus!');
    }
}
</script>

@endsection