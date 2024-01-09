<div>
    {{-- In work, do what you enjoy. --}}
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Form Hitung Bahan /</span> Create</h4>

    @livewire('components.flash-message')

    <div class="row">
        @forelse ($resultLayoutSetting as $index => $data)
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="card-title header-elements">
                            <h5 class="m-0 me-2">Layout Setting {{ $data['noFormLayoutSetting'] }} - </h5>
                            <div class="card-title-elements">
                                <select id="defaultSelect"
                                    class="form-select @error('resultLayoutSetting.' . $index . '.state') is-invalid @enderror"
                                    name="resultLayoutSetting.{{ $index }}.state"
                                    wire:model.defer='resultLayoutSetting.{{ $index }}.state'>
                                    <option label="Pilih posisi"></option>
                                    <option value="depan/belakang">Depan/Belakang</option>
                                    <option value="depan">Depan</option>
                                    <option value="tengah">Tengah</option>
                                    <option value="belakang">Belakang</option>
                                </select>
                            </div>
                            <div class="card-title-elements ms-auto">
                                <button type="button" class="btn btn-sm btn-primary"><span
                                        class="ti-xs ti ti-trash me-1"></span>Delete Layout Setting</button>
                                <button type="button" class="btn btn-sm btn-info" wire:click="addFormSetting"><span
                                        class="ti-xs ti ti-file-plus me-1"></span>Add Layout Setting</button>
                            </div>
                        </div>

                        {{-- Action canvas --}}
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div class="card shadow-none bg-transparent border border-secondary mb-3">
                                    <div class="card-body">
                                        <h6 class="card-title">Shape</h6>
                                        <button type="button" class="btn btn-sm btn-dark"
                                            onclick="addRectangleSetting({{ $index }})"><span
                                                class="ti-xs ti ti-rectangle me-1"></span>Add Rectangle</button>
                                        <button type="button" class="btn btn-sm btn-primary"
                                            onclick="addTextSetting({{ $index }})"><span
                                                class="ti-xs ti ti-text-size me-1"></span>Add Text</button>
                                        <button type="button" class="btn btn-sm btn-info"
                                            onclick="addLineSetting({{ $index }})"><span
                                                class="ti-xs ti ti-line me-1"></span>Add Line</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card shadow-none bg-transparent border border-secondary mb-3">
                                    <div class="card-body">
                                        <h6 class="card-title">Action</h6>
                                        <button type="button" class="btn btn-sm btn-dark"
                                            onclick="copySetting({{ $index }})"><span
                                                class="ti-xs ti ti-copy me-1"></span>Copy</button>
                                        <button type="button" class="btn btn-sm btn-info"
                                            onclick="pasteSetting({{ $index }})"><span
                                                class="ti-xs ti ti-clipboard me-1"></span>Paste</button>
                                        <button type="button" class="btn btn-sm btn-primary"
                                            onclick="deleteObjectsSetting({{ $index }})"><span
                                                class="ti-xs ti ti-eraser me-1"></span>Delete</button>
                                        <button type="button" class="btn btn-sm btn-warning"
                                            onclick="addCanvasSetting({{ $index }})"
                                            id="btn-canvas-setting-{{ $index }}"><span
                                                class="ti-xs ti ti-square-plus me-1"></span>Create Canvas</button>
                                        <button type="button" class="save-canvas-setting"
                                            onclick="exportCanvasSetting({{ $index }})"
                                            style="display: none;">Export</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- canvas layout setting --}}
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <div id="canvas-wrapper-setting-{{ $index }}" wire:ignore></div>
                            </div>
                        </div>

                        {{-- Action canvas --}}
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <div class="card shadow-none bg-transparent border border-secondary mb-3">
                                    <div class="card-body">
                                        <h6 class="card-title">Form Setting {{ $data['noFormLayoutSetting'] }}</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <x-forms.number
                                                            wire:model.defer="resultLayoutSetting.{{ $index }}.itemsLength"
                                                            :placeholder="'Panjang Barang Jadi (cm)'"></x-forms.number>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <x-forms.number
                                                            wire:model.defer="resultLayoutSetting.{{ $index }}.itemsWidth"
                                                            :placeholder="'Lebar Barang Jadi (cm)'"></x-forms.number>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <x-forms.number
                                                            wire:model.defer="resultLayoutSetting.{{ $index }}.sheetLength"
                                                            :placeholder="'Panjang Lembar Cetak (cm)'"></x-forms.number>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <x-forms.number
                                                            wire:model.defer="resultLayoutSetting.{{ $index }}.sheetWidth"
                                                            :placeholder="'Lebar Lembar Cetak (cm)'"></x-forms.number>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <x-forms.number
                                                            wire:model.defer="resultLayoutSetting.{{ $index }}.colomnItems"
                                                            :placeholder="'Panjang Naik'"></x-forms.number>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <x-forms.number
                                                            wire:model.defer="resultLayoutSetting.{{ $index }}.rowItems"
                                                            :placeholder="'Lebar Naik'"></x-forms.number>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <x-forms.number
                                                            wire:model.defer="resultLayoutSetting.{{ $index }}.gapBetweenLengthItems"
                                                            :placeholder="'Jarak Panjang (cm)'"></x-forms.number>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <x-forms.number
                                                            wire:model.defer="resultLayoutSetting.{{ $index }}.gapBetweenWidthItems"
                                                            :placeholder="'Jarak Lebar (cm)'"></x-forms.number>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <x-forms.number
                                                            wire:model.defer="resultLayoutSetting.{{ $index }}.marginTop"
                                                            :placeholder="'Sisi Atas (cm)'"></x-forms.number>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <x-forms.number
                                                            wire:model.defer="resultLayoutSetting.{{ $index }}.marginBottom"
                                                            :placeholder="'Sisi Bawah (cm)'"></x-forms.number>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <x-forms.number
                                                            wire:model.defer="resultLayoutSetting.{{ $index }}.marginLeft"
                                                            :placeholder="'Sisi Kiri (cm)'"></x-forms.number>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <x-forms.number
                                                            wire:model.defer="resultLayoutSetting.{{ $index }}.marginRight"
                                                            :placeholder="'Sisi Kanan (cm)'"></x-forms.number>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <x-forms.number
                                                            wire:model.defer="resultLayoutSetting.{{ $index }}.gapVertical"
                                                            :placeholder="'Jarak Tambahan Vertical (cm)'"></x-forms.number>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <x-forms.number
                                                            wire:model.defer="resultLayoutSetting.{{ $index }}.gapHorizontal"
                                                            :placeholder="'Jarak Tambahan Horizontal (cm)'"></x-forms.number>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @empty
        @endforelse
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="card-title header-elements">
                        <h5 class="m-0 me-2">Form Keterangan 1</h5>
                        <div class="card-title-elements ms-auto">
                            <button type="button" class="btn btn-sm btn-primary"><span
                                    class="ti-xs ti ti-trash me-1"></span>Delete Keterangan</button>
                            <button type="button" class="btn btn-sm btn-info" wire:click="addFormketerangan"><span
                                    class="ti-xs ti ti-file-plus me-1"></span>Add Keterangan</button>
                        </div>
                    </div>
                    {{-- Action canvas --}}
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <div class="card shadow-none bg-transparent border border-secondary mb-3">
                                <div class="card-body">
                                    <h6 class="card-title">Plate</h6>
                                    <div class="row mb-2">
                                        <div class="col-md-4">
                                            <label class="form-label" for="Status">Status</label>
                                            <div class="form-check custom-option custom-option-basic">
                                                <label class="form-check-label custom-option-content"
                                                    for="customRadioTemp1"
                                                    style="padding: .422rem .875rem; padding-left: 2.77rem;">
                                                    <input name="focCustomerNumber"
                                                        wire:model.live='focCustomerNumber' class="form-check-input"
                                                        type="checkbox" value="1" id="customRadioTemp1" />
                                                    <span class="custom-option-header">
                                                        <span class="h6 mb-0">Baru</span>
                                                    </span>
                                                </label>
                                            </div>
                                            @error('focCustomerNumber')
                                                <span class=""
                                                    style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;"
                                                    role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="Ukuran">Ukuran</label>
                                            <input type="text" class="form-control" wire:model.defer=""
                                                placeholder="Ukuran Plate" />
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="Jumlah">Jumlah</label>
                                            <input type="text" class="form-control" wire:model.defer=""
                                                placeholder="Jumlah Plate" />
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-4">
                                            <label class="form-label" for="Status">Status</label>
                                            <div class="form-check custom-option custom-option-basic">
                                                <label class="form-check-label custom-option-content"
                                                    for="customRadioTemp2"
                                                    style="padding: .422rem .875rem; padding-left: 2.77rem;">
                                                    <input name="focCustomerNumber"
                                                        wire:model.live='focCustomerNumber' class="form-check-input"
                                                        type="checkbox" value="2" id="customRadioTemp2" />
                                                    <span class="custom-option-header">
                                                        <span class="h6 mb-0">Repeat</span>
                                                    </span>
                                                </label>
                                            </div>
                                            @error('focCustomerNumber')
                                                <span class=""
                                                    style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;"
                                                    role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="Ukuran">Ukuran</label>
                                            <input type="text" class="form-control" wire:model.defer=""
                                                placeholder="Ukuran Plate" />
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="Jumlah">Jumlah</label>
                                            <input type="text" class="form-control" wire:model.defer=""
                                                placeholder="Jumlah Plate" />
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <div class="col-md-4">
                                            <label class="form-label" for="Status">Status</label>
                                            <div class="form-check custom-option custom-option-basic">
                                                <label class="form-check-label custom-option-content"
                                                    for="customRadioTemp3"
                                                    style="padding: .422rem .875rem; padding-left: 2.77rem;">
                                                    <input name="focCustomerNumber"
                                                        wire:model.live='focCustomerNumber' class="form-check-input"
                                                        type="checkbox" value="Baru" id="customRadioTemp3" />
                                                    <span class="custom-option-header">
                                                        <span class="h6 mb-0">Sample</span>
                                                    </span>
                                                </label>
                                            </div>
                                            @error('focCustomerNumber')
                                                <span class=""
                                                    style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;"
                                                    role="alert">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="Ukuran">Ukuran</label>
                                            <input type="text" class="form-control" wire:model.defer=""
                                                placeholder="Ukuran Plate" />
                                        </div>
                                        <div class="col-md-4">
                                            <label class="form-label" for="Jumlah">Jumlah</label>
                                            <input type="text" class="form-control" wire:model.defer=""
                                                placeholder="Jumlah Plate" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card shadow-none bg-transparent border border-secondary mb-3">
                                <div class="card-body">
                                    <h6 class="card-title">Pond</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @forelse ($resultLayoutBahan as $index => $data)
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="card-title header-elements">
                            <h5 class="m-0 me-2">Layout Bahan {{ $data['noFormLayoutBahan'] }} - </h5>
                            <div class="card-title-elements">
                                <select id="defaultSelect"
                                    class="form-select @error('resultLayoutBahan.' . $index . '.state') is-invalid @enderror"
                                    name="resultLayoutBahan.{{ $index }}.state"
                                    wire:model.defer='resultLayoutBahan.{{ $index }}.state'>
                                    <option label="Pilih posisi"></option>
                                    <option value="depan/belakang">Depan/Belakang</option>
                                    <option value="depan">Depan</option>
                                    <option value="tengah">Tengah</option>
                                    <option value="belakang">Belakang</option>
                                </select>
                            </div>
                            <div class="card-title-elements ms-auto">
                                <button type="button" class="btn btn-sm btn-primary"><span
                                        class="ti-xs ti ti-trash me-1"></span>Delete Layout Bahan</button>
                                <button type="button" class="btn btn-sm btn-info" wire:click="addFormBahan"><span
                                        class="ti-xs ti ti-file-plus me-1"></span>Add Layout Bahan</button>
                            </div>
                        </div>

                        {{-- Action canvas --}}
                        <div class="row mb-2">
                            <div class="col-md-6">
                                <div class="card shadow-none bg-transparent border border-secondary mb-3">
                                    <div class="card-body">
                                        <h6 class="card-title">Shape</h6>
                                        <button type="button" class="btn btn-sm btn-dark"
                                            onclick="addRectangleBahan({{ $index }})"><span
                                                class="ti-xs ti ti-rectangle me-1"></span>Add Rectangle</button>
                                        <button type="button" class="btn btn-sm btn-primary"
                                            onclick="addTextBahan({{ $index }})"><span
                                                class="ti-xs ti ti-text-size me-1"></span>Add Text</button>
                                        <button type="button" class="btn btn-sm btn-info"
                                            onclick="addLineBahan({{ $index }})"><span
                                                class="ti-xs ti ti-line me-1"></span>Add Line</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card shadow-none bg-transparent border border-secondary mb-3">
                                    <div class="card-body">
                                        <h6 class="card-title">Action</h6>
                                        <button type="button" class="btn btn-sm btn-dark"
                                            onclick="copyBahan({{ $index }})"><span
                                                class="ti-xs ti ti-copy me-1"></span>Copy</button>
                                        <button type="button" class="btn btn-sm btn-info"
                                            onclick="pasteBahan({{ $index }})"><span
                                                class="ti-xs ti ti-clipboard me-1"></span>Paste</button>
                                        <button type="button" class="btn btn-sm btn-primary"
                                            onclick="deleteObjectsBahan({{ $index }})"><span
                                                class="ti-xs ti ti-eraser me-1"></span>Delete</button>
                                        <button type="button" class="btn btn-sm btn-warning"
                                            onclick="addCanvasBahan({{ $index }})"
                                            id="btn-canvas-bahan-{{ $index }}"><span
                                                class="ti-xs ti ti-square-plus me-1"></span>Create Canvas</button>
                                        <button type="button" class="save-canvas-Bahan"
                                            onclick="exportCanvasBahan({{ $index }})"
                                            style="display: none;">Export</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- canvas layout setting --}}
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <div id="canvas-wrapper-bahan-{{ $index }}" wire:ignore></div>
                            </div>
                        </div>

                        {{-- Action canvas --}}
                        <div class="row mb-2">
                            <div class="col-md-12">
                                <div class="card shadow-none bg-transparent border border-secondary mb-3">
                                    <div class="card-body">
                                        <h6 class="card-title">Form Bahan {{ $data['noFormLayoutBahan'] }}</h6>
                                        <div class="row">
                                            <div class="col-md-6 mb-2">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <x-forms.number
                                                            wire:model.defer="resultLayoutBahan.{{ $index }}.planoLength"
                                                            :placeholder="'Panjang Plano (cm)'"></x-forms.number>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <x-forms.number
                                                            wire:model.defer="resultLayoutBahan.{{ $index }}.planoWidth"
                                                            :placeholder="'Lebar Plano (cm)'"></x-forms.number>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                @forelse ($data['sheetSize'] as $key => $item)
                                                    <div class="row mb-2">
                                                        <div class="col-md-6">
                                                            <x-forms.number
                                                                wire:model.defer="resultLayoutBahan.{{ $index }}.sheetSize.{{ $key }}.sheetLength"
                                                                :placeholder="'Panjang Lembar Cetak (cm)'"></x-forms.number>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label" for="Lebar Lembar Cetak">Lebar
                                                                Lembar Cetak</label>
                                                            <div class="input-group">
                                                                <input type="number" class="form-control"
                                                                    name="resultLayoutBahan.{{ $index }}.sheetSize.{{ $key }}.sheetWidth"
                                                                    wire:model.defer="resultLayoutBahan.{{ $index }}.sheetSize.{{ $key }}.sheetWidth"
                                                                    placeholder="Lebar Lembar Cetak (cm)" />
                                                                <button class="btn btn-outline-primary" type="button"
                                                                    wire:click="removeLembarCetak({{ $index }}, {{ $key }})">Delete</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <div class="row mb-2">
                                                        <div class="col-md-6">
                                                            <x-forms.number
                                                                wire:model.defer="resultLayoutBahan.{{ $index }}.sheetSize.0.sheetLength"
                                                                :placeholder="'Panjang Lembar Cetak (cm)'"></x-forms.number>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <x-forms.number
                                                                wire:model.defer="resultLayoutBahan.{{ $index }}.sheetSize.0.sheetWidth"
                                                                :placeholder="'Lebar Lembar Cetak (cm)'"></x-forms.number>
                                                        </div>
                                                    </div>
                                                @endforelse
                                                <button type="button" class="btn btn-sm btn-info"
                                                    wire:click='addLembarCetak({{ $index }})'><span
                                                        class="ti-xs ti ti-plus me-1"></span>Add Lembar Cetak</button>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <x-forms.text
                                                            wire:model.defer="resultLayoutBahan.{{ $index }}.bahanType"
                                                            :placeholder="'Jenis Bahan'"></x-forms.text>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <x-forms.text
                                                            wire:model.defer="resultLayoutBahan.{{ $index }}.gramasi"
                                                            :placeholder="'Gramasi'"></x-forms.text>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <x-forms.number
                                                            wire:model.defer="resultLayoutBahan.{{ $index }}.onePlanoSheet"
                                                            :placeholder="'1 Plano (Lembar Cetak)'"></x-forms.number>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <x-forms.number
                                                            wire:model.defer="resultLayoutBahan.{{ $index }}.onePlanoItems"
                                                            :placeholder="'1 Plano (Total Items)'"></x-forms.number>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="form-label" for="Status Bahan">Status
                                                            Bahan</label>
                                                        <select id="defaultSelect"
                                                            class="form-select @error('resultLayoutBahan.' . $index . '.requestBahan') is-invalid @enderror"
                                                            name="resultLayoutBahan.{{ $index }}.requestBahan"
                                                            wire:model.defer='resultLayoutBahan.{{ $index }}.requestBahan'>
                                                            <option label="Pilih Status Bahan"></option>
                                                            <option value="stock">Stock</option>
                                                            <option value="beli">Beli</option>
                                                            <option value="stock/beli">Stock & Beli</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <x-forms.text
                                                            wire:model.defer="resultLayoutBahan.{{ $index }}.sourceBahan"
                                                            :placeholder="'Sumber Bahan'"></x-forms.text>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <x-forms.text
                                                            wire:model.defer="resultLayoutBahan.{{ $index }}.merkBahan"
                                                            :placeholder="'Merk Bahan'"></x-forms.text>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <x-forms.text
                                                            wire:model.defer="resultLayoutBahan.{{ $index }}.supplier"
                                                            :placeholder="'Supplier'"></x-forms.text>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-2">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <x-forms.number
                                                            wire:model.defer="resultLayoutBahan.{{ $index }}.jumlahSheet"
                                                            :placeholder="'Jumlah Lembar Cetak'"></x-forms.number>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <x-forms.number
                                                            wire:model.defer="resultLayoutBahan.{{ $index }}.jumlahIncit"
                                                            :placeholder="'Jumlah Incit'"></x-forms.number>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <x-forms.number
                                                            wire:model.defer="resultLayoutBahan.{{ $index }}.totalSheet"
                                                            :placeholder="'Total Lembar Cetak'"></x-forms.number>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <x-forms.number
                                                            wire:model.defer="resultLayoutBahan.{{ $index }}.price"
                                                            :placeholder="'Harga Bahan'"></x-forms.number>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <x-forms.number
                                                            wire:model.defer="resultLayoutBahan.{{ $index }}.totalPlano"
                                                            :placeholder="'Jumlah Bahan'"></x-forms.number>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <x-forms.number
                                                            wire:model.defer="resultLayoutBahan.{{ $index }}.wasteLength"
                                                            :placeholder="'Panjang Sisa Bahan'"></x-forms.number>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <x-forms.number
                                                            wire:model.defer="resultLayoutBahan.{{ $index }}.wasteWidth"
                                                            :placeholder="'Lebar Sisa Bahan'"></x-forms.number>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        @empty
        @endforelse
    </div>
    <button type="button" class="btn btn-primary me-sm-3 me-1" wire:click='store' id="submitBtn">Save</button>
