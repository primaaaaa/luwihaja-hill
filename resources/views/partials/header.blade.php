@guest
<header class="top-bar">
  <div class="container">
    <a class="brand" href="{{ url('/') }}">
      <img src="{{ asset('asset/logo_top.png') }}" alt="Logo" />
      Luwihaja<span>Hill</span>
    </a>
    <div class="auth">
      <a href="{{ route('login') }}">Login</a>
      <a href="{{ route('register') }}">Register</a>
      <a href="{{ url('/logout') }}" class="logout-btn">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
          </a>
      <button class="hamburger" aria-label="Menu">
        <i class="fa-solid fa-bars"></i>
      </button>
    </div>
  </div>
</header>
@endguest

@auth
<header class="top-bar">
  <div class="container">
    <a class="brand" href="{{ url('/') }}">
      <img src="{{ asset('asset/logo_top.png') }}" alt="Logo" />
      Luwihaja<span>Hill</span>
    </a>

    <div class="auth">

      {{-- MENU USER --}}
      <div class="user-menu">
        <button class="user-icon" id="userMenuBtn">
          <i class="fa-solid fa-user"></i>
        </button>

        <div class="user-dropdown" id="userDropdown">
          <div class="user-info">
            <span class="user-name">{{ Auth::user()->nama }}</span>
            <span class="user-email">{{ Auth::user()->email }}</span>
          </div>

          <hr>

          <a href="{{ url('/riwayatreservasi') }}">
            <i class="fa-solid fa-calendar-check"></i> Reservasi Saya
          </a>

          <a href="{{ url('/riwayatpembayaran') }}">
            <i class="fa-solid fa-credit-card"></i> Pembayaran Saya
          </a>

          <hr>

          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn">
              <i class="fa-solid fa-right-from-bracket"></i> Logout
            </button>
          </form>
        </div>
      </div>

      <button class="hamburger" aria-label="Menu">
        <i class="fa-solid fa-bars"></i>
      </button>

    </div>
  </div>
</header>
@endauth

<nav class="nav-menu">
  <div class="container">
    <x-nav-link href="/" :active="request()->is('/')">Beranda</x-nav-link>
    <x-nav-link href="/tentang" :active="request()->is('tentang')">Tentang Kami</x-nav-link>
    <x-nav-link href="/kebijakan" :active="request()->is('kebijakan')">Kebijakan & Syarat</x-nav-link>
    <x-nav-link href="/akomodasi" :active="request()->is('akomodasi')">Akomodasi</x-nav-link>
    <x-nav-link href="/fasilitas" :active="request()->is('fasilitas')">Fasilitas</x-nav-link>
    <x-nav-link href="/galeri" :active="request()->is('galeri')">Galeri</x-nav-link>
  </div>
</nav>