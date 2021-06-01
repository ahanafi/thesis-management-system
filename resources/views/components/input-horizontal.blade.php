<div class="form-group row">
    <label for="{{ $field }}" class="col-sm-4 col-form-label">
        {{ ucwords($label) }}
        @if($isRequired) <span class="text-danger">*</span> @endif
    </label>

    <div class="col-sm-7">
        <input type="{{ $type }}" class="form-control @error($field) is-invalid @enderror"
               name="{{ $field }}"
               @if($placeholder) placeholder="{{ $placeholder }}" @endif
               @if($value) value="{{ $value }}" @else value="{{ old($field) }}" @endif
               autocomplete="off"
               @if($isRequired) required="required" @endif
               @if($isReadOnly) readonly @endif
        >

        @error($field)
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>
