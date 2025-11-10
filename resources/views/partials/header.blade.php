<header class="top-bar">
  <div class="container">
    <a class="brand" href="{{ url('/') }}">
      {{-- <img src="asset/logo.png" alt="Logo" />   --}}
      Luwihaja<span>Hill</span>
    </a>
    <div class="auth">
      <a href="{{ route('login') }}">Login</a>
      <a href="{{ route('register') }}">Register</a>
      <button class="hamburger" aria-label="Menu">
        <i class="fa-solid fa-bars"></i>
      </button>
    </div>
  </div>
</header>

<nav class="nav-menu">
  <div class="container">
    <a href="{{ url('/') }}">Beranda</a>
    <a href="{{ url('/tentang') }}">Tentang Kami</a>
    <a href="{{ url('/kebijakan') }}">Kebijakan & Syarat</a>
    <a href="{{ url('/akomodasi') }}">Akomodasi</a>
    <a href="{{ url('/fasilitas') }}">Fasilitas</a>
    <a href="{{ url('/galeri') }}">Galeri</a>
  </div>
</nav>


