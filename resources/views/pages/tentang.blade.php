@extends('layouts.app')

@section('title', 'Tentang Villa | Luwihaja Hill')

@section('content')

  <!-- Hero -->
  <section class="hero">
    <div class="overlay"></div>
    <div class="hero-inner">
      <h1>Tentang <span class="accent">Kami</span></h1>
      <p>Kami menyediakan villa nyaman dengan fasilitas lengkap dan suasana tenang di tepi sungai, sempurna untuk liburan keluarga maupun pasangan.</p>
    </div>
  </section>

  <!-- About Section -->
  <section class="about-section">
    <div class="container">
      <div class="about-content">
        <div class="about-text">
          <h2>Tentang Kami</h2>
          <p>Luwihaja Hill adalah destinasi penginapan yang memadukan kenyamanan modern dengan keindahan alam. Terletak di tepi sungai yang jernih, kami menghadirkan vila nyaman dengan fasilitas lengkap untuk pasangan maupun keluarga.</p>
          <p class="muted">Dengan pelayanan ramah dan suasana tenang, kami berkomitmen memberikan pengalaman liburan yang berkesan bagi setiap tamu.</p>
        </div>
        <div class="about-image">
          <img src="asset/hiasan1.jpg" alt="Villa Interior">
            <div class="overlay"></div>
        </div>
      </div>

      <!-- Video Section -->
      <div class="video-section">
        <div class="video-container">
          <iframe 
            src="https://www.youtube.com/embed/dQw4w9WgXcQ" 
            title="Luwihaja Hill Video" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
            allowfullscreen>
          </iframe>
        </div>
      </div>
    </div>
  </section>

  <!-- Team Section -->
  <section class="team-section">
    <div class="container">
      <h2>Tim Kami</h2>
      <div class="team-grid">
        <div class="team-member">
          <div class="team-photo">
            <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=400&auto=format&fit=crop" alt="Lulu Fatimah">
          </div>
          <h3>LULU FATIMAH</h3>
        </div>
        <div class="team-member">
          <div class="team-photo">
            <img src="https://images.unsplash.com/photo-1560250097-0b93528c311a?q=80&w=400&auto=format&fit=crop" alt="Widodo">
          </div>
          <h3>WIDODO</h3>
        </div>
        <div class="team-member">
          <div class="team-photo">
            <img src="https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?q=80&w=400&auto=format&fit=crop" alt="Haryanto">
          </div>
          <h3>HARYANTO</h3>
        </div>
      </div>
    </div>
  </section>

@endsection
