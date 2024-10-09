@props(['name', 'id', 'label', 'disabled', 'placeholder' => '', 'value' => ''])

<div class="form-group">
    <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    <textarea name="{{ $name }}" id="{{ $id }}" class="form-control  @error($name)is-invalid  @enderror" placeholder="{{ $placeholder }}"
        aria-describedby="exampleInputEmail1-error" aria-invalid="true" {{ $disabled ?? '' }}>{{ empty($value) ? old($id) : $value }}</textarea>
    @error($name)
        <span class="invalid-feedback">{{ $message }}</span>
    @enderror
</div>
