@extends('layouts.admin-layout')
@props(['header' => 'Refund'])
@section('admin-content')

<div class="p-4">
    <x-data-table 
        title="Daftar Pengajuan Refund"
        :headers="$tableHeader"
        :addButton="false"
        :exportButton="false"
        :filterOptions="['Menunggu', 'Disetujui', 'Ditolak']">

        @forelse ($refunds as $refund)
        <tr>
            <td>{{ $refund->kode_refund }}</td>
            <td>{{ $refund->reservasi->kode_reservasi ?? '-' }}</td>
            <td>{{ $refund->reservasi->user->nama ?? '-' }}</td>
            <td>{{ \Carbon\Carbon::parse($refund->tgl_pengajuan)->format('d-m-Y') }}</td>
            <td>
                @php
                    $statusClass = match($refund->status) {
                        'Menunggu' => 'badge-dipesan',
                        'Disetujui' => 'badge-tersedia',
                        'Ditolak' => 'badge-nonaktif',
                        default => 'badge-dipesan'
                    };
                @endphp
                
                <div class="dropdown">
                    <button class="btn badge-status {{ $statusClass }} dropdown-toggle" 
                            type="button" 
                            id="statusDropdown{{ $refund->id_refund }}" 
                            data-bs-toggle="dropdown" 
                            aria-expanded="false">
                        {{ $refund->status }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="statusDropdown{{ $refund->id_refund }}">
                        <li>
                            <a class="dropdown-item update-status" 
                               href="#" 
                               data-id="{{ $refund->id_refund }}" 
                               data-status="Menunggu">
                                Menunggu
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item update-status" 
                               href="#" 
                               data-id="{{ $refund->id_refund }}" 
                               data-status="Disetujui">
                                Disetujui
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item update-status" 
                               href="#" 
                               data-id="{{ $refund->id_refund }}" 
                               data-status="Ditolak">
                                Ditolak
                            </a>
                        </li>
                    </ul>
                </div>
            </td>
            <td>
                <div class="action-buttons">
                    <a href="{{ route('refund-detail', $refund->id_refund) }}" class="btn-lihat-detail">
                        Lihat Detail
                    </a>
                </div>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" style="text-align: center; padding: 40px; color: #6c757d;">
                <p>Belum ada pengajuan refund</p>
            </td>
        </tr>
        @endforelse

    </x-data-table>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Update status refund
    document.querySelectorAll('.update-status').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            
            const refundId = this.dataset.id;
            const newStatus = this.dataset.status;
            
            if (confirm(`Apakah Anda yakin ingin mengubah status menjadi "${newStatus}"?`)) {
                // Kirim request update status
                fetch(`/admin/refund/${refundId}/update-status`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ status: newStatus })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Gagal mengubah status');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan');
                });
            }
        });
    });
});
</script>
@endpush