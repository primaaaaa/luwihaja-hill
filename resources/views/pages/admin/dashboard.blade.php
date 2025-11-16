@extends('layouts.admin-layout')
@props(['header' => 'Dashboard'])
@section('admin-content')
 <div class="p-4">
    <div class="stats-container">
        <x-stat-card title="Total Kamar" :jumlah="10"></x-stat-card>
        <x-stat-card title="Total Reservasi" :jumlah="5"></x-stat-card>
        <x-stat-card title="Total Ulasan" :jumlah="4"></x-stat-card>
    </div>

    <x-card-main title="Grafik Reservasi"></x-card-main>
</div>
@endsection
