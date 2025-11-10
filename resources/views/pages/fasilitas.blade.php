@extends('layouts.app')

@section('title', 'Fasilitas Villa | Luwihaja Hill')

@section('content')
  <!-- Hero -->
  <section class="hero">
    <div class="overlay"></div>
    <div class="hero-inner">
      <h1>Fasilitas <span class="accent">Villa</span></h1>
      <p>
        Nikmati fasilitas lengkap kami untuk pengalaman menginap yang nyaman
        dan menyenangkan.
      </p>
    </div>
  </section>

  <!-- Facilities Section -->
  <section class="facilities-section">
    <div class="container">
      <div class="facilities-grid">
        <div class="facility-card">
          <img
            src="asset/luwiahaja.webp"
            alt="Office"
            class="facility-image"
          />
          <div class="facility-info"><h3>OFFICE</h3></div>
        </div>

        <div class="facility-card">
          <img
            src="asset/mushola.webp"
            alt="Mushola"
            class="facility-image"
          />
          <div class="facility-info"><h3>MUSHOLA</h3></div>
        </div>

        <div class="facility-card">
          <img
            src="asset/api unggun.jpg"
            alt="Area Api Unggun"
            class="facility-image"
          />
          <div class="facility-info"><h3>AREA API UNGGUN</h3></div>
        </div>

        <div class="facility-card">
          <img
            src="asset/luwiahaja.webp"
            alt="Parkiran"
            class="facility-image"
          />
          <div class="facility-info"><h3>PARKIRAN</h3></div>
        </div>

        <div class="facility-card">
          <img
            src="asset/gazebo.jpg"
            alt="Gazebo"
            class="facility-image"
          />
          <div class="facility-info"><h3>GAZEBO</h3></div>
        </div>

        <div class="facility-card">
          <img
            src="asset/cafe.jpg"
            alt="Cafe"
            class="facility-image"
          />
          <div class="facility-info"><h3>CAFE</h3></div>
        </div>

        <div class="facility-card">
          <img
            src="asset/sungai.jpg"
            alt="Pemandangan Sungai"
            class="facility-image"
          />
          <div class="facility-info"><h3>PEMANDANGAN SUNGAI</h3></div>
        </div>

        <div class="facility-card">
          <img
            src="asset/toilet (2).jpg"
            alt="Toilet"
            class="facility-image"
          />
          <div class="facility-info"><h3>TOILET</h3></div>
        </div>

        <div class="facility-card">
          <img
            src="asset/market.webp"
            alt="Mini Market"
            class="facility-image"
          />
          <div class="facility-info"><h3>MINI MARKET</h3></div>
        </div>
      </div>
    </div>
  </section>
@endsection
