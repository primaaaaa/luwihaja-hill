@props(['title' => '', 'jumlah' => 0])

@php
    $icon = 'bi-graph-up'; 
    
    if (str_contains(strtolower($title), 'kamar')) {
        $icon = 'bi-door-closed-fill';
    } elseif (str_contains(strtolower($title), 'reservasi')) {
        $icon = 'bi-people-fill';
    } elseif (str_contains(strtolower($title), 'ulasan')) {
        $icon = 'bi-chat-dots-fill';
    }
@endphp

<div class="card-stat">
    <div class="stat-icon">
        <i class="bi {{ $icon }}"></i>
    </div>
    <div class="stat-info">
        <h6>{{ $title }}</h6>
        <h2>{{ $jumlah }}</h2>
    </div>
</div>