</div>

@push('scripts')
    <script src="/assets/plugins/fabricjs/fabric.js"></script>
    <script src="/assets/plugins/fabricjs/centering_guidelines.js"></script>
    <script src="/assets/plugins/fabricjs/aligning_guidelines.js"></script>

    <script>
        var canvasesSetting = {};

        function addCanvasSetting(index) {
            var button = document.getElementById("btn-canvas-setting-" + index);
            button.disabled = true;
            var canvasContainer = document.createElement('div');
            canvasContainer.id = 'canvas-container-setting-' + index;
            canvasContainer.classList.add('border');

            var canvasWrapper = document.getElementById('canvas-wrapper-setting-' + index);
            canvasWrapper.appendChild(canvasContainer);

            // Buat elemen <canvas> baru
            var canvasElement = document.createElement('canvas');
            canvasElement.id = 'canvas-setting-' + index;
            canvasElement.width = canvasWrapper.offsetWidth; // Atur lebar sesuai dengan lebar canvas-wrapper
            canvasElement.height = canvasWrapper.offsetWidth / 1.5; // Atur tinggi sesuai kebutuhan

            // Tambahkan elemen <canvas> ke dalam wrapper
            // canvasWrapper.appendChild(canvasElement);
            canvasContainer.appendChild(canvasElement);

            // Inisialisasi objek canvas menggunakan Fabric.js
            var canvas = new fabric.Canvas('canvas-setting-' + index, {
                snapAngle: 45,
                guidelines: true,
                snapToGrid: 10,
                snapToObjects: true
            });

            // Tambahkan kode logika lainnya di sini, seperti menambahkan objek atau event listener
            var json = @this.resultLayoutSetting[index].dataJSON;
            if (json) {
                canvas.loadFromJSON(json, function() {
                    var firstObject = canvas.getObjects()[0];
                    // Check if the first object exists and its dimensions are within canvas boundaries
                    if (firstObject && firstObject.width * 20 <= canvas.width && firstObject.height * 20 <= canvas
                        .height) {
                        canvas.forEachObject(function(object) {
                            // Scale each object by a factor of 20
                            object.scaleX *= 20;
                            object.scaleY *= 20;
                            object.left *= 20;
                            object.top *= 20;
                            // Add any other scaling adjustments you may need
                        });
                        canvas.renderAll();
                    } else {
                        canvas.forEachObject(function(object) {
                            // Scale each object by a factor of 20
                            object.scaleX *= 10;
                            object.scaleY *= 10;
                            object.left *= 10;
                            object.top *= 10;
                            // Add any other scaling adjustments you may need
                        });
                        canvas.renderAll();
                    }
                });

                canvasesSetting[canvasContainer.id] = canvas;
                initCenteringGuidelines(canvas);
                initAligningGuidelines(canvas);
            } else {
                canvasesSetting[canvasContainer.id] = canvas;
                initCenteringGuidelines(canvas);
                initAligningGuidelines(canvas);
            }
        }

        function addRectangleSetting(index) {
            var currentCanvas = getCurrentCanvasSetting(index);
            var rect = new fabric.Rect({
                left: 50,
                top: 50,
                width: 100,
                height: 100,
                fill: 'transparent',
                stroke: 'black',
                strokeWidth: 2,
                snapAngle: 15,
                snapThreshold: 10,
                snapToGrid: 10,
                noScaleCache: false,
                strokeUniform: true,
            });

            // Menambahkan event listener saat scaling dimulai
            currentCanvas.on("mouse:up", function() {
                var currObj = currentCanvas.getActiveObject();
                if (currObj && currObj.type === 'rect') {
                    var newWidth = currObj.width * currObj.scaleX,
                        newHeight = currObj.height * currObj.scaleY;

                    currObj.set({
                        'width': newWidth,
                        'height': newHeight,
                        scaleX: 1,
                        scaleY: 1
                    });
                    currentCanvas.renderAll();
                }
            });
            currentCanvas.add(rect);
        }

        function addTextSetting(index) {
            var currentCanvas = getCurrentCanvasSetting(index);
            var text = new fabric.IText('Sample Text', {
                left: 50,
                top: 50,
                width: 200,
                fontSize: 20,
                fontFamily: 'Arial',
                fill: 'black',
                snapAngle: 15,
                snapThreshold: 10,
                snapToGrid: 10,
                strokeUniform: true,
                lockUniScaling: true,
            });


            currentCanvas.add(text);
        }

        function addLineSetting(index) {
            var currentCanvas = getCurrentCanvasSetting(index);
            var line = new fabric.Line([200, 50, 200, 200], {
                fill: 'black',
                stroke: 'black',
                strokeWidth: 2,
                snapAngle: 15,
                snapThreshold: 10,
                snapToGrid: 10,
                strokeUniform: true
            });
            currentCanvas.add(line);
        }

        function copySetting(index) {
            var currentCanvas = getCurrentCanvasSetting(index);
            var activeObject = currentCanvas.getActiveObject();
            if (activeObject) {
                activeObject.clone(function(cloned) {
                    currentCanvas.clipboard = cloned;
                });
            }
        }

        function pasteSetting(index) {
            var currentCanvas = getCurrentCanvasSetting(index);
            if (currentCanvas.clipboard) {
                currentCanvas.clipboard.clone(function(clonedObj) {
                    currentCanvas.discardActiveObject();
                    clonedObj.set({
                        left: clonedObj.left + 10,
                        top: clonedObj.top + 10,
                        evented: true,
                    });
                    if (clonedObj.type === 'activeSelection') {
                        clonedObj.canvas = currentCanvas;
                        clonedObj.forEachObject(function(obj) {
                            currentCanvas.add(obj);
                        });
                        clonedObj.setCoords();
                    } else {
                        currentCanvas.add(clonedObj);
                    }
                    currentCanvas.clipboard.top += 100;
                    currentCanvas.clipboard.left += 100;
                    currentCanvas.setActiveObject(clonedObj);
                    currentCanvas.requestRenderAll();
                });
            }
        }

        function deleteObjectsSetting(index) {
            var currentCanvas = getCurrentCanvasSetting(index);
            var activeObject = currentCanvas.getActiveObject();
            if (activeObject) {
                if (activeObject.type === 'activeSelection') {
                    activeObject.forEachObject(function(obj) {
                        currentCanvas.remove(obj);
                    });
                } else {
                    currentCanvas.remove(activeObject);
                }
                currentCanvas.discardActiveObject();
                currentCanvas.requestRenderAll();
            }
        }

        function exportCanvasSetting(index) {
            var currentCanvas = getCurrentCanvasSetting(index);
            if (currentCanvas) {
                var dataURL = currentCanvas.toDataURL();
                var dataJSON = currentCanvas.toJSON();
                delete dataJSON.version;
                var dataJSON = JSON.stringify(dataJSON);
                @this.set('resultLayoutSetting.' + index + '.dataURL', dataURL);
                @this.set('resultLayoutSetting.' + index + '.dataJSON', dataJSON);
            }
        }

        function getCurrentCanvasSetting(index) {
            var currentCanvasId = 'canvas-container-setting-' + index;
            return canvasesSetting[currentCanvasId];
        }
    </script>

    <script>
        var canvasesBahan = {};

        function addCanvasBahan(indexBahan) {
            var buttonBahan = document.getElementById("btn-canvas-bahan-" + indexBahan);
            buttonBahan.disabled = true;
            var canvasContainer = document.createElement('div');
            canvasContainer.id = 'canvas-container-bahan-' + indexBahan;
            canvasContainer.classList.add('border');

            var canvasWrapper = document.getElementById('canvas-wrapper-bahan-' + indexBahan);
            canvasWrapper.appendChild(canvasContainer);

            // Buat elemen <canvas> baru
            var canvasElement = document.createElement('canvas');
            canvasElement.id = 'canvas-bahan-' + indexBahan;
            canvasElement.width = canvasWrapper.offsetWidth; // Atur lebar sesuai dengan lebar canvas-wrapper
            canvasElement.height = canvasWrapper.offsetWidth / 1.5; // Atur tinggi sesuai kebutuhan

            // Tambahkan elemen <canvas> ke dalam wrapper
            // canvasWrapper.appendChild(canvasElement);
            canvasContainer.appendChild(canvasElement);

            // Inisialisasi objek canvas menggunakan Fabric.js
            var canvas = new fabric.Canvas('canvas-bahan-' + indexBahan, {
                snapAngle: 45,
                guidelines: true,
                snapToGrid: 10,
                snapToObjects: true
            });

            var json = @this.resultLayoutBahan[indexBahan].dataJSON;
            if (json) {
                canvas.loadFromJSON(json, function() {
                    var firstObject = canvas.getObjects()[0];
                    // Check if the first object exists and its dimensions are within canvas boundaries
                    if (firstObject && firstObject.width * 20 <= canvas.width && firstObject.height * 20 <= canvas
                        .height) {
                        canvas.forEachObject(function(object) {
                            // Scale each object by a factor of 20
                            object.scaleX *= 20;
                            object.scaleY *= 20;
                            object.left *= 20;
                            object.top *= 20;
                            // Add any other scaling adjustments you may need
                        });
                        canvas.renderAll();
                    } else {
                        canvas.forEachObject(function(object) {
                            // Scale each object by a factor of 20
                            object.scaleX *= 10;
                            object.scaleY *= 10;
                            object.left *= 10;
                            object.top *= 10;
                            // Add any other scaling adjustments you may need
                        });
                        canvas.renderAll();
                    }
                });

                canvasesBahan[canvasContainer.id] = canvas;
                initCenteringGuidelines(canvas);
                initAligningGuidelines(canvas);
            } else {
                canvasesBahan[canvasContainer.id] = canvas;
                initCenteringGuidelines(canvas);
                initAligningGuidelines(canvas);
            }
        }

        function addRectangleBahan(indexBahan) {
            var currentCanvas = getCurrentCanvasBahan(indexBahan);
            var rect = new fabric.Rect({
                left: 50,
                top: 50,
                width: 100,
                height: 100,
                fill: 'transparent',
                stroke: 'black',
                strokeWidth: 2,
                snapAngle: 15,
                snapThreshold: 10,
                snapToGrid: 10,
                strokeUniform: true
            });

            // Menambahkan event listener saat scaling dimulai
            currentCanvas.on("mouse:up", function() {
                var currObj = currentCanvas.getActiveObject();
                if (currObj && currObj.type === 'rect') {
                    var newWidth = currObj.width * currObj.scaleX,
                        newHeight = currObj.height * currObj.scaleY;

                    currObj.set({
                        'width': newWidth,
                        'height': newHeight,
                        scaleX: 1,
                        scaleY: 1
                    });
                    currentCanvas.renderAll();
                }
            });

            currentCanvas.add(rect);
        }

        function addTextBahan(indexBahan) {
            var currentCanvas = getCurrentCanvasBahan(indexBahan);
            var text = new fabric.IText('Sample Text', {
                left: 50,
                top: 50,
                width: 200,
                fontSize: 20,
                fontFamily: 'Arial',
                fill: 'black',
                snapAngle: 15,
                snapThreshold: 10,
                snapToGrid: 10,
                strokeUniform: true,
                lockUniScaling: true,
            });
            currentCanvas.add(text);
        }

        function addLineBahan(indexBahan) {
            var currentCanvas = getCurrentCanvasBahan(indexBahan);
            var line = new fabric.Line([50, 50, 200, 200], {
                fill: 'black',
                stroke: 'black',
                strokeWidth: 2,
                snapAngle: 15,
                snapThreshold: 10,
                snapToGrid: 10,
                strokeUniform: true
            });
            currentCanvas.add(line);
        }

        function copyBahan(indexBahan) {
            var currentCanvas = getCurrentCanvasBahan(indexBahan);
            var activeObject = currentCanvas.getActiveObject();
            if (activeObject) {
                activeObject.clone(function(cloned) {
                    currentCanvas.clipboard = cloned;
                });
            }
        }

        function pasteBahan(indexBahan) {
            var currentCanvas = getCurrentCanvasBahan(indexBahan);
            if (currentCanvas.clipboard) {
                currentCanvas.clipboard.clone(function(clonedObj) {
                    currentCanvas.discardActiveObject();
                    clonedObj.set({
                        left: clonedObj.left + 10,
                        top: clonedObj.top + 10,
                        evented: true,
                    });
                    if (clonedObj.type === 'activeSelection') {
                        clonedObj.canvas = currentCanvas;
                        clonedObj.forEachObject(function(obj) {
                            currentCanvas.add(obj);
                        });
                        clonedObj.setCoords();
                    } else {
                        currentCanvas.add(clonedObj);
                    }
                    currentCanvas.clipboard.top += 100;
                    currentCanvas.clipboard.left += 100;
                    currentCanvas.setActiveObject(clonedObj);
                    currentCanvas.requestRenderAll();
                });
            }
        }

        function deleteObjectsBahan(indexBahan) {
            var currentCanvas = getCurrentCanvasBahan(indexBahan);
            var activeObject = currentCanvas.getActiveObject();
            if (activeObject) {
                if (activeObject.type === 'activeSelection') {
                    activeObject.forEachObject(function(obj) {
                        currentCanvas.remove(obj);
                    });
                } else {
                    currentCanvas.remove(activeObject);
                }
                currentCanvas.discardActiveObject();
                currentCanvas.requestRenderAll();
            }
        }

        function exportCanvasBahan(indexBahan) {
            var currentCanvas = getCurrentCanvasBahan(indexBahan);
            if (currentCanvas) {
                var dataURL = currentCanvas.toDataURL();
                var dataJSON = currentCanvas.toJSON();
                delete dataJSON.version;
                var dataJSON = JSON.stringify(dataJSON);
                @this.set('layoutBahans.' + indexBahan + '.dataURL', dataURL);
                @this.set('layoutBahans.' + indexBahan + '.dataJSON', dataJSON);
            }
        }

        function getCurrentCanvasBahan(indexBahan) {
            var currentCanvasId = 'canvas-container-bahan-' + indexBahan;
            return canvasesBahan[currentCanvasId];
        }
    </script>

    <script>
        document.getElementById("submitBtn").addEventListener("click", function(event) {
            var allCanvasButtons = document.querySelectorAll(".save-canvas-setting");
            allCanvasButtons.forEach(function(button) {
                button.click();
            });

            var allCanvasButtonsBahan = document.querySelectorAll(".save-canvas-bahan");
            allCanvasButtonsBahan.forEach(function(button) {
                button.click();
            });
        });
    </script>
@endpush
