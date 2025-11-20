@props([
    'label',
    'name',
    'rows' => 3,
    'placeholder' => '',
    'value' => ''
    ])

<label class="form-label">{{$label}}</label>
<textarea class="form-control kamar-input" name="{{$name}}" rows="{{ $rows }}"
    placeholder="{{ $placeholder }}">{{ $value }}</textarea>