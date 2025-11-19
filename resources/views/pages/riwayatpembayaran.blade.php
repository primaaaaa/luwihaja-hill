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
              @if($pembayaran->status == 'Menunggu')
              <span class="badge badge-warning">Menunggu</span>
              @elseif($pembayaran->status == 'Lunas')
              <span class="badge badge-success">Lunas</span>
              @elseif($pembayaran->status == 'Batal')
              <span class="badge badge-danger">Batal</span>
              @else
              <span class="badge badge-secondary">{{ $pembayaran->status }}</span>
              @endif
            </td>

            <td>
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
        Menampilkan {{ $pembayarans->firstItem() ?? 0 }} sampai {{ $pembayarans->lastItem() ?? 0 }} dari {{
        $pembayarans->total() }} data
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

<!-- Modal Refund -->
{{-- <div id="modalRefund" class="modal-refund">
  <div class="modal-refund-content">
    <div class="modal-refund-header">
      <h2>Formulir Pengajuan Refund</h2>
      <button class="close-modal-refund" onclick="closeModalRefund()">&times;</button>
    </div>
    <div class="modal-refund-body">
      <form id="formRefund" method="POST" action="{{ route('refund.store') }}" enctype="multipart/form-data">
        @csrf

        <input type="hidden" id="id_pembayaran" name="id_pembayaran" value="">

        <div class="form-refund-row">
          <div class="form-refund-group">
            <label>Nama Pemesan</label>
            <input type="text" value="{{ Auth::user()->nama }}" readonly>
          </div>
          <div class="form-refund-group">
            <label>Kode Reservasi</label>
            <input type="text" id="kode_reservasi_display" value="" readonly>
          </div>
        </div>

        <div class="form-refund-row">
          <div class="form-refund-group">
            <label>Tanggal Check In</label>
            <input type="date" id="check_in_display" value="" readonly>
          </div>
          <div class="form-refund-group">
            <label>Tanggal Check Out</label>
            <input type="date" id="check_out_display" value="" readonly>
          </div>
        </div>

        <div class="form-refund-group">
          <label>Alasan Refund <span style="color: red;">*</span></label>
          <textarea name="alasan_refund" placeholder="Contoh: Berubah Pikiran" required></textarea>
        </div>

        <div class="form-refund-row">
          <div class="form-refund-group">
            <label>Nominal Refund</label>
            <input type="text" id="nominal_refund_display" readonly>
          </div>
          <div class="form-refund-group">
            <label>Bukti Pendukung (Opsional)</label>
            <div class="file-upload-refund-wrapper">
              <label for="fileUploadRefund" class="file-upload-refund-label" id="fileLabel">
                <span class="file-name-text">Pilih file</span>
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"
                  style="width: 20px; height: 20px; color: #40723F;">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                </svg>
              </label>
              <input type="file" name="bukti_pendukung" id="fileUploadRefund" style="display: none;"
                accept="image/*,.pdf">
            </div>
          </div>
        </div>

        <h3 class="form-refund-section-title">Rekening Pengembalian</h3>

        <div class="bank-refund-row">
          <div class="form-refund-group">
            <label>Nama Bank <span style="color: red;">*</span></label>
            <input type="text" name="nama_bank" placeholder="BCA" required>
          </div>
          <div class="form-refund-group">
            <label>Nomor Rekening <span style="color: red;">*</span></label>
            <input type="text" name="nomor_rekening" placeholder="920290290" required>
          </div>
          <div class="form-refund-group">
            <label>Nama Pemilik <span style="color: red;">*</span></label>
            <input type="text" name="nama_pemilik" placeholder="Prima Yudhistira" required>
          </div>
        </div>

        <button type="submit" class="btn-submit-refund">Kirim Pengajuan Refund</button>
      </form>
    </div>
  </div>
</div> --}}

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
    
    document.getElementById('modalRefund').classList.add('show');
    document.body.style.overflow = 'hidden';
  }

  function closeModalRefund() {
    document.getElementById('modalRefund').classList.remove('show');
    document.body.style.overflow = 'auto';
  }

  document.getElementById('modalRefund').addEventListener('click', function(e) {
    if (e.target === this) {
      closeModalRefund();
    }
  });

  document.getElementById('fileUploadRefund').addEventListener('change', function(e) {
    const fileName = e.target.files[0]?.name || 'Pilih file';
    document.querySelector('.file-name-text').textContent = fileName;
  });
</script>

@endsection