@extends('layouts.admin-layout')
@props(['header' => 'Reservasi'])
@section('admin-content')

<div class="p-4">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <x-data-table title="Daftar Reservasi" :headers="$tableHeader" :addButton="false"
        :filterOptions="['Menunggu', 'Dikonfirmasi', 'Selesai', 'Dibatalkan']" :data="$reservations" :exportButton="true">

        @forelse ($reservations as $reservation)
        <tr>
            <td>{{ $reservation->kode_reservasi }}</td>
            <td>{{ $reservation->kamar->kode_tipe ?? 'N/A' }}</td>
            <td>{{ \Carbon\Carbon::parse($reservation->tgl_checkin)->format('d M Y') }}</td>
            <td>{{ \Carbon\Carbon::parse($reservation->tgl_checkout)->format('d M Y') }}</td>
            <td>
                @php
                $statusClass = match($reservation->status) {
                'Menunggu' => 'badge-dipesan',
                'Dikonfirmasi' => 'badge-terisi',
                'Selesai' => 'badge-tersedia',
                'Dibatalkan' => 'badge-nonaktif',
                default => 'badge-dipesan'
                };
                @endphp

                <div class="dropdown">
                    <button class="btn badge-status {{ $statusClass }} dropdown-toggle" type="button"
                        id="statusDropdown{{ $loop->index }}" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ $reservation->status }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="statusDropdown{{ $loop->index }}">
                        <li>
                            <form action="{{ route('admin.reservasi.update-status', $reservation->id_reservasi) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="Menunggu">
                                <button type="submit" class="dropdown-item">Menunggu</button>
                            </form>
                        </li>
                        <li>
                            <form action="{{ route('admin.reservasi.update-status', $reservation->id_reservasi) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="Dikonfirmasi">
                                <button type="submit" class="dropdown-item">Dikonfirmasi</button>
                            </form>
                        </li>
                        <li>
                            <form action="{{ route('admin.reservasi.update-status', $reservation->id_reservasi) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="Selesai">
                                <button type="submit" class="dropdown-item">Selesai</button>
                            </form>
                        </li>
                        <li>
                            <form action="{{ route('admin.reservasi.update-status', $reservation->id_reservasi) }}"
                                method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="Dibatalkan">
                                <button type="submit" class="dropdown-item">Dibatalkan</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </td>
            <td>
                <div class="action-buttons">
                    <a href="{{ route('reservasi-detail', $reservation->id_reservasi) }}" class="btn-action btn-detail">
                        <i class="bi bi-eye-fill"></i>
                    </a>
                    <button class="btn-action btn-delete" data-bs-toggle="modal"
                        data-bs-target="#deleteModal{{ $reservation->id_reservasi }}">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </div>
            </td>
        </tr>

        <!-- Modal Delete untuk setiap reservasi -->
        <div class="modal fade" id="deleteModal{{ $reservation->id_reservasi }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered delete-modal-dialog">
                <div class="modal-content delete-modal">
                    <button type="button" class="btn-close delete-close" data-bs-dismiss="modal"></button>
                    <div class="modal-body text-center delete-modal-body">
                        <h6 class="fw-bold mb-3 delete-title">
                            Apakah Anda yakin ingin<br>menghapus reservasi {{ $reservation->kode_reservasi }}?
                        </h6>
                        <div class="d-flex gap-2 justify-content-center mt-4">
                            <button class="btn btn-tidak" data-bs-dismiss="modal">Tidak</button>
                            <form action="{{ route('admin.reservasi.delete', $reservation->id_reservasi) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-ya">Ya</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @empty
        <tr>
            <td colspan="6" class="text-center">Tidak ada data reservasi</td>
        </tr>
        @endforelse

    </x-data-table>
</div>

@endsection