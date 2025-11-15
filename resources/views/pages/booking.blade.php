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

        <div class="form-group">
          <label for="nama">Nama</label>
          <input type="text" id="nama" placeholder="Prima Yudhistira" />
        </div>

        <div class="form-group">
          <label for="checkin">Check In</label>
          <input type="date" id="checkin" />
        </div>

        <div class="form-group">
          <label for="checkout">Check Out</label>
          <input type="date" id="checkout" />
        </div>

        <div class="form-group">
          <label for="tipe">Tipe Villa</label>
          <select id="tipe">
            <option value="" disabled selected>Pilih Tipe Villa</option>
            <option value="500000">Family Room</option>
            <option value="750000">Deluxe Room</option>
            <option value="1000000">Suite Room</option>
            <option value="1500000">Presidential Suite</option>
          </select>
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" placeholder="prima@gmail.com" />
        </div>

        <div class="form-group">
          <label for="notelp">No. Telepon</label>
          <input type="notl;" id="notl;" placeholder="0871871878" />
        </div>

        <button class="btn-primary-reservasi" onclick="handleLanjutkan()">Lanjutkan</button>
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
          <label for="namaPemilik">Nama Pemilik</label>
          <input type="text" id="namaPemilik" placeholder="Prima" />
        </div>
        <div class="form-group">
          <label for="namaBank">Nama Bank</label>
          <input type="text" id="namaBank" placeholder="BCA" />
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label for="nomorRekening">Nomor Rekening</label>
          <input type="text" id="nomorRekening" placeholder="8910910" />
        </div>
        <div class="form-group">
          <label for="buktiPembayaran">Bukti Pembayaran</label>
          <div class="file-upload-wrapper">
            <input type="file" id="buktiFile" accept="image/*,.pdf" onchange="handleFileUpload()" />
            <label for="buktiFile" class="file-upload-label-unified" id="fileLabel">
              <span class="file-name-text">Pilih file</span>
              <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 20px; height: 20px; color: #198754;">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
              </svg>
            </label>
          </div>
        </div>
      </div>

      <div class="form-group form-full">
        <label for="metodePembayaran">Metode Pembayaran</label>
        <select id="metodePembayaran">
          <option value="Transfer Bank">Transfer Bank</option>
          <option value="E-Wallet">E-Wallet</option>
          <option value="Cash">Cash</option>
        </select>
      </div>
      <button class="btn-primary-reservasi" onclick="window.location.href='/pembayaransukses'">
        Kirim
      </button>
    </div>
  </div>
</div>

<script>
  const hamburger = document.querySelector('.hamburger');
      const nav = document.querySelector('.nav-menu');

      hamburger.addEventListener('click', () => {
        nav.classList.toggle('open');
      });

      const navLinks = document.querySelectorAll('.nav-menu a');
      navLinks.forEach(link => {
        link.addEventListener('click', () => {
          nav.classList.remove('open');
        });
      });

      // Booking form functionality
      const checkinInput = document.getElementById('checkin');
      const checkoutInput = document.getElementById('checkout');
      const tipeSelect = document.getElementById('tipe');
      const paymentBtn = document.getElementById('paymentBtn');

      // Set minimum dates
      const today = new Date().toISOString().split('T')[0];
      checkinInput.min = today;

      // Update room type display
      tipeSelect.addEventListener('change', function() {
        const price = parseInt(this.value);
        const roomType = this.options[this.selectedIndex].text;
        
        // Only update display, don't calculate yet
        document.getElementById('displayPrice').textContent = formatRupiah(price);
        document.getElementById('displayType').textContent = roomType;
      });

      // Update checkout minimum date when checkin changes
      checkinInput.addEventListener('change', function() {
        checkoutInput.min = this.value;
        if (checkoutInput.value && checkoutInput.value <= this.value) {
          checkoutInput.value = '';
        }
      });

      function calculateTotal() {
        const checkin = checkinInput.value;
        const checkout = checkoutInput.value;
        const pricePerNight = parseInt(tipeSelect.value);

        if (!checkin || !checkout) {
          document.getElementById('pricePerNight').textContent = '-';
          document.getElementById('nights').textContent = '-';
          document.getElementById('subtotal').textContent = '-';
          document.getElementById('total').textContent = '-';
          paymentBtn.disabled = true;
          return;
        }

        const start = new Date(checkin);
        const end = new Date(checkout);
        const nights = Math.ceil((end - start) / (1000 * 60 * 60 * 24));

        if (nights <= 0) {
          document.getElementById('pricePerNight').textContent = '-';
          document.getElementById('nights').textContent = '-';
          document.getElementById('subtotal').textContent = '-';
          document.getElementById('total').textContent = '-';
          paymentBtn.disabled = true;
          return;
        }

        const total = nights * pricePerNight;

        document.getElementById('pricePerNight').textContent = formatRupiah(pricePerNight);
        document.getElementById('nights').textContent = nights + ' malam';
        document.getElementById('subtotal').textContent = formatRupiah(total);
        document.getElementById('total').textContent = formatRupiah(total);
        paymentBtn.disabled = false;
      }

      function formatRupiah(number) {
        return 'Rp ' + number.toLocaleString('id-ID');
      }

      function handleLanjutkan() {
        const nama = document.getElementById('nama').value;
        const email = document.getElementById('email').value;
        const checkin = checkinInput.value;
        const checkout = checkoutInput.value;
        const tipe = tipeSelect.value;

        if (!nama || !email || !checkin || !checkout || !tipe) {
          alert('Mohon lengkapi semua data!');
          return;
        }

        // Show room preview
        document.getElementById('roomPreview').classList.add('show');

        // Calculate and show total
        calculateTotal();
        
        // Scroll to total card
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
        
        // Show modal
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
    fileLabel.textContent = fileName;
    fileLabel.style.color = 'var(--green-900)';
    fileLabel.style.fontWeight = '500';
  } else {
    fileLabel.textContent = 'Pilih file...';
    fileLabel.style.color = '#6c757d';
    fileLabel.style.fontWeight = '400';
  }
}

      function submitPayment() {
        const namaPemilik = document.getElementById('namaPemilik').value;
        const namaBank = document.getElementById('namaBank').value;
        const nomorRekening = document.getElementById('nomorRekening').value;
        const buktiFile = document.getElementById('buktiFile').files[0];
        const metode = document.getElementById('metodePembayaran').value;

        if (!namaPemilik || !namaBank || !nomorRekening || !buktiFile) {
          alert('Mohon lengkapi semua data pembayaran!');
          return;
        }

        const total = document.getElementById('total').textContent;
        alert('Pembayaran berhasil disubmit!\n\nDetail:\n' + 
              'Nama: ' + namaPemilik + '\n' +
              'Bank: ' + namaBank + '\n' +
              'No. Rek: ' + nomorRekening + '\n' +
              'Total: ' + total + '\n' +
              'Metode: ' + metode + '\n\n' +
              'Terima kasih! Kami akan segera memverifikasi pembayaran Anda.');
        
        closeModal();
      }

      // Close modal when clicking outside
      window.onclick = function(event) {
        const modal = document.getElementById('paymentModal');
        if (event.target === modal) {
          closeModal();
        }
      }
</script>

@endsection