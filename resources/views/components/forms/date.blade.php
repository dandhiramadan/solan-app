<div x-data="{ inputName: @entangle($attributes->wire('model')->value()) }">
    <label class="form-label" for="{{ $placeholder }}">{{ $placeholder }}</label>
    <input type="date" class="form-control @error($attributes->wire('model')->value()) is-invalid @enderror" x-model="inputName" placeholder="{{ $placeholder }}" />
    @error($attributes->wire('model')->value())
        <div class="invalid-feedback">{{ $errors->first($attributes->wire('model')->value()) }}</div>
    @enderror
</div>
