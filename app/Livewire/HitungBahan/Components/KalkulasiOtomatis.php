<?php

namespace App\Livewire\HitungBahan\Components;

use App\Models\Machine;
use Livewire\Component;
use App\Models\Instruction;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\Storage;

#[Title('Kalkulasi Otomatis')]
class KalkulasiOtomatis extends Component
{
    public $spk;

    public $machineSelected = 3;

    public $quantityItems = 1000;
    public $itemsLength = 13;
    public $itemsWidth = 6.5;
    public $orientationSetting = 'landscape';

    public $planoLength = 109;
    public $planoWidth = 79;
    public $orientationPlano = 'landscape';

    public $pondSelected = 'Y';
    public $potongJadiSelected = 'Y';
    public $jarakPotongJadiSelected = 'Y';
    public $resultSheetLandscapeItems = [];
    public $resultSheetPotraitItems = [];
    public $resultPlanoLandscapeItems = [];
    public $resultPlanoPotraitItems = [];

    public $showPreviewSetting = false;
    public $layoutSettingDataJson;
    public $layoutSettingDataUrl;
    public $folderTmpSetting;
    public $fileNameSetting;

    public $showPreviewBahan = false;
    public $layoutBahanDataJson;
    public $layoutBahanDataUrl;
    public $folderTmpBahan;
    public $fileNameBahan;

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

        if($this->orientationSetting == 'landscape'){
            $this->resultSheetLandscapeItems = $this->calculateSheet($this->quantityItems, $this->itemsLength, $this->itemsWidth, $gapBetweenLengthItems, $gapBetweenWidthItems, $minimalLengthSheet, $minimalWidthSheet, $maximalLengthSheet, $maximalWidthSheet, 'landscape');

            if($this->orientationPlano == 'landscape'){
                $this->resultPlanoLandscapeItems = $this->calculateSheetsInPlano($this->planoLength, $this->planoWidth, $this->resultSheetLandscapeItems, $minimalLengthSheet, $minimalWidthSheet, $maximalLengthSheet, $maximalWidthSheet, 'landscape');
            }else if($this->orientationPlano == 'potrait'){
                $this->resultPlanoLandscapeItems = $this->calculateSheetsInPlano($this->planoLength, $this->planoWidth, $this->resultSheetLandscapeItems, $minimalLengthSheet, $minimalWidthSheet, $maximalLengthSheet, $maximalWidthSheet, 'potrait');
            }else{

            }

        }else if($this->orientationSetting == 'potrait'){
            $this->resultSheetPotraitItems = $this->calculateSheet($this->quantityItems, $this->itemsLength, $this->itemsWidth, $gapBetweenLengthItems, $gapBetweenWidthItems, $minimalLengthSheet, $minimalWidthSheet, $maximalLengthSheet, $maximalWidthSheet, 'potrait');

        }else{

        }
    }

    public function calculateSheet($quantityItems, $itemsLength, $itemsWidth, $gapBetweenLengthItems, $gapBetweenWidthItems, $minimalLengthSheet, $minimalWidthSheet, $maximalLengthSheet, $maximalWidthSheet, $orientationSetting)
    {
        $sheetMarginTop = 1;
        $sheetMarginBottom = 0.5;
        $sheetMarginLeft = 0.5;
        $sheetMarginRight = 0.5;

        if($orientationSetting == 'landscape'){
            [$itemsLength, $itemsWidth] = [$itemsLength, $itemsWidth];
            [$gapBetweenLengthItems, $gapBetweenWidthItems] = [$gapBetweenLengthItems, $gapBetweenWidthItems];
        }else{
            [$itemsLength, $itemsWidth] = [$itemsWidth, $itemsLength];
            [$gapBetweenLengthItems, $gapBetweenWidthItems] = [$gapBetweenWidthItems, $gapBetweenLengthItems];
        }

        $result = [];

        for ($colomn = floor(($maximalLengthSheet - $sheetMarginLeft - $sheetMarginRight) / $itemsLength); $colomn > 0; $colomn--) {
            for ($row = floor(($maximalWidthSheet - $sheetMarginTop - $sheetMarginBottom) / $itemsWidth); $row > 0; $row--) {
                // Menghitung ukuran panjang dan lebar sheet
                $sheetLength = $colomn * $itemsLength + $sheetMarginLeft + $sheetMarginRight + $gapBetweenLengthItems * ($colomn - 1);
                $sheetWidth = $row * $itemsWidth + $sheetMarginTop + $sheetMarginBottom + $gapBetweenWidthItems * ($row - 1);

                // Memeriksa kriteria minimal dan maksimal
                if ($sheetLength >= $minimalLengthSheet && $sheetLength <= $maximalLengthSheet && $sheetWidth >= $minimalWidthSheet && $sheetWidth <= $maximalWidthSheet) {
                    $result[] = [
                        'sheetMarginTop' => (float) $sheetMarginTop,
                        'sheetMarginBottom' => (float) $sheetMarginBottom,
                        'sheetMarginLeft' => (float) $sheetMarginLeft,
                        'sheetMarginRight' => (float) $sheetMarginRight,
                        'gapBetweenLengthItems' => (float) $gapBetweenLengthItems,
                        'gapBetweenWidthItems' => (float) $gapBetweenWidthItems,
                        'panjangItems' => (float) $itemsLength,
                        'lebarItems' => (float) $itemsWidth,
                        'sheetLength' => (float) $sheetLength,
                        'sheetWidth' => (float) $sheetWidth,
                        'colomn' => (int) $colomn,
                        'row' => (int) $row,
                        'orientationItems' => $orientationSetting,
                        'totalItemsOnSheet' => (int) $colomn * (int) $row,
                    ];
                }
            }
        }

        return $result;
    }

    public function calculateSheetsInPlano($planoLength, $planoWidth, $sheetData, $minimalLengthSheet, $minimalWidthSheet, $maximalLengthSheet, $maximalWidthSheet, $orientationPlano)
    {
        $result = [];
        foreach ($sheetData as $key => $data) {
            $tempSheetLength = $data['sheetLength'];
            $tempSheetWidth = $data['sheetWidth'];

            if ($orientationPlano == 'landscape') {
                [$data['sheetLength'], $data['sheetWidth']] = [$data['sheetLength'], $data['sheetWidth']];
            } else {
                [$data['sheetLength'], $data['sheetWidth']] = [$data['sheetWidth'], $data['sheetLength']];
            }

            $sheetSizesExtra1 = [];
            $sheetSizesExtra2 = [];
            // plano dibagi menjadi kolomn
            $colomnPlano = floor($planoLength / $data['sheetLength']);
            $rowPlano = floor($planoWidth / $data['sheetWidth']);

            // Menghitung jumlah lembar sheet potrait yang muat dalam plano
            $totalSheets = $colomnPlano * $rowPlano;

            if ($colomnPlano * $data['sheetLength'] <= $planoLength && $rowPlano * $data['sheetWidth'] <= $planoWidth) {
                $wasteResult = $this->calculateWasteInPlano($planoLength, $planoWidth, $data['sheetLength'], $data['sheetWidth'], $colomnPlano, $rowPlano, $sheetData);


                $matchingSheets = array_filter($sheetData, function ($array) use ($data) {
                    return $array['sheetLength'] == $data['sheetLength'];
                });

                if ($wasteResult['wasteWidth'] >= $minimalWidthSheet && $wasteResult['wasteWidth'] <= $maximalWidthSheet) {
                    if ($matchingSheets) {
                        $wasteWidth = $wasteResult['wasteWidth'];
                        foreach ($matchingSheets as $item) {
                            if($wasteWidth >= $item['sheetWidth']){
                                $wasteColomnPlano = floor($data['sheetLength'] / $item['sheetLength']);
                                $wasteRowPlano = floor($wasteWidth / $item['sheetWidth']);
                                $wasteWidth -= $item['sheetWidth'];

                                $sheetSizesExtra1 = [
                                    'sheetMarginTop' => (float) $item['sheetMarginTop'],
                                    'sheetMarginBottom' => (float) $item['sheetMarginBottom'],
                                    'sheetMarginLeft' => (float) $item['sheetMarginLeft'],
                                    'sheetMarginRight' => (float) $item['sheetMarginRight'],
                                    'gapBetweenLengthItems' => (float) $item['gapBetweenLengthItems'],
                                    'gapBetweenWidthItems' => (float) $item['gapBetweenWidthItems'],
                                    'panjangItems' => $item['panjangItems'],
                                    'lebarItems' => $item['lebarItems'],
                                    'colomnSheet' => $item['colomn'],
                                    'rowSheet' => $item['row'],
                                    'orientationItems' => $item['orientationItems'],
                                    'sheetLength' => $item['sheetLength'],
                                    'sheetWidth' => $item['sheetWidth'],
                                    'colomnPlano' => (int) $wasteColomnPlano,
                                    'rowPlano' => (int) $wasteRowPlano,
                                    'planoLength' => (int) $planoLength,
                                    'planoWidth' => (int) $planoWidth,
                                    'totalItemsOnSheet' => (int) $item['totalItemsOnSheet'],
                                    'totalItemsOnPlano' => (int) ($wasteColomnPlano * $wasteRowPlano) * $item['totalItemsOnSheet'],
                                    'wasteLength' => $wasteResult['wasteLength'],
                                    'wasteWidth' => $wasteWidth,
                                ];

                                foreach ($matchingSheets as $list) {
                                    if($wasteWidth >= $list['sheetWidth']){
                                        $wasteColomnPlano = floor($data['sheetLength'] / $list['sheetLength']);
                                        $wasteRowPlano = floor($wasteWidth / $list['sheetWidth']);
                                        $wasteWidth -= $list['sheetWidth'];
                                        $sheetSizesExtra2 = [
                                            'sheetMarginTop' => (float) $list['sheetMarginTop'],
                                            'sheetMarginBottom' => (float) $list['sheetMarginBottom'],
                                            'sheetMarginLeft' => (float) $list['sheetMarginLeft'],
                                            'sheetMarginRight' => (float) $list['sheetMarginRight'],
                                            'gapBetweenLengthItems' => (float) $list['gapBetweenLengthItems'],
                                            'gapBetweenWidthItems' => (float) $list['gapBetweenWidthItems'],
                                            'panjangItems' => $list['panjangItems'],
                                            'lebarItems' => $list['lebarItems'],
                                            'colomnSheet' => $list['colomn'],
                                            'rowSheet' => $list['row'],
                                            'orientationItems' => $list['orientationItems'],
                                            'sheetLength' => $list['sheetLength'],
                                            'sheetWidth' => $list['sheetWidth'],
                                            'colomnPlano' => (int) $wasteColomnPlano,
                                            'rowPlano' => (int) $wasteRowPlano,
                                            'planoLength' => (int) $planoLength,
                                            'planoWidth' => (int) $planoWidth,
                                            'totalItemsOnSheet' => (int) $list['totalItemsOnSheet'],
                                            'totalItemsOnPlano' => (int) ($wasteColomnPlano * $wasteRowPlano) * $list['totalItemsOnSheet'],
                                            'wasteLength' => $wasteResult['wasteLength'],
                                            'wasteWidth' => $wasteWidth,
                                        ];

                                    }
                                }
                            }
                        }
                    }
                }

                $sheetSizes = [
                    'tempSheetLength' => (float) $tempSheetLength,
                    'tempSheetWidth' => (float) $tempSheetWidth,
                    'sheetMarginTop' => (float) $data['sheetMarginTop'],
                    'sheetMarginBottom' => (float) $data['sheetMarginBottom'],
                    'sheetMarginLeft' => (float) $data['sheetMarginLeft'],
                    'sheetMarginRight' => (float) $data['sheetMarginRight'],
                    'gapBetweenLengthItems' => (float) $data['gapBetweenLengthItems'],
                    'gapBetweenWidthItems' => (float) $data['gapBetweenWidthItems'],
                    'panjangItems' => $data['panjangItems'],
                    'lebarItems' => $data['lebarItems'],
                    'colomnSheet' => $data['colomn'],
                    'rowSheet' => $data['row'],
                    'orientationItems' => $data['orientationItems'],
                    'sheetLength' => $data['sheetLength'],
                    'sheetWidth' => $data['sheetWidth'],
                    'colomnPlano' => (int) $colomnPlano,
                    'rowPlano' => (int) $rowPlano,
                    'planoLength' => (int) $planoLength,
                    'planoWidth' => (int) $planoWidth,
                    'totalItemsOnSheet' => (int) $data['totalItemsOnSheet'],
                    'totalItemsOnPlano' => (int) ($colomnPlano * $rowPlano) * $data['totalItemsOnSheet'],
                    'wasteLength' => $wasteResult['wasteLength'],
                    'wasteWidth' => $wasteResult['wasteWidth'],
                ];

                $result[] = [
                    'sheetSizes' => $sheetSizes,
                    'sheetSizesExtra1' => $sheetSizesExtra1,
                    'sheetSizesExtra2' => $sheetSizesExtra2,
                ];
            }
        }

        $bestItemsOnPlano = [];
        foreach ($result as $data) {
            $totalItems = 0;

            $totalItems += $data['sheetSizes']['totalItemsOnPlano'] ?? 0;
            $totalItems += $data['sheetSizesExtra1']['totalItemsOnPlano'] ?? 0;
            $totalItems += $data['sheetSizesExtra2']['totalItemsOnPlano'] ?? 0;

            $bestItemsOnPlano[] = [
                'sheetSizes' => $data['sheetSizes'],
                'sheetSizesExtra1' => $data['sheetSizesExtra1'],
                'sheetSizesExtra2' => $data['sheetSizesExtra2'],
                'totalItemsOnPlano' => $totalItems,
            ];
        }

        $bestTotalItemsOnPlanoEntry = null;
        $maxTotalItemsOnPlano = 0;

        foreach ($bestItemsOnPlano as $data) {
            if ($data['totalItemsOnPlano'] > $maxTotalItemsOnPlano) {
                $maxTotalItemsOnPlano = $data['totalItemsOnPlano'];
                $bestTotalItemsOnPlanoEntry = $data;
            }
        }

        $this->dispatch('createLayoutSettingSheetSize', $bestTotalItemsOnPlanoEntry['sheetSizes']);
        $this->dispatch('createLayoutBahanSheetSize', $bestTotalItemsOnPlanoEntry['sheetSizes']);

        return $result;
    }

    public function calculateWasteInPlano($planoLength, $planoWidth, $sheetLength, $sheetWidth, $colomnPlano, $rowPlano, $sheetData)
    {
        $result = [
            'wasteLength' => $planoLength - ($sheetLength * $colomnPlano),
            'wasteWidth' => $planoWidth - ($sheetWidth * $rowPlano),
        ];

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

}
