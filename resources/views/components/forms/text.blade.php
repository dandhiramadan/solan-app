<div x-data="{ inputName: @entangle($attributes->wire('model')->value()) }">
    <input type="text" id="defaultInput" class="form-control @error($attributes->wire('model')->value()) is-invalid @enderror" x-model="inputName" placeholder="John Doe" />
    @error($attributes->wire('model')->value())
        <div class="invalid-feedback">{{ $errors->first($attributes->wire('model')->value()) }}</div>
    @enderror
</div>
