@extends('layouts.admin-layout')
@props(['header' => 'Ulasan'])
@section('admin-content')

<div class="p-4">
    <x-data-table title="Daftar Ulasan" :headers="$tableHeader" :addButton="false" :exportButton="false"
        :filterOptions="[]">

        @foreach ($ulasan as $review)
        @php
        $words = explode(' ', $review->isi_ulasan);
        $shortComment = implode(' ', array_slice($words, 0, 3));
        if (count($words) > 3) {
        $shortComment .= ' ...';
        }
        @endphp

        <tr>
            <td>{{ $review->user->nama ?? 'N/A' }}</td>
            <td>{{ $review->reservasi->kode_reservasi ?? '-' }}</td>
            <td>{{ number_format($review->rating, 1) }}</td>
            <td>{{ $shortComment }}</td>
            <td>{{ $review->tgl_ulasan?->format('Y-m-d') }}</td>

            <td>
                <div class="action-buttons">
                    <a href="{{ route('ulasan-detail', $review->id_ulasan) }}" class="btn-action btn-detail">
                        <i class="bi bi-eye-fill"></i>
                    </a>
                    <button class="btn-action btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal"
                        data-id="{{ $review->id_ulasan }}">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </div>
            </td>
        </tr>

        @endforeach


    </x-data-table>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered delete-modal-dialog">
        <div class="modal-content delete-modal">

            <button type="button" class="btn-close delete-close" data-bs-dismiss="modal"></button>

            <div class="modal-body text-center delete-modal-body">
                <h6 class="fw-bold mb-3 delete-title">
                    Apakah Anda yakin ingin<br>menghapus ulasan ini?
                </h6>

                <div class="d-flex gap-2 justify-content-center mt-4">
                    <button class="btn btn-tidak" data-bs-dismiss="modal">Tidak</button>
                    <button class="btn btn-ya">Ya</button>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection