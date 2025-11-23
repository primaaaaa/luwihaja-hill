@extends('layouts.app')

@section('title', 'Kebijakan & Syarat | Luwihaja Hill')

@section('content')

    <!-- Hero -->
    <section class="page-header">
      <div class="overlay"></div>
      <div class="hero-inner">
        <h1>Kebijakan & <span class="accent">Syarat</span></h1>
        <p>Nikmati kenyamanan menginap dengan tenang. Kami memiliki
          aturan dan syarat yang jelas agar pengalaman liburan Anda
          aman, nyaman, dan menyenangkan bagi semua tamu.</p>
      </div>
    </section>

    <!-- Policy Cards Section -->
    <section class="policy-section">
      <div class="container">
        <div class="policy-grid">

          <div class="policy-card">
            <div class="policy-icon" aria-hidden="true">
              <svg class="icon" role="img" aria-labelledby="ttl1">
                <title id="ttl1">Perubahan dan Pembatalan Reservasi</title>
                <use href="#icon-calendar-check"></use>
              </svg>
            </div>
            <h3>Perubahan dan Pembatalan Reservasi</h3>
            <p>Tamu dapat mengubah jadwal reservasi asalkan
              konfirmasi diberikan 3 atau 4 hari sebelumnya dan
              tidak bisa dilakukan pada hari-H kedatangan.</p>
          </div>

          <div class="policy-card">
            <div class="policy-icon" aria-hidden="true">
              <svg class="icon" role="img" aria-labelledby="ttl2">
                <title id="ttl2">Proses Pengembalian Dana</title>
                <use href="#icon-hand-dollar"></use>
              </svg>
            </div>
            <h3>Proses Pengembalian Dana</h3>
            <p>Untuk pembatalan yang disetujui, dana refund baru
              akan dikembalikan paling cepat 3 hari setelah
              tanggal check-out yang seharusnya.</p>
          </div>

          <div class="policy-card">
            <div class="policy-icon" aria-hidden="true">
              <svg class="icon" role="img" aria-labelledby="ttl3">
                <title id="ttl3">Aturan Setelah Check-in</title>
                <use href="#icon-calendar-xmark"></use>
              </svg>
            </div>
            <h3>Aturan Setelah Check-in</h3>
            <p>Pihak villa memiliki aturan tegas untuk tidak
              melayani permintaan refund dengan alasan apa pun
              setelah tamu selesai melakukan proses check-in.</p>
          </div>

          <div class="policy-card">
            <div class="policy-icon" aria-hidden="true">
              <svg class="icon" role="img" aria-labelledby="ttl4">
                <title id="ttl4">Kebijakan Tamu Syariah</title>
                <use href="#icon-users"></use>
              </svg>
            </div>
            <h3>Kebijakan Tamu Syariah</h3>
            <p>Sebagai vila syariah, terdapat aturan khusus di mana
              pihak villa tidak dapat menerima tamu yang merupakan
              pasangan belum menikah.</p>
          </div>

        </div>
      </div>
    </section>

@endsection
