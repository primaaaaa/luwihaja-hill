@props([
    'id' => '',
    'title' => '',
    'route' => ''
    ])

    <div class="modal fade" id="editModal{{ $id }}" tabindex="-1">
            <div class="modal-dialog" style="max-width: 600px;">
                <div class="modal-content kamar-modal">
                    <form action="{{ route($route, $id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="modal-header border-0">
                            <h5 class="modal-title text-success fw-bold text-center w-100"
                                style="color:#3A6E3A !important;">
                                {{ $title }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            {{ $slot }}
                        <div class="modal-footer border-0 d-flex justify-content-center">
                            <button type="submit" class="btn btn-success w-100 py-2 tombol-simpan">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>