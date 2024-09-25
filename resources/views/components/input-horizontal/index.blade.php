@props([
    'label' => null ?? ucfirst($name),
    'type' => null ?? 'text',
    'name',
    'id'    => null ?? $name,
    'placeholder' => null,
    'autocomplete' => null ?? 'off',
    'readonly' => false,
    'disabled' => false,
    'required' => false,
    'value' => null ?? old($name)
])

<div class="row mb-3">
    <div class="col-md-4">
        <label for="{{ $id }}"
            class="form-label @error($name) text-danger @enderror {{ $required ? 'required' : '' }}"
        >
            {{ __($label) }}
        </label>
    </div>
    <div class="col-md-6">
    <input type="{{ $type }}"
           name="{{ $name }}"
           id="{{ $id }}"
           class="form-control @error($name) is-invalid @enderror"
           placeholder="{{ $placeholder }}"
           autocomplete="{{ $autocomplete }}"
           {{ $readonly ? 'readonly' : '' }}
           {{ $disabled ? 'disabled' : '' }}
           {{ $required ? 'required' : '' }}
           {{--           value="{{ old($name, $model->name ) }}"--}}
           value="{{ $value }}"
    >
    @error($name)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror
    </div>
</div>
