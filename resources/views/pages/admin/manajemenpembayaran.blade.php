@extends('layouts.admin-layout')
@props(['header' => 'Pembayaran'])
@section('admin-content')

<div class="p-4">
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <x-data-table title="Daftar Pembayaran" :headers="$tableHeader" :addButton="false" :exportButton="true" :data="$pembayarans"
        :filterOptions="['Menunggu', 'Lunas', 'Batal']">

        @forelse ($pembayarans as $payment)
        <tr data-status="{{ $payment->status }}">
            <td>{{ $payment->reservasi->kode_reservasi ?? 'N/A' }}</td>
            <td>{{ $payment->reservasi->user->nama ?? 'N/A' }}</td>
            <td>{{ $payment->tgl_pembayaran ? $payment->tgl_pembayaran->format('d-m-Y') : '-' }}</td>
            <td>
                Rp {{ number_format($payment->reservasi->total_harga ?? 0, 0, ',', '.') }}
            </td>
            <td>
                @php
                $statusClass = match($payment->status) {
                    'Menunggu' => 'badge-dipesan',
                    'Lunas' => 'badge-tersedia',
                    'Batal' => 'badge-nonaktif',
                    default => 'badge-dipesan'
                };
                @endphp

                @if($payment->status === 'Menunggu')
                <div class="dropdown">
                    <button class="btn badge-status {{ $statusClass }} dropdown-toggle" type="button"
                        id="statusDropdown{{ $loop->index }}" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ $payment->status }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="statusDropdown{{ $loop->index }}">
                        <li>
                            <form action="{{ route('pembayaran-update-status', $payment->id_pembayaran) }}"
                                method="POST">
                                @csrf
                                <input type="hidden" name="status" value="Menunggu">
                                <button type="submit" class="dropdown-item">Menunggu</button>
                            </form>
                        </li>
                        <li>
                            <form action="{{ route('pembayaran-update-status', $payment->id_pembayaran) }}"
                                method="POST">
                                @csrf
                                <input type="hidden" name="status" value="Lunas">
                                <button type="submit" class="dropdown-item">Lunas</button>
                            </form>
                        </li>
                        <li>
                            <form action="{{ route('pembayaran-update-status', $payment->id_pembayaran) }}"
                                method="POST">
                                @csrf
                                <input type="hidden" name="status" value="Batal">
                                <button type="submit" class="dropdown-item">Batal</button>
                            </form>
                        </li>
                    </ul>
                </div>
                @else
                <span class="btn badge-status {{ $statusClass }}">{{ $payment->status }}</span>
                @endif
            </td>
            <td>
                <div class="action-buttons">
                    <a href="{{ route('pembayaran-detail', $payment->id_pembayaran) }}" class="btn-lihat-detail">
                        Lihat Detail
                    </a>
                </div>
            </td>
        </tr>

        @empty
        <tr>
            <td colspan="6" class="text-center">Tidak ada data pembayaran</td>
        </tr>
        @endforelse

    </x-data-table>
</div>

@endsection