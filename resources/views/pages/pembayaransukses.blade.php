@extends('layouts.app')

@section('title', 'Akomodasi | Luwihaja Hill')

@section('content')
 
 <section class="page-header">
      <div class="overlay"></div>
      <div class="hero-inner">
        <h1>Booking <span class="accent">Villa</span></h1>
        <p>Nikmati kemudahan memesan akomodasi terbaik kami dan pastikan liburan Anda berjalan lancar dan tak terlupakan.</p>
      </div>
    </section>

    <!-- Success Section -->
    <section class="success-section">
      <div class="container">
        <div class="success-icon">
            <img src="{{ asset('asset/sukses.png') }}" alt="Sukses">
        </div>
        
        <div class="success-content">
          <h2>Reservasi berhasil</h2>
          <p>Terima kasih telah memesan! Pesanan Anda menunggu konfirmasi admin.</p>
          <p>Pastikan liburan Anda menyenangkan dan jangan lupa cek barang sebelum sampai.</p>
          <a class="btn-sukses-bayar" href="{{ url('/riwayatpembayaran') }}">Lihat Riwayat</a>
        </div>
      </div>
    </section>


@endsection