@extends('layouts.admin-layout')
@props(['header' => 'Ulasan'])
@section('admin-content')

<div class="p-4">
    <x-data-table title="Daftar Ulasan" :headers="$tableHeader" :addButton="false" :exportButton="false" :data="$ulasan"
        :filterOptions="[]">

        @if($ulasan->isEmpty())
        <tr>
            <td colspan="6" class="text-center py-3 text-muted">
                Tidak ada ulasan.
            </td>
        </tr>
        @else

        @foreach ($ulasan as $review)
        @php
            $words = explode(' ', $review->isi_ulasan);
            $shortComment = implode(' ', array_slice($words, 0, 3));
            if (count($words) > 3) $shortComment .= ' ...';
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

                    {{-- Tombol Delete yang memanggil modal --}}
                    <button class="btn-action btn-delete" data-bs-toggle="modal"
                        data-bs-target="#deleteModal{{ $review->id_ulasan }}">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </div>
            </td>
        </tr>

        {{-- Modal Delete KHUSUS untuk review ini --}}
        <div class="modal fade" id="deleteModal{{ $review->id_ulasan }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered delete-modal-dialog">
                <div class="modal-content delete-modal">

                    <button type="button" class="btn-close delete-close" data-bs-dismiss="modal"></button>

                    <div class="modal-body text-center delete-modal-body">
                        <h6 class="fw-bold mb-3 delete-title">
                            Apakah Anda yakin ingin<br>menghapus ulasan ini?
                        </h6>

                        <form action="{{ route('admin.ulasan.delete', $review->id_ulasan) }}" method="POST">
                            @csrf
                            @method('DELETE')

                            <div class="d-flex gap-2 justify-content-center mt-4">
                                <button type="button" class="btn btn-tidak" data-bs-dismiss="modal">Tidak</button>
                                <button type="submit" class="btn btn-ya">Ya</button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>

        @endforeach

        @endif

    </x-data-table>
</div>

@endsection
