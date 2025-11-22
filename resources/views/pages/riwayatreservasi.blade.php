@extends('layouts.app')

@section('title', 'Riwayat Reservasi | Luwihaja Hill')

@section('content')

<section class="hero">
    <div class="overlay"></div>
    <div class="hero-inner">
        <h1>Riwayat <span class="accent">Reservasi</span></h1>
        <p>Kelola dan pantau seluruh reservasi villa Anda di sini.</p>
    </div>
</section>

<section class="table-section">
    <div class="container">

        <div class="section-header">
            <h2>Daftar Reservasi Saya</h2>

            <div class="search-wrapper">
                <div class="search-box-riwayat">
                    <input type="text" id="searchInput" placeholder="Cari reservasi...">
                    <span class="search-icon">
                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2" />
                            <path d="M20 20L17 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                        </svg>
                    </span>
                </div>
            </div>
        </div>

        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Nama Tamu</th>
                        <th>Kode Reservasi</th>
                        <th>Check-in</th>
                        <th>Check-out</th>
                        <th>Kode Kamar</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody id="reservasiTable">
                    @foreach ($reservasis as $r)
                    <tr>
                        <td>{{ Auth::user()->nama }}</td>

                        <td>{{ $r->kode_reservasi }}</td>

                        <td>{{ \Carbon\Carbon::parse($r->tgl_checkin)->format('d M Y') }}</td>

                        <td>{{ \Carbon\Carbon::parse($r->tgl_checkout)->format('d M Y') }}</td>

                        <td>{{ $r->kamar->kode_tipe }}</td>

                        <td>
                            @php
                            $statusClean = trim($r->status);
                            @endphp

                            @if($statusClean === 'Dikonfirmasi' || $statusClean === 'Konfirmasi')
                            <span class="badge badge-success">Dikonfirmasi</span>
                            @elseif($statusClean === 'Batal' || $statusClean === 'Dibatalkan')
                            <span class="badge badge-danger">Dibatalkan</span>
                            @elseif($statusClean === 'Selesai' || $statusClean === 'Completed')
                            <span class="badge badge-info">Selesai</span>
                            @elseif($statusClean === 'Menunggu')
                            <span class="badge badge-warning">Menunggu</span>
                            @else
                            <span class="badge badge-secondary">{{ $statusClean }}</span>
                            @endif
                        </td>

                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>

        <div class="pagination-wrapper">
            {{ $reservasis->links() }}
        </div>

    </div>
</section>

@endsection