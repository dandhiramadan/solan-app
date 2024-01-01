<div x-data="{ inputName: @entangle($attributes->wire('model')->value()) }">
    <label class="form-label" for="{{ $placeholder }}">{{ $placeholder }}</label>
    <textarea class="form-control @error($attributes->wire('model')->value()) is-invalid @enderror" x-model="inputName"  rows="3" placeholder="{{ $placeholder }}" @if($attributes->has('readonly') && $attributes->get('readonly')) readonly @endif></textarea>
    @error($attributes->wire('model')->value())
    <span class="" style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;"
    role="alert">{{ $errors->first($attributes->wire('model')->value()) }}</span>
    @enderror
</div>
