@extends('layouts.app')

@section('title', 'Riwayat Pembayaran | Luwihaja Hill')

@section('content')

<!-- Hero -->
<section class="hero">
  <div class="overlay"></div>
  <div class="hero-inner">
    <h1>Riwayat <span class="accent">Pembayaran</span></h1>
    <p>Kelola dan pantau seluruh transaksi Anda di sini. Pastikan semua reservasi tercatat dengan jelas dan aman.</p>
  </div>
</section>

<!-- Table Section -->
<section class="table-section">
  <div class="container">
    <!-- Header with Title and Search -->
    <div class="section-header">
      <h2 class="section-title">Daftar Pembayaran</h2>

      <div class="search-wrapper">
        <div class="search-box-riwayat">
          <input type="text" id="searchInput" placeholder="Cari pembayaran...">
          <span class="search-icon">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <circle cx="11" cy="11" r="7" stroke="currentColor" stroke-width="2" />
              <path d="M20 20L17 17" stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            </svg>
          </span>
        </div>
      </div>
    </div>

    @if(session('success'))
    <div class="alert alert-success"
      style="padding: 16px; background: #d4edda; color: #155724; border-radius: 8px; margin-bottom: 24px;">
      {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger"
      style="padding: 16px; background: #f8d7da; color: #721c24; border-radius: 8px; margin-bottom: 24px;">
      {{ session('error') }}
    </div>
    @endif

    <div class="table-wrapper">
      <table>
        <thead>
          <tr>
            <th>Nama Tamu</th>
            <th>Kode Pembayaran</th>
            <th>Kode Reservasi</th>
            <th>Total Harga</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody id="tableBody">
          @forelse($pembayarans as $pembayaran)
          <tr>
            <td>{{ Auth::user()->nama }}</td>
            <td>{{ $pembayaran->kode_pembayaran }}</td>
            <td>{{ $pembayaran->reservasi->kode_reservasi ?? '-' }}</td>
            <td style="font-weight: 600; color: #198754;">
              Rp {{ number_format($pembayaran->reservasi->total_harga ?? 0, 0, ',', '.') }}
            </td>

            <td>
              @php
              $statusClean = trim($pembayaran->status);
              @endphp
              
              @if($statusClean === 'Lunas')
              <span class="badge badge-success">Lunas</span>
              @elseif($statusClean === 'Batal')
              <span class="badge badge-danger">Batal</span>
              @elseif($statusClean === 'Menunggu')
              <span class="badge badge-warning">Menunggu</span>
              @else
              <span class="badge badge-secondary">{{ $statusClean }}</span>
              @endif
            </td>

            <td>
              @if($statusClean === 'Menunggu')
              <button class="btn-refund" onclick="openModalRefund(
                '{{ $pembayaran->id_pembayaran }}',
                '{{ $pembayaran->reservasi->kode_reservasi }}',
                '{{ $pembayaran->reservasi->tgl_checkin }}',
                '{{ $pembayaran->reservasi->tgl_checkout }}',
                '{{ $pembayaran->reservasi->total_harga }}'
              )">
                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M12 5V19M5 12H19" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" />
                </svg>
                Refund
              </button>
              @else
              <span class="text-muted" style="font-size: 14px;">
                {{ $statusClean === 'Lunas' ? 'Pembayaran Selesai' : 'Dibatalkan' }}
              </span>
              @endif
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" style="text-align: center; padding: 40px; color: #6c757d;">
              <svg style="width: 64px; height: 64px; margin-bottom: 16px; opacity: 0.5;" fill="none"
                stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                </path>
              </svg>
              <p style="font-size: 16px; margin: 0;">Belum ada riwayat pembayaran</p>
              <a href="{{ route('pages.booking') }}"
                style="display: inline-block; margin-top: 16px; padding: 10px 24px; background: #198754; color: white; text-decoration: none; border-radius: 6px;">
                Mulai Booking
              </a>
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <!-- Pagination -->
    @if($pembayarans->hasPages())
    <div class="pagination-wrapper">
      <div class="pagination-info">
        Menampilkan {{ $pembayarans->firstItem() ?? 0 }} sampai {{ $pembayarans->lastItem() ?? 0 }} dari {{ $pembayarans->total() }} data
      </div>
      <div class="pagination">
        {{-- Previous Page --}}
        @if ($pembayarans->onFirstPage())
        <button disabled>‹</button>
        @else
        <a href="{{ $pembayarans->previousPageUrl() }}"><button>‹</button></a>
        @endif

        {{-- Page Numbers --}}
        @foreach ($pembayarans->getUrlRange(1, $pembayarans->lastPage()) as $page => $url)
        @if ($page == $pembayarans->currentPage())
        <button class="active">{{ $page }}</button>
        @else
        <a href="{{ $url }}"><button>{{ $page }}</button></a>
        @endif
        @endforeach

        {{-- Next Page --}}
        @if ($pembayarans->hasMorePages())
        <a href="{{ $pembayarans->nextPageUrl() }}"><button>›</button></a>
        @else
        <button disabled>›</button>
        @endif
      </div>
    </div>
    @endif
  </div>
</section>

<script>
  const searchInput = document.getElementById('searchInput');
  const tableBody = document.getElementById('tableBody');
  const rows = tableBody.querySelectorAll('tr');

  searchInput.addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();

    rows.forEach(row => {
      const text = row.textContent.toLowerCase();
      if (text.includes(searchTerm)) {
        row.style.display = '';
      } else {
        row.style.display = 'none';
      }
    });
  });

  function openModalRefund(idPembayaran, kodeReservasi, checkIn, checkOut, totalHarga) {
    document.getElementById('id_pembayaran').value = idPembayaran;
    document.getElementById('kode_reservasi_display').value = kodeReservasi;
    document.getElementById('check_in_display').value = checkIn;
    document.getElementById('check_out_display').value = checkOut;
    document.getElementById('nominal_refund_display').value = 'Rp ' + parseInt(totalHarga).toLocaleString('id-ID');