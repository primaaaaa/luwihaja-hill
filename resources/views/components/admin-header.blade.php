<!-- Komponen untuk header di halaman admin -->

@props(['header' => ''])
<div class="topbar">
        <h4>{{$header }}</h4>
        <div class="profile">
          <img src="https://via.placeholder.com/40" alt="Profile">
          <div>
            <strong>Prima</strong><br>
            <small class="text-muted">{{ $header }}</small>
          </div>
        </div>
      </div>