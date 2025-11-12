<!-- Komponen untuk Sidebar di halaman admin -->
    <div class="sidebar d-flex flex-column px-3">
      <div class="brand">
        <span class="fs-5 ms-2">🏡 Luwihaja Hill</span>
      </div>
      <nav class="nav flex-column">
        <x-side-link href="/admin/dashboard" :active="request()->is('admin/dashboard')">Dashboard</x-side-link>
        <x-side-link href="/admin/kamar" :active="request()->is('admin/kamar')">Kamar</x-side-link>
        <x-side-link href="/admin/reservasi" :active="request()->is('admin/reservasi')">Reservasi</x-side-link>
        <x-side-link href="/admin/ulasan" :active="request()->is('admin/ulasan')">Ulasan</x-side-link>
        <x-side-link href="/admin/cms" :active="request()->is('admin/cms')">CMS</x-side-link>
        <x-side-link href="/admin/refund" :active="request()->is('admin.refund')">Refund</x-side-link>
        <x-side-link href="/admin/pembayaran" :active="request()->is('admin/pembayaran')">Pembayaran</x-side-link>
        <x-side-link href="/admin/signout" :active="request()->is('admin/signout')">Sign Out</x-side-link>
      
      </nav>
    </div>
