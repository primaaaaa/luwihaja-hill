@extends('layouts.app')

@section('title', 'Akomodasi | Luwihaja Hill')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<section class="hero">
    <div class="overlay"></div>
    <div class="hero-inner">
        <h1>Detail <span class="accent">Akomodasi</span></h1>
        <p>Nikmati akomodasi nyaman dengan berbagai pilihan kamar untuk pengalaman menginap yang tak terlupakan.</p>
    </div>
</section>

<section class="room-details-section spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="room-details-item">
                    <img src="asset/super deluxe.jpg" alt="Twin Bed Room">
                    <div class="rd-text">
                        <div class="rd-title">
                            <h3>Deluxe Room</h3>
                            <div class="rdt-right">
                                <a class="booking-btn" href="{{ url('/booking') }}">Booking Sekarang</a>
                                <a href="#" class="bagikan-text">Bagikan</a>
                                <div class="social-share">
                                    <!-- Facebook Share -->
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=URL_HALAMAN_INI"
                                        target="_blank" class="social-icon facebook">
                                        <i class="fa-brands fa-facebook-f"></i>
                                    </a>
                                    <!-- Instagram (Instagram tidak support direct share link, biasanya pakai copy link) -->
                                    <a href="https://www.instagram.com/" target="_blank" class="social-icon instagram">
                                        <i class="fa-brands fa-instagram"></i>
                                    </a>
                                    <!-- WhatsApp Share -->
                                    <a href="https://wa.me/?text=Cek%20kamar%20Twin%20Bed%20Room%20di%20Luwihaja%20Hill%20-%20URL_HALAMAN_INI"
                                        target="_blank" class="social-icon whatsapp">
                                        <i class="fa-brands fa-whatsapp"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <h2>Rp700.000<span>/Malam</span></h2>
                        <table class="detail-table">
                            <tbody>
                                <tr>
                                    <td class="r-o">Unit:</td>
                                    <td>1</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Kategori:</td>
                                    <td>Family Room</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Kapsasitas:</td>
                                    <td>4</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Ketersediaan:</td>
                                    <td class="status-tersedia">Tersedia</td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="f-para">Family Room dengan kapasitas untuk 3 hingga 4 orang dewasa, cocok untuk
                            liburan keluarga. Setiap unit menyajikan pemandangan yang berbeda-beda, mulai dari
                            pemandangan langsung ke sungai, kolam ikan dan taman, hingga pegunungan dan kolam renang.
                            Harga sewa per malam bervariasi tergantung tipe kamar, mulai dari Rp 800.000 hingga Rp
                            1.600.000 pada hari biasa (weekday) dan Rp 1.000.000 hingga Rp 1.800.000 pada akhir pekan
                            (weekend). Fasilitas standar mencakup sarapan, welcome drink, dan snack box gratis,
                            sementara beberapa unit dilengkapi dengan fasilitas tambahan seperti mini kitchen dan kamar
                            mandi dalam dengan pemanas air (water heater) untuk menambah kenyamanan.</p>
                    </div>
                </div>

                <div class="rd-reviews">
                    <h4>Ulasan</h4>
                    <div class="review-item">
                        <div class="ri-pic">
                            <img src="asset/prima.jpeg" alt="Prima Yudhistira">
                        </div>
                        <div class="ri-text">
                            <div class="review-header">
                                <div class="review-rating">
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                    <i class="fa-solid fa-star"></i>
                                </div>
                                <span class="review-date">Diunggah pada 14 September 2025</span>
                            </div>
                            <h5>Prima Yudhistira</h5>
                            <p>Family Room nyaman dan bersih, cocok untuk liburan bersama keluarga. Pelayanan staf ramah
                                dan suasana villa tenang membuat pengalaman menginap menyenangkan.</p>
                        </div>
                    </div>
                </div>

                <div class="review-add">
                    <h4>Tulis Ulasan</h4>
                    <form action="#" class="ra-form">
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" placeholder="Nama*">
                            </div>
                            <div class="col-lg-6">
                                <input type="text" placeholder="Email*">
                            </div>
                            <div class="col-lg-12">
                                <div>
                                    <h5>Rating:</h5>
                                    <div class="rating">
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                        <i class="fa-solid fa-star"></i>
                                    </div>
                                </div>
                                <textarea placeholder="Komentar"></textarea>
                                <button type="submit">Kirim Ulasan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="room-booking">
                    <h3>Reservasi</h3>
                    <form action="#">
                        <div class="check-date">
                            <label for="date-in">Check In</label>
                            <input type="date" class="date-input" id="date-in">
                            <i class="fa-regular fa-calendar"></i>
                        </div>
                        <div class="check-date">
                            <label for="date-out">Check Out</label>
                            <input type="date" class="date-input" id="date-out">
                            <i class="fa-regular fa-calendar"></i>
                        </div>
                        <div class="check-date">
                            <label for="villa-type">Tipe Villa</label>
                            <select class="date-input" id="villa-type">
                                <option value="">Pilih Tipe Villa</option>
                                <option value="twin">Twin Bed Room</option>
                                <option value="deluxe">Deluxe Room</option>
                                <option value="family">Family Room</option>
                            </select>
                        </div>
                        <button type="submit">Cek Ketersediaan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection