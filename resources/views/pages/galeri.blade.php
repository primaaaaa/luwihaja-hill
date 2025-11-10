@extends('layouts.app')

@section('title', 'Galeri | Luwihaja Hill')

@section('content')

<section class="hero">
    <div class="overlay"></div>
    <div class="hero-inner">
        <h1>Galeri <span class="accent">Villa</span></h1>
        <p>Jelajahi keindahan villa melalui galeri kami. Temukan momen-momen nyaman dan pemandangan menawan, mulai dari
            interior elegan hingga area outdoor yang asri, cocok untuk inspirasi liburan Anda.</p>
    </div>
</section>

<section class="gallery-section">
    <div class="container">

        <div class="gallery-grid">
            @foreach($photos as $photo)
            <div class="gallery-item">
                <img src="{{ asset('asset/' . $photo) }}" alt="Foto Galeri Luwihaja Hill">
            </div>
            @endforeach
        </div>

        <div class="pagination">
            
            @if ($photos->onFirstPage())
                <button disabled><i class="fa-solid fa-chevron-left"></i></button>
            @else
                <a href="{{ $photos->previousPageUrl() }}" rel="prev"><i class="fa-solid fa-chevron-left"></i></a>
            @endif

            @for ($page = 1; $page <= $photos->lastPage(); $page++)
                @if ($page == $photos->currentPage())
                    <span class="active">{{ $page }}</span>
                @else
                    <a href="{{ $photos->url($page) }}">{{ $page }}</a>
                @endif
            @endfor

            @if ($photos->hasMorePages())
                <a href="{{ $photos->nextPageUrl() }}" rel="next"><i class="fa-solid fa-chevron-right"></i></a>
            @else
                <button disabled><i class="fa-solid fa-chevron-right"></i></button>
            @endif

        </div>

    </div>
</section>

@endsection