@extends('layouts.app')

@section('title', 'Kebijakan & Syarat | Luwihaja Hill')

@section('content')

    <section class="hero">
      <div class="overlay"></div>
      <div class="hero-inner">
        <h1>Kebijakan & <span class="accent">Syarat</span></h1>
        <p>Nikmati kenyamanan menginap dengan tenang. Kami memiliki
          aturan dan syarat yang jelas agar pengalaman liburan Anda
          aman, nyaman, dan menyenangkan bagi semua tamu.</p>
      </div>
    </section>

    <section class="policy-section">
      <div class="container">
        <div class="policy-grid">

          <div class="policy-card">
            <div class="policy-icon">
              <svg class="icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="3" y="4" width="18" height="16" rx="2" ry="2" stroke="currentColor" stroke-width="1.6" />
                <line x1="8" y1="2.5" x2="8" y2="6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                <line x1="16" y1="2.5" x2="16" y2="6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                <line x1="3" y1="9" x2="21" y2="9" stroke="currentColor" stroke-width="1.6" />
                <path d="M9 14.5l2 2 4-4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" />
              </svg>
            </div>
            <h3>Perubahan dan Pembatalan Reservasi</h3>
            <p>Tamu dapat mengubah jadwal reservasi asalkan
              konfirmasi diberikan 3 atau 4 hari sebelumnya dan
              tidak bisa dilakukan pada hari-H kedatangan.</p>
          </div>

          <div class="policy-card">
            <div class="policy-icon">
              <svg class="icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M14.5 5.5c0-1.2-1-2-2.2-2H12c-1.2 0-2.2.8-2.2 2s1 2 2.2 2h.3c1.2 0 2.2.8 2.2 2s-1 2-2.2 2h-.3c-1.2 0-2.2-.8-2.2-2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                <line x1="12" y1="2.8" x2="12" y2="4" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                <line x1="12" y1="11" x2="12" y2="12.2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                <path d="M3 15.5h6.8c.8 0 1.4.6 1.4 1.4 0 .4-.2.7-.5.9l-1.9 1.1c-.3.2-.5.5-.5.9 0 .7.6 1.3 1.3 1.3h4.2c2.4 0 4.4-1.9 4.7-4.2" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" />
                <path d="M20.5 16.9h-4.3c-.8 0-1.4-.6-1.4-1.4s.6-1.4 1.4-1.4h2.9c1 0 2 .8 1.4 2.8z" stroke="currentColor" stroke-width="1.6" stroke-linejoin="round" />
              </svg>
            </div>
            <h3>Proses Pengembalian Dana</h3>
            <p>Untuk pembatalan yang disetujui, dana refund baru
              akan dikembalikan paling cepat 3 hari setelah
              tanggal check-out yang seharusnya.</p>
          </div>

          <div class="policy-card">
            <div class="policy-icon">
              <svg class="icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="3" y="4" width="18" height="16" rx="2" ry="2" stroke="currentColor" stroke-width="1.6" />
                <line x1="8" y1="2.5" x2="8" y2="6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                <line x1="16" y1="2.5" x2="16" y2="6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                <line x1="3" y1="9" x2="21" y2="9" stroke="currentColor" stroke-width="1.6" />
                <path d="M9.3 13.7l5.4 5.4M14.7 13.7l-5.4 5.4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" />
              </svg>
            </div>
            <h3>Aturan Setelah Check-in</h3>
            <p>Pihak villa memiliki aturan tegas untuk tidak
              melayani permintaan refund dengan alasan apa pun
              setelah tamu selesai melakukan proses check-in.</p>
          </div>

          <div class="policy-card">
            <div class="policy-icon">
              <svg class="icon" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <circle cx="9" cy="9" r="3.2" stroke="currentColor" stroke-width="1.6" />
                <path d="M3.8 18.2c.5-2.7 2.9-4.6 5.7-4.6s5.2 1.9 5.7 4.6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
                <circle cx="16.8" cy="8" r="2.6" stroke="currentColor" stroke-width="1.6" />
                <path d="M13.6 18.2c.4-1.8 1.9-3.3 4.1-3.6" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" />
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