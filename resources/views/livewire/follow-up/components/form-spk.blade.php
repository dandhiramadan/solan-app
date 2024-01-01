<div>
    {{-- Stop trying to control. --}}
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Form SPK /</span> New SPK</h4>

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
    <!-- Basic Layout -->
    <div class="card mb-4">
        <h5 class="card-header">Form New SPK</h5>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6 mb-2">
                    <div class="row">
                        <label class="form-label" for="collapsible-fullname">Tipe SPK</label>
                        <div class="col-md">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="customRadioTemp1"
                                    style="padding: .422rem .875rem; padding-left: 2.77rem;">
                                    <input name="spkType" wire:model.defer='spkType' class="form-check-input" type="radio"
                                        value="layout" id="customRadioTemp1" />
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
                                    <input name="spkType" wire:model.defer='spkType' class="form-check-input" type="radio"
                                        value="sample" id="customRadioTemp2" />
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
                                    <input name="spkType" wire:model.defer='spkType' class="form-check-input" type="radio"
                                        value="production" id="customRadioTemp3" />
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
                                    <input name="spkType" wire:model.defer='spkType' class="form-check-input" type="radio"
                                        value="stock" id="customRadioTemp4" />
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Stock</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        @error('spkType')
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
                            @this.set('customerSelected', $($el).val())
                        })" name="customerSelected" wire:model.defer="customerSelected"
                            id="customerSelected" class="select2 form-select form-select-lg" data-allow-clear="true">
                            <option label="Pilih Pemesan"></option>
                            @foreach ($customer as $data)
                                <option value="{{ $data->id }}">{{ $data->name }} - {{ $data->taxes }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('customerSelected')
                        <span class="" style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;" role="alert">
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
                                    <input name="subSpk" wire:model='subSpk' class="form-check-input" type="checkbox"
                                        value="V" id="customRadioTemp5" />
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Ya</span>
                                    </span>
                                </label>
                            </div>
                            @error('subSpk')
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
                                    @this.set('spkParent', $($el).val())
                                })" name="spkParent" wire:model.defer="spkParent"
                                    id="spkParent" class="select2 form-select form-select-lg" data-allow-clear="true">
                                    <option label="Pilih Parent"></option>
                                    @foreach ($parent as $data)
                                        <option value="{{ $data->spk_number }}">[ {{ $data->spk_number }}
                                            ] - {{ $data->customer_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('spkParent')
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
                        <input type="text" class="form-control @error('spkNumber') is-invalid @enderror"
                            wire:model.defer='spkNumber' placeholder="SPK Number" aria-label="SPK Number"
                            aria-describedby="button-generate" readonly />
                        <button class="btn btn-outline-primary" type="button" id="button-generate"
                            wire:click='generateSpkNumber' wire:key='generateSpkNumber'>Generate</button>
                        @error('spkNumber')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label" for="SPK FSC">SPK FSC</label>
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="customRadioTemp6"
                                    style="padding: .422rem .875rem; padding-left: 2.77rem;">
                                    <input name="spkFsc" wire:model='spkFsc' class="form-check-input" type="checkbox"
                                        value="V" id="customRadioTemp6" />
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Ya</span>
                                    </span>
                                </label>
                            </div>
                            @error('spkFsc')
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
                                    @this.set('fscType', $($el).val())
                                })" name="fscType" wire:model.defer="fscType" id="fscType"
                                    class="select2 form-select form-select-lg" data-allow-clear="true">
                                    <option label="Pilih Tipe FSC"></option>
                                    <option value="FS">FS</option>
                                    <option value="FM">FM</option>
                                    <option value="FR">FR</option>
                                </select>
                            </div>
                            @error('fscType')
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
                        <input type="text" class="form-control @error('spkNumberFsc') is-invalid @enderror"
                            wire:model.defer='spkNumberFsc' placeholder="SPK Number FSC" aria-label="SPK Number FSC"
                            aria-describedby="button-generate" readonly />
                        <button class="btn btn-outline-primary" type="button" id="button-generate"
                            wire:click='generateSpkNumberFsc' wire:key='generateSpkNumberFsc'>Generate</button>
                        @error('spkNumberFsc')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <x-forms.date wire:model.defer="orderDate" :placeholder="'Tanggal PO Masuk'"></x-forms.date>
                </div>
                <div class="col-md-6 mb-2">
                    <x-forms.date wire:model.defer="deliveryDate" :placeholder="'Tanggal Permintaan Kirim'"></x-forms.date>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label" for="FOC">FOC</label>
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="customRadioTemp7"
                                    style="padding: .422rem .875rem; padding-left: 2.77rem;">
                                    <input name="focCustomerNumber" wire:model.live='focCustomerNumber'
                                        class="form-check-input" type="checkbox" value="V" id="customRadioTemp7" />
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Ya</span>
                                    </span>
                                </label>
                            </div>
                            @error('focCustomerNumber')
                                <span class="" style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;"
                                    role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-8">
                            <x-forms.text wire:model.defer="customerNumber" :placeholder="'No. Purchase Order'"></x-forms.text>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <x-forms.text wire:model.defer="orderName" :placeholder="'Nama Order'"></x-forms.text>
                </div>
                <div class="col-md-6 mb-2">
                    <x-forms.text wire:model.defer="codeStyle" :placeholder="'Code Style'"></x-forms.text>
                </div>
                <div class="col-md-6 mb-2">
                    <x-forms.number wire:model.defer="quantity" :placeholder="'Quantity'"></x-forms.number>
                </div>
                <div class="col-md-6 mb-2">
                    <x-forms.text wire:model.defer="followUp" :placeholder="'Follow Up'"></x-forms.text>
                </div>
                <div class="col-md-6 mb-2">
                    <div class="row">
                        <div class="col-md-6">
                            <x-forms.number wire:model.defer="price" :placeholder="'Harga'"></x-forms.number>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="PPN">PPN</label>
                            <select class="form-select" aria-label="Pilih PPN" wire:model.defer="ppn">
                                <option label="Pilih PPN"></option>
                                <option value="Include">Include</option>
                                <option value="Exclude">Exclude</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 mb-2">
                    <x-forms.number wire:model.defer="panjangBarang" :placeholder="'Panjang Barang'"></x-forms.number>
                </div>
                <div class="col-md-6 mb-2">
                    <x-forms.number wire:model.defer="lebarBarang" :placeholder="'Lebar Barang'"></x-forms.number>
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
                                    @this.set('spkLayout', $($el).val())
                                })" name="spkLayout" wire:model.defer="spkLayout"
                                    id="spkLayout" class="select2 form-select form-select-lg" data-allow-clear="true">
                                    <option label="Pilih SPK Layout"></option>
                                    @foreach ($layout as $data)
                                        <option value="{{ $data->spk_number }}">{{ $data->spk_number }} -
                                            {{ $data->order_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('spkLayout')
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
                                    @this.set('spkSample', $($el).val())
                                })" name="spkSample" wire:model.defer="spkSample"
                                    id="spkSample" class="select2 form-select form-select-lg" data-allow-clear="true">
                                    <option label="Pilih SPK Sample"></option>
                                    @foreach ($sample as $data)
                                        <option value="{{ $data->spk_number }}">{{ $data->spk_number }} -
                                            {{ $data->order_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('spkSample')
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
                                    @this.set('spkStock', $($el).val())
                                })" name="spkStock" wire:model.defer="spkStock"
                                    id="spkStock" class="select2 form-select form-select-lg" data-allow-clear="true">
                                    <option label="Pilih SPK Stock"></option>
                                    @foreach ($stock as $data)
                                        <option value="{{ $data->spk_number }}">{{ $data->spk_number }} -
                                            {{ $data->order_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('spkStock')
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
                                            wire:model.defer="langkahKerja.{{ $key }}.description" readonly />
                                        @if ($data['description'] == 'Laminating Doff' || $data['description'] == 'Laminating Gloss')
                                            <select class="form-select" aria-label="Pilih"
                                                wire:model.defer="langkahKerja.{{ $key }}.state_text">
                                                <option label="Pilih"></option>
                                                <option value="Depan">Depan</option>
                                                <option value="Belakang">Belakang</option>
                                                <option value="Depan Belakang">Depan Belakang</option>
                                            </select>
                                        @endif
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
                    <x-forms.filepond wire:model="fileContoh" multiple allowImagePreview imagePreviewMaxHeight="200"
                        allowFileTypeValidation allowFileSizeValidation maxFileSize="1024mb" />
                    @error('fileContoh')
                        <span class="" style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;"
                            role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="File Arsip">File Arsip</label>
                    <x-forms.filepond wire:model="fileArsip" multiple allowImagePreview imagePreviewMaxHeight="200"
                        allowFileTypeValidation allowFileSizeValidation maxFileSize="1024mb" />
                    @error('fileArsip')
                        <span class="" style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;"
                            role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label class="form-label" for="File Accounting">File Accounting</label>
                    <x-forms.filepond wire:model="fileAccounting" multiple allowImagePreview imagePreviewMaxHeight="200"
                        allowFileTypeValidation allowFileSizeValidation maxFileSize="1024mb" />
                    @error('fileAccounting')
                        <span class="" style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;"
                            role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-header header-elements">
                            <span class="me-2">Catatan</span>
                            <div class="card-header-elements ms-auto">
                                <button type="button" class="btn btn-xs btn-primary" wire:click="addCatatan">
                                    <span class="tf-icon ti ti-plus ti-xs me-1"></span>Tambah Catatan
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($catatan as $key => $note)
                                    <div class="col-lg-12 col-md-12">
                                        <label for="exampleFormControlTextarea1" class="form-label">Tujuan</label>
                                        <div class="input-group">
                                            <select
                                                class="form-select @error('catatan.' . $key . '.tujuan') is-invalid @enderror"
                                                aria-label="Pilih Tujuan"
                                                wire:model="catatan.{{ $key }}.tujuan">
                                                <option label="Pilih Tujuan"></option>
                                                @foreach ($workStep as $item)
                                                    <option value="{{ $item->description }}">{{ $item->description }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button class="btn btn-outline-primary" type="button" id="button-addon1"
                                                wire:click="removeCatatan({{ $key }})"><span
                                                    class="tf-icon ti ti-x ti-xs me-1"></span>Delete</button>
                                        </div>
                                        @error('catatan.' . $key . '.tujuan')
                                            <span class=""
                                                style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;"
                                                role="alert">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12 col-md-12 mt-2">
                                        <label for="exampleFormControlTextarea1" class="form-label">Catatan</label>
                                        <div class="input-group">
                                            <textarea class="form-control @error('catatan.' . $key . '.pesan') is-invalid @enderror" rows="3"
                                                placeholder="Catatan" wire:model="catatan.{{ $key }}.pesan"></textarea>
                                        </div>
                                    </div>

                                    @error('catatan.' . $key . '.pesan')
                                        <span class="" style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;"
                                            role="alert">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                    <div class="border-bottom border-bottom-dashed mb-3 mt-3"></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-4">
                <button type="button" class="btn btn-info me-sm-3 me-1" wire:click='sampleRecord'>Download Sample
                    Record</button>
                <button type="submit" class="btn btn-primary me-sm-3 me-1" wire:click='save'>Submit</button>
            </div>
        </div>

    </div>
</div>

@push('scripts')
    <script src="/asset/plugins/livewire-sortable/livewire-sortable.js"></script>
@endpush
