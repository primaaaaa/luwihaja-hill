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
              @php
              $reservasi = $pembayaran->reservasi;
              $checkoutDate = $reservasi->tgl_checkout ?? null;
              $today = \Carbon\Carbon::today();
              @endphp

              @if($statusClean === 'Menunggu' || ($statusClean === 'Lunas' && $checkoutDate &&
              $today->lt(\Carbon\Carbon::parse($checkoutDate))))
              <button class="btn-refund" data-id="{{ $pembayaran->id_pembayaran }}"
                data-idreservasi="{{ $pembayaran->reservasi->id_reservasi }}"
                data-kode="{{ $pembayaran->reservasi->kode_reservasi }}"
                data-checkin="{{ $pembayaran->reservasi->tgl_checkin }}"
                data-checkout="{{ $pembayaran->reservasi->tgl_checkout }}"
                data-total="{{ $pembayaran->reservasi->total_harga }}">
                
                Ajukan Refund
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
        Menampilkan {{ $pembayarans->firstItem() ?? 0 }} sampai {{ $pembayarans->lastItem() ?? 0 }} dari {{
        $pembayarans->total() }} data
      </div>
      <div class="pagination">
        @if ($pembayarans->onFirstPage())
        <button disabled>‹</button>
        @else
        <a href="{{ $pembayarans->previousPageUrl() }}"><button>‹</button></a>
        @endif

        @foreach ($pembayarans->getUrlRange(1, $pembayarans->lastPage()) as $page => $url)
        @if ($page == $pembayarans->currentPage())
        <button class="active">{{ $page }}</button>
        @else
        <a href="{{ $url }}"><button>{{ $page }}</button></a>
        @endif
        @endforeach

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
<div class="modal" id="modalRefundCustom">
  <div class="modal-content">
    <div class="modal-header">
      <h3>Formulir Pengajuan Refund</h3>
      <button class="close-modal">&times;</button>
    </div>

    <div class="modal-body">
      <form action="{{ route('refund.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id_pembayaran" id="id_pembayaran">
        <input type="hidden" name="id_reservasi" id="id_reservasi">
        <!-- Kode Reservasi & Nominal Refund -->
        <div class="form-row">
          <div class="form-group">
            <label for="kode_reservasi_display">Kode Reservasi *</label>
            <input type="text" id="kode_reservasi_display" class="form-control" readonly>
          </div>

          <div class="form-group">
            <label for="nominal_refund_display">Nominal Refund *</label>
            <input type="text" id="nominal_refund_display" class="form-control" readonly>
          </div>
        </div>

        <!-- Check-in & Check-out -->
        <div class="form-row">
          <div class="form-group">
            <label for="check_in_display">Tanggal Check-in *</label>
            <input type="date" id="check_in_display" class="form-control" readonly>
          </div>

          <div class="form-group">
            <label for="check_out_display">Tanggal Check-out *</label>
            <input type="date" id="check_out_display" class="form-control" readonly>
          </div>
        </div>

        <!-- Alasan Refund -->
        <div class="form-group form-full">
          <label for="alasan_refund">Alasan Refund *</label>
          <textarea name="alasan_refund" id="alasan_refund" class="form-control" rows="4" required></textarea>
        </div>

        <!-- File Upload -->
        <div class="form-group form-full">
          <label>Bukti Pendukung *</label>
          <div class="file-upload-wrapper">
            <input type="file" id="fileUploadRefund" name="bukti_pendukung" accept="image/*,.pdf" required>
            <label class="file-upload-label-unified" for="fileUploadRefund">
              <span id="file-name-refund">Pilih file</span>
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" width="20" height="20">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
              </svg>
            </label>
          </div>
        </div>

        <!-- Rekening -->
        <div class="form-group form-full">
          <label>Nama Bank *</label>
          <input type="text" id="nama_bank_tujuan" name="nama_bank_tujuan" class="form-control" required>
        </div>

        <div class="form-row">
          <div class="form-group">
            <label>Nomor Rekening *</label>
            <input type="text" id="norek_tujuan" name="norek_tujuan" class="form-control" required>
          </div>

          <div class="form-group">
            <label>Nama Pemilik Rekening *</label>
            <input type="text" id="pemilik_tujuan" name="pemilik_tujuan" class="form-control" required>
          </div>
        </div>

        <button type="submit" class="btn-primary-reservasi">Kirim Pengajuan Refund</button>
      </form>
    </div>
  </div>
</div>



@endsection

@push('scripts')
@push('scripts')
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('modalRefundCustom');
    const openButtons = document.querySelectorAll('.btn-refund');
    const closeButton = modal.querySelector('.close-modal');

    openButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            modal.classList.add('show');

            document.getElementById('id_reservasi').value = btn.dataset.idreservasi;
            document.getElementById('id_pembayaran').value = btn.dataset.id;
            document.getElementById('kode_reservasi_display').value = btn.dataset.kode;
            
            // Format tanggal
            const checkin = btn.dataset.checkin;
            const checkout = btn.dataset.checkout;
            
            if (checkin) {
                document.getElementById('check_in_display').value = formatDate(checkin);
            }
            
            if (checkout) {
                document.getElementById('check_out_display').value = formatDate(checkout);
            }
            
            document.getElementById('nominal_refund_display').value = 'Rp ' + parseInt(btn.dataset.total).toLocaleString('id-ID');
        });
    });

    closeButton.addEventListener('click', () => {
        modal.classList.remove('show');
        resetForm();
    });

    modal.addEventListener('click', e => {
        if(e.target === modal) {
            modal.classList.remove('show');
            resetForm();
        }
    });

    const fileInput = document.getElementById('fileUploadRefund');
    const fileNameDisplay = document.getElementById('file-name-refund');
    fileInput?.addEventListener('change', () => {
        fileNameDisplay.textContent = fileInput.files[0]?.name || 'Pilih file';
    });

    function formatDate(dateString) {
        if (!dateString) return '';
        
        if (/^\d{4}-\d{2}-\d{2}$/.test(dateString)) {
            return dateString;
        }
        
        const date = new Date(dateString);
        if (isNaN(date.getTime())) return '';
        
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        
        return `${year}-${month}-${day}`;
    }

    function resetForm() {
        document.getElementById('alasan_refund').value = '';
        fileInput.value = '';
        fileNameDisplay.textContent = 'Pilih file';
        document.getElementById('nama_bank_tujuan').value = '';
        document.getElementById('norek_tujuan').value = '';
        document.getElementById('pemilik_tujuan').value = '';
    }
});
</script>
@endpush