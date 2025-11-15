@extends('layouts.admin-layout')
@props(['header' => 'Reservasi'])
@section('admin-content')

<div class="p-4">
    <x-card-main title="Daftar Reservasi">
        <x-data-table :headers="$tableHeader"></x-data-table>
    </x-card-main>
</div>

@endsection