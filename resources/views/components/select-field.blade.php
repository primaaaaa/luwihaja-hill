@props([
    'label',
    'name',
    'required' => false,
    'disabled' => false,
    'value' => '',      // Nilai dari database (misal: "Deluxe Bed")
    'option' => [],     // Array pilihan (misal: ['Deluxe Bed', 'Queen Bed'])
    'placeholder' => null
])
 
    <label class="form-label">{{ $label }}</label>
    <div class="select-wrapper">
        <select class="form-select kamar-input custom-select" 
                name="{{ $name }}" 
                {{ $required ? 'required' : '' }}
                {{ $disabled ? 'disabled' : '' }}>
            
            {{-- Placeholder Logic --}}
            @if($placeholder)
                {{-- Tampilkan placeholder. Jika value kosong, ini terpilih --}}
                <option value="" disabled {{ empty($value) ? 'selected' : '' }}>
                    {{ $placeholder }}
                </option>
            @endif
        
            {{-- Looping Array Option --}}
            @foreach ($option as $opt)
                <option value="{{ $opt }}" {{ $value == $opt ? 'selected' : '' }}>
                    {{ $opt }}
                </option>
            @endforeach
        </select>
    </div>