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
                data-weekend="{{ $room->harga_weekend }}" data-nama="{{ $room->kategori }}"
                data-foto="{{ asset('storage/kamar/' . $room->foto_kamar) }}" data-kapasitas="{{ $room->kapasitas }}"
                data-unit="{{ $room->nama_unit }}" {{ $selectedRoom && $selectedRoom->id_tipe_villa ==
                $room->id_tipe_villa ? 'selected' : '' }}>

                {{ $room->kategori }} - {{ $room->nama_unit }}
              </option>
              @endforeach
            </select>
          </div>


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
           <img src="{{ asset('asset/home.jpg') }}" id="roomImagePreview" alt="Villa Image">
          </div>
          <div class="room-details">
            <h3> Tipe Kamar
              <span class="price" id="displayType">-</span>
            </h3>
            <p>Kapasitas: <span id="displayKapasitas">-</span></p>
            <p>Unit: <span id="displayUnit">-</span></p>

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

  const today = new Date().toISOString().split('T')[0];
  checkinInput.min = today;

  function formatRupiah(number) {
    return 'Rp ' + number.toLocaleString('id-ID');
  }

  function isWeekend(dateString) {
    const date = new Date(dateString);
    const day = date.getDay();
    return day === 0 || day === 6;
  }

  function countWeekendDays(checkin, checkout) {
    let count = 0;
    let currentDate = new Date(checkin);
    const endDate = new Date(checkout);
    while (currentDate < endDate) {
      if (isWeekend(currentDate.toISOString().split('T')[0])) count++;
      currentDate.setDate(currentDate.getDate() + 1);
    }
    return count;
  }

  function updateRoomDisplay() {
    const selectedOption = tipeSelect.options[tipeSelect.selectedIndex];
    if (!selectedOption || selectedOption.value === "") return;

    document.getElementById('displayType').textContent =
      selectedOption.dataset.nama || "-";

  let fotoUrl = selectedOption.dataset.foto || "{{ asset('images/no-image.png') }}";
document.getElementById('roomImagePreview').src = encodeURI(fotoUrl);

    document.getElementById('displayKapasitas').textContent =
      selectedOption.dataset.kapasitas || "-";

    document.getElementById('displayUnit').textContent =
      selectedOption.dataset.unit || "-";
  }
  tipeSelect.addEventListener('change', function () {
      updateRoomDisplay();
    const selectedOption = this.options[this.selectedIndex];
    document.getElementById('displayType').textContent = selectedOption.dataset.nama || "-";
  });

  checkinInput.addEventListener('change', function () {
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

    if (!checkin || !checkout || !selectedOption || selectedOption.value === "") {
      resetTotalCard();
      return;
    }

    const weekdayPrice = parseInt(selectedOption.dataset.weekday);
    const weekendPrice = parseInt(selectedOption.dataset.weekend);

    const start = new Date(checkin);
    const end = new Date(checkout);
    const totalNights = Math.ceil((end - start) / (1000 * 60 * 60 * 24));

    if (totalNights <= 0) {
      resetTotalCard();
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

  function resetTotalCard() {
    document.getElementById('pricePerNight').textContent = '-';
    document.getElementById('nights').textContent = '-';
    document.getElementById('subtotal').textContent = '-';
    document.getElementById('total').textContent = '-';
    paymentBtn.disabled = true;
  }

  function handleLanjutkan() {
    if (!checkinInput.value || !checkoutInput.value || !tipeSelect.value) {
      alert('Mohon lengkapi semua data reservasi!');
      return;
    }

    updateRoomDisplay();
    
    document.getElementById('roomPreview').classList.add('show');
    
    calculateTotal();

    document.getElementById('totalCard').scrollIntoView({
      behavior: 'smooth',
      block: 'center'
    });
  }

  function handlePayment() {
    if (document.getElementById('total').textContent === '-') {
      alert('Silakan klik tombol "Lanjutkan" terlebih dahulu!');
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
      const fileSize = fileInput.files[0].size;
      if (fileSize > 2048000) {
        alert('Ukuran maksimal 2MB!');
        fileInput.value = '';
        return;
      }
      const fileNameText = fileLabel.querySelector('.file-name-text');
      if (fileNameText) {
        fileNameText.textContent = fileInput.files[0].name;
      }
    }
  }

  function submitPayment() {
    const namaPemilik = document.getElementById('namaPemilik').value.trim();
    const namaBank = document.getElementById('namaBank').value.trim();
    const nomorRekening = document.getElementById('nomorRekening').value.trim();
    const metode = document.getElementById('metodePembayaran').value;
    const buktiFile = document.getElementById('buktiFile').files[0];

    if (!namaPemilik || !namaBank || !nomorRekening || !metode || !buktiFile) {
      alert('Mohon lengkapi semua data pembayaran!');
      return;
    }

    if (!/^\d+$/.test(nomorRekening)) {
      alert('Nomor rekening harus angka!');
      return;
    }

    document.getElementById('hiddenNamaPemilik').value = namaPemilik;
    document.getElementById('hiddenNamaBank').value = namaBank;
    document.getElementById('hiddenNomorRekening').value = nomorRekening;
    document.getElementById('hiddenMetodePembayaran').value = metode;

    const mainForm = document.getElementById('bookingForm');
    const newFileInput = document.createElement('input');
    newFileInput.type = 'file';
    newFileInput.name = 'bukti_pembayaran';
    newFileInput.style.display = 'none';
    const dt = new DataTransfer();
    dt.items.add(buktiFile);
    newFileInput.files = dt.files;
    mainForm.appendChild(newFileInput);

    closeModal();
    mainForm.submit();
  }

  window.onclick = function (event) {
    const modal = document.getElementById('paymentModal');
    if (event.target === modal) closeModal();
  };

  document.getElementById('paymentModal').addEventListener('keypress', function (e) {
    if (e.key === 'Enter' && e.target.tagName !== 'BUTTON') {
      e.preventDefault();
    }
  });
</script>


@endsection