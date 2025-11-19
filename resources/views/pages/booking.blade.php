@extends('layouts.app')

@section('title', 'Pembayaran | Luwihaja Hill')

@section('content')

<!-- Hero -->
<section class="hero">
  <div class="overlay"></div>
  <div class="hero-inner">
    <h1>Booking<span class="accent">Villa</span></h1>
    <p>Nikmati kemudahan memesan akomodasi terbaik kami dan pastikan liburan Anda berjalan lancar dan tak terlupakan.
    </p>
  </div>
</section>

<!-- Booking Section -->
<section class="booking-section">
  <div class="container">
    <div class="booking-grid">

      <!-- Reservasi Card -->
      <div class="reservasi-card">
        <h2>Reservasi</h2>

        <form id="bookingForm" method="POST" action="{{ route('booking.store') }}" enctype="multipart/form-data">
          @csrf

          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" value="{{ $user->nama }}" readonly
              style="background-color: #f5f5f5;" />
          </div>

          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="{{ $user->email }}" readonly
              style="background-color: #f5f5f5;" />
          </div>

          <div class="form-group">
            <label for="notelp">No. Telepon</label>
            <input type="text" id="notelp" name="notelp" value="{{ $user->noTelepon }}" readonly
              style="background-color: #f5f5f5;" />
          </div>

          <div class="form-group">
            <label for="checkin">Check In</label>
            <input type="date" id="checkin" name="check_in" min="{{ date('Y-m-d') }}" required />
          </div>

          <div class="form-group">
            <label for="checkout">Check Out</label>
            <input type="date" id="checkout" name="check_out" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required />
          </div>

          <div class="form-group">
            <label for="tipe">Tipe Villa</label>
            <select id="tipe" name="id_tipe_villa" required>
              <option value="" disabled {{ !$selectedRoom ? 'selected' : '' }}>Pilih Tipe Villa</option>
              @foreach($rooms as $room)
              <option value="{{ $room->id_tipe_villa }}" data-weekday="{{ $room->harga_weekday }}"
                data-weekend="{{ $room->harga_weekend }}" data-nama="{{ $room->kategori }}" {{ $selectedRoom &&
                $selectedRoom->id_tipe_villa == $room->id_tipe_villa ? 'selected' : '' }}>
                {{ $room->kategori }} - {{ $room->nama_unit }}
              </option>
              @endforeach
            </select>
          </div>

          <!-- Hidden inputs untuk harga -->
          <input type="hidden" id="hargaPerMalam" name="harga_per_malam" value="0">
          <input type="hidden" id="totalHarga" name="total_harga" value="0">

          <!-- Hidden inputs untuk data pembayaran (PENTING!) -->
          <input type="hidden" id="hiddenNamaPemilik" name="nama_pemilik" value="">
          <input type="hidden" id="hiddenNamaBank" name="nama_bank" value="">
          <input type="hidden" id="hiddenNomorRekening" name="nomor_rekening" value="">
          <input type="hidden" id="hiddenMetodePembayaran" name="metode_pembayaran" value="">

          <button type="button" class="btn-primary-reservasi" onclick="handleLanjutkan()">Lanjutkan</button>
        </form>
      </div>

      <!-- Total Card -->
      <div class="total-card" id="totalCard">
        <h2>Total</h2>

        <div class="room-preview-bayar" id="roomPreview">
          <div class="room-image-bayar">
            <img src="asset/super deluxe.jpg">
          </div>
          <div class="room-details">
            <h3>
              Tipe Kamar
              <span class="price" id="displayPrice">-</span>
            </h3>
            <p id="displayType">-</p>
            <p>Kapasitas: 2-4 orang</p>
            <p>Unit: 1</p>
          </div>
        </div>

        <div class="pricing-details">
          <div class="price-row">
            <span>Harga per malam:</span>
            <span id="pricePerNight">-</span>
          </div>
          <div class="price-row">
            <span>Jumlah malam:</span>
            <span id="nights">-</span>
          </div>
          <div class="price-row">
            <span>Subtotal:</span>
            <span id="subtotal">-</span>
          </div>
          <div class="price-row total">
            <span>Total:</span>
            <span id="total">-</span>
          </div>
        </div>

        <button class="btn-primary-reservasi-bayar" id="paymentBtn" onclick="handlePayment()" disabled>
          Lanjutkan Pembayaran
        </button>

        <p class="info-text">
          Pastikan data Anda sudah benar sebelum melanjutkan pembayaran
        </p>
      </div>

    </div>
  </div>
</section>

<div id="paymentModal" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h3>Formulir Pembayaran</h3>
      <button class="close-modal" onclick="closeModal()">&times;</button>
    </div>
    <div class="modal-body">
      <p style="margin-bottom: 24px; color: var(--muted);">
        Silakan transfer ke <strong>Bank BCA 02092089 a.n. Villa Luwihaja Hill</strong>,
        lalu upload bukti pembayaran di form ini.
      </p>

      <div class="form-row">
        <div class="form-group">
          <label for="namaPemilik">Nama Pemilik Rekening <span style="color: red;">*</span></label>
          <input type="text" id="namaPemilik" placeholder="Contoh: Prima Wijaya" required />
        </div>
        <div class="form-group">
          <label for="namaBank">Nama Bank <span style="color: red;">*</span></label>
          <input type="text" id="namaBank" placeholder="Contoh: BCA" required />
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="nomorRekening">Nomor Rekening <span style="color: red;">*</span></label>
          <input type="text" id="nomorRekening" placeholder="Contoh: 8910910123" required />
        </div>
        <div class="form-group">
          <label for="buktiPembayaran">Bukti Pembayaran <span style="color: red;">*</span></label>
          <div class="file-upload-wrapper">
            <input type="file" id="buktiFile" name="bukti_pembayaran" accept="image/*,.pdf"
              onchange="handleFileUpload()" required />
            <label for="buktiFile" class="file-upload-label-unified" id="fileLabel">
              <span class="file-name-text">Pilih file</span>
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"
                style="width: 20px; height: 20px; color: #198754;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
              </svg>
            </label>
          </div>
          <small style="color: #6c757d; font-size: 12px; margin-top: 4px; display: block;">
            Format: JPG, PNG, atau PDF. Maksimal 2MB
          </small>
        </div>
      </div>

      <div class="form-group form-full">
        <label for="metodePembayaran">Metode Pembayaran <span style="color: red;">*</span></label>
        <select id="metodePembayaran" required>
          <option value="">Pilih Metode Pembayaran</option>
          <option value="Transfer Bank">Transfer Bank</option>
          <option value="E-Wallet">E-Wallet</option>
          <option value="Kartu Kredit">Kartu Kredit</option>
        </select>
      </div>

      <button class="btn-primary-reservasi" onclick="submitPayment()">
        Kirim Pembayaran
      </button>
    </div>
  </div>
</div>

<script>
  const checkinInput = document.getElementById('checkin');
  const checkoutInput = document.getElementById('checkout');
  const tipeSelect = document.getElementById('tipe');
  const paymentBtn = document.getElementById('paymentBtn');

  // Set minimum dates
  const today = new Date().toISOString().split('T')[0];
  checkinInput.min = today;

  // Fungsi untuk cek apakah weekend
  function isWeekend(dateString) {
    const date = new Date(dateString);
    const day = date.getDay();
    return day === 0 || day === 6;
  }

  // Fungsi untuk cek berapa hari weekend
  function countWeekendDays(checkin, checkout) {
    let count = 0;
    let currentDate = new Date(checkin);
    const endDate = new Date(checkout);
    
    while (currentDate < endDate) {
      if (isWeekend(currentDate.toISOString().split('T')[0])) {
        count++;
      }
      currentDate.setDate(currentDate.getDate() + 1);
    }
    return count;
  }

  // Update room type display
  tipeSelect.addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const weekdayPrice = parseInt(selectedOption.dataset.weekday);
    const roomType = selectedOption.dataset.nama;
    
    document.getElementById('displayType').textContent = roomType;
    document.getElementById('displayPrice').textContent = formatRupiah(weekdayPrice);
  });

  // Update checkout minimum date when checkin changes
  checkinInput.addEventListener('change', function() {
    const nextDay = new Date(this.value);
    nextDay.setDate(nextDay.getDate() + 1);
    checkoutInput.min = nextDay.toISOString().split('T')[0];
    
    if (checkoutInput.value && checkoutInput.value <= this.value) {
      checkoutInput.value = '';
    }
  });

  function calculateTotal() {
    const checkin = checkinInput.value;
    const checkout = checkoutInput.value;
    const selectedOption = tipeSelect.options[tipeSelect.selectedIndex];
    
    if (!checkin || !checkout || !selectedOption.value) {
      document.getElementById('pricePerNight').textContent = '-';
      document.getElementById('nights').textContent = '-';
      document.getElementById('subtotal').textContent = '-';
      document.getElementById('total').textContent = '-';
      paymentBtn.disabled = true;
      return;
    }

    const weekdayPrice = parseInt(selectedOption.dataset.weekday);
    const weekendPrice = parseInt(selectedOption.dataset.weekend);

    const start = new Date(checkin);
    const end = new Date(checkout);
    const totalNights = Math.ceil((end - start) / (1000 * 60 * 60 * 24));

    if (totalNights <= 0) {
      document.getElementById('pricePerNight').textContent = '-';
      document.getElementById('nights').textContent = '-';
      document.getElementById('subtotal').textContent = '-';
      document.getElementById('total').textContent = '-';
      paymentBtn.disabled = true;
      return;
    }

    const weekendNights = countWeekendDays(checkin, checkout);
    const weekdayNights = totalNights - weekendNights;

    const total = (weekdayNights * weekdayPrice) + (weekendNights * weekendPrice);
    const avgPricePerNight = Math.round(total / totalNights);

    document.getElementById('hargaPerMalam').value = avgPricePerNight;
    document.getElementById('totalHarga').value = total;

    document.getElementById('pricePerNight').textContent = formatRupiah(avgPricePerNight);
    document.getElementById('nights').textContent = totalNights + ' malam';
    document.getElementById('subtotal').textContent = formatRupiah(total);
    document.getElementById('total').textContent = formatRupiah(total);
    
    paymentBtn.disabled = false;
  }

  function formatRupiah(number) {
    return 'Rp ' + number.toLocaleString('id-ID');
  }

  function handleLanjutkan() {
    const checkin = checkinInput.value;
    const checkout = checkoutInput.value;
    const tipe = tipeSelect.value;

    if (!checkin || !checkout || !tipe) {
      alert('Mohon lengkapi semua data!');
      return;
    }

    document.getElementById('roomPreview').classList.add('show');
    calculateTotal();
    
    document.getElementById('totalCard').scrollIntoView({ 
      behavior: 'smooth', 
      block: 'nearest' 
    });
  }

  function handlePayment() {
    const total = document.getElementById('total').textContent;
    if (total === '-') {
      alert('Silakan klik tombol "Lanjutkan" terlebih dahulu untuk menghitung total');
      return;
    }
    
    document.getElementById('paymentModal').classList.add('show');
  }

  function closeModal() {
    document.getElementById('paymentModal').classList.remove('show');
  }

  function handleFileUpload() {
    const fileInput = document.getElementById('buktiFile');
    const fileLabel = document.getElementById('fileLabel');
    
    if (fileInput.files.length > 0) {
      const fileName = fileInput.files[0].name;
      const fileSize = fileInput.files[0].size;
      const fileNameSpan = fileLabel.querySelector('.file-name-text');
      
      if (fileSize > 2048000) {
        alert('Ukuran file terlalu besar! Maksimal 2MB');
        fileInput.value = '';
        return;
      }
      
      if (fileNameSpan) {
        fileNameSpan.textContent = fileName;
      }
      fileLabel.style.color = 'var(--green-900)';
      fileLabel.style.fontWeight = '500';
    }
  }

