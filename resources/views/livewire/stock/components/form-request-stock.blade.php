<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Stock /</span> Form Request Stock</h4>

    @livewire('components.details-order', ['id' => $id])

    @if (session()->has('success'))
        <div class="alert alert-success d-flex align-items-center" role="alert">
            <span class="alert-icon text-success me-2">
                <i class="ti ti-check ti-xs"></i>
            </span>
            {{ session('success') }}
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-danger d-flex align-items-center" role="alert">
            <span class="alert-icon text-danger me-2">
                <i class="ti ti-ban ti-xs"></i>
            </span>
            {{ session('error') }}
        </div>
    @endif

    <div class="card mb-4">
        <h5 class="card-header">Form Request Stock</h5>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6 mb-2">
                    <div class="row">
                        <label class="form-label" for="collapsible-fullname">Gunakan Stock ?</label>
                        <div class="col-md">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="customRadioTemp1"
                                    style="padding: .422rem .875rem; padding-left: 2.77rem;">
                                    <input name="gunakanStock" wire:model='gunakanStock'
                                        wire:click="updateGunakanStock(true)" class="form-check-input" type="radio"
                                        value="true" id="customRadioTemp1" />
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Ya</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="customRadioTemp2"
                                    style="padding: .422rem .875rem; padding-left: 2.77rem;">
                                    <input name="gunakanStock" wire:model='gunakanStock'
                                        wire:click="updateGunakanStock(false)" class="form-check-input" type="radio"
                                        value="false" id="customRadioTemp2" />
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Tidak</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        @error('gunakanStock')
                            <span class="" style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;"
                                role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-2" @if ($showStock === false) hidden @else @endif>
                    <label class="form-label" for="Cari Stock">Cari Stock</label>
                    <div wire:ignore>
                        <select x-init="$($el).select2({
                            placeholder: 'Pilih Cari Stock',
                            allowClear: true,
                            width: '100%',
                        });
                        $($el).on('change', function() {
                            $wire.set('stockSelected', $($el).val())
                        });
                        $($el).val($($el).val());
                        $($el).trigger('change');" name="stockSelected" wire:model.live="stockSelected"
                            id="stockSelected" class="select2 form-select form-select-lg" data-allow-clear="true">
                            <option label="Pilih Cari Stock"></option>
                            @foreach ($products as $data)
                                <option value="{{ $data->id }}"
                                    wire:click='updateStockSelected({{ $data->id }})'>{{ $data->name }} -
                                    {{ $data->panjang }} cm x
                                    {{ $data->lebar }} cm - {{ $data->customer_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('stockSelected')
                        <span class="" style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;"
                            role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-12 mb-2" @if ($showStock === false) hidden  @else @endif>
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <h6 class="card-title mb-3">List Stock</h6>
                                @forelse ($dataStock as $key => $data)
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="Accessories">Accessories</label>
                                        <input type="text" class="form-control" placeholder="Accessories"
                                            wire:model.defer="dataStock.{{ $key }}.description" readonly />
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="Stock">Stock</label>
                                        <input type="text" class="form-control" placeholder="Stock"
                                            wire:model.defer="dataStock.{{ $key }}.quantity" readonly />
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label class="form-label" for="Quantity">Quantity</label>
                                        <input type="number" class="form-control" placeholder="Quantity"
                                            wire:model.defer="dataStock.{{ $key }}.requestQuantity" />
                                    </div>
                                @empty
                                @endforelse

                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <x-forms.number wire:model.defer="totalQuantity" :placeholder="'Total Stock'"></x-forms.number>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label" for="File Rincian Stock">File Rincian Stock</label>
                    <x-forms.filepond wire:model="fileRincianStock" multiple allowImagePreview
                        imagePreviewMaxHeight="200" allowFileTypeValidation allowFileSizeValidation
                        maxFileSize="1024mb" />
                    @error('fileRincianStock')
                        <span class="" style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;"
                            role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="btn btn-primary me-sm-3 me-1" wire:click='store'>Selesai</button>
            </div>
        </div>

    </div>

</div>
