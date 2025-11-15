@extends('layouts.admin-layout')
@props(['header' => 'Refund'])
@section('admin-content')

<div class="p-4">
    <x-card-main title="Daftar Refund">
        <x-data-table :headers="$tableHeader"></x-data-table>
    </x-card-main>
</div>

@endsection