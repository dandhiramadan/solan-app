<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Stock /</span> Form Request Stock</h4>

    @livewire('components.details-order', ['id' => $id ])

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
                    <label class="form-label" for="Cari Stock">Cari Stock</label>
                    <div wire:ignore>
                        <select x-init="$($el).select2({
                            placeholder: 'Pilih Cari Stock',
                            allowClear: true,
                        });
                        $($el).on('change', function() {
                            @this.set('stockSelected', $($el).val())
                        })" name="stockSelected" wire:model.defer="stockSelected"
                            id="stockSelected" class="select2 form-select form-select-lg" data-allow-clear="true">
                            <option label="Pilih Cari Stock"></option>
                            {{-- @foreach ($customer as $data)
                                <option value="{{ $data->id }}">{{ $data->name }} - {{ $data->taxes }}</option>
                            @endforeach --}}
                        </select>
                    </div>
                    @error('stockSelected')
                        <span class="" style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <x-forms.number wire:model.defer="stock" :placeholder="'Stock Tersedia'"></x-forms.number>
                </div>
                <div class="col-md-6 mb-2">
                    <x-forms.number wire:model.defer="stock" :placeholder="'Stock'"></x-forms.number>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label" for="File Rincian Stock">File Rincian Stock</label>
                    <x-forms.filepond wire:model="fileRincianStock" multiple allowImagePreview imagePreviewMaxHeight="200"
                        allowFileTypeValidation allowFileSizeValidation maxFileSize="1024mb" />
                    @error('fileRincianStock')
                        <span class="" style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;"
                            role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="btn btn-primary me-sm-3 me-1" wire:click='save'>Selesai</button>
            </div>
        </div>

    </div>

</div>
