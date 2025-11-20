@props([
    'page' => '',
    'data' => [],
    'route' => '',
    ''
    
    ])
        
        
        <div class="modal fade" id="editModal{{ $room->id_tipe_villa }}" tabindex="-1">
            <div class="modal-dialog" style="max-width: 600px;">
                <div class="modal-content kamar-modal">
                    <form action="{{ route($route, $room->id_tipe_villa) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="modal-header border-0">
                            <h5 class="modal-title text-success fw-bold text-center w-100"
                                style="color:#3A6E3A !important;">
                                Edit {{ $page }}
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <div class="modal-body">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Unit Kamar</label>
                                    <input type="text" class="form-control kamar-input" name="nama_unit"
                                        value="{{ $room->nama_unit }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Kapasitas</label>
                                    <input type="number" class="form-control kamar-input" name="kapasitas"
                                        value="{{ $room->kapasitas }}" required>
                                </div>
                            </div>

                            <div class="row g-3 mt-1">
                                <div class="col-md-6">
                                    <label class="form-label">Harga Weekday</label>
                                    <input type="number" class="form-control kamar-input" name="harga_weekday"
                                        value="{{ $room->harga_weekday }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Harga Weekend</label>
                                    <input type="number" class="form-control kamar-input" name="harga_weekend"
                                        value="{{ $room->harga_weekend }}" required>
                                </div>
                            </div>

                            <div class="mt-3">
                                <label class="form-label">Kategori</label>
                                <div class="select-wrapper">
                                    <select class="form-select kamar-input custom-select" name="kategori" required>
                                        <option value="Deluxe Bed" {{ $room->kategori == 'Deluxe Bed' ? 'selected' : '' }}>Deluxe Bed</option>
                                        <option value="Queen Bed" {{ $room->kategori == 'Queen Bed' ? 'selected' : '' }}>Queen Bed</option>
                                        <option value="Twin Bed" {{ $room->kategori == 'Twin Bed' ? 'selected' : '' }}>Twin Bed</option>
                                        <option value="Super Deluxe" {{ $room->kategori == 'Super Deluxe' ? 'selected' : '' }}>Super Deluxe</option>
                                        <option value="Family Room" {{ $room->kategori == 'Family Room' ? 'selected' : '' }}>Family Room</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mt-3">
                                <label class="form-label">Status</label>
                                <div class="select-wrapper">
                                    <select class="form-select kamar-input custom-select" name="status" required>
                                        <option value="Tersedia" {{ $room->status == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                                        <option value="Terisi" {{ $room->status == 'Terisi' ? 'selected' : '' }}>Terisi</option>
                                        <option value="Dipesan" {{ $room->status == 'Dipesan' ? 'selected' : '' }}>Dipesan</option>
                                        <option value="Nonaktif" {{ $room->status == 'Nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mt-3">
                                <label class="form-label">Deskripsi Kamar</label>
                                <textarea class="form-control kamar-input" name="deskripsi"
                                    rows="3">{{ $room->deskripsi }}</textarea>
                            </div>

                            <div class="row g-3 mt-1">
                                <div class="col-md-6">
                                    <label class="form-label">Foto Kamar</label>
                                    <label class="upload-wrapper">
                                        <input type="file" name="foto_kamar" accept="image/*" hidden class="file-input-edit">
                                        <span class="file-name-display">{{ $room->foto_kamar ? basename($room->foto_kamar) : 'Upload foto' }}</span>
                                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            style="width: 22px; height: 22px; color: #198754;">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                    </label>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label">Kode Tipe</label>
                                    <input type="text" class="form-control kamar-input" name="kode_tipe"
                                        value="{{ $room->kode_tipe }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer border-0 d-flex justify-content-center">
                            <button type="submit" class="btn btn-success w-100 py-2 tombol-simpan">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>