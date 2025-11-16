<!-- Komponen untuk Sidebar di halaman admin -->
<div class="sidebar d-flex flex-column px-3">
    <div class="brand">
        <img src="{{ asset('asset/logo_top.png') }}" alt="Luwihaja Hill" class="logo-img">
        <span class="brand-text">Luwihaja Hill</span>
    </div>
    
    <nav class="nav flex-column">
        <x-side-link href="/admin/dashboard" :active="request()->is('admin/dashboard')">
            <i class="bi bi-pie-chart-fill"></i>
            <span>Dashboard</span>
        </x-side-link>
        
        <x-side-link href="/admin/kamar" :active="request()->is('admin/kamar')">
            <i class="bi bi-door-closed-fill"></i>
            <span>Kamar</span>
        </x-side-link>
        
        <x-side-link href="/admin/reservasi" :active="request()->is('admin/reservasi')">
            <i class="bi bi-people-fill"></i>
            <span>Reservasi</span>
        </x-side-link>
        
        <x-side-link href="/admin/ulasan" :active="request()->is('admin/ulasan')">
            <i class="bi bi-chat-dots-fill"></i>
            <span>Ulasan</span>
        </x-side-link>
        
        <x-side-link href="/admin/cms" :active="request()->is('admin/cms')">
            <i class="bi bi-database-fill"></i>
            <span>CMS</span>
        </x-side-link>
        
        <x-side-link href="/admin/refund" :active="request()->is('admin/refund')">
            <i class="bi bi-credit-card-fill"></i>
            <span>Refund</span>
        </x-side-link>
        
        <x-side-link href="/admin/pembayaran" :active="request()->is('admin/pembayaran')">
            <i class="bi bi-cash-stack"></i>
            <span>Pembayaran</span>
        </x-side-link>
        
        <x-side-link href="/admin/signout" :active="request()->is('admin/signout')">
            <i class="bi bi-box-arrow-right"></i>
            <span>Sign Out</span>
        </x-side-link>
    </nav>
</div>