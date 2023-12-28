<div>
    {{-- If you look to others for fulfillment, you will never truly be fulfilled. --}}
    <h4 class="py-3 mb-4"><span class="text-muted fw-light">Form Hitung Bahan /</span> Create</h4>
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

    @if ($showCalculate)
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
                            });
                            $($el).on('change', function() {
                                @this.set('machineSelected', $($el).val())
                            })" name="machineSelected" wire:model.live="machineSelected"
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
                        <div wire:ignore>
                            <label class="form-label" for="Orientation Layout Bahan">Orientation Layout Bahan</label>
                            <select x-init="$($el).select2({
                                placeholder: 'Pilih Orientation Layout Bahan',
                                allowClear: true,
                            });
                            $($el).on('change', function() {
                                @this.set('orientationPlano', $($el).val())
                            })" name="orientationPlano" wire:model.live="orientationPlano"
                                id="orientationPlano" class="select2 form-select form-select-lg"
                                data-allow-clear="true">
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
                    </div>
                    <div class="col-md-4 mb-2">
                        <x-forms.number wire:model.live="itemsLength" :placeholder="'Panjang Barang Jadi'"></x-forms.number>
                    </div>
                    <div class="col-md-4 mb-2">
                        <x-forms.number wire:model.live="itemsWidth" :placeholder="'Lebar Barang Jadi'"></x-forms.number>
                    </div>
                    <div class="col-md-4 mb-2">
                        <div wire:ignore>
                            <label class="form-label" for="Orientation Layout Setting">Orientation Layout
                                Setting</label>
                            <select x-init="$($el).select2({
                                placeholder: 'Pilih Orientation Layout Setting',
                                allowClear: true,
                            });
                            $($el).on('change', function() {
                                @this.set('orientationSheet', $($el).val())
                            })" name="orientationSheet" wire:model.live="orientationSheet"
                                id="orientationSheet" class="select2 form-select form-select-lg"
                                data-allow-clear="true">
                                <option label="Pilih Orientation Layout Setting"></option>
                                <option value="landscape">Landscape</option>
                                <option value="potrait">Potrait</option>
                                <option value="auto rotate">Auto Rotate</option>
                            </select>
                        </div>
                        @error('orientationSheet')
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
                                        <input name="pondSelected" class="form-check-input" type="radio"
                                            value="Y" id="pondSelected1" wire:model.live="pondSelected" />
                                        <span class="custom-option-header">
                                            <span class="h6 mb-0">Ya</span>
                                        </span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md">
                                <div class="form-check custom-option custom-option-basic">
                                    <label class="form-check-label custom-option-content" for="pondSelected2">
                                        <input name="pondSelected" class="form-check-input" type="radio"
                                            value="N" id="pondSelected2" wire:model.live="pondSelected" />
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
                                    <label class="form-check-label custom-option-content"
                                        for="jarakPotongJadiSelected1">
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
                                    <label class="form-check-label custom-option-content"
                                        for="jarakPotongJadiSelected2">
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
                <div class="pt-4">
                    @if ($showPreviewSetting)
                        <button type="button" class="btn btn-info me-sm-3 me-1"
                            wire:click.prevent='calculate' wire:key='recalculate'>Recalculate</button>
                    @else
                        <button type="button" class="btn btn-info me-sm-3 me-1"
                            wire:click.prevent='calculate' wire:key='calculate'>Calculate</button>
                    @endif

                    @if ($showPreviewSetting)
                        <button type="button" class="btn btn-primary me-sm-3 me-1" wire:click.prevent='saveToForm'
                            wire:key='saveToForm'>Save to Form</button>
                    @endif
                </div>
                <div class="row mb-3">
                    <div class="col-md-8">
                        <div class="fabric-canvas-wrapper-setting">
                            @if ($showPreviewSetting)
                                <h5 class="card-header">Layout Setting</h5>
                                <img src="{{ asset(Storage::url($folderTmpSetting . '/' . $fileNameSetting)) }}">
                            @endif
                            <canvas id="canvasSetting"></canvas>
                        </div>
                    </div>
                    <div class="col-md-4">
                        @if ($showPreviewSetting)
                        <div class="card">
                            <h5 class="card-header">Details Setting</h5>
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
                </div>
                <div class="row mb-3">
                    <div class="col-md-8">
                        <div class="fabric-canvas-wrapper-bahan">
                            @if ($showPreviewBahan)
                                <h5 class="card-header">Layout Bahan</h5>
                                <img src="{{ asset(Storage::url($folderTmpBahan . '/' . $fileNameBahan)) }}">
                            @endif
                            <canvas id="canvasBahan"></canvas>
                        </div>
                    </div>
                    <div class="col-md-4">
                        @if ($showPreviewBahan)
                        <div class="card">
                            <h5 class="card-header">Details Bahan</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <label for="Panjang Lembar Cetak" class="form-label">Panjang Lembar Cetak</label>
                                        <input class="form-control" type="text" wire:model.defer="detailResultBahan.sheetLength" readonly />
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="Lebar Lembar" class="form-label">Lebar Lembar</label>
                                        <input class="form-control" type="text" wire:model.defer="detailResultBahan.sheetWidth" readonly />
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="Panjang Plano" class="form-label">Panjang Plano</label>
                                        <input class="form-control" type="text" wire:model.defer="detailResultBahan.planoLength" readonly />
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="Lebar Plano" class="form-label">Lebar Plano</label>
                                        <input class="form-control" type="text" wire:model.defer="detailResultBahan.planoWidth" readonly />
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="1 Plano (Barang Jadi)" class="form-label">1 Plano (Barang Jadi)</label>
                                        <input class="form-control" type="text" wire:model.defer="detailResultBahan.totalItems" readonly />
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <label for="Total Plano" class="form-label">Total Plano</label>
                                        <input class="form-control" type="text" wire:model.defer="detailResultBahan.totalPlano" readonly />
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>

@push('scripts')
    <script src="/assets/plugins/fabricjs/fabric.js"></script>
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('createLayoutSetting', (data) => {
                let col = data[0].col;
                let row = data[0].row;
                let sheetLength = data[0].sheetLength;
                let sheetWidth = data[0].sheetWidth;
                let wasteLength = data[0].wasteLength;
                let wasteWidth = data[0].wasteWidth;
                let itemsWidth = data[0].itemsWidth;
                let itemsLength = data[0].itemsLength;
                let gapBetweenItems = data[0].gapBetweenItems;
                let sheetMarginTop = data[0].sheetMarginTop;
                let sheetMarginBottom = data[0].sheetMarginBottom;
                let sheetMarginLeft = data[0].sheetMarginLeft;
                let sheetMarginRight = data[0].sheetMarginRight;
                let orientationSheet = data[0].orientationSheet;


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

                // Initiating Remove function
                function Remove() {
                    canvas.clear().renderAll();
                }
                // Buat objek persegi panjang sesuai dengan data yang diterima
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

                var textSheetLength = new fabric.IText('Panjang Lembar Cetak = ' + (sheetLength) + ' cm', {
                    fontFamily: 'Arial',
                    fontSize: 0.5,
                    left: 0, // Posisi horizontal di tengah
                    top: -0.2, // Posisi vertikal di tengah
                });

                canvas.add(textSheetLength);

                var textSheetWidth = new fabric.IText('Lebar Lembar Cetak = ' + (sheetWidth) + ' cm', {
                    fontFamily: 'Arial',
                    fontSize: 0.5,
                    left: sheetLength + 1.5, // Posisi horizontal di tengah
                    top: 0.2, // Posisi vertikal di tengah
                    angle: 90,
                });

                canvas.add(textSheetWidth);

                // Loop untuk baris
                for (let i = 0; i < row; i++) {
                    // Loop untuk kolom
                    for (let j = 0; j < col; j++) {
                        // Hitung posisi kiri dan atas untuk setiap persegi panjang
                        var leftPos = j * (itemsLength + gapBetweenItems) + sheetMarginLeft;
                        var topPos = i * (itemsWidth + gapBetweenItems) + sheetMarginTop + 1;

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

            Livewire.on('createLayoutSettingAutoRotate', (data) => {
                let col = data[0].colSheet;
                let row = data[0].rowSheet;
                let sheetLength = data[0].sheetLength;
                let sheetWidth = data[0].sheetWidth;
                let wasteLength = data[0].wasteLength;
                let wasteWidth = data[0].wasteWidth;
                let itemsWidth = data[0].itemsWidth;
                let itemsLength = data[0].itemsLength;
                let gapBetweenItems = data[0].gapBetweenItems;
                let sheetMarginTop = data[0].sheetMarginTop;
                let sheetMarginBottom = data[0].sheetMarginBottom;
                let sheetMarginLeft = data[0].sheetMarginLeft;
                let sheetMarginRight = data[0].sheetMarginRight;
                let orientationSheet = data[0].orientationSheet;

                console.log(data);

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
                canvas.clear();
                let canvasWidth = sheetLength + 2;
                let canvasHeight = sheetWidth + 2;

                canvas.setWidth(canvasWidth);
                canvas.setHeight(canvasHeight);

                // Buat objek persegi panjang sesuai dengan data yang diterima
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

                var textSheetLength = new fabric.IText('Panjang Lembar Cetak = ' + (sheetLength) + ' cm', {
                    fontFamily: 'Arial',
                    fontSize: 0.5,
                    left: 0, // Posisi horizontal di tengah
                    top: -0.2, // Posisi vertikal di tengah
                });

                canvas.add(textSheetLength);

                var textSheetWidth = new fabric.IText('Lebar Lembar Cetak = ' + (sheetWidth) + ' cm', {
                    fontFamily: 'Arial',
                    fontSize: 0.5,
                    left: sheetLength + 1.5, // Posisi horizontal di tengah
                    top: 0.2, // Posisi vertikal di tengah
                    angle: 90,
                });

                canvas.add(textSheetWidth);

                // Loop untuk baris
                for (let i = 0; i < row; i++) {
                    // Loop untuk kolom
                    for (let j = 0; j < col; j++) {
                        // Hitung posisi kiri dan atas untuk setiap persegi panjang
                        var leftPos = j * (itemsLength + gapBetweenItems) + sheetMarginLeft;
                        var topPos = i * (itemsWidth + gapBetweenItems) + sheetMarginTop + 1;

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
                let col = data[0].col;
                let row = data[0].row;
                let planoLength = data[0].planoLength;
                let planoWidth = data[0].planoWidth;
                let sheetLength = data[0].sheetLength;
                let sheetWidth = data[0].sheetWidth;
                let wasteLength = data[0].wasteLength;
                let wasteWidth = data[0].wasteWidth;
                let itemsWidth = data[0].itemsWidth;
                let itemsLength = data[0].itemsLength;
                let gapBetweenItems = data[0].gapBetweenItems;
                let sheetMarginTop = data[0].sheetMarginTop;
                let sheetMarginBottom = data[0].sheetMarginBottom;
                let sheetMarginLeft = data[0].sheetMarginLeft;
                let sheetMarginRight = data[0].sheetMarginRight;
                let orientationSheet = data[0].orientationSheet;

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
                canvas.clear();
                let canvasWidth = planoLength + 2.5;
                let canvasHeight = planoWidth + 2.5;

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
                for (let i = 0; i < row; i++) {
                    // Loop untuk kolom
                    for (let j = 0; j < col; j++) {
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

            Livewire.on('createLayoutBahanAutoRotate', (data) => {
                let col = data[0].col;
                let row = data[0].row;
                let planoLength = data[0].planoLength;
                let planoWidth = data[0].planoWidth;
                let sheetLength = data[0].sheetLength;
                let sheetWidth = data[0].sheetWidth;
                let cutSheetLength = data[0].cutSheetLength;
                let cutSheetWidth = data[0].cutSheetWidth;
                let totalItems = data[0].totalItems;
                let planoLength_extra_1 = data[0].planoLength_extra_1;
                let planoWidth_extra_1 = data[0].planoWidth_extra_1;
                let col_extra_1 = data[0].col_extra_1;
                let row_extra_1 = data[0].row_extra_1;
                let item_per_plano_extra_1 = data[0].item_per_plano_extra_1;
                let planoLength_extra_2 = data[0].planoLength_extra_2;
                let planoWidth_extra_2 = data[0].planoWidth_extra_2;
                let col_extra_2 = data[0].col_extra_2;
                let row_extra_2 = data[0].row_extra_2;
                let item_per_plano_extra_2 = data[0].item_per_plano_extra_2;

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
                canvas.clear();
                let canvasWidth = planoLength + 2.5;
                let canvasHeight = planoWidth + 2.5;

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
                for (let i = 0; i < row; i++) {
                    // Loop untuk kolom
                    for (let j = 0; j < col; j++) {
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

                // Loop untuk extra 1
                for (let i = 0; i < row_extra_1; i++) {
                    // Loop untuk kolom
                    for (let j = 0; j < col_extra_1; j++) {
                        // Hitung posisi kiri dan atas untuk setiap persegi panjang
                        var leftPos = (j * sheetWidth) + cutSheetLength;
                        var topPos = i * sheetLength + 2;

                        // Buat objek persegi panjang
                        var rectangle = new fabric.Rect({
                            top: topPos,
                            left: leftPos,
                            width: sheetWidth,
                            height: sheetLength,
                            fill: 'transparent',
                            stroke: 'blue',
                            strokeWidth: 0.1,
                            strokeUniform: true
                        });

                        // Tambahkan objek persegi panjang ke dalam canvas
                        canvas.add(rectangle);

                        // Hitung posisi teks untuk menempatkannya di tengah kotak
                        var textLeftPos = leftPos + sheetWidth / 2;
                        var textTopPos = topPos + sheetLength / 2;

                        // Tambahkan teks panjang ke dalam canvas
                        var textLength = new fabric.IText(sheetWidth + ' cm', {
                            fontFamily: 'Arial',
                            fontSize: 1,
                            left: leftPos,
                            top: topPos,
                            textAlign: 'center',
                        });

                        canvas.add(textLength);

                        // Tambahkan teks lebar ke dalam canvas
                        var textWidth = new fabric.IText(sheetLength + ' cm', {
                            fontFamily: 'Arial',
                            fontSize: 1,
                            left: leftPos,
                            top: topPos + sheetLength,
                            angle: -90,
                            textAlign: 'center',
                        });

                        canvas.add(textWidth);
                    }
                }

                // Loop untuk extra 2
                for (let i = 0; i < row_extra_2; i++) {
                    // Loop untuk kolom
                    for (let j = 0; j < col_extra_2; j++) {
                        // Hitung posisi kiri dan atas untuk setiap persegi panjang
                        var leftPos = j * sheetWidth;
                        var topPos = cutSheetWidth + (i * sheetLength + 2);

                        // Buat objek persegi panjang
                        var rectangle = new fabric.Rect({
                            top: topPos,
                            left: leftPos,
                            width: sheetWidth,
                            height: sheetLength,
                            fill: 'transparent',
                            stroke: 'blue',
                            strokeWidth: 0.1,
                            strokeUniform: true
                        });

                        // Tambahkan objek persegi panjang ke dalam canvas
                        canvas.add(rectangle);

                        // Hitung posisi teks untuk menempatkannya di tengah kotak
                        var textLeftPos = leftPos + sheetWidth / 2;
                        var textTopPos = topPos + sheetLength / 2;

                        // Tambahkan teks panjang ke dalam canvas
                        var textLength = new fabric.IText(sheetWidth + ' cm', {
                            fontFamily: 'Arial',
                            fontSize: 1,
                            left: leftPos,
                            top: topPos,
                            textAlign: 'center',
                        });

                        canvas.add(textLength);

                        // Tambahkan teks lebar ke dalam canvas
                        var textWidth = new fabric.IText(sheetLength + ' cm', {
                            fontFamily: 'Arial',
                            fontSize: 1,
                            left: leftPos,
                            top: topPos + sheetLength,
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

            Livewire.on('createLayoutBahanAutoRotateSheet', (data) => {
                let colSheet = data[0].colSheet;
                let rowSheet = data[0].rowSheet;
                let col = data[0].col;
                let row = data[0].row;
                let planoLength = data[0].planoLength;
                let planoWidth = data[0].planoWidth;
                let sheetLength = data[0].sheetLength;
                let sheetWidth = data[0].sheetWidth;
                let cutSheetLength = data[0].cutSheetLength;
                let cutSheetWidth = data[0].cutSheetWidth;
                let totalItems = data[0].totalItems;
                let planoLength_extra_1 = data[0].planoLength_extra_1;
                let planoWidth_extra_1 = data[0].planoWidth_extra_1;
                let col_extra_1 = data[0].col_extra_1;
                let row_extra_1 = data[0].row_extra_1;
                let item_per_plano_extra_1 = data[0].item_per_plano_extra_1;
                let planoLength_extra_2 = data[0].planoLength_extra_2;
                let planoWidth_extra_2 = data[0].planoWidth_extra_2;
                let col_extra_2 = data[0].col_extra_2;
                let row_extra_2 = data[0].row_extra_2;
                let item_per_plano_extra_2 = data[0].item_per_plano_extra_2;

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
                canvas.clear();
                let canvasWidth = planoLength + 2.5;
                let canvasHeight = planoWidth + 2.5;

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
                for (let i = 0; i < row; i++) {
                    // Loop untuk kolom
                    for (let j = 0; j < col; j++) {
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

                // Loop untuk extra 1
                for (let i = 0; i < row_extra_1; i++) {
                    // Loop untuk kolom
                    for (let j = 0; j < col_extra_1; j++) {
                        // Hitung posisi kiri dan atas untuk setiap persegi panjang
                        var leftPos = (j * sheetWidth) + cutSheetLength;
                        var topPos = i * sheetLength + 2;

                        // Buat objek persegi panjang
                        var rectangle = new fabric.Rect({
                            top: topPos,
                            left: leftPos,
                            width: sheetWidth,
                            height: sheetLength,
                            fill: 'transparent',
                            stroke: 'blue',
                            strokeWidth: 0.1,
                            strokeUniform: true
                        });

                        // Tambahkan objek persegi panjang ke dalam canvas
                        canvas.add(rectangle);

                        // Hitung posisi teks untuk menempatkannya di tengah kotak
                        var textLeftPos = leftPos + sheetWidth / 2;
                        var textTopPos = topPos + sheetLength / 2;

                        // Tambahkan teks panjang ke dalam canvas
                        var textLength = new fabric.IText(sheetWidth + ' cm', {
                            fontFamily: 'Arial',
                            fontSize: 1,
                            left: leftPos,
                            top: topPos,
                            textAlign: 'center',
                        });

                        canvas.add(textLength);

                        // Tambahkan teks lebar ke dalam canvas
                        var textWidth = new fabric.IText(sheetLength + ' cm', {
                            fontFamily: 'Arial',
                            fontSize: 1,
                            left: leftPos,
                            top: topPos + sheetLength,
                            angle: -90,
                            textAlign: 'center',
                        });

                        canvas.add(textWidth);
                    }
                }

                // Loop untuk extra_2
                for (let i = 0; i < row_extra_2; i++) {
                    // Loop untuk kolom
                    for (let j = 0; j < col_extra_2; j++) {
                        // Hitung posisi kiri dan atas untuk setiap persegi panjang
                        var leftPos = j * sheetLength;
                        var topPos = i * sheetWidth + (row * sheetWidth) + 2;

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
                        var textLeftPos = leftPos + sheetWidth / 2;
                        var textTopPos = topPos + sheetLength / 2;

                        // Tambahkan teks panjang ke dalam canvas
                        var textLength = new fabric.IText(sheetWidth + ' cm', {
                            fontFamily: 'Arial',
                            fontSize: 1,
                            left: leftPos,
                            top: topPos,
                            textAlign: 'center',
                        });

                        canvas.add(textLength);

                        // Tambahkan teks lebar ke dalam canvas
                        var textWidth = new fabric.IText(sheetLength + ' cm', {
                            fontFamily: 'Arial',
                            fontSize: 1,
                            left: leftPos,
                            top: topPos + sheetLength,
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
        });
    </script>
@endpush
