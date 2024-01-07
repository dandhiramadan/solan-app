<div>
    {{-- Close your eyes. Count to one. That is how long forever feels. --}}
    <div class="card mb-4">
        <h5 class="card-header">Form New SPK</h5>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-2">
                    <x-forms.number wire:model.live="quantityItems" :placeholder="'Quantity'"></x-forms.number>
                </div>
                <div class="col-md-6 mb-2">
                    <div wire:ignore>
                        <label class="form-label" for="Machine">Machine</label>
                        <select x-init="$($el).select2({
                            placeholder: 'Pilih Machine',
                            allowClear: true,
                            width: '100%',
                        });
                        $($el).on('change', function() {
                            $wire.set('machineSelected', $($el).val())
                        });
                        $($el).val($($el).val());
                        $($el).trigger('change');" name="machineSelected" wire:model.live="machineSelected"
                            id="machineSelected" class="select2 form-select form-select-lg" data-allow-clear="true">
                            <option label="Pilih Machine"></option>
                            @foreach ($machine as $data)
                                <option value="{{ $data->id }}">{{ $data->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('machineSelected')
                        <span class="" style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;"
                            role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-4 mb-2">
                    <x-forms.number wire:model.live="planoLength" :placeholder="'Panjang Bahan'"></x-forms.number>
                </div>
                <div class="col-md-4 mb-2">
                    <x-forms.number wire:model.live="planoWidth" :placeholder="'Lebar Bahan'"></x-forms.number>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="row">
                        <label class="form-label" for="Orientation Layout Bahan">Orientation Layout Bahan</label>
                        <div class="col-md mb-md-0 mb-2">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="orientationPlano1">
                                    <input name="orientationPlano" class="form-check-input" type="radio" value="Y"
                                        id="orientationPlano1" wire:model.live="orientationPlano" />
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Ya</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="orientationPlano2">
                                    <input name="orientationPlano" class="form-check-input" type="radio" value="N"
                                        id="orientationPlano2" wire:model.live="orientationPlano" />
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Tidak</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        @error('orientationPlano')
                            <span class="" style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;"
                                role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                {{-- <div class="col-md-4 mb-2">
                    <div wire:ignore>
                        <label class="form-label" for="Orientation Layout Bahan">Orientation Layout Bahan</label>
                        <select x-init="$($el).select2({
                            placeholder: 'Pilih Orientation Layout Bahan',
                            allowClear: true,
                            width: '100%',
                        });
                        $($el).on('change', function() {
                            $wire.set('orientationPlano', $($el).val())
                        });
                        $($el).val($($el).val());
                        $($el).trigger('change');" name="orientationPlano" wire:model.live="orientationPlano"
                            id="orientationPlano" class="select2 form-select form-select-lg" data-allow-clear="true">
                            <option label="Pilih Orientation Layout Bahan"></option>
                            <option value="landscape">Landscape</option>
                            <option value="potrait">Potrait</option>
                            <option value="auto rotate">Auto Rotate</option>
                        </select>
                    </div>
                    @error('orientationPlano')
                        <span class="" style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;"
                            role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div> --}}
                <div class="col-md-4 mb-2">
                    <x-forms.number wire:model.live="itemsLength" :placeholder="'Panjang Barang Jadi'"></x-forms.number>
                </div>
                <div class="col-md-4 mb-2">
                    <x-forms.number wire:model.live="itemsWidth" :placeholder="'Lebar Barang Jadi'"></x-forms.number>
                </div>
                <div class="col-md-4 mb-2">
                    <div wire:ignore>
                        <label class="form-label" for="Orientation Layout Setting">Orientation Layout Setting</label>
                        <select x-init="$($el).select2({
                            placeholder: 'Pilih Orientation Layout Setting',
                            allowClear: true,
                            width: '100%',
                        });
                        $($el).on('change', function() {
                            $wire.set('orientationSetting', $($el).val())
                        });
                        $($el).val($($el).val());
                        $($el).trigger('change');" name="orientationSetting" wire:model.live="orientationSetting"
                            id="orientationSetting" class="select2 form-select form-select-lg" data-allow-clear="true">
                            <option label="Pilih Orientation Layout Setting"></option>
                            <option value="landscape">Landscape</option>
                            <option value="potrait">Potrait</option>
                            <option value="auto rotate">Auto Rotate</option>
                        </select>
                    </div>
                    @error('orientationSetting')
                        <span class="" style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;"
                            role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="col-md-4 mb-2">
                    <div class="row">
                        <label class="form-label" for="Pond">Pond</label>
                        <div class="col-md mb-md-0 mb-2">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="pondSelected1">
                                    <input name="pondSelected" class="form-check-input" type="radio" value="Y"
                                        id="pondSelected1" wire:model.live="pondSelected" />
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Ya</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="pondSelected2">
                                    <input name="pondSelected" class="form-check-input" type="radio" value="N"
                                        id="pondSelected2" wire:model.live="pondSelected" />
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Tidak</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        @error('pondSelected')
                            <span class="" style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;"
                                role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="row">
                        <label class="form-label" for="Potong Jadi">Potong Jadi</label>
                        <div class="col-md mb-md-0 mb-2">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="potongJadiSelected1">
                                    <input name="potongJadiSelected" class="form-check-input" type="radio"
                                        value="Y" id="potongJadiSelected1"
                                        wire:model.live="potongJadiSelected" />
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Ya</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="potongJadiSelected2">
                                    <input name="potongJadiSelected" class="form-check-input" type="radio"
                                        value="N" id="potongJadiSelected2"
                                        wire:model.live="potongJadiSelected" />
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Tidak</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        @error('potongJadiSelected')
                            <span class="" style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;"
                                role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-4 mb-2">
                    <div class="row">
                        <label class="form-label" for="Jarak Potong Jadi">Jarak Potong Jadi</label>
                        <div class="col-md mb-md-0 mb-2">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="jarakPotongJadiSelected1">
                                    <input name="jarakPotongJadiSelected" class="form-check-input" type="radio"
                                        value="Y" id="jarakPotongJadiSelected1"
                                        wire:model.live="jarakPotongJadiSelected" />
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Ya</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-md">
                            <div class="form-check custom-option custom-option-basic">
                                <label class="form-check-label custom-option-content" for="jarakPotongJadiSelected2">
                                    <input name="jarakPotongJadiSelected" class="form-check-input" type="radio"
                                        value="N" id="jarakPotongJadiSelected2"
                                        wire:model.live="jarakPotongJadiSelected" />
                                    <span class="custom-option-header">
                                        <span class="h6 mb-0">Tidak</span>
                                    </span>
                                </label>
                            </div>
                        </div>
                        @error('jarakPotongJadiSelected')
                            <span class="" style="margin-top: 0.25rem; font-size:0.8125rem; color: #ea5455;"
                                role="alert">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="button" class="btn btn-info me-sm-3 me-1" wire:click='calculate'>Calculate</button>
        </div>
    </div>

    {{-- layout setting
    <div class="card mb-4">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>panjang</th>
                        <th>lebar</th>
                        <th>panjang naik</th>
                        <th>lebar naik</th>
                        <th>panjang lc</th>
                        <th>lebar lc</th>
                        <th>orientation</th>
                        <th>orientation Plano</th>
                        <th>Sheet Length Plano</th>
                        <th>Sheet Width Plano</th>
                        <th>Colomn Sheet</th>
                        <th>Row Sheet</th>
                        <th>Total Items On Plano</th>
                        <th>Waste Length Plano</th>
                        <th>Waste Width Plano</th>
                        <th>Sheet Other Length</th>
                        <th>Sheet Other Width</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @forelse ($resultSheetLandscapeItems as $data)
                    <tr>
                        <td>{{ $data['itemsLength'] }}</td>
                        <td>{{ $data['itemsWidth'] }}</td>
                        <td>{{ $data['colomnItems'] }}</td>
                        <td>{{ $data['rowItems'] }}</td>
                        <td>{{ $data['sheetLength'] }}</td>
                        <td>{{ $data['sheetWidth'] }}</td>
                        <td>{{ $data['orientationItemsOnSheet'] }}</td>
                        <td>{{ $data['orientationItemsOnPlano'] }}</td>
                        <td>{{ $data['sheetLengthOnPlano'] }}</td>
                        <td>{{ $data['sheetWidthOnPlano'] }}</td>
                        <td>{{ $data['colomnSheet'] }}</td>
                        <td>{{ $data['rowSheet'] }}</td>
                        <td>{{ $data['totalItemsOnPlano'] }}</td>
                        <td>{{ $data['wastePlanoLength'] }}</td>
                        <td>{{ $data['wastePlanoWidth'] }}</td>
                        <td>{{ $data['sheetLengthWasteWidth'] }}</td>
                        <td>{{ $data['sheetWidthWasteWidth'] }}</td>
                    </tr>
                    @empty

                    @endforelse
                </tbody>
            </table>
        </div>
    </div> --}}

    <div class="row mb-3">
        <div class="col-md-8">
            <div class="fabric-canvas-wrapper-setting" style="border: 1px black;">
                @if ($showPreviewSetting)
                    <h5 class="card-header mb-3">Layout Setting 1</h5>
                    <img src="{{ asset(Storage::url($folderTmpSetting . '/' . $fileNameSetting)) }}">
                @endif
                <canvas id="canvasSetting"></canvas>
            </div>
        </div>
        <div class="col-md-4">
            @if ($showPreviewSetting)
                <div class="card">
                    <h5 class="card-header">Details Layout Setting 1</h5>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-2">
                                <label for="Panjang Lembar Cetak" class="form-label">Panjang Lembar Cetak</label>
                                <input class="form-control" type="text" wire:model.defer="detailResultSetting.sheetLength" readonly />
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="Lebar Lembar" class="form-label">Lebar Lembar</label>
                                <input class="form-control" type="text" wire:model.defer="detailResultSetting.sheetWidth" readonly />
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="Panjang Barang Jadi" class="form-label">Panjang Barang Jadi</label>
                                <input class="form-control" type="text" wire:model.defer="detailResultSetting.itemsLength" readonly />
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="Lebar Barang Jadi" class="form-label">Lebar Barang Jadi</label>
                                <input class="form-control" type="text" wire:model.defer="detailResultSetting.itemsWidth" readonly />
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="Panjang Naik" class="form-label">Panjang Naik</label>
                                <input class="form-control" type="text" wire:model.defer="detailResultSetting.col" readonly />
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="Lebar Naik" class="form-label">Lebar Naik</label>
                                <input class="form-control" type="text" wire:model.defer="detailResultSetting.row" readonly />
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="Jarak Atas" class="form-label">Jarak Atas</label>
                                <input class="form-control" type="text" wire:model.defer="detailResultSetting.sheetMarginTop" readonly />
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="Jarak Bawah" class="form-label">Jarak Bawah</label>
                                <input class="form-control" type="text" wire:model.defer="detailResultSetting.sheetMarginBottom" readonly />
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="Jarak Kiri" class="form-label">Jarak Kiri</label>
                                <input class="form-control" type="text" wire:model.defer="detailResultSetting.sheetMarginLeft" readonly />
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="Jarak Kanan" class="form-label">Jarak Kanan</label>
                                <input class="form-control" type="text" wire:model.defer="detailResultSetting.sheetMarginRight" readonly />
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="Jarak Antar Barang" class="form-label">Jarak Antar Barang</label>
                                <input class="form-control" type="text" wire:model.defer="detailResultSetting.gapBetweenItems" readonly />
                            </div>
                            <div class="col-md-6 mb-2">
                                <label for="1 Lembar Cetak" class="form-label">1 Lembar Cetak (Barang Jadi)</label>
                                <input class="form-control" type="text" wire:model.defer="detailResultSetting.itemsPerSheet" readonly />
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <div class="col-md-8">
            <div class="fabric-canvas-wrapper-setting-other-size" style="border: 1px black;">
                @if ($showPreviewSettingOtherSize)
                    <h5 class="card-header">Layout Setting 2</h5>
                    <img src="{{ asset(Storage::url($folderTmpSettingOtherSize . '/' . $fileNameSettingOtherSize)) }}">
                @endif
                <canvas id="canvasSettingOtherSize"></canvas>
            </div>
        </div>
        <div class="col-md-8">
            <div class="fabric-canvas-wrapper-bahan">
                @if ($showPreviewBahan)
                    <h5 class="card-header">Layout Bahan</h5>
                    <img src="{{ asset(Storage::url($folderTmpBahan . '/' . $fileNameBahan)) }}">
                @endif
                <canvas id="canvasBahan"></canvas>
            </div>
        </div>
    </div>

</div>

@push('scripts')
    <script src="/assets/plugins/fabricjs/fabric.js"></script>
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('createLayoutSetting', (data) => {
                let itemsLength = data[0].itemsLength;
                let itemsWidth = data[0].itemsWidth;
                let colomnItems = data[0].colomnItems;
                let rowItems = data[0].rowItems;
                let sheetLength = data[0].sheetLength;
                let sheetWidth = data[0].sheetWidth;
                let gapBetweenItems = data[0].gapBetweenItems;
                let sheetMarginTop = data[0].sheetMarginTop;
                let sheetMarginBottom = data[0].sheetMarginBottom;
                let sheetMarginLeft = data[0].sheetMarginLeft;
                let sheetMarginRight = data[0].sheetMarginRight;
                let gapBetweenLengthItems = data[0].gapBetweenLengthItems;
                let gapBetweenWidthItems = data[0].gapBetweenWidthItems;

                let titlePanjangLembarCetak;
                let titleLebarLembarCetak;

                if (sheetLength > sheetWidth) {
                    titlePanjangLembarCetak = "Panjang Lembar Cetak = ";
                    titleLebarLembarCetak = "Lebar Lembar Cetak = ";
                } else {
                    titlePanjangLembarCetak = "Panjang Lembar Cetak = ";
                    titleLebarLembarCetak = "Lebar Lembar Cetak = ";
                }

                function resizeCanvas() {
                    const outerCanvasContainer = $('.fabric-canvas-wrapper-setting')[0];
                    const ratio = canvas.getWidth() / canvas.getHeight();
                    const containerWidth = outerCanvasContainer.clientWidth;
                    const containerHeight = outerCanvasContainer.clientHeight;

                    const scale = containerWidth / canvas.getWidth();
                    const zoom = canvas.getZoom() * scale;
                    canvas.setDimensions({
                        width: containerWidth,
                        height: containerWidth / ratio
                    });
                    canvas.setViewportTransform([zoom, 0, 0, zoom, 0, 0]);
                }

                $(window).resize(resizeCanvas);

                var canvas = new fabric.Canvas('canvasSetting');
                let canvasWidth = sheetLength + 2;
                let canvasHeight = sheetWidth + 2;

                canvas.setWidth(canvasWidth);
                canvas.setHeight(canvasHeight);
                canvas.clear();

                var rectangle = new fabric.Rect({
                    top: 1,
                    left: 0,
                    width: sheetLength,
                    height: sheetWidth,
                    fill: 'transparent',
                    stroke: 'blue',
                    strokeWidth: 0.1,
                    strokeUniform: true
                });

                canvas.add(rectangle);

                var textSheetLength = new fabric.IText((titlePanjangLembarCetak) + (sheetLength) + ' cm', {
                    fontFamily: 'Arial',
                    fontSize: 0.5,
                    left: 0,
                    top: -0.2,
                });

                canvas.add(textSheetLength);

                var textSheetWidth = new fabric.IText((titleLebarLembarCetak) + (sheetWidth) + ' cm', {
                    fontFamily: 'Arial',
                    fontSize: 0.5,
                    left: sheetLength + 1.5,
                    top: 0.2,
                    angle: 90,
                });

                canvas.add(textSheetWidth);

                // Loop untuk baris
                for (let i = 0; i < rowItems; i++) {
                    // Loop untuk kolom
                    for (let j = 0; j < colomnItems; j++) {
                        // Hitung posisi kiri dan atas untuk setiap persegi panjang
                        var leftPos = j * (itemsLength + gapBetweenLengthItems) + sheetMarginLeft;
                        var topPos = i * (itemsWidth + gapBetweenWidthItems) + sheetMarginTop + 1;

                        // Buat objek persegi panjang
                        var rectangle = new fabric.Rect({
                            top: topPos,
                            left: leftPos,
                            width: itemsLength,
                            height: itemsWidth,
                            fill: 'transparent',
                            stroke: 'red',
                            strokeWidth: 0.1,
                            strokeUniform: true
                        });

                        // Tambahkan objek persegi panjang ke dalam canvas
                        canvas.add(rectangle);

                        // Hitung posisi teks untuk menempatkannya di tengah kotak
                        var textLeftPos = leftPos + itemsLength / 2;
                        var textTopPos = topPos + itemsWidth / 2;

                        // Tambahkan teks panjang ke dalam canvas
                        var textLength = new fabric.IText(itemsLength + ' cm', {
                            fontFamily: 'Arial',
                            fontSize: 0.5,
                            left: leftPos,
                            top: topPos,
                            textAlign: 'center',
                        });

                        canvas.add(textLength);

                        // Tambahkan teks lebar ke dalam canvas
                        var textWidth = new fabric.IText(itemsWidth + ' cm', {
                            fontFamily: 'Arial',
                            fontSize: 0.5,
                            left: leftPos,
                            top: topPos + itemsWidth,
                            angle: -90,
                            textAlign: 'center',
                        });

                        canvas.add(textWidth);
                    }
                }

                resizeCanvas();

                function saveCanvasSetting() {
                    var dataURL = canvas.toDataURL('image/png');
                    var dataJSON = canvas.toJSON();
                    delete dataJSON.version;
                    var dataJSON = JSON.stringify(dataJSON);

                    // Display the image
                    @this.setLayoutSettingDataUrl(dataURL);
                    @this.setLayoutSettingDataJson(dataJSON);
                }

                saveCanvasSetting();
            });

            Livewire.on('createLayoutBahan', (data) => {
                let colomnSheet = data[0].colomnSheet;
                let rowSheet = data[0].rowSheet;
                let sheetLength = data[0].sheetLengthOnPlano;
                let sheetWidth = data[0].sheetWidthOnPlano;
                let planoLength = data[0].planoLength;
                let planoWidth = data[0].planoWidth;

                let colomnSheetWasteWidth = data[0].colomnSheetWasteWidth;
                let rowSheetWasteWidth = data[0].rowSheetWasteWidth;
                let sheetLengthWasteWidth = data[0].sheetLengthWasteWidth;
                let sheetWidthWasteWidth = data[0].sheetWidthWasteWidth;

                function resizeCanvas() {
                    const outerCanvasContainer = $('.fabric-canvas-wrapper-bahan')[0];
                    const ratio = canvas.getWidth() / canvas.getHeight();
                    const containerWidth = outerCanvasContainer.clientWidth;
                    const containerHeight = outerCanvasContainer.clientHeight;

                    const scale = containerWidth / canvas.getWidth();
                    const zoom = canvas.getZoom() * scale;
                    canvas.setDimensions({
                        width: containerWidth,
                        height: containerWidth / ratio
                    });
                    canvas.setViewportTransform([zoom, 0, 0, zoom, 0, 0]);
                }

                $(window).resize(resizeCanvas);

                var canvas = new fabric.Canvas('canvasBahan');
                let canvasWidth = planoLength + 2.5;
                let canvasHeight = planoWidth + 2.5;
                canvas.clear();

                canvas.setWidth(canvasWidth);
                canvas.setHeight(canvasHeight);

                // Buat objek persegi panjang sesuai dengan data yang diterima
                var rectangle = new fabric.Rect({
                    top: 2,
                    left: 0,
                    width: planoLength,
                    height: planoWidth,
                    fill: 'transparent',
                    stroke: 'green',
                    strokeWidth: 0.1,
                    strokeUniform: true
                });

                canvas.add(rectangle);

                var textPlanoLength = new fabric.IText('Panjang Bahan = ' + (planoLength) + ' cm', {
                    fontFamily: 'Arial',
                    fontSize: 1,
                    left: 0, // Posisi horizontal di tengah
                    top: -0.2, // Posisi vertikal di tengah
                });

                canvas.add(textPlanoLength);

                var textPlanoWidth = new fabric.IText('Lebar Bahan = ' + (planoWidth) + ' cm', {
                    fontFamily: 'Arial',
                    fontSize: 1,
                    left: planoLength + 2, // Posisi horizontal di tengah
                    top: 0.2, // Posisi vertikal di tengah
                    angle: 90,
                });

                canvas.add(textPlanoWidth);

                // Loop untuk baris
                for (let i = 0; i < rowSheet; i++) {
                    // Loop untuk kolom
                    for (let j = 0; j < colomnSheet; j++) {
                        // Hitung posisi kiri dan atas untuk setiap persegi panjang
                        var leftPos = j * sheetLength;
                        var topPos = i * sheetWidth + 2;

                        // Buat objek persegi panjang
                        var rectangle = new fabric.Rect({
                            top: topPos,
                            left: leftPos,
                            width: sheetLength,
                            height: sheetWidth,
                            fill: 'transparent',
                            stroke: 'blue',
                            strokeWidth: 0.1,
                            strokeUniform: true
                        });

                        // Tambahkan objek persegi panjang ke dalam canvas
                        canvas.add(rectangle);

                        // Hitung posisi teks untuk menempatkannya di tengah kotak
                        var textLeftPos = leftPos + sheetLength / 2;
                        var textTopPos = topPos + sheetWidth / 2;

                        // Tambahkan teks panjang ke dalam canvas
                        var textLength = new fabric.IText(sheetLength + ' cm', {
                            fontFamily: 'Arial',
                            fontSize: 1,
                            left: leftPos,
                            top: topPos,
                            textAlign: 'center',
                        });

                        canvas.add(textLength);

                        // Tambahkan teks lebar ke dalam canvas
                        var textWidth = new fabric.IText(sheetWidth + ' cm', {
                            fontFamily: 'Arial',
                            fontSize: 1,
                            left: leftPos,
                            top: topPos + sheetWidth,
                            angle: -90,
                            textAlign: 'center',
                        });

                        canvas.add(textWidth);
                    }
                }

                // Loop untuk baris waste width plano
                for (let i = 0; i < rowSheetWasteWidth; i++) {
                    // Loop untuk kolom
                    for (let j = 0; j < colomnSheetWasteWidth; j++) {
                        // Hitung posisi kiri dan atas untuk setiap persegi panjang
                        var leftPos = j * sheetLengthWasteWidth;
                        var topPos = (i * sheetWidthWasteWidth) + (rowSheet * sheetWidth) + 2;

                        // Buat objek persegi panjang
                        var rectangle = new fabric.Rect({
                            top: topPos,
                            left: leftPos,
                            width: sheetLengthWasteWidth,
                            height: sheetWidthWasteWidth,
                            fill: 'transparent',
                            stroke: 'blue',
                            strokeWidth: 0.1,
                            strokeUniform: true
                        });

                        // Tambahkan objek persegi panjang ke dalam canvas
                        canvas.add(rectangle);

                        // Hitung posisi teks untuk menempatkannya di tengah kotak
                        var textLeftPos = leftPos + sheetLengthWasteWidth / 2;
                        var textTopPos = topPos + sheetWidthWasteWidth / 2;

                        // Tambahkan teks panjang ke dalam canvas
                        var textLength = new fabric.IText(sheetLengthWasteWidth + ' cm', {
                            fontFamily: 'Arial',
                            fontSize: 1,
                            left: leftPos,
                            top: topPos,
                            textAlign: 'center',
                        });

                        canvas.add(textLength);

                        // Tambahkan teks lebar ke dalam canvas
                        var textWidth = new fabric.IText(sheetWidthWasteWidth + ' cm', {
                            fontFamily: 'Arial',
                            fontSize: 1,
                            left: leftPos,
                            top: topPos + sheetWidthWasteWidth,
                            angle: -90,
                            textAlign: 'center',
                        });

                        canvas.add(textWidth);
                    }
                }

                resizeCanvas();

                function saveCanvasBahan() {
                    var dataURL = canvas.toDataURL('image/png');
                    var dataJSON = canvas.toJSON();
                    delete dataJSON.version;
                    var dataJSON = JSON.stringify(dataJSON);

                    // Display the image
                    @this.setLayoutBahanDataUrl(dataURL);
                    @this.setLayoutBahanDataJson(dataJSON);
                }

                saveCanvasBahan();
            });

            Livewire.on('createLayoutSettingOtherSize', (data) => {
                let itemsLengthWasteWidth = data[0].itemsLengthWasteWidth;
                let itemsWidthWasteWidth = data[0].itemsWidthWasteWidth;
                let colomnItemsWasteWidth = data[0].colomnItemsWasteWidth;
                let rowItemsWasteWidth = data[0].rowItemsWasteWidth;
                let sheetLengthWasteWidth = data[0].sheetLengthWasteWidth;
                let sheetWidthWasteWidth = data[0].sheetWidthWasteWidth;
                let gapBetweenItems = data[0].gapBetweenItems;
                let sheetMarginTop = data[0].sheetMarginTop;
                let sheetMarginBottom = data[0].sheetMarginBottom;
                let sheetMarginLeft = data[0].sheetMarginLeft;
                let sheetMarginRight = data[0].sheetMarginRight;
                let gapBetweenLengthItems = data[0].gapBetweenLengthItems;
                let gapBetweenWidthItems = data[0].gapBetweenWidthItems;

                let titlePanjangLembarCetak;
                let titleLebarLembarCetak;

                if (sheetLengthWasteWidth > sheetWidthWasteWidth) {
                    titlePanjangLembarCetak = "Panjang Lembar Cetak = ";
                    titleLebarLembarCetak = "Lebar Lembar Cetak = ";
                } else {
                    titlePanjangLembarCetak = "Panjang Lembar Cetak = ";
                    titleLebarLembarCetak = "Lebar Lembar Cetak = ";
                }

                function resizeCanvas() {
                    const outerCanvasContainer = $('.fabric-canvas-wrapper-setting-other-size')[0];
                    const ratio = canvas.getWidth() / canvas.getHeight();
                    const containerWidth = outerCanvasContainer.clientWidth;
                    const containerHeight = outerCanvasContainer.clientHeight;

                    const scale = containerWidth / canvas.getWidth();
                    const zoom = canvas.getZoom() * scale;
                    canvas.setDimensions({
                        width: containerWidth,
                        height: containerWidth / ratio
                    });
                    canvas.setViewportTransform([zoom, 0, 0, zoom, 0, 0]);
                }

                $(window).resize(resizeCanvas);

                var canvas = new fabric.Canvas('canvasSettingOtherSize');
                let canvasWidth = sheetLengthWasteWidth + 2;
                let canvasHeight = sheetWidthWasteWidth + 2;

                canvas.setWidth(canvasWidth);
                canvas.setHeight(canvasHeight);
                canvas.clear();

                var rectangle = new fabric.Rect({
                    top: 1,
                    left: 0,
                    width: sheetLengthWasteWidth,
                    height: sheetWidthWasteWidth,
                    fill: 'transparent',
                    stroke: 'blue',
                    strokeWidth: 0.1,
                    strokeUniform: true
                });

                canvas.add(rectangle);

                var textsheetLengthWasteWidth = new fabric.IText((titlePanjangLembarCetak) + (sheetLengthWasteWidth) + ' cm', {
                    fontFamily: 'Arial',
                    fontSize: 0.5,
                    left: 0,
                    top: -0.2,
                });

                canvas.add(textsheetLengthWasteWidth);

                var textsheetWidthWasteWidth = new fabric.IText((titleLebarLembarCetak) + (sheetWidthWasteWidth) + ' cm', {
                    fontFamily: 'Arial',
                    fontSize: 0.5,
                    left: sheetLengthWasteWidth + 1.5,
                    top: 0.2,
                    angle: 90,
                });

                canvas.add(textsheetWidthWasteWidth);

                // Loop untuk baris
                for (let i = 0; i < rowItemsWasteWidth; i++) {
                    // Loop untuk kolom
                    for (let j = 0; j < colomnItemsWasteWidth; j++) {
                        // Hitung posisi kiri dan atas untuk setiap persegi panjang
                        var leftPos = j * (itemsLengthWasteWidth + gapBetweenLengthItems) + sheetMarginLeft;
                        var topPos = i * (itemsWidthWasteWidth + gapBetweenWidthItems) + sheetMarginTop + 1;

                        // Buat objek persegi panjang
                        var rectangle = new fabric.Rect({
                            top: topPos,
                            left: leftPos,
                            width: itemsLengthWasteWidth,
                            height: itemsWidthWasteWidth,
                            fill: 'transparent',
                            stroke: 'red',
                            strokeWidth: 0.1,
                            strokeUniform: true
                        });

                        // Tambahkan objek persegi panjang ke dalam canvas
                        canvas.add(rectangle);

                        // Hitung posisi teks untuk menempatkannya di tengah kotak
                        var textLeftPos = leftPos + itemsLengthWasteWidth / 2;
                        var textTopPos = topPos + itemsWidthWasteWidth / 2;

                        // Tambahkan teks panjang ke dalam canvas
                        var textLength = new fabric.IText(itemsLengthWasteWidth + ' cm', {
                            fontFamily: 'Arial',
                            fontSize: 0.5,
                            left: leftPos,
                            top: topPos,
                            textAlign: 'center',
                        });

                        canvas.add(textLength);

                        // Tambahkan teks lebar ke dalam canvas
                        var textWidth = new fabric.IText(itemsWidthWasteWidth + ' cm', {
                            fontFamily: 'Arial',
                            fontSize: 0.5,
                            left: leftPos,
                            top: topPos + itemsWidthWasteWidth,
                            angle: -90,
                            textAlign: 'center',
                        });

                        canvas.add(textWidth);
                    }
                }

                resizeCanvas();

                function saveCanvasSetting() {
                    var dataURL = canvas.toDataURL('image/png');
                    var dataJSON = canvas.toJSON();
                    delete dataJSON.version;
                    var dataJSON = JSON.stringify(dataJSON);

                    // Display the image
                    @this.setLayoutSettingDataUrlOtherSize(dataURL);
                    @this.setLayoutSettingDataJsonOtherSize(dataJSON);
                }

                saveCanvasSetting();
            });
        });
    </script>
@endpush
