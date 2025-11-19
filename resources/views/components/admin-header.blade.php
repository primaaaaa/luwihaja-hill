@props(['header' => ''])
<div class="topbar">
    <h4>{{ $header }}</h4>
    <div class="profile">
        <div class="profile-icon">
            <i class="bi bi-person-fill"></i>
        </div>
        <div class="profile-info">
            <strong>{{ Auth::user()->nama }}</strong>
            <small>{{ Auth::user()->role }}</small>
        </div>
    </div>
</div>