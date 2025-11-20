@props([
        'page' => '',
        'id' => '',
        'nama' => '',
        'route' => ''
    ])    

    
    <div class="modal fade" id="deleteModal{{ $id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered delete-modal-dialog">
                <div class="modal-content delete-modal">
                    <button type="button" class="btn-close delete-close" data-bs-dismiss="modal"></button>
                    <div class="modal-body text-center delete-modal-body">
                        <h6 class="fw-bold mb-3 delete-title">
                            Apakah Anda yakin ingin<br>menghapus {{$page}} {{ $nama }}?
                        </h6>
                        <div class="d-flex gap-2 justify-content-center mt-4">
                            <button class="btn btn-tidak" data-bs-dismiss="modal">Tidak</button>
                            <form action="{{ route($route, $id) }}" method="POST"
                                class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-ya">Ya</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>