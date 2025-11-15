@extends('layouts.admin-layout')
@props(['header' => 'Kamar'])
@section('admin-content')

<div class="p-4">
    <x-card-main title="Daftar Kamar">
        <x-data-table :headers="$tableHeader" :rows="$rooms">
            @foreach ($rooms as $room )
                <tr>
                    <td scope="col">{{ $room['kode_tipe'] }}</td>
                    <td scope="col">{{ $room['unit'] }}</td>
                    <td scope="col">{{ $room['kapasitas'] }}</td>
                    <td scope="col">{{ $room['kategori'] }}</td>
                    <td scope="col">
                        <button>
                            Nonaktif
                        </button>
                    </td>
                    <td scope="col">
                        <a class="btn btn-success">A</a>
                        <a class="btn btn-success">B</a>
                        <a class="btn btn-success">C</a>
                    </td>
                    

                </tr>
            @endforeach
        </x-data-table>
    </x-card-main>
</div>

@endsection