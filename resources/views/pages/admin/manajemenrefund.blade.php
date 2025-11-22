@extends('layouts.admin-layout')
@props(['header' => 'Refund'])
@section('admin-content')

<div class="p-4">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <x-data-table 
        title="Daftar Pengajuan Refund"
        :headers="$tableHeader"
        :addButton="false"
        :exportButton="false"
        :filterOptions="['Menunggu', 'Disetujui', 'Ditolak', 'Dibayar']">

        @forelse ($refunds as $refund)
        <tr>
            <td>{{ $refund->kode_refund }}</td>
            <td>{{ $refund->reservasi->kode_reservasi ?? '-' }}</td>
            <td>{{ $refund->reservasi->user->nama ?? '-' }}</td>
            <td>{{ \Carbon\Carbon::parse($refund->tgl_pengajuan)->format('d-m-Y') }}</td>
            <td>
                @php
                    $statusClass = match($refund->status) {
                        'Menunggu' => 'badge-dipesan',
                        'Disetujui' => 'badge-tersedia',
                        'Dibayar' => 'badge-info',
                        'Ditolak' => 'badge-nonaktif',
                        default => 'badge-dipesan'
                    };
                @endphp
                
                <div class="dropdown">
                    <button class="btn badge-status {{ $statusClass }} dropdown-toggle" 
                            type="button" 
                            id="statusDropdown{{ $refund->id_refund }}" 
                            data-bs-toggle="dropdown" 
                            aria-expanded="false">
                        {{ $refund->status }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="statusDropdown{{ $refund->id_refund }}">
                        <li>
                            <form action="{{ route('refund.update-status', $refund->id_refund) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="Menunggu">
                                <button type="submit" class="dropdown-item">Menunggu</button>
                            </form>
                        </li>
                        <li>
                            <form action="{{ route('refund.update-status', $refund->id_refund) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="Disetujui">
                                <button type="submit" class="dropdown-item">Disetujui</button>
                            </form>
                        </li>
                        <li>
                            <form action="{{ route('refund.update-status', $refund->id_refund) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="Ditolak">
                                <button type="submit" class="dropdown-item">Ditolak</button>
                            </form>
                        </li>
                        <li>
                            <form action="{{ route('refund.update-status', $refund->id_refund) }}" method="POST">
                                @csrf
                                <input type="hidden" name="status" value="Dibayar">
                                <button type="submit" class="dropdown-item">Dibayar</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </td>
            <td>
                <div class="action-buttons">
                    <a href="{{ route('refund-detail', $refund->id_refund) }}" class="btn-lihat-detail">
                        Lihat Detail
                    </a>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" style="text-align: center; padding: 40px; color: #6c757d;">
                <p>Belum ada pengajuan refund</p>
            </td>
        </tr>
        @endforelse

    </x-data-table>
</div>

@endsection