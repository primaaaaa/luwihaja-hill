@props([
    'label',
    'type' => 'file',
    'name',
    'hidden' => false,
    'value' => null
    ])

<label class="form-label">{{$label}}</label>
<label class="upload-wrapper">
    <input type="{{ $type }}" name="foto_kamar" accept="image/*" hidden class="file-input-add">
        <span class="file-name-display">{{$value ? basename($value) : 'Upload Foto'}}</span>
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"
                style="width: 22px; height: 22px; color: #198754;">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
            </svg>
</label>