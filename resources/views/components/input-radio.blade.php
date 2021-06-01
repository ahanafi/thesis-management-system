<div class="custom-control custom-radio custom-control-inline">
    <input
        type="radio"
        class="custom-control-input"
        id="{{ $value }}"
        name="{{ $name }}"
        value="{{ $value }}"
        @if(strtolower($checked) === strtolower($value)) checked='checked' @endif
    >
    <label class="custom-control-label" for="{{ $value }}">{{ $label }}</label>
</div>
