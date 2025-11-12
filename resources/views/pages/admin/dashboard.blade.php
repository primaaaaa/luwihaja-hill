@extends('layouts.admin-layout')
@props(['header' => 'Dashboard'])
@section('admin-content')
  <div class="p-4">
      <!-- Statistik -->
      <div class="row g-4">
        <div class="col-md-4">
          <x-stat-card title="Total Kamar" :jumlah="10"></x-stat-card>
        </div>
        <div class="col-md-4">
          <x-stat-card title="Total Reservasi" :jumlah="5"></x-stat-card>
        </div>
        <div class="col-md-4">
          <x-stat-card title="Total Ulasan" :jumlah="4"></x-stat-card>
        </div>
      </div>

      <!-- Chart Placeholder -->
      <x-card-main title="Grafik Reservasi"></x-card-main>
  </div>
@endsection
