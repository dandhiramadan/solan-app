<div>
    {{-- Stop trying to control. --}}
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Form SPK /</span> New SPK</h4>
    <!-- Basic Layout -->
    <div class="card mb-4">
        <h5 class="card-header">Form New SPK</h5>
        <form class="card-body" wire:submit="save">
            <div class="row mb-3">
                <div class="col-md-6 mb-2">
                    <div class="row">
                        <label class="form-label" for="collapsible-fullname">Tipe SPK</label>
                        <div class="col-md">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="customRadioTemp1"
                                    style="padding: .422rem .875rem; padding-left: 2.77rem;">
                                    <input name="spk_type" wire:model.defer='spk_type' class="form-check-input"
                                        type="radio" value="layout" id="customRadioTemp1" />
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Layout</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="customRadioTemp2"
                                    style="padding: .422rem .875rem; padding-left: 2.77rem;">
                                    <input name="spk_type" wire:model.defer='spk_type' class="form-check-input"
                                        type="radio" value="sample" id="customRadioTemp2" />
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Sample</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="customRadioTemp3"
                                    style="padding: .422rem .875rem; padding-left: 2.77rem;">
                                    <input name="spk_type" wire:model.defer='spk_type' class="form-check-input"
                                        type="radio" value="production" id="customRadioTemp3" />
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Production</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="customRadioTemp4"
                                    style="padding: .422rem .875rem; padding-left: 2.77rem;">
                                    <input name="spk_type" wire:model.defer='spk_type' class="form-check-input"
                                        type="radio" value="stock" id="customRadioTemp4" />
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Stock</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        @error('spk_type')
                            <span class="" style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;"
                                role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <label class="form-label" for="Pemesan">Pemesan</label>
                    <div wire:ignore>
                        <select x-init="$($el).select2({
                            placeholder: 'Pilih Pemesan',
                            allowClear: true,
                        });
                        $($el).on('change', function() {
                            @this.set('customer_name', $($el).val())
                        })" name="customer_name" wire:model.defer="customer_name"
                            id="customer_name" class="select2 form-select form-select-lg" data-allow-clear="true">
                            <option label="Pilih Pemesan"></option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                        </select>
                    </div>
                    @error('customer_name')
                        <span class="" style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;"
                            role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-6 mb-2">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label" for="SPK Parent">Sub SPK</label>
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="customRadioTemp5"
                                    style="padding: .422rem .875rem; padding-left: 2.77rem;">
                                    <input name="sub_spk" wire:model.defer='sub_spk' class="form-check-input"
                                        type="checkbox" value="V" id="customRadioTemp5" />
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Ya</span>
                                    </span>
                                </label>
                            </div>
                            @error('sub_spk')
                                <span class="" style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;"
                                    role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-8">
                            <div wire:ignore>
                                <label class="form-label" for="SPK Parent">SPK Parent</label>
                                <select x-init="$($el).select2({
                                    placeholder: 'Pilih SPK Parent',
                                    allowClear: true,
                                });
                                $($el).on('change', function() {
                                    @this.set('spk_parent', $($el).val())
                                })" name="spk_parent" wire:model.defer="spk_parent"
                                    id="spk_parent" class="select2 form-select form-select-lg"
                                    data-allow-clear="true">
                                    <option label="Pilih SPK Parent"></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                            @error('spk_parent')
                                <span class="" style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;"
                                    role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <label class="form-label" for="SPK Parent">SPK Number</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('spk_number') is-invalid @enderror"
                            wire:model.defer='spk_number' placeholder="SPK Number" aria-label="SPK Number"
                            aria-describedby="button-generate" readonly />
                        <button class="btn btn-outline-primary" type="button" id="button-generate">Generate</button>
                        @error('spk_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label" for="SPK FSC">SPK FSC</label>
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="customRadioTemp5"
                                    style="padding: .422rem .875rem; padding-left: 2.77rem;">
                                    <input name="spk_fsc" wire:model.defer='spk_fsc' class="form-check-input"
                                        type="checkbox" value="V" id="customRadioTemp5" />
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Ya</span>
                                    </span>
                                </label>
                            </div>
                            @error('spk_fsc')
                                <span class="" style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;"
                                    role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-8">
                            <div wire:ignore>
                                <label class="form-label" for="Tipe FSC">Tipe FSC</label>
                                <select x-init="$($el).select2({
                                    placeholder: 'Pilih Tipe FSC',
                                    allowClear: true,
                                });
                                $($el).on('change', function() {
                                    @this.set('fsc_type', $($el).val())
                                })" name="fsc_type" wire:model.defer="fsc_type"
                                    id="fsc_type" class="select2 form-select form-select-lg"
                                    data-allow-clear="true">
                                    <option label="Pilih Tipe FSC"></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                            @error('fsc_type')
                                <span class="" style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;"
                                    role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <label class="form-label" for="SPK Parent">SPK Number FSC</label>
                    <div class="input-group">
                        <input type="text" class="form-control @error('spk_number_fsc') is-invalid @enderror"
                            wire:model.defer='spk_number_fsc' placeholder="SPK Number FSC"
                            aria-label="SPK Number FSC" aria-describedby="button-generate" readonly />
                        <button class="btn btn-outline-primary" type="button" id="button-generate">Generate</button>
                        @error('spk_number_fsc')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <x-forms.date wire:model.defer="order_date" :placeholder="'Tanggal PO Masuk'"></x-forms.date>
                </div>
                <div class="col-md-6 mb-2">
                    <x-forms.date wire:model.defer="order_date" :placeholder="'Tanggal Permintaan Kirim'"></x-forms.date>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label" for="FOC">FOC</label>
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="customRadioTemp6"
                                    style="padding: .422rem .875rem; padding-left: 2.77rem;">
                                    <input name="foc" wire:model.defer='foc' class="form-check-input"
                                        type="checkbox" value="V" id="customRadioTemp5" />
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Ya</span>
                                    </span>
                                </label>
                            </div>
                            @error('foc')
                                <span class="" style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;"
                                    role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-8">

                            <x-forms.text wire:model.defer="customer_number" :placeholder="'No. Purchase Order'"></x-forms.text>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <x-forms.text wire:model.defer="order_name" :placeholder="'Nama Order'"></x-forms.text>
                </div>
                <div class="col-md-6 mb-2">
                    <x-forms.text wire:model.defer="code_style" :placeholder="'Code Style'"></x-forms.text>
                </div>
                <div class="col-md-6 mb-2">
                    <x-forms.number wire:model.defer="quantity" :placeholder="'Quantity'"></x-forms.number>
                </div>
                <div class="col-md-6 mb-2">
                    <x-forms.text wire:model.defer="follow_up" :placeholder="'Follow Up'"></x-forms.text>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="row">
                        <div class="col-md-6">
                            <x-forms.number wire:model.defer="price" :placeholder="'Harga'"></x-forms.number>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="PPN">PPN</label>
                            <select class="form-select" aria-label="Pilih PPN">
                                <option label="Pilih PPN"></option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <x-forms.number wire:model.defer="panjang_barang" :placeholder="'Panjang Barang'"></x-forms.number>
                </div>
                <div class="col-md-6 mb-2">
                    <x-forms.number wire:model.defer="lebar_barang" :placeholder="'Lebar Barang'"></x-forms.number>
                </div>
                <div class="col-md-12 mb-2">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label" for="SPK Layout">SPK Layout</label>
                            <div wire:ignore>
                                <select x-init="$($el).select2({
                                    placeholder: 'Pilih SPK Layout',
                                    allowClear: true,
                                });
                                $($el).on('change', function() {
                                    @this.set('spk_layout', $($el).val())
                                })" name="spk_layout" wire:model.defer="spk_layout"
                                    id="spk_layout" class="select2 form-select form-select-lg"
                                    data-allow-clear="true">
                                    <option label="Pilih SPK Layout"></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                            @error('spk_layout')
                                <span class="" style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;"
                                    role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="SPK Sample">SPK Sample</label>
                            <div wire:ignore>
                                <select x-init="$($el).select2({
                                    placeholder: 'Pilih SPK Sample',
                                    allowClear: true,
                                });
                                $($el).on('change', function() {
                                    @this.set('spk_sample', $($el).val())
                                })" name="spk_sample" wire:model.defer="spk_sample"
                                    id="spk_sample" class="select2 form-select form-select-lg"
                                    data-allow-clear="true">
                                    <option label="Pilih SPK Sample"></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                            @error('spk_sample')
                                <span class="" style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;"
                                    role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" for="SPK Stock">SPK Stock</label>
                            <div wire:ignore>
                                <select x-init="$($el).select2({
                                    placeholder: 'Pilih SPK Stock',
                                    allowClear: true,
                                });
                                $($el).on('change', function() {
                                    @this.set('spk_stock', $($el).val())
                                })" name="spk_stock" wire:model.defer="spk_stock"
                                    id="spk_stock" class="select2 form-select form-select-lg"
                                    data-allow-clear="true">
                                    <option label="Pilih SPK Stock"></option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>
                            </div>
                            @error('spk_stock')
                                <span class="" style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;"
                                    role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-6">
                    <div class="card mb-4">
                        <h5 class="card-header">Langkah Kerja</h5>
                        <div class="card-body">
                            @error('langkahKerja')
                                <span class="" style="margin-top: 0.35rem; font-size:0.8125rem; color: #ea5455;"
                                    role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                            <div class="demo-inline-spacing" wire:sortable="updateTaskOrder">
                                @foreach ($langkahKerja as $key => $data)
                                    <div class="input-group" wire:sortable.item="{{ $key }}"
                                        wire:key="task-{{ $key }}">
                                        <button type="button" class="btn btn-icon btn-outline-primary"
                                            wire:sortable.handle role="button">
                                            <span class="ti ti-arrows-move-vertical"></span>
                                        </button>
                                        <input type="text" class="form-control"
                                            wire:model.defer="langkahKerja.{{ $key }}.description"
                                            readonly />
                                        <button class="btn btn-outline-primary" type="button"
                                            wire:click="removeLangkahKerja({{ $key }})">Delete</button>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card mb-4">
                        <h5 class="card-header">List Langkah Kerja</h5>
                        <div class="card-body">
                            <div class="demo-inline-spacing">
                                @foreach ($workStep as $key => $item)
                                    @if (
                                        $item->description == 'Cetak Label' ||
                                            $item->description == 'Hot Cutting' ||
                                            $item->description == 'Hot Cutting Folding' ||
                                            $item->description == 'Lipat Perahu' ||
                                            $item->description == 'Lipat Kanan Kiri')
                                        <button type="button" class="btn btn-outline-info"
                                            wire:click="addLangkahKerja('{{ $item->description }}')">{{ $item->description }}</button>
                                    @else
                                        <button type="button" class="btn btn-outline-primary"
                                            wire:click="addLangkahKerja('{{ $item->description }}')">{{ $item->description }}</button>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label" for="File Contoh">File Contoh</label>
                    <x-forms.filepond wire:model="file_contoh" multiple allowImagePreview imagePreviewMaxHeight="200"
                        allowFileTypeValidation allowFileSizeValidation maxFileSize="1024mb" />
                    @error('file_contoh')
                        <span class="" style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;"
                            role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="File Arsip">File Arsip</label>
                    <x-forms.filepond wire:model="file_arsip" multiple allowImagePreview imagePreviewMaxHeight="200"
                        allowFileTypeValidation allowFileSizeValidation maxFileSize="1024mb" />
                    @error('file_arsip')
                        <span class="" style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;"
                            role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="File Accounting">File Accounting</label>
                    <x-forms.filepond wire:model="file_accounting" multiple allowImagePreview imagePreviewMaxHeight="200"
                        allowFileTypeValidation allowFileSizeValidation maxFileSize="1024mb" />
                    @error('file_accounting')
                        <span class="" style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;"
                            role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <div class="pt-4">
                <button type="button" class="btn btn-info me-sm-3 me-1">Download Sample Record</button>
                <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v1.x.x/dist/livewire-sortable.js"></script>
@endpush
