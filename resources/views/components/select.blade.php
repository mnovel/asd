@props(['name', 'id', 'label'])

<div class="form-group">
    @if (!empty($label))
        <label for="{{ $id }}" class="form-label">{{ $label ?? '' }}</label>
    @endif
    <select class="form-select @error($name)is-invalid  @enderror" id="{{ $id }}" name="{{ $name }}" aria-invalid="true">
        <option selected disabled value="">Choose...</option>
        {{ $slot }}
    </select>
    @error($name)
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
