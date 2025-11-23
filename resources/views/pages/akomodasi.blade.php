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
            @if($featuredRooms && count($featuredRooms) > 0)
            @foreach($featuredRooms as $index => $featured)
            <img src="{{ asset('storage/' . $featured->foto_kamar) }}" alt="{{ $featured->kategori }}"
                class="slideshow-img" style="{{ $index === 0 ? '' : 'display: none;' }}">
            @endforeach
            @else
            <img src="asset/deluexeroomm.jpg" alt="Featured Room">
            @endif
        </div>
    </div>
</section>

<section class="search-section">
    <div class="container">
        <form action="{{ route('akomodasi') }}" method="GET">

            <div class="category-tabs">

                <a href="{{ route('akomodasi', request()->except('kategori')) }}"
                    class="tab-item {{ !request('kategori') ? 'active' : '' }}">
                    Semua
                </a>

                @foreach($kategoriList as $kat)
                <a href="{{ route('akomodasi', array_merge(request()->all(), ['kategori' => $kat])) }}"
                    class="tab-item {{ request('kategori') == $kat ? 'active' : '' }}">
                    {{ $kat }}
                </a>
                @endforeach

            </div>

            <div class="search-box">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" name="search" placeholder="Cari akomodasi (contoh: twin bed, deluxe, 5000000)"
                    value="{{ request('search') }}">
                <button type="submit">Cari</button>
            </div>
        </form>
    </div>
</section>

<section class="rooms-section">
    <div class="container">
        @forelse($rooms as $room)
        <!-- Room Card -->
        <div class="room-card">
            <div class="room-info">
                <h3>
                    {{ $room->kategori }} Unit {{ str_replace(' ', '_', $room->nama_unit) }}
                </h3>
                <div class="room-price">
                    <span class="price-display" data-weekday="{{ $room->harga_weekday }}"
                        data-weekend="{{ $room->harga_weekend }}">
                        {{ $room->formatted_harga_weekend }}
                    </span>
                    <span class="stars">
                        @for($i = 1; $i <= 5; $i++) @if($i <=round($room->average_rating))
                            <i class="fa-solid fa-star"></i>
                            @else
                            <i class="fa-regular fa-star"></i>
                            @endif
                            @endfor
                    </span>
                </div>
                <p class="room-description">
                    @php
                    $desc = $room->deskripsi ?? 'Kamar nyaman dengan fasilitas lengkap untuk pengalaman menginap yang
                    tak terlupakan.';
                    preg_match('/^([^.!?]*[.!?]\s*){1,2}/', $desc, $matches);
                    $shortDesc = $matches[0] ?? $desc;
                    echo strlen($desc) > strlen($shortDesc) ? rtrim($shortDesc) . '...' : $shortDesc;
                    @endphp
                </p>
                <div class="room-buttons">
                    @if($room->is_available)
                    <a class="btn-booking"
                        href="{{ url('/booking?room=' . $room->id_tipe_villa . '&check_in=' . $checkInDate . '&check_out=' . $checkOutDate) }}">
                        Booking Sekarang
                    </a>
                    @else
                    <a class="btn-booking" style="opacity: 0.5; cursor: not-allowed; pointer-events: none;">
                        Sudah Dibooking
                    </a>
                    @endif

                    <a class="btn-detail" href="{{ url('/detailakomodasi/' . $room->id_tipe_villa) }}">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @if($room->foto_kamar)
            <img src="{{ asset('storage/' . $room->foto_kamar) }}" alt="{{ $room->kategori }}" class="room-image">
            @else
            <img src="asset/super deluxe.jpg" alt="{{ $room->kategori }}" class="room-image">
            @endif
        </div>
        @empty
        <div class="no-result">
            <h3>Mohon maaf, tidak ada akomodasi yang ditemukan.</h3>
            <p>Coba kata kunci lain atau lihat semua akomodasi yang tersedia.</p>
        </div>
        @endforelse

        @if($rooms->hasPages())
        <div class="pagination">
            @if($rooms->onFirstPage())
            <button disabled>
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            @else
            <a href="{{ $rooms->appends(request()->query())->previousPageUrl() }}">
                <button>
                    <i class="fa-solid fa-chevron-left"></i>
                </button>
            </a>
            @endif

            @foreach($rooms->links()->elements[0] as $page => $url)
            @if($page == $rooms->currentPage())
            <span class="active">{{ $page }}</span>
            @else
            <a href="{{ $rooms->appends(request()->query())->url($page) }}"><span>{{ $page }}</span></a>
            @endif
            @endforeach

            @if($rooms->hasMorePages())
            <a href="{{ $rooms->appends(request()->query())->nextPageUrl() }}">
                <button>
                    <i class="fa-solid fa-chevron-right"></i>
                </button>
            </a>
            @else
            <button disabled>
                <i class="fa-solid fa-chevron-right"></i>
            </button>
            @endif
        </div>
        @endif
    </div>
</section>

<script>
    let slideIndex = 0;
function showSlides() {
    const slides = document.querySelectorAll('.slideshow-img');
    if (slides.length === 0) return;
    
    slides.forEach(slide => slide.style.display = 'none');
    slideIndex++;
    if (slideIndex > slides.length) slideIndex = 1;
    slides[slideIndex - 1].style.display = 'block';
    setTimeout(showSlides, 5000);
}

function updatePrices() {
    const today = new Date();
    const isWeekend = today.getDay() === 0 || today.getDay() === 6;
    
    document.querySelectorAll('.price-display').forEach(priceEl => {
        const weekdayPrice = parseInt(priceEl.dataset.weekday);
        const weekendPrice = parseInt(priceEl.dataset.weekend);
        priceEl.textContent = 'Rp' + (isWeekend ? weekendPrice : weekdayPrice).toLocaleString('id-ID');
    });
}

document.addEventListener('DOMContentLoaded', function() {
    showSlides();
    updatePrices();
});
</script>

@endsection