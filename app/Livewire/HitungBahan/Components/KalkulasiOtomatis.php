<?php

namespace App\Livewire\HitungBahan\Components;

use Throwable;
use App\Models\Machine;
use Livewire\Component;
use App\Models\Instruction;
use App\Models\LayoutBahan;
use App\Models\LayoutSetting;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

#[Title('Kalkulasi Otomatis')]
class KalkulasiOtomatis extends Component
{
    public $spk;

    public $machineSelected;
    public $quantityItems;
    public $itemsLength;
    public $itemsWidth;
    public $orientationSetting;
    public $planoLength;
    public $planoWidth;
    public $orientationPlano;
    public $autoRotate;
    public $pondSelected;
    public $potongJadiSelected;
    public $jarakPotongJadiSelected;

    public $resultSheetLandscapeItems = [];
    public $resultSheetPotraitItems = [];
    public $resultPlanoLandscapeItems = [];
    public $resultPlanoPotraitItems = [];

    public $showPreviewSetting = false;
    public $layoutSettingDataJson;
    public $layoutSettingDataUrl;
    public $folderTmpSetting;
    public $fileNameSetting;

    public $showPreviewSettingOtherSize = false;
    public $layoutSettingDataJsonOtherSize;
    public $layoutSettingDataUrlOtherSize;
    public $folderTmpSettingOtherSize;
    public $fileNameSettingOtherSize;

    public $showPreviewSettingOtherSizeAutoRotate = false;
    public $layoutSettingDataJsonOtherSizeAutoRotate;
    public $layoutSettingDataUrlOtherSizeAutoRotate;
    public $folderTmpSettingOtherSizeAutoRotate;
    public $fileNameSettingOtherSizeAutoRotate;

    public $showPreviewBahan = false;
    public $layoutBahanDataJson;
    public $layoutBahanDataUrl;
    public $folderTmpBahan;
    public $fileNameBahan;

    public $resultCalculate = [];

    public function mount($id)
    {
        $this->spk = Instruction::find($id);
        $this->quantityItems = $this->spk->quantity - $this->spk->quantity_stock;
    }

    public function render()
    {
        return view('livewire.hitung-bahan.components.kalkulasi-otomatis', [
            'machine' => Machine::where('type', 'Mesin Cetak')->get(),
        ]);
    }

    public function calculate()
    {
        $this->validate(
            [
                'machineSelected' => 'required',
                'quantityItems' => 'required',
                'itemsLength' => 'required',
                'itemsWidth' => 'required',
                'orientationSetting' => 'required',
                'planoLength' => 'required',
                'planoWidth' => 'required',
                'orientationPlano' => 'required',
                'pondSelected' => 'required',
                'potongJadiSelected' => 'required',
                'jarakPotongJadiSelected' => 'required',
            ],
            [
                'machineSelected.required' => 'Machine harus diisi.',
                'quantityItems.required' => 'Quantity harus diisi.',
                'itemsLength.required' => 'Panjang Barang Jadi harus diisi.',
                'itemsWidth.required' => 'Lebar Barang Jadi harus diisi.',
                'orientationSetting.required' => 'Orientasi Setting diisi.',
                'planoLength.required' => 'Panjang Plano harus diisi.',
                'planoWidth.required' => 'Lebar Plano harus diisi.',
                'orientationPlano.required' => 'Orientasi harus diisi.',
                'pondSelected.required' => 'Pond harus diisi.',
                'potongJadiSelected.required' => 'Potong Jadi harus diisi.',
                'jarakPotongJadiSelected.required' => 'Jarak Potong harus diisi.',
            ],
        );

        $this->showPreviewSetting = false;
        $this->showPreviewSettingOtherSize = false;
        $this->showPreviewSettingOtherSizeAutoRotate = false;
        $this->showPreviewBahan = false;

        //pemilihan mesin
        if ($this->pondSelected === 'Y' && $this->potongJadiSelected === 'N' && $this->jarakPotongJadiSelected === 'N') {
            $gapBetweenLengthItems = 0.4;
            $gapBetweenWidthItems = 0.4;
        } elseif ($this->pondSelected === 'Y' && $this->potongJadiSelected === 'Y' && $this->jarakPotongJadiSelected === 'N') {
            $gapBetweenLengthItems = 0.2;
            $gapBetweenWidthItems = 0.2;
        } elseif ($this->pondSelected === 'Y' && $this->potongJadiSelected === 'Y' && $this->jarakPotongJadiSelected === 'Y') {
            $gapBetweenLengthItems = 0.2;
            $gapBetweenWidthItems = 0.2;
        } elseif ($this->pondSelected === 'N' && $this->potongJadiSelected === 'Y' && $this->jarakPotongJadiSelected === 'Y') {
            $gapBetweenLengthItems = 0.2;
            $gapBetweenWidthItems = 0.2;
        } elseif ($this->pondSelected === 'N' && $this->potongJadiSelected === 'Y' && $this->jarakPotongJadiSelected === 'N') {
            $gapBetweenLengthItems = 0;
            $gapBetweenWidthItems = 0;
        } else {
            $gapBetweenLengthItems = 0;
            $gapBetweenWidthItems = 0;
        }

        $machine = Machine::find($this->machineSelected);
        $minimalLengthSheet = $machine->panjang_area_cetak_minimal;
        $minimalWidthSheet = $machine->lebar_area_cetak_minimal;
        $maximalLengthSheet = $machine->panjang_area_cetak_maximal;
        $maximalWidthSheet = $machine->lebar_area_cetak_maximal;
        $maximalLengthBahan = $machine->panjang_maximal_bahan;
        $maximalWidthBahan = $machine->lebar_maximal_bahan;

        $this->resultSheetLandscapeItems = $this->calculateSheet(currency_convert($this->quantityItems), currency_convert($this->itemsLength), currency_convert($this->itemsWidth), $gapBetweenLengthItems, $gapBetweenWidthItems, $minimalLengthSheet, $minimalWidthSheet, $maximalLengthSheet, $maximalWidthSheet, $this->orientationSetting, currency_convert($this->planoLength), currency_convert($this->planoWidth), $this->orientationPlano, $this->autoRotate);
    }

    public function calculateSheet($quantityItems, $itemsLength, $itemsWidth, $gapBetweenLengthItems, $gapBetweenWidthItems, $minimalLengthSheet, $minimalWidthSheet, $maximalLengthSheet, $maximalWidthSheet, $orientationSetting, $planoLength, $planoWidth, $orientationPlano, $autoRotate)
    {
        $sheetMarginTop = 1;
        $sheetMarginBottom = 0.5;
        $sheetMarginLeft = 0.5;
        $sheetMarginRight = 0.5;

        if ($orientationSetting == 'landscape') {
            [$itemsLength, $itemsWidth] = [$itemsLength, $itemsWidth];
            [$gapBetweenLengthItems, $gapBetweenWidthItems] = [$gapBetweenLengthItems, $gapBetweenWidthItems];
        } else {
            [$itemsLength, $itemsWidth] = [$itemsWidth, $itemsLength];
            [$gapBetweenLengthItems, $gapBetweenWidthItems] = [$gapBetweenWidthItems, $gapBetweenLengthItems];
        }

        $result = [];

        $maxRow = 0;
        $maxCol = 0;

        for ($row = 1; $row <= $maximalLengthSheet; $row++) {
            for ($colomn = 1; $colomn <= $maximalWidthSheet; $colomn++) {
                $currentSheetLength = ($colomn * $itemsLength) + ($gapBetweenLengthItems * ($colomn - 1)) + $sheetMarginLeft + $sheetMarginRight;
                $currentSheetWidth = ($row * $itemsWidth) + ($gapBetweenWidthItems * ($row - 1)) + $sheetMarginTop + $sheetMarginBottom;

                if (($currentSheetLength >= $minimalLengthSheet && $currentSheetLength <= $maximalLengthSheet) && ($currentSheetWidth >= $minimalWidthSheet && $currentSheetWidth <= $maximalWidthSheet)) {
                    if($orientationPlano == 'N'){
                        $tempSheetLength = $currentSheetLength;
                        $tempSheetWidth = $currentSheetWidth;
                    }else{
                        $tempSheetLength = $currentSheetWidth;
                        $tempSheetWidth = $currentSheetLength;
                    }

                    $colomnSheet = floor($planoLength / $tempSheetLength);
                    $rowSheet = floor($planoWidth / $tempSheetWidth);
                    $wastePlanoLength = $planoLength - ($tempSheetLength * $colomnSheet);
                    $wastePlanoWidth = $planoWidth - ($tempSheetWidth * $rowSheet);


                    $resultSheet = [
                        'planoLength' => (float) $planoLength,
                        'planoWidth' => (float) $planoWidth,

                        'sheetMarginTop' => (float) $sheetMarginTop,
                        'sheetMarginBottom' => (float) $sheetMarginBottom,
                        'sheetMarginLeft' => (float) $sheetMarginLeft,
                        'sheetMarginRight' => (float) $sheetMarginRight,
                        'gapBetweenLengthItems' => (float) $gapBetweenLengthItems,
                        'gapBetweenWidthItems' => (float) $gapBetweenWidthItems,
                        'itemsLength' => (float) $itemsLength,
                        'itemsWidth' => (float) $itemsWidth,
                        'colomnItems' => (int) $colomn,
                        'rowItems' => (int) $row,
                        'sheetLength' => (float) $currentSheetLength,
                        'sheetWidth' => (float) $currentSheetWidth,
                        'orientationItemsOnSheet' => $orientationSetting,
                        'orientationItemsOnPlano' => $orientationPlano,
                        'totalItemsOnSheet' => (int) $colomn * $row,
                        'colomnSheet' => (int) $colomnSheet,
                        'rowSheet' => (int) $rowSheet,
                        'wastePlanoLength' => (float) $wastePlanoLength,
                        'wastePlanoWidth' => (float) $wastePlanoWidth,
                        'totalItemsOnPlano' => (int) ($colomnSheet * $rowSheet) * ($colomn * $row),
                        'sheetLengthOnPlano' => (float) $tempSheetLength,
                        'sheetWidthOnPlano' => (float) $tempSheetWidth,

                        'sheetMarginTopWasteWidth' => (float) $sheetMarginTop,
                        'sheetMarginBottomWasteWidth' => (float) $sheetMarginBottom,
                        'sheetMarginLeftWasteWidth' => (float) $sheetMarginLeft,
                        'sheetMarginRightWasteWidth' => (float) $sheetMarginRight,
                        'gapBetweenLengthItemsWasteWidth' => (float) $gapBetweenLengthItems,
                        'gapBetweenWidthItemsWasteWidth' => (float) $gapBetweenWidthItems,
                        'itemsLengthWasteWidth' => (float) $itemsLength,
                        'itemsWidthWasteWidth' => (float) $itemsWidth,
                        'colomnItemsWasteWidth' => null,
                        'rowItemsWasteWidth' => null,
                        'sheetLengthWasteWidth' => null,
                        'sheetWidthWasteWidth' => null,
                        'orientationItemsWasteWidth' => $orientationSetting,
                        'totalItemsOnSheetWasteWidth' => null,
                        'colomnSheetWasteWidth' => null,
                        'rowSheetWasteWidth' => null,
                        'wastePlanoLengthWasteWidth' => null,
                        'wastePlanoWidthWasteWidth' => null,
                        'totalItemsOnPlanoWasteWidth' => null,
                        'totalSheetOnPlanoWasteWidth' => null,
                        'totalItemsFinalOnWasteWidth' => null,

                        'sheetMarginTopWasteLength' => (float) $sheetMarginTop,
                        'sheetMarginBottomWasteLength' => (float) $sheetMarginBottom,
                        'sheetMarginLeftWasteLength' => (float) $sheetMarginLeft,
                        'sheetMarginRightWasteLength' => (float) $sheetMarginRight,
                        'gapBetweenLengthItemsWasteLength' => (float) $gapBetweenLengthItems,
                        'gapBetweenWidthItemsWasteLength' => (float) $gapBetweenWidthItems,
                        'itemsLengthWasteLength' => (float) $itemsLength,
                        'itemsWidthWasteLength' => (float) $itemsWidth,
                        'colomnItemsWasteLength' => null,
                        'rowItemsWasteLength' => null,
                        'sheetLengthWasteLength' => null,
                        'sheetWidthWasteLength' => null,
                        'orientationItemsWasteLength' => $orientationSetting,
                        'totalItemsOnSheetWasteLength' => null,
                        'colomnSheetWasteLength' => null,
                        'rowSheetWasteLength' => null,
                        'wastePlanoLengthWasteLength' => null,
                        'wastePlanoWidthWasteLength' => null,
                        'totalItemsOnPlanoWasteLength' => null,
                        'totalSheetOnPlanoWasteLength' => null,
                        'totalItemsFinalOnWasteLength' => null,

                        'totalSheetOnPlano' => (int) ($colomnSheet * $rowSheet),
                        'totalItemsFinal' => (int) ($colomnSheet * $rowSheet) * ($colomn * $row),
                    ];

                    $result[] = $resultSheet;
                }
            }
        }

        foreach($result as $key => $dataSheet) {
            if($dataSheet['wastePlanoWidth'] >= $minimalWidthSheet) {
                foreach($result as $itemSheet) {
                    $maxTotalItemsOnSheet = 0;
                    $bestMatchingSheet = null;

                    if($dataSheet['sheetLength'] == $itemSheet['sheetLengthOnPlano'] && $itemSheet['sheetWidth'] <= $dataSheet['wastePlanoWidth']){
                        //cari pada $item yang memiliki value pada key totalItemsOnSheet yang terbanyak
                        if ($itemSheet['totalItemsOnSheet'] > $maxTotalItemsOnSheet) {
                            $maxTotalItemsOnSheet = $itemSheet['totalItemsOnSheet'];
                            $bestMatchingSheet = $itemSheet;
                        }
                    }

                    if ($bestMatchingSheet) {
                        $result[$key]['colomnItemsWasteWidth'] = $bestMatchingSheet['colomnItems'];
                        $result[$key]['rowItemsWasteWidth'] = $bestMatchingSheet['rowItems'];
                        $result[$key]['sheetLengthWasteWidth'] = $bestMatchingSheet['sheetLength'];
                        $result[$key]['sheetWidthWasteWidth'] = $bestMatchingSheet['sheetWidth'];
                        $result[$key]['totalItemsOnSheetWasteWidth'] = $result[$key]['colomnItemsWasteWidth'] * $result[$key]['rowItemsWasteWidth'];
                        $result[$key]['colomnSheetWasteWidth'] = floor($planoLength / $bestMatchingSheet['sheetLength']);
                        $result[$key]['rowSheetWasteWidth'] = floor($dataSheet['wastePlanoWidth'] / $bestMatchingSheet['sheetWidth']);

                        $result[$key]['totalItemsOnPlanoWasteWidth'] = (int) $result[$key]['totalItemsOnSheetWasteWidth'] * $result[$key]['colomnSheetWasteWidth'] * $result[$key]['rowSheetWasteWidth'];
                        $result[$key]['totalSheetOnPlanoWasteWidth'] = (int) $dataSheet['totalSheetOnPlano'] + ($result[$key]['colomnSheetWasteWidth'] * $result[$key]['rowSheetWasteWidth']);
                        $result[$key]['totalItemsFinalOnWasteWidth'] = (int) $result[$key]['totalItemsOnPlanoWasteWidth'];
                    }
                }
            }

            if($dataSheet['wastePlanoLength'] >= $dataSheet['wastePlanoWidth'] && $autoRotate == true) {
                foreach($result as $itemSheet) {
                    $maxTotalItemsOnSheet = 0;
                    $bestMatchingSheet = null;

                    if($dataSheet['sheetLength'] == $itemSheet['sheetLengthOnPlano'] && $itemSheet['sheetWidth'] <= $dataSheet['wastePlanoLength']){
                        //cari pada $item yang memiliki value pada key totalItemsOnSheet yang terbanyak
                        if ($itemSheet['totalItemsOnSheet'] > $maxTotalItemsOnSheet) {
                            $maxTotalItemsOnSheet = $itemSheet['totalItemsOnSheet'];
                            $bestMatchingSheet = $itemSheet;
                        }
                    }

                    if ($bestMatchingSheet) {
                        $result[$key]['colomnItemsWasteLength'] = $bestMatchingSheet['colomnItems'];
                        $result[$key]['rowItemsWasteLength'] = $bestMatchingSheet['rowItems'];
                        $result[$key]['sheetLengthWasteLength'] = $bestMatchingSheet['sheetLength'];
                        $result[$key]['sheetWidthWasteLength'] = $bestMatchingSheet['sheetWidth'];
                        $result[$key]['totalItemsOnSheetWasteLength'] = $result[$key]['colomnItemsWasteLength'] * $result[$key]['rowItemsWasteLength'];
                        $result[$key]['colomnSheetWasteLength'] = floor($dataSheet['wastePlanoLength'] / $bestMatchingSheet['sheetWidth']);
                        $result[$key]['rowSheetWasteLength'] = floor($planoWidth / $bestMatchingSheet['sheetLength']);

                        $result[$key]['totalItemsOnPlanoWasteLength'] = (int) $result[$key]['totalItemsOnSheetWasteLength'] * $result[$key]['colomnSheetWasteLength'] * $result[$key]['rowSheetWasteLength'];
                        $result[$key]['totalSheetOnPlanoWasteLength'] = (int) $dataSheet['totalSheetOnPlano'] + ($result[$key]['colomnSheetWasteLength'] * $result[$key]['rowSheetWasteLength']);
                        $result[$key]['totalItemsFinalOnWasteLength'] = (int) $result[$key]['totalItemsOnPlanoWasteLength'];
                    }
                }
            }
        }

        usort($result, function ($a, $b) {
            return $a['colomnItems'] - $b['colomnItems'];
        });

        foreach($result as $key => $dataSheet) {
            $totalItems = $dataSheet['totalItemsFinal'] + $dataSheet['totalItemsFinalOnWasteWidth'] + $dataSheet['totalItemsFinalOnWasteLength'];
            $result[$key]['totalItems'] = $totalItems;
        }

        $maxTotalItemsFinal = 0;
        $bestResult = null;

        foreach ($result as $dataSheet) {
            if (isset($dataSheet['totalItems']) && $dataSheet['totalItems'] > $maxTotalItemsFinal) {
                $maxTotalItemsFinal = $dataSheet['totalItems'];

                $totalPlano = $quantityItems / $dataSheet['totalItems'];
                $totalPlano = (int) ceil($totalPlano);
                    if ($totalPlano != floor($totalPlano)) {
                        $totalPlano += 1;
                    }
                $dataSheet['totalPlano'] = (int) $totalPlano;
                $bestResult = $dataSheet;
            }
        }

        $this->dispatch('createLayoutSetting', $bestResult);
        $this->dispatch('createLayoutBahan', $bestResult);

        if($bestResult != null && $bestResult['sheetLengthWasteWidth'] != null && $bestResult['sheetWidthWasteWidth'] != null){
            $this->dispatch('createLayoutSettingOtherSize', $bestResult);
        }

        if($bestResult != null && $bestResult['sheetLengthWasteWidth'] == $bestResult['sheetLengthWasteLength'] && $bestResult['sheetWidthWasteWidth'] != $bestResult['sheetWidthWasteLength']) {
            $this->dispatch('createLayoutSettingOtherSizeAutoRotate', $bestResult);
        }

        if($bestResult != null && $bestResult['sheetLength'] > $bestResult['sheetWidth']){
            $bestResult['sheetLength'] = $bestResult['sheetLength'];
            $bestResult['sheetWidth'] = $bestResult['sheetWidth'];
        } else {
            $bestResult['sheetLength'] = $bestResult['sheetWidth'];
            $bestResult['sheetWidth'] = $bestResult['sheetLength'];
        }

        $this->resultCalculate = $bestResult;

        return $result;
    }

    public function setLayoutSettingDataUrl($dataURL)
    {
        $this->folderTmpSetting = 'public/' . $this->spk->spk_number . '/hitung-bahan/tmp-setting/';
        $this->layoutSettingDataUrl = $dataURL;
        $base64ImageSetting = $dataURL;
        $uniqueIdSetting = uniqid();
        $this->fileNameSetting = $uniqueIdSetting . '.png';
        $imageSetting = base64_decode(substr($base64ImageSetting, strpos($base64ImageSetting, ',') + 1));
        Storage::put($this->folderTmpSetting . $this->fileNameSetting, $imageSetting);

        $this->showPreviewSetting = true;
    }

    public function setLayoutSettingDataJson($dataJson)
    {
        $this->layoutSettingDataJson = $dataJson;
    }

    public function setLayoutSettingDataUrlOtherSize($dataURL)
    {
        $this->folderTmpSettingOtherSize = 'public/' . $this->spk->spk_number . '/hitung-bahan/tmp-setting/';
        $this->layoutSettingDataUrlOtherSize = $dataURL;
        $base64ImageSetting = $dataURL;
        $uniqueIdSetting = uniqid();
        $this->fileNameSettingOtherSize = $uniqueIdSetting . '.png';
        $imageSetting = base64_decode(substr($base64ImageSetting, strpos($base64ImageSetting, ',') + 1));
        Storage::put($this->folderTmpSettingOtherSize . $this->fileNameSettingOtherSize, $imageSetting);

        $this->showPreviewSettingOtherSize = true;
    }

    public function setLayoutSettingDataJsonOtherSize($dataJson)
    {
        $this->layoutSettingDataJsonOtherSize = $dataJson;
    }

    public function setLayoutSettingDataUrlOtherSizeAutoRotate($dataURL)
    {
        $this->folderTmpSettingOtherSizeAutoRotate = 'public/' . $this->spk->spk_number . '/hitung-bahan/tmp-setting/';
        $this->layoutSettingDataUrlOtherSizeAutoRotate = $dataURL;
        $base64ImageSetting = $dataURL;
        $uniqueIdSetting = uniqid();
        $this->fileNameSettingOtherSizeAutoRotate = $uniqueIdSetting . '.png';
        $imageSetting = base64_decode(substr($base64ImageSetting, strpos($base64ImageSetting, ',') + 1));
        Storage::put($this->folderTmpSettingOtherSizeAutoRotate . $this->fileNameSettingOtherSizeAutoRotate, $imageSetting);

        $this->showPreviewSettingOtherSizeAutoRotate = true;
    }

    public function setLayoutSettingDataJsonOtherSizeAutoRotate($dataJson)
    {
        $this->layoutSettingDataJsonOtherSizeAutoRotate = $dataJson;
    }

    public function setLayoutBahanDataUrl($dataURL)
    {
        $this->folderTmpBahan = 'public/' . $this->spk->spk_number . '/hitung-bahan/tmp-bahan/';
        $this->layoutBahanDataUrl = $dataURL;
        $base64ImageBahan = $dataURL;
        $uniqueIdBahan = uniqid();
        $this->fileNameBahan = $uniqueIdBahan . '.png';
        $imageBahan = base64_decode(substr($base64ImageBahan, strpos($base64ImageBahan, ',') + 1));
        Storage::put($this->folderTmpBahan . $this->fileNameBahan, $imageBahan);

        $this->showPreviewBahan = true;
    }

    public function setLayoutBahanDataJson($dataJson)
    {
        $this->layoutBahanDataJson = $dataJson;
    }

    public function store()
    {
        $this->validate(
            [
                'machineSelected' => 'required',
                'quantityItems' => 'required',
                'itemsLength' => 'required',
                'itemsWidth' => 'required',
                'orientationSetting' => 'required',
                'planoLength' => 'required',
                'planoWidth' => 'required',
                'orientationPlano' => 'required',
                'pondSelected' => 'required',
                'potongJadiSelected' => 'required',
                'jarakPotongJadiSelected' => 'required',
            ],
            [
                'machineSelected.required' => 'Machine harus diisi.',
                'quantityItems.required' => 'Quantity harus diisi.',
                'itemsLength.required' => 'Panjang Barang Jadi harus diisi.',
                'itemsWidth.required' => 'Lebar Barang Jadi harus diisi.',
                'orientationSetting.required' => 'Orientasi Setting diisi.',
                'planoLength.required' => 'Panjang Plano harus diisi.',
                'planoWidth.required' => 'Lebar Plano harus diisi.',
                'orientationPlano.required' => 'Orientasi harus diisi.',
                'pondSelected.required' => 'Pond harus diisi.',
                'potongJadiSelected.required' => 'Potong Jadi harus diisi.',
                'jarakPotongJadiSelected.required' => 'Jarak Potong harus diisi.',
            ],
        );


        try {
            DB::beginTransaction();

            $createLayoutSetting = LayoutSetting::create([
                'instruction_id' => $this->spk->id,
                'sortorder' => 1,
                'state' => null,
                'panjang_barang_jadi' => $this->resultCalculate['itemsLength'],
                'lebar_barang_jadi' => $this->resultCalculate['itemsWidth'],
                'panjang_lembar_cetak' => $this->resultCalculate['sheetLength'],
                'lebar_lembar_cetak' => $this->resultCalculate['sheetWidth'],
                'panjang_naik' => $this->resultCalculate['colomnItems'],
                'lebar_naik' => $this->resultCalculate['rowItems'],
                'jarak_panjang' => $this->resultCalculate['gapBetweenLengthItems'],
                'jarak_lebar' => $this->resultCalculate['gapBetweenWidthItems'],
                'sisi_atas' => $this->resultCalculate['sheetMarginTop'],
                'sisi_bawah' => $this->resultCalculate['sheetMarginBottom'],
                'sisi_kiri' => $this->resultCalculate['sheetMarginLeft'],
                'sisi_kanan' => $this->resultCalculate['sheetMarginRight'],
                'jarak_tambahan_vertical' => null,
                'jarak_tambahan_horizontal' => null,
                'file_path' => $this->folderTmpSetting,
                'file_name' => $this->fileNameSetting,
                'dataJSON' => $this->layoutSettingDataJson,
            ]);

            $sheetSize = [
                [
                    'sheetLength' => $this->resultCalculate['sheetLength'], 'sheetWidth' => $this->resultCalculate['sheetWidth'],
                ],
                [
                    'sheetLength' => $this->resultCalculate['sheetLengthWasteWidth'], 'sheetWidth' => $this->resultCalculate['sheetWidthWasteWidth'],
                ],
                [
                    'sheetLength' => $this->resultCalculate['sheetLengthWasteLength'], 'sheetWidth' => $this->resultCalculate['sheetWidthWasteLength'],

                ]
            ];

            $createLayoutBahan = LayoutBahan::create([
                'instruction_id' => $this->spk->id,
                'sortorder' => 1,
                'state' => null,
                'include_belakang' => null,
                'panjang_plano' => $this->resultCalculate['planoLength'],
                'lebar_plano' => $this->resultCalculate['planoWidth'],
                'lembar_cetak' => json_encode($sheetSize),
                'jenis_bahan' => null,
                'gramasi' => null,
                'one_plano' => $this->resultCalculate['totalSheetOnPlano'],
                'sumber_bahan' => null,
                'merk_bahan' => null,
                'supplier' => null,
                'jumlah_lembar_cetak' => $this->resultCalculate['totalSheetOnPlano'],
                'jumlah_incit' => null,
                'total_lembar_cetak' => $this->resultCalculate['totalSheetOnPlano'],
                'harga_bahan' => null,
                'jumlah_bahan' => $this->resultCalculate['totalPlano'],
                'panjang_sisa_bahan' => null,
                'lebar_sisa_bahan' => null,
                'file_path' => $this->folderTmpBahan,
                'file_name' => $this->fileNameBahan,
                'dataJSON' => $this->layoutBahanDataJson,
                'layout_custom_file_name' => null,
                'layout_custom_path' => null,
            ]);

            if($this->resultCalculate != null && $this->resultCalculate['sheetLengthWasteWidth'] != null && $this->resultCalculate['sheetWidthWasteWidth'] != null){
                $createLayoutSettingOtherSize = LayoutSetting::create([
                    'instruction_id' => $this->spk->id,
                    'sortorder' => 2,
                    'state' => null,
                    'panjang_barang_jadi' => $this->resultCalculate['itemsLength'],
                    'lebar_barang_jadi' => $this->resultCalculate['itemsWidth'],
                    'panjang_lembar_cetak' => $this->resultCalculate['sheetLengthWasteWidth'],
                    'lebar_lembar_cetak' => $this->resultCalculate['sheetWidthWasteWidth'],
                    'panjang_naik' => $this->resultCalculate['colomnItemsWasteWidth'],
                    'lebar_naik' => $this->resultCalculate['rowItemsWasteWidth'],
                    'jarak_panjang' => $this->resultCalculate['gapBetweenLengthItems'],
                    'jarak_lebar' => $this->resultCalculate['gapBetweenWidthItems'],
                    'sisi_atas' => $this->resultCalculate['sheetMarginTop'],
                    'sisi_bawah' => $this->resultCalculate['sheetMarginBottom'],
                    'sisi_kiri' => $this->resultCalculate['sheetMarginLeft'],
                    'sisi_kanan' => $this->resultCalculate['sheetMarginRight'],
                    'jarak_tambahan_vertical' => null,
                    'jarak_tambahan_horizontal' => null,
                    'file_path' => $this->folderTmpSettingOtherSize,
                    'file_name' => $this->fileNameSettingOtherSize,
                    'dataJSON' => $this->layoutSettingDataJsonOtherSize,
                ]);
            }

            if($this->resultCalculate != null && $this->resultCalculate['sheetLengthWasteWidth'] == $this->resultCalculate['sheetLengthWasteLength'] && $this->resultCalculate['sheetWidthWasteWidth'] != $this->resultCalculate['sheetWidthWasteLength']) {
                $createLayoutSettingOtherSizeAutoRotate = LayoutSetting::create([
                    'instruction_id' => $this->spk->id,
                    'sortorder' => 2,
                    'state' => null,
                    'panjang_barang_jadi' => $this->resultCalculate['itemsLength'],
                    'lebar_barang_jadi' => $this->resultCalculate['itemsWidth'],
                    'panjang_lembar_cetak' => $this->resultCalculate['sheetLengthWasteLength'],
                    'lebar_lembar_cetak' => $this->resultCalculate['sheetWidthWasteLength'],
                    'panjang_naik' => $this->resultCalculate['colomnItemsWasteLength'],
                    'lebar_naik' => $this->resultCalculate['rowItemsWasteLength'],
                    'jarak_panjang' => $this->resultCalculate['gapBetweenLengthItems'],
                    'jarak_lebar' => $this->resultCalculate['gapBetweenWidthItems'],
                    'sisi_atas' => $this->resultCalculate['sheetMarginTop'],
                    'sisi_bawah' => $this->resultCalculate['sheetMarginBottom'],
                    'sisi_kiri' => $this->resultCalculate['sheetMarginLeft'],
                    'sisi_kanan' => $this->resultCalculate['sheetMarginRight'],
                    'jarak_tambahan_vertical' => null,
                    'jarak_tambahan_horizontal' => null,
                    'file_path' => $this->folderTmpSettingOtherSizeAutoRotate,
                    'file_name' => $this->fileNameSettingOtherSizeAutoRotate,
                    'dataJSON' => $this->layoutSettingDataJsonOtherSizeAutoRotate,
                ]);
            }

            DB::commit();

            session()->flash('success', 'Data kalkulasi otomatis berhasil disimpan.');
            $this->redirectRoute('FormCreate.HitungBahan', ['state' => 'create', 'id' => $this->spk->id]);

        } catch (Throwable $th) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan !!! ' . $th->getMessage());
        }
    }
}
