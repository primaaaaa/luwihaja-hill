@props([
    'name',
    'label',
    'type',
    'value' => '',
    'required' => false,
    'placeholder' => '',
    'min',
    'readonly' => false
    ])

<label class="form-label">{{$label}}</label>
<input  type="{{ $type }}" 
        class="form-control kamar-input" name="{{ $name }}"
        value="{{ $value }}" 
        {{$required ? 'required' : ''}} 
        placeholder = "{{ $placeholder }}"
        {{ $readonly ? 'readonly' : '' }} style="{{ $readonly ? 'background-color: #e9ecef;' : '' }}">