@extends('layouts.admin-layout')
@props(['header' => 'Ulasan'])
@section('admin-content')

<div class="p-4">
    <x-card-main title="Daftar Ulasan">
        <x-data-table :headers="$tableHeaders"></x-data-table>
    </x-card-main>
</div>

@endsection