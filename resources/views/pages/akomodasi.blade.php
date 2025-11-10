@extends('layouts.app')

@section('title', 'Akomodasi | Luwihaja Hill')

@section('content')

   <section class="hero">
    <div class="overlay"></div>
    <div class="hero-inner">
      <h1>Akomodasi <span class="accent">Villa</span></h1>
      <p>Nikmati akomodasi nyaman dengan berbagai pilihan kamar untuk pengalaman menginap yang tak terlupakan.</p>
    </div>
  </section>

  <!-- Featured Section -->
  <section class="featured-section">
    <div class="container">
      <h2>Berbagai <span class="accent">Akomodasi Nyaman</span></h2>
      <div class="featured-image">
        <img src="asset/deluexeroomm.jpg" alt="Featured Room">
      </div>
    </div>
  </section>

  <!-- Search Section -->
  <section class="search-section">
    <div class="container">
      <div class="search-box">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input type="text" placeholder="Cari akomodasi (contoh: twin bed)">
        <button>Cari</button>
      </div>
    </div>
  </section>

  <!-- Rooms Section -->
  <section class="rooms-section">
    <div class="container">
      <!-- Deluxe Room -->
      <div class="room-card">
        <div class="room-info">
          <h3>Deluxe Room</h3>
          <div class="room-price">
            Rp1.800.000
            <span class="stars">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
            </span>
          </div>
          <p class="room-description">Kamar tipe Deluxe memiliki desain yang unik dan terbagi menjadi dua jenis, yaitu Deluxe Bed dan Super Deluxe.</p>
          <div class="room-buttons">
            <button class="btn-booking">Booking Sekarang</button>
            <button class="btn-detail">Lihat Detail</button>
          </div>
        </div>
        <img src="asset/super deluxe.jpg" alt="Deluxe Room" class="room-image">
      </div>

      <!-- Family Room -->
      <div class="room-card">
        <div class="room-info">
          <h3>Family Room</h3>
          <div class="room-price">
            Rp800.000
            <span class="stars">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
            </span>
          </div>
          <p class="room-description">Kamar luas untuk keluarga 3-4 orang, dengan pilihan harga dan pemandangan berbeda.</p>
          <div class="room-buttons">
            <button class="btn-booking">Booking Sekarang</button>
            <button class="btn-detail">Lihat Detail</button>
          </div>
        </div>
        <img src="asset/familit roiom fr1.jpg" alt="Family Room" class="room-image">
      </div>

      <!-- Queen Bed -->
      <div class="room-card">
        <div class="room-info">
          <h3>Queen Bed</h3>
          <div class="room-price">
            Rp700.000
            <span class="stars">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
            </span>
          </div>
          <p class="room-description">Kamar untuk 2 orang dewasa dengan sarapan, welcome drink, pemandangan sungai, Wi-Fi, dan fasilitas lengkap.</p>
          <div class="room-buttons">
            <button class="btn-booking">Booking Sekarang</button>
            <button class="btn-detail">Lihat Detail</button>
          </div>
        </div>
        <img src="asset/queenbed1.jpg" alt="Queen Bed" class="room-image">
      </div>

      <!-- Twin Bed -->
      <div class="room-card">
        <div class="room-info">
          <h3>Twin Bed</h3>
          <div class="room-price">
            Rp600.000
            <span class="stars">
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
              <i class="fa-solid fa-star"></i>
            </span>
          </div>
          <p class="room-description">Kamar untuk 2 orang dewasa dengan sarapan, welcome drink, pemandangan sungai, Wi-Fi, dan fasilitas lengkap.</p>
          <div class="room-buttons">
            <button class="btn-booking">Booking Sekarang</button>
            <button class="btn-detail">Lihat Detail</button>
          </div>
        </div>
        <img src="asset/twin bed.jpg" alt="Twin Bed" class="room-image">
      </div>

      <!-- Pagination -->
      <div class="pagination">
        <button disabled>
          <i class="fa-solid fa-chevron-left"></i>
        </button>
        <span class="active">1</span>
        <span>2</span>
        <span>3</span>
        <span>4</span>
        <button>
          <i class="fa-solid fa-chevron-right"></i>
        </button>
      </div>
    </div>
  </section>


@endsection