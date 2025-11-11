@extends('layouts.app')

@section('title', 'Beranda | Luwihaja Hill')

@section('content')

<!-- Hero -->
<section id="beranda" class="hero">
  <div class="overlay"></div>
  <div class="hero-inner">
    <h1>Selamat Datang di Villa <span class="accent">Luwihaja Hill</span></h1>
    <p>
      Nikmati suasana tenang di tepi sungai dengan penginapan nyaman dan
      fasilitas lengkap. Tempat terbaik untuk liburan bersama keluarga
      maupun pasangan.
    </p>
    <a class="btn btn-primary" href="{{ url('/akomodasi') }}">Pesan Sekarang</a>
  </div>
</section>

<!-- Tentang & Kebijakan -->
<section id="tentang" class="section about-section">
  <div class="container">
    <!-- Tentang Kami -->
    <div class="content-block">
      <div class="content-text">
        <h2>Tentang Kami</h2>
        <p>
          Luwihaja Hill adalah destinasi penginapan yang memadukan kenyamanan
          modern dengan keindahan alam. Terletak di tepi sungai yang jernih,
          kami menghadirkan vila nyaman dengan fasilitas lengkap untuk pasangan
          maupun keluarga.
        </p>
        <p>
          Dengan pelayanan ramah dan suasana tenang, kami berkomitmen
          memberikan pengalaman liburan yang berkesan bagi setiap tamu.
          Setiap sudut dirancang untuk memberikan kenyamanan terbaik dan
          momen berharga bersama orang-orang tersayang.
        </p>
        <a class="link-ghost" href="{{ url('/tentang') }}">Baca Selengkapnya</a>
      </div>
      <div class="content-image">
        <img src="{{ asset('asset/familit roiom fr1.jpg') }}" alt="Kamar Villa" />
        <div class="overlay"></div>
      </div>
    </div>

    <!-- Kebijakan & Syarat -->
    <div id="kebijakan" class="content-block reverse">
      <div class="content-text">
        <h2>Kebijakan & Syarat</h2>
        <p>
          Kami menerapkan proses reservasi sesuai ketersediaan di kalender,
          dengan penyesuaian harga antara weekday dan weekend. Demi
          kenyamanan bersama, tamu diharapkan menjaga kebersihan serta tidak
          membawa hewan peliharaan.
        </p>
        <p>
          Dengan pelayanan ramah dan suasana tenang, kami berkomitmen
          memberikan pengalaman liburan yang berkesan. Kami juga memiliki
          kebijakan pembatalan yang fleksibel untuk kenyamanan Anda.
        </p>
        <a class="link-ghost" href="{{ url('/kebijakan') }}">Baca Selengkapnya</a>
      </div>
      <div class="content-image">
        <img src="{{ asset('asset/hiasan.jpg') }}" alt="Ruang santai" />
        <div class="overlay"></div>
      </div>
    </div>
  </div>
</section>

<!-- Fasilitas -->
<section id="fasilitas" class="section">
  <div class="container">
    <h2 class="title center">Fasilitas</h2>
    <div class="grid-fac">

      <!-- Office -->
      <div class="fac">
        <span class="icon">
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="4" y="3" width="10" height="18" rx="1.5" stroke="currentColor" stroke-width="1.75" />
            <path d="M9 3v18" stroke="currentColor" stroke-width="1.75" />
            <path d="M3 21h18" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
            <rect x="16" y="9" width="4" height="9" rx="1" stroke="currentColor" stroke-width="1.75" />
            <path d="M6.5 6.5h2m0 3h-2m0 3h2" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
          </svg>
        </span>
        <h4>Office</h4>
        <p>Tempat untuk keperluan administrasi dan informasi pengunjung.</p>
      </div>

      <!-- Mushola -->
      <div class="fac">
        <span class="icon">
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 5c2.5 1.6 4 3.6 4 6.5V21H8v-9.5C8 8.6 9.5 6.6 12 5Z" stroke="currentColor" stroke-width="1.75" />
            <path d="M4 21v-6a3 3 0 0 1 3-3h10a3 3 0 0 1 3 3v6" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
            <path d="M12 3v2" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
            <path d="M2.5 10l2-1.5V21" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
          </svg>
        </span>
        <h4>Mushola</h4>
        <p>Menyediakan tempat untuk ibadah dan perlengkapan bersih.</p>
      </div>

      <!-- Area Api Unggun -->
      <div class="fac fac--accent">
        <span class="icon">
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 3c2.3 2.6 1.2 4.6.2 5.7 1 .2 2.6.1 3.8-1 0 3-2 4.4-4 5 2.4 0 5 1.8 5 5 0 2.8-2.2 4.8-5 4.8s-5-2-5-4.8c0-2.5 1.7-4.2 4-5-1.3-.6-2.8-2.3-2.4-4.8 1.1 1 2.6 1.1 3.6.9C10 7.3 9.7 5.3 12 3Z" stroke="currentColor" stroke-width="1.75" stroke-linejoin="round" />
            <path d="M6 20c1.2-.9 3-.9 4.2 0 .9.7 2.7.7 3.6 0 1.2-.9 3-.9 4.2 0" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
          </svg>
        </span>
        <h4>Area Api Unggun</h4>
        <p>Tempat api unggun untuk kegiatan menyenangkan saat malam.</p>
      </div>

      <!-- Parkiran -->
      <div class="fac fac--accent">
        <span class="icon">
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="3" y="3" width="18" height="18" rx="3" stroke="currentColor" stroke-width="1.75" />
            <path d="M8 17V7h5a3 3 0 1 1 0 6H8Z" stroke="currentColor" stroke-width="1.75" stroke-linejoin="round" />
          </svg>
        </span>
        <h4>Parkiran</h4>
        <p>Lokasi luas yang disediakan untuk kendaraan pengunjung.</p>
      </div>

      <!-- Gazebo -->
      <div class="fac">
        <span class="icon">
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M3 10l9-6 9 6" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M6 10v8m12-8v8M3 18h18" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
          </svg>
        </span>
        <h4>Gazebo</h4>
        <p>Ruang santai terbuka yang teduh untuk bersantai bersama.</p>
      </div>

      <!-- Cafe -->
      <div class="fac">
        <span class="icon">
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="3" y="6" width="11" height="12" rx="2" stroke="currentColor" stroke-width="1.75" />
            <path d="M14 8h3a3 3 0 0 1 0 6h-3" stroke="currentColor" stroke-width="1.75" />
            <path d="M7 4s0 1 1 1-1 1-1 2" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
          </svg>
        </span>
        <h4>Cafe</h4>
        <p>Tersedia menu ringan, minuman dan hidangan hangat.</p>
      </div>

      <!-- Pemandangan Sungai -->
      <div class="fac">
        <span class="icon">
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M3 9c2 0 2-2 4-2s2 2 4 2 2-2 4-2 2 2 4 2" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
            <path d="M3 13c2 0 2-2 4-2s2 2 4 2 2-2 4-2 2 2 4 2" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
            <path d="M3 17c2 0 2-2 4-2s2 2 4 2 2-2 4-2 2 2 4 2" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
          </svg>
        </span>
        <h4>Pemandangan Sungai</h4>
        <p>Area di tepi sungai yang asri — cocok untuk bersantai atau foto.</p>
      </div>

      <!-- Toilet -->
      <div class="fac">
        <span class="icon">
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="7" cy="6" r="2" stroke="currentColor" stroke-width="1.75" />
            <path d="M5 20v-7a2 2 0 0 1 4 0v7" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
            <circle cx="17" cy="6" r="2" stroke="currentColor" stroke-width="1.75" />
            <path d="M15 20v-4h4v4" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
          </svg>
        </span>
        <h4>Toilet</h4>
        <p>Fasilitas kamar kecil yang bersih dan memadai.</p>
      </div>

      <!-- Mini Market -->
      <div class="fac fac--accent">
        <span class="icon">
          <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M3 9l2-4h14l2 4" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" stroke-linejoin="round" />
            <path d="M5 9a3 3 0 0 0 6 0 3 3 0 0 0 6 0" stroke="currentColor" stroke-width="1.75" stroke-linecap="round" />
            <path d="M4 9v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9" stroke="currentColor" stroke-width="1.75" />
            <path d="M9 20v-5h6v5" stroke="currentColor" stroke-width="1.75" />
          </svg>
        </span>
        <h4>Mini Market</h4>
        <p>Toko kecil menyediakan kebutuhan harian dan oleh-oleh.</p>
      </div>

    </div>
  </div>
</section>

<!-- Akomodasi -->
<section id="akomodasi" class="section">
  <div class="container">
    <h2 class="title center">Akomodasi</h2>
    <div class="rooms">
      <article class="room">
        <img src="{{ asset('asset/super deluxe.jpg') }}" alt="Deluxe Bed" />
        <div class="room-body"><h4>DOUBLE BED</h4></div>
      </article>
      <article class="room">
        <img src="{{ asset('asset/familit roiom fr1.jpg') }}" alt="Family Room" />
        <div class="room-body"><h4>FAMILY ROOM</h4></div>
      </article>
      <article class="room">
        <img src="{{ asset('asset/twin bed.jpg') }}" alt="Twin Bed" />
        <div class="room-body"><h4>TWIN BED</h4></div>
      </article>
    </div>
    <div class="center mt-8">
      <a class="btn btn-ghost" href="{{ url('/akomodasi') }}">Lihat Selengkapnya</a>
    </div>
  </div>
</section>

<!-- Ulasan -->
<section class="section bg-soft">
  <div class="container">
    <h2 class="title center">Ulasan</h2>
    <div class="reviews">
      @php
        $reviews = [
          ['author'=>'Aretta Dwi Hapsari','email'=>'aretta@gmail.com','text'=>'Pelayanannya sangat ramah dan tempatnya nyaman.'],
          ['author'=>'Rafi Fakhri','email'=>'rafi@gmail.com','text'=>'Pemandangannya indah, cocok untuk liburan bersama keluarga.'],
          ['author'=>'Prima Yudhistira','email'=>'prima@gmail.com','text'=>'Fasilitas lengkap dan suasananya tenang, sangat menyenangkan!'],
          ['author'=>'Alhamid Adriansyah','email'=>'alhamid@gmail.com','text'=>'Pengalaman menginap yang menyenangkan, pasti ingin kembali.']
        ];
      @endphp

      @foreach ($reviews as $r)
      <div class="review">
        <div class="quote">
          <svg class="quote-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" fill="currentColor">
            <path d="M544 360C544 426.3 490.3 480 424 480L416 480C398.3 480 384 465.7 384 448C384 430.3 398.3 416 416 416L424 416C454.9 416 480 390.9 480 360L480 352L416 352C380.7 352 352 323.3 352 288L352 224C352 188.7 380.7 160 416 160L480 160C515.3 160 544 188.7 544 224L544 360zM288 360C288 426.3 234.3 480 168 480L160 480C142.3 480 128 465.7 128 448C128 430.3 142.3 416 160 416L168 416C198.9 416 224 390.9 224 360L224 352L160 352C124.7 352 96 323.3 96 288L96 224C96 188.7 124.7 160 160 160L224 160C259.3 160 288 188.7 288 224L288 360z" />
          </svg>
        </div>
        <p>{{ $r['text'] }}</p>
        <h5 class="author">{{ $r['author'] }}</h5>
        <a class="email" href="mailto:{{ $r['email'] }}">{{ $r['email'] }}</a>
      </div>
      @endforeach
    </div>
  </div>
</section>

<!-- FAQ -->
<section class="section" id="faq">
  <div class="container">
    <h2 class="title center">FAQs</h2>
    <div class="faq">
      <details>
        <summary>Bagaimana cara melakukan reservasi villa?</summary>
        <p>
          Anda bisa melakukan reservasi melalui halaman pemesanan di website. Pilih tanggal check-in dan check-out, isi data diri, lalu lakukan pembayaran.
        </p>
      </details>
      <details>
        <summary>Apakah harga sudah termasuk sarapan?</summary>
        <p>Harga belum termasuk sarapan. Namun kami menyediakan paket sarapan dengan biaya tambahan.</p>
      </details>
      <details>
        <summary>Apakah diperbolehkan membawa hewan peliharaan?</summary>
        <p>Mohon maaf, untuk kenyamanan bersama kami belum menerima hewan peliharaan.</p>
      </details>
      <details>
        <summary>Apakah ada layanan antar-jemput?</summary>
        <p>Kami menyediakan layanan antar-jemput bandara/kota terdekat atas permintaan.</p>
      </details>
      <details>
        <summary>Apa saja fasilitas yang tersedia di villa?</summary>
        <p>Area api unggun, cafe, mushola, gazebo, mini market, toilet, parkiran, dan pemandangan sungai.</p>
      </details>
    </div>
  </div>
</section>

@endsection
