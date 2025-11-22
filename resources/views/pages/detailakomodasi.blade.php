@extends('layouts.app')

@section('title', 'Detail Akomodasi | Luwihaja Hill')

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
                    @if($room->foto_kamar)
                    <img src="{{ asset('storage/' . $room->foto_kamar) }}" alt="{{ $room->nama_unit }}">
                    @else
                    <img src="asset/super deluxe.jpg" alt="{{ $room->nama_unit }}">
                    @endif
                    <div class="rd-text">
                        <div class="rd-title">
                            <h3>{{ $room->kategori }}</h3>
                            <div class="rdt-right">
                                {{-- Button Booking --}}
                                @if($isAvailable)
                                <a class="btn-booking" href="{{ url('/booking?room=' . $room->id_tipe_villa) }}">
                                    Booking Sekarang
                                </a>
                                @else
                                <a class="btn-booking" style="opacity: 0.5; cursor: not-allowed; pointer-events: none;">
                                    Sudah Dibooking
                                </a>
                                @endif

                                <a href="#" class="bagikan-text">Bagikan</a>
                                <div class="social-share">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                        target="_blank" class="social-icon facebook">
                                        <i class="fa-brands fa-facebook-f"></i>
                                    </a>
                                    <a href="https://www.instagram.com/" target="_blank" class="social-icon instagram">
                                        <i class="fa-brands fa-instagram"></i>
                                    </a>
                                    <a href="https://wa.me/?text=Cek%20kamar%20{{ urlencode($room->nama_unit) }}%20di%20Luwihaja%20Hill%20-%20{{ urlencode(url()->current()) }}"
                                        target="_blank" class="social-icon whatsapp">
                                        <i class="fa-brands fa-whatsapp"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <h2>
                            <span class="price-display" data-weekday="{{ $room->harga_weekday }}"
                                data-weekend="{{ $room->harga_weekend }}">
                                {{ $room->formatted_harga_weekend }}
                            </span>
                            <span>/Malam</span>
                        </h2>
                        <table class="detail-table">
                            <tbody>
                                <tr>
                                    <td class="r-o">Unit:</td>
                                    <td>{{ $room->nama_unit ?: '-' }}</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Kategori:</td>
                                    <td>{{ $room->kategori }}</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Kapasitas:</td>
                                    <td>{{ $room->kapasitas }} Orang</td>
                                </tr>
                                <tr>
                                    <td class="r-o">Ketersediaan:</td>
                                    <td class="status-{{ str_replace(' ', '-', strtolower($statusSelected)) }}">
                                        {{ $statusSelected }}
                                        @if($availableRoomsSelected > 0)
                                        ({{ $availableRoomsSelected }} Kamar)
                                        @endif

                                        {{-- @if(session('checked_dates'))
                                        <br><small style="color: #999;">untuk {{
                                            \Carbon\Carbon::parse(session('checked_dates.check_in'))->format('d M Y') }}
                                            - {{
                                            \Carbon\Carbon::parse(session('checked_dates.check_out'))->format('d M Y')
                                            }}</small>
                                        @elseif($checkInDate != now()->format('Y-m-d'))
                                        <br><small style="color: #999;">untuk {{
                                            \Carbon\Carbon::parse($checkInDate)->format('d M Y') }} - {{
                                            \Carbon\Carbon::parse($checkOutDate)->format('d M Y') }}</small>
                                        @endif --}}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <p class="f-para">{{ $room->deskripsi ?? 'Kamar nyaman dengan fasilitas lengkap untuk pengalaman
                            menginap yang tak terlupakan.' }}</p>
                    </div>
                </div>

                <div class="rd-reviews">
                    <h4>Ulasan
                        {{-- @if($totalUlasan > 0)
                        <span style="color: #dfa974; margin-left: 10px;">
                            <i class="fa-solid fa-star"></i> {{ number_format($averageRating, 1) }}/5
                        </span>
                        @endif --}}
                    </h4>

                    @if($ulasan->count() > 0)
                    @foreach($ulasan as $review)
                    <div class="review-item">
                        <div class="ri-pic">
                            <i class="fa-solid fa-user" style="font-size: 40px; color: #1f2937;"></i>
                        </div>
                        <div class="ri-text">
                            <div class="review-header">
                                <div class="review-rating">
                                    @for($i = 1; $i <= 5; $i++) @if($i <=$review->rating)
                                        <i class="fa-solid fa-star"></i>
                                        @else
                                        <i class="fa-regular fa-star"></i>
                                        @endif
                                        @endfor
                                </div>
                                <span class="review-date">Diunggah pada {{
                                    \Carbon\Carbon::parse($review->tgl_ulasan)->format('d F Y') }}</span>
                            </div>
                            <h5>{{ $review->user->nama ?? 'Tamu' }}</h5>
                            <p>{{ $review->isi_ulasan }}</p>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <p style="text-align: center; color: #666; padding: 20px;">Belum ada ulasan untuk kamar ini.</p>
                    @endif
                </div>

                <div class="review-add">
                    <h4>Tulis Ulasan</h4>

                    @if(session('success_ulasan'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-check-circle"></i> {{ session('success_ulasan') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if(session('error_ulasan'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fa-solid fa-exclamation-circle"></i> {{ session('error_ulasan') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Terjadi kesalahan:</strong>
                        <ul style="margin-bottom: 0; padding-left: 20px;">
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <!-- Peringatan jika belum pernah reservasi selesai -->
                    @if(auth()->check() && !$canReview)
                    <div class="alert alert-warning" role="alert">
                        <i class="fa-solid fa-info-circle"></i> Anda harus menyelesaikan reservasi terlebih dahulu untuk
                        memberikan ulasan.
                    </div>
                    @endif

                    <form action="{{ route('ulasan.store') }}" method="POST" class="ra-form">
                        @csrf
                        <input type="hidden" name="id_tipe_villa" value="{{ $room->id_tipe_villa }}">

                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" name="nama" placeholder="Nama*"
                                    value="{{ auth()->check() ? auth()->user()->nama : old('nama') }}" {{
                                    auth()->check() ? 'readonly' : '' }} required>
                            </div>
                            <div class="col-lg-6">
                                <input type="email" name="email" placeholder="Email*"
                                    value="{{ auth()->check() ? auth()->user()->email : old('email') }}" {{
                                    auth()->check() ? 'readonly' : '' }} required>
                            </div>
                            <div class="col-lg-12">
                                <div>
                                    <h5>Rating:</h5>
                                    <div class="rating" id="star-rating">
                                        <i class="fa-solid fa-star" data-rating="1"></i>
                                        <i class="fa-solid fa-star" data-rating="2"></i>
                                        <i class="fa-solid fa-star" data-rating="3"></i>
                                        <i class="fa-solid fa-star" data-rating="4"></i>
                                        <i class="fa-solid fa-star" data-rating="5"></i>
                                    </div>
                                    <input type="hidden" name="rating" id="rating-input" value="5" required>
                                </div>
                                <textarea name="komentar" placeholder="Tulis komentar Anda (minimal 10 karakter)"
                                    required>{{ old('komentar') }}</textarea>

                                <!-- Disable button jika user login tapi belum pernah reservasi -->
                                <button type="submit" {{ (auth()->check() && !$canReview) ? 'disabled' : '' }}>
                                    Kirim Ulasan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="room-booking">
                    <h3>Reservasi</h3>
                    <form action="{{ route('check.availability') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_tipe_villa" value="{{ $room->id_tipe_villa }}">

                        <div class="check-date">
                            <label for="date-in">Check In</label>
                            <input type="date" class="date-input" id="date-in" name="check_in"
                                value="{{ old('check_in', session('checked_dates.check_in', $checkInDate)) }}"
                                min="{{ date('Y-m-d') }}" required>
                            <i class="fa-regular fa-calendar"></i>
                        </div>
                        <div class="check-date">
                            <label for="date-out">Check Out</label>
                            <input type="date" class="date-input" id="date-out" name="check_out"
                                value="{{ old('check_out', session('checked_dates.check_out', $checkOutDate)) }}"
                                min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                            <i class="fa-regular fa-calendar"></i>
                        </div>
                        <div class="check-date">
                            <label for="villa-type">Tipe Villa</label>
                            <select class="date-input" id="villa-type" name="tipe_villa" disabled>
                                <option value="{{ $room->id_tipe_villa }}" selected>{{ $room->kategori }}</option>
                            </select>
                        </div>
                        <button type="submit">Cek Ketersediaan</button>
                    </form>

                    @if(session('availability_message'))
                    <div class="availability-result" style="margin-top: 15px; padding: 15px; border-radius: 5px; 
             background: {{ session('availability_status') == 'available' ? '#d4edda' : '#f8d7da' }}; 
             color: {{ session('availability_status') == 'available' ? '#155724' : '#721c24' }};">
                        <strong>{{ session('availability_message') }}</strong>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function updatePrices() {
    const today = new Date();
    const isWeekend = today.getDay() === 0 || today.getDay() === 6;
    
    document.querySelectorAll('.price-display').forEach(priceEl => {
        const weekdayPrice = parseInt(priceEl.dataset.weekday);
        const weekendPrice = parseInt(priceEl.dataset.weekend);
        priceEl.textContent = 'Rp' + (isWeekend ? weekendPrice : weekdayPrice).toLocaleString('id-ID');
    });
}

document.getElementById('date-in').addEventListener('change', function() {
    const checkIn = new Date(this.value);
    const checkOutInput = document.getElementById('date-out');
    const minCheckOut = new Date(checkIn);
    minCheckOut.setDate(minCheckOut.getDate() + 1);
    checkOutInput.min = minCheckOut.toISOString().split('T')[0];
    
    if (checkOutInput.value && new Date(checkOutInput.value) <= checkIn) {
        checkOutInput.value = '';
    }
});

document.addEventListener('DOMContentLoaded', function() {
    updatePrices();
});


document.addEventListener('DOMContentLoaded', function() {
    const stars = document.querySelectorAll('#star-rating i');
    const ratingInput = document.getElementById('rating-input');
    
    if (stars.length > 0) {
        stars.forEach(star => {
            star.addEventListener('click', function() {
                const rating = this.getAttribute('data-rating');
                ratingInput.value = rating;
                
                stars.forEach(s => {
                    const starRating = s.getAttribute('data-rating');
                    if (starRating <= rating) {
                        s.classList.remove('fa-regular');
                        s.classList.add('fa-solid');
                        s.style.color = '#dfa974';
                    } else {
                        s.classList.remove('fa-solid');
                        s.classList.add('fa-regular');
                        s.style.color = '#dfa974';
                    }
                });
            });
            
            star.addEventListener('mouseenter', function() {
                const rating = this.getAttribute('data-rating');
                stars.forEach(s => {
                    const starRating = s.getAttribute('data-rating');
                    if (starRating <= rating) {
                        s.style.opacity = '1';
                    } else {
                        s.style.opacity = '0.3';
                    }
                });
            });
        });
        
        document.getElementById('star-rating').addEventListener('mouseleave', function() {
            stars.forEach(s => {
                s.style.opacity = '1';
            });
        });
    }
});

</script>

@endsection