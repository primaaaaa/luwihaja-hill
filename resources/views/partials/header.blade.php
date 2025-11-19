<header class="top-bar">
  <div class="container">
    <a class="brand" href="{{ url('/') }}">
      <img src="asset/logo_top.png" alt="Logo" />  
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

{{-- kalau udah login --}}

{{-- <header class="top-bar">
  <div class="container">
    <a class="brand" href="{{ url('/') }}">
      <img src="asset/logo_top.png" alt="Logo" />  
      Luwihaja<span>Hill</span>
    </a>
    <div class="auth">
      {{-- Ikon User dengan Dropdown --}}
      {{-- <div class="user-menu">
        <button class="user-icon" id="userMenuBtn">
          <i class="fa-solid fa-user"></i>
        </button>
        <div class="user-dropdown" id="userDropdown">
          <div class="user-info">
            <span class="user-name">John Doe</span>
            <span class="user-email">johndoe@example.com</span>
          </div>
          <hr>
          <a href="{{ url('/riwayatreservasi') }}">
            <i class="fa-solid fa-calendar-check"></i> Reservasi Saya
          </a>
          <a href="{{ url('/riwayatpembayaran') }}">
            <i class="fa-solid fa-credit-card"></i> Pembayaran Saya
          </a>
          <hr>
          <a href="{{ url('/logout') }}" class="logout-btn">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
          </a>
        </div>
      </div>
      
      <button class="hamburger" aria-label="Menu">
        <i class="fa-solid fa-bars"></i>
      </button>
    </div>
  </div>
</header> --}} 

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


