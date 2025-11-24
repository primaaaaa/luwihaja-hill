@extends('layouts.app')

@section('title', 'Riwayat Refund | Luwihaja Hill')

@section('content')

<section class="page-header">
    <div class="overlay"></div>
    <div class="hero-inner">
        <h1>Riwayat <span class="accent">Refund</span></h1>
        <p>Lihat kembali <a href="{{ url('/riwayatpembayaran') }}" class="link-white-underline">pembayaran</a> villa Anda sebelumnya.</p>
    </div>
</section>

<div class="table-section refund-section">
    <div class="container">

        <div class="section-header">
            <h2>Daftar Refund Saya</h2>

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
                        <th>Kode Refund</th>
                        <th>Kode Reservasi</th>
                        <th>Kode Pembayaran</th>
                        <th>Tanggal Pengajuan</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody id="refundTable">
                    @foreach ($refunds as $r)
                    <tr>
                        <td>{{ Auth::user()->nama }}</td>

                        <td>{{ $r->kode_refund }}</td>

                        <td>{{ $r->reservasi->kode_reservasi ?? '-' }}</td>

                        <td>{{ $r->pembayaran->kode_pembayaran ?? '-' }}</td>


                        <td>{{ \Carbon\Carbon::parse($r->tgl_pengajuan)->format('d M Y') }}</td>
                        <td>
                            @php
                            $statusClean = trim($r->status);
                            @endphp

                            @if($statusClean === 'Disetujui')
                            <span class="badge badge-success">Disetujui</span>
                            @elseif($statusClean === 'Ditolak')
                            <span class="badge badge-danger">Ditolak</span>
                            @elseif($statusClean === 'Menunggu')
                            <span class="badge badge-warning">Menunggu</span>
                            @elseif($statusClean === 'Dibayar')
                            <span class="badge badge-info">Dibayar</span>
                            @else
                            <span class="badge badge-secondary">{{ $statusClean }}</span>
                            @endif

                        </td>
                    </tr>
                    @endforeach
                    @if ($refunds->isEmpty())
                    <tr>
                        <td colspan="6" style="text-align: center;">Belum ada refund diajukan.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            {{ $refunds->links() }}
        </div>

    </div>
</section>

@endsection

@push('scripts')
<script>
    const searchInput = document.getElementById('searchInput');
    const tableBody = document.getElementById('refundTable');
    const rows = tableBody.querySelectorAll('tr');

    searchInput.addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();

        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });
</script>
@endpush