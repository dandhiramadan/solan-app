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
    public $itemsLength = 10;
    public $itemsWidth = 6;
    public $orientationSetting = 'landscape';

    public $planoLength = 109;
    public $planoWidth = 79;
    public $orientationPlano = 'Y';

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

    public $showPreviewSettingOtherSize = false;
    public $layoutSettingDataJsonOtherSize;
    public $layoutSettingDataUrlOtherSize;
    public $folderTmpSettingOtherSize;
    public $fileNameSettingOtherSize;

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
        $this->showPreviewSetting = false;
        $this->showPreviewSettingOtherSize = false;
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

        $this->resultSheetLandscapeItems = $this->calculateSheet(currency_convert($this->quantityItems), currency_convert($this->itemsLength), currency_convert($this->itemsWidth), $gapBetweenLengthItems, $gapBetweenWidthItems, $minimalLengthSheet, $minimalWidthSheet, $maximalLengthSheet, $maximalWidthSheet, $this->orientationSetting, currency_convert($this->planoLength), currency_convert($this->planoWidth), $this->orientationPlano);
    }

    public function calculateSheet($quantityItems, $itemsLength, $itemsWidth, $gapBetweenLengthItems, $gapBetweenWidthItems, $minimalLengthSheet, $minimalWidthSheet, $maximalLengthSheet, $maximalWidthSheet, $orientationSetting, $planoLength, $planoWidth, $orientationPlano)
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
                        'totalItemsFinal' => (int) ($colomnSheet * $rowSheet) * ($colomn * $row),
                    ];

                    $result[] = $resultSheet;
                }
            }
        }

        foreach($result as $key => $dataSheet) {
            if($dataSheet['wastePlanoWidth'] >= $minimalWidthSheet){
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
                        $result[$key]['totalItemsFinal'] = (int) $dataSheet['totalItemsFinal'] + (int) $result[$key]['totalItemsOnPlanoWasteWidth'];
                    }
                }
            }else{

            }
        }

        usort($result, function ($a, $b) {
            return $a['colomnItems'] - $b['colomnItems'];
        });


        $maxTotalItemsFinal = 0;
        $bestResult = null;

        foreach ($result as $dataSheet) {
            if (isset($dataSheet['totalItemsFinal']) && $dataSheet['totalItemsFinal'] > $maxTotalItemsFinal) {
                $maxTotalItemsFinal = $dataSheet['totalItemsFinal'];

                $totalPlano = $quantityItems / $dataSheet['totalItemsFinal'];
                $totalPlano = (int) ceil($totalPlano);
                    if ($totalPlano != floor($totalPlano)) {
                        $totalPlano += 1;
                    }
                $dataSheet['totalPlano'] = (int) $totalPlano;
                $bestResult = $dataSheet;
            }
        }

        if($bestResult['sheetLengthWasteWidth'] == null && $bestResult['sheetWidthWasteWidth'] == null){
            $this->dispatch('createLayoutSetting', $bestResult);
            $this->dispatch('createLayoutBahan', $bestResult);
        } else {
            $this->dispatch('createLayoutSetting', $bestResult);
            $this->dispatch('createLayoutSettingOtherSize', $bestResult);
            $this->dispatch('createLayoutBahan', $bestResult);
        }

        if($bestResult['sheetLength'] > $bestResult['sheetWidth']){
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
