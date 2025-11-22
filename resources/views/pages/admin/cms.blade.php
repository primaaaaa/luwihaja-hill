@extends('layouts.admin-layout')
@props(['header' => 'CMS'])
@section('admin-content')

<div class="p-4">
    {{-- Alert Messages --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <x-data-table 
        title="CMS Galeri"
        :data="$galleries"
        :headers="$tableHeader"
        :addButton="true"
        :exportButton="false"
        :filterOptions="[]">

        @forelse ($galleries as $gallery)
        <tr>
            <td>{{ $gallery->kode_galeri }}</td>
            <td>{{ $gallery->file }}</td>
            <td>{{ \Carbon\Carbon::parse($gallery->tgl_upload)->format('d/m/Y') }}</td>
            <td>
                <div class="action-buttons">
                    <button class="btn-action btn-detail" data-bs-toggle="modal" data-bs-target="#detailModal{{ $gallery->id_galeri }}">
                        <i class="bi bi-eye-fill"></i>
                    </button>
                    <button class="btn-action btn-delete" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $gallery->id_galeri }}">
                        <i class="bi bi-trash-fill"></i>
                    </button>
                </div>
            </td>
        </tr>

        {{-- Modal Detail untuk setiap gallery --}}
        <div class="modal fade cms-detail-modal" id="detailModal{{ $gallery->id_galeri }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header cms-modal-header">
                        <h5 class="modal-title cms-modal-title">Detail Gambar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4">
                        @php
                            $extension = pathinfo($gallery->file, PATHINFO_EXTENSION);
                            $imageExtensions = ['jpg', 'jpeg', 'png', 'gif'];
                        @endphp
                        
                        @if(in_array(strtolower($extension), $imageExtensions))
                            <img src="{{ asset('storage/galeri/' . $gallery->file) }}" alt="Detail" class="cms-detail-image">
                        @elseif(strtolower($extension) == 'mp4')
                            <video controls class="cms-detail-image">
                                <source src="{{ asset('storage/galeri/' . $gallery->file) }}" type="video/mp4">
                            </video>
                        @else
                            <div class="text-center p-4">
                                <i class="bi bi-file-earmark" style="font-size: 3rem;"></i>
                                <p>{{ $gallery->file }}</p>
                                <a href="{{ asset('storage/galeri/' . $gallery->file) }}" class="btn btn-primary" download>Download File</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        {{-- Modal Delete untuk setiap gallery --}}
        <div class="modal fade" id="deleteModal{{ $gallery->id_galeri }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered delete-modal-dialog">
                <div class="modal-content delete-modal">
                    <button type="button" class="btn-close delete-close" data-bs-dismiss="modal"></button>
                    <div class="modal-body text-center delete-modal-body">
                        <h6 class="fw-bold mb-3 delete-title">
                            Apakah Anda yakin ingin<br>menghapus konten ini?
                        </h6>
                        <div class="d-flex gap-2 justify-content-center mt-4">
                            <button class="btn btn-tidak" data-bs-dismiss="modal">Tidak</button>
                            <form action="{{ route('cms.delete', $gallery->id_galeri) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-ya">Ya</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <tr>
            <td colspan="4" class="text-center">Tidak ada data galeri</td>
        </tr>
        @endforelse

    </x-data-table>
</div>

{{-- Modal Upload --}}
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('cms.upload') }}" method="POST" enctype="multipart/form-data" id="uploadForm">
                @csrf
                <div class="modal-header cms-modal-header">
                    <h5 class="modal-title cms-modal-title" id="addModalLabel">Upload</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="cms-upload-area" id="cmsUploadArea">
                        <input type="file" name="files[]" id="cmsFileInput" accept=".jpg,.jpeg,.png,.gif,.mp4,.pdf,.psd,.ai,.doc,.docx,.ppt,.pptx" multiple>
                        <div class="cms-upload-icon">
                            <i class="bi bi-cloud-arrow-up"></i>
                        </div>
                        <div class="cms-upload-text">
                            Drag & drop files or <a href="#" id="cmsBrowseLink">Browse</a>
                        </div>
                        <div class="cms-upload-formats">
                            Supported formats: JPEG, PNG, GIF, MP4, PDF, PSD, AI, Word, PPT
                        </div>
                    </div>
                    <div id="cmsFileList" class="cms-file-list"></div>
                </div>
                <div class="modal-footer justify-content-center border-0 pb-4">
                    <button type="submit" class="cms-btn-unggah">UNGGAH</button>
                    <button type="button" class="cms-btn-batal" data-bs-dismiss="modal">BATAL</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const uploadArea = document.getElementById('cmsUploadArea');
        const fileInput = document.getElementById('cmsFileInput');
        const browseLink = document.getElementById('cmsBrowseLink');
        const fileList = document.getElementById('cmsFileList');

        if (!uploadArea || !fileInput || !browseLink || !fileList) return;

        browseLink.addEventListener('click', (e) => {
            e.preventDefault();
            fileInput.click();
        });

        uploadArea.addEventListener('click', (e) => {
            if (e.target !== browseLink && !browseLink.contains(e.target)) {
                fileInput.click();
            }
        });

        fileInput.addEventListener('change', (e) => {
            handleFiles(e.target.files);
        });

        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.classList.add('dragover');
        });

        uploadArea.addEventListener('dragleave', () => {
            uploadArea.classList.remove('dragover');
        });

        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.classList.remove('dragover');
            const dt = e.dataTransfer;
            fileInput.files = dt.files;
            handleFiles(dt.files);
        });

        function handleFiles(files) {
            fileList.innerHTML = '';
            Array.from(files).forEach(file => {
                const fileItem = document.createElement('div');
                fileItem.className = 'cms-file-item';
                fileItem.innerHTML = `
                    <i class="bi bi-file-earmark"></i>
                    <span>${file.name} (${formatFileSize(file.size)})</span>
                `;
                fileList.appendChild(fileItem);
            });
        }

        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
        }
    });
</script>

@endsection