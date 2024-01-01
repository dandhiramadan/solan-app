<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Stock /</span> Good Receipt</h4>

    @livewire('components.flash-message')

    <!-- Basic Layout -->
    <div class="card mb-4">
        <h5 class="card-header">Form Good Receipt</h5>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6 mb-2">
                    <div wire:ignore>
                        <label class="form-label" for="Product">Product</label>
                        <select x-init="$($el).select2({
                            placeholder: 'Pilih Product',
                            allowClear: true,
                            width: '100%',
                        });
                        $($el).on('change', function() {
                            $wire.set('productSelected', $($el).val())
                        });
                        $($el).val($($el).val());
                        $($el).trigger('change');" name="productSelected" wire:model.defer="productSelected"
                            id="productSelected" class="select2 form-select form-select-lg" data-allow-clear="true">
                            <option label="Pilih Product"></option>
                            @foreach ($products as $data)
                                <option value="{{ $data->id }}">{{ $data->name }} - {{ $data->customer_name }} -
                                    {{ $data->panjang }} cm x {{ $data->lebar }} cm</option>
                            @endforeach
                        </select>
                    </div>
                    @error('productSelected')
                        <span class="" style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;"
                            role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div class="col-md-6 mb-2">
                    <x-forms.number wire:model.defer="totalQuantity" :placeholder="'Total Quantity'"></x-forms.number>
                </div>
                <div class="col-md-6 mb-2">
                    <x-forms.text wire:model.defer="sender" :placeholder="'Sender'"></x-forms.text>
                </div>
                <div class="col-md-6 mb-2">
                    <x-forms.text wire:model.defer="recipient" :placeholder="'Recipient'"></x-forms.text>
                </div>
                <div class="col-md-6 mb-2">
                    <x-forms.text wire:model.defer="rak" :placeholder="'Rak'"></x-forms.text>
                </div>
                <div class="col-md-6 mb-2">
                    <x-forms.text wire:model.defer="baris" :placeholder="'Baris'"></x-forms.text>
                </div>

                <div class="col-lg-12 col-md-12 mt-2">
                    <label for="exampleFormControlTextarea1" class="form-label">Catatan</label>
                    <div class="input-group">
                        <textarea class="form-control @error('catatan') is-invalid @enderror" rows="3" placeholder="Catatan"
                            wire:model="catatan"></textarea>
                    </div>
                </div>

                @error('catatan')
                    <span class="" style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;" role="alert">
                        {{ $message }}
                    </span>
                @enderror

                <h3>Accessories</h3>
                <button type="button" wire:click="addAccessoryInput">Add Accessories</button>
                @foreach ($accessories as $key => $accessory)
                    <div>
                        <select class="form-select" aria-label="Pilih"
                            wire:model.defer="accessories.{{ $key }}.id">
                            <option label="Pilih"></option>
                            @foreach ($dataAccessories as $data)

                            <option value="{{ $data->id }}">{{ $data->description }}</option>
                            @endforeach
                        </select>
                        <input wire:model.defer="accessories.{{ $key }}.quantity" type="number"
                            placeholder="Quantity" min="1" required>
                    </div>
                @endforeach
                @error('accessories.*.id')
                    <span>{{ $message }}</span>
                @enderror
                @error('accessories.*.quantity')
                    <span>{{ $message }}</span>
                @enderror


                <div class="pt-4">
                    <button type="button" class="btn btn-primary me-sm-3 me-1" wire:click='store'>Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
