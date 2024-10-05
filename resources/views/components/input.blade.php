@props(['type', 'name', 'id', 'label', 'disabled', 'placeholder' => '', 'value' => ''])

<div class="form-group">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <input type="{{ $type }}" name="{{ $name }}" id="{{ $id }}" class="form-control  @error($name)is-invalid  @enderror" placeholder="{{ $placeholder }}" aria-invalid="true"
        value="{{ empty($value) ? old($id) : $value }}" {{ $disabled ?? '' }}>
    @error($name)
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>