function submitPayment() {
    const namaPemilik = document.getElementById('namaPemilik').value.trim();
    const namaBank = document.getElementById('namaBank').value.trim();
    const nomorRekening = document.getElementById('nomorRekening').value.trim();
    const buktiFile = document.getElementById('buktiFile').files[0];
    const metode = document.getElementById('metodePembayaran').value;

    // Validasi
    if (!namaPemilik || !namaBank || !nomorRekening || !buktiFile || !metode) {
      alert('Mohon lengkapi semua data pembayaran!');
      return;
    }

    if (namaPemilik.length < 3) {
      alert('Nama pemilik rekening minimal 3 karakter!');
      return;
    }

    if (!/^\d+$/.test(nomorRekening)) {
      alert('Nomor rekening hanya boleh berisi angka!');
      return;
    }

    // Transfer data ke hidden input
    document.getElementById('hiddenNamaPemilik').value = namaPemilik;
    document.getElementById('hiddenNamaBank').value = namaBank;
    document.getElementById('hiddenNomorRekening').value = nomorRekening;
    document.getElementById('hiddenMetodePembayaran').value = metode;

    // ✅ PERBAIKAN: Gunakan FormData untuk handle file upload
    const mainForm = document.getElementById('bookingForm');
    const fileInput = document.getElementById('buktiFile');
    
    // Buat input file baru di form utama
    const newFileInput = document.createElement('input');
    newFileInput.type = 'file';
    newFileInput.name = 'bukti_pembayaran';
    newFileInput.style.display = 'none';
    
    // Transfer file dari modal ke input baru
    const dataTransfer = new DataTransfer();
    dataTransfer.items.add(fileInput.files[0]);
    newFileInput.files = dataTransfer.files;
    
    // Tambahkan ke form
    mainForm.appendChild(newFileInput);

    // Close modal dan submit
    closeModal();
    
    // Optional: Tampilkan loading
    const submitButtons = document.querySelectorAll('button[type="button"]');
    submitButtons.forEach(btn => {
      btn.disabled = true;
      btn.textContent = 'Mengirim...';
    });
    
    // Submit form
    mainForm.submit();
  }

  window.onclick = function(event) {
    const modal = document.getElementById('paymentModal');
    if (event.target === modal) {
      closeModal();
    }
  }

  window.addEventListener('DOMContentLoaded', function() {
    if (tipeSelect.value) {
      const selectedOption = tipeSelect.options[tipeSelect.selectedIndex];
      document.getElementById('displayType').textContent = selectedOption.dataset.nama;
    }
  });

  document.getElementById('paymentModal').addEventListener('keypress', function(e) {
    if (e.key === 'Enter' && e.target.tagName !== 'BUTTON') {
      e.preventDefault();
      return false;
    }
  });
</script>

@endsection