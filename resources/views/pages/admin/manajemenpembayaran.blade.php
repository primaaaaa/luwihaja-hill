@extends('layouts.admin-layout')
@props(['header' => 'Kamar'])
@section('admin-content')

<div class="p-4">
    <x-card-main title="Daftar Pembayaran">
        <x-data-table :headers="$tableHeader" :rows="[]"></x-data-table>
    </x-card-main>
</div>

@endsection