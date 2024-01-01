<div x-data="{ inputName: @entangle($attributes->wire('model')->value()) }">
    <label class="form-label" for="{{ $placeholder }}">{{ $placeholder }}</label>
    <input type="text" class="form-control @error($attributes->wire('model')->value()) is-invalid @enderror" x-model="inputName" placeholder="{{ $placeholder }}" @if($attributes->has('readonly') && $attributes->get('readonly')) readonly @endif/>
    @error($attributes->wire('model')->value())
        <div class="invalid-feedback">{{ $errors->first($attributes->wire('model')->value()) }}</div>
    @enderror
</div>
