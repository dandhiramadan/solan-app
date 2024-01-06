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
    public $orientationPlano = 'potrait';

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

    public $showPreviewSettingExtra1 = false;
    public $layoutSettingDataJsonExtra1;
    public $layoutSettingDataUrlExtra1;
    public $folderTmpSettingExtra1;
    public $fileNameSettingExtra1;

    public $showPreviewBahan = false;
    public $layoutBahanDataJson;
    public $layoutBahanDataUrl;
    public $folderTmpBahan;
    public $fileNameBahan;

    public $resultAllSheet = [];

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


        $this->resultSheetLandscapeItems = $this->calculateSheet($this->quantityItems, $this->itemsLength, $this->itemsWidth, $gapBetweenLengthItems, $gapBetweenWidthItems, $minimalLengthSheet, $minimalWidthSheet, $maximalLengthSheet, $maximalWidthSheet, $this->orientationSetting, $this->planoLength, $this->planoWidth, $this->orientationPlano);
        // $this->resultSheetPotraitItems = $this->calculateSheet($this->quantityItems, $this->itemsLength, $this->itemsWidth, $gapBetweenLengthItems, $gapBetweenWidthItems, $minimalLengthSheet, $minimalWidthSheet, $maximalLengthSheet, $maximalWidthSheet, 'potrait', $this->planoLength, $this->planoWidth, 'potrait');

        // $this->resultAllSheet = array_merge($this->resultSheetLandscapeItems, $this->resultSheetPotraitItems);

        // if ($this->orientationSetting == 'landscape') {

        //     // if ($this->orientationPlano == 'landscape') {
        //     //     $this->resultPlanoLandscapeItems = $this->calculateSheetsInPlano($this->planoLength, $this->planoWidth, $this->resultSheetLandscapeItems, $minimalLengthSheet, $minimalWidthSheet, $maximalLengthSheet, $maximalWidthSheet, 'landscape');
        //     // } elseif ($this->orientationPlano == 'potrait') {
        //     //     $this->resultPlanoLandscapeItems = $this->calculateSheetsInPlano($this->planoLength, $this->planoWidth, $this->resultSheetLandscapeItems, $minimalLengthSheet, $minimalWidthSheet, $maximalLengthSheet, $maximalWidthSheet, 'potrait');
        //     // } else {

        //     // }
        // } elseif ($this->orientationSetting == 'potrait') {

        //     // if ($this->orientationPlano == 'landscape') {
        //     //     $this->resultPlanoLandscapeItems = $this->calculateSheetsInPlano($this->planoLength, $this->planoWidth, $this->resultSheetPotraitItems, $minimalLengthSheet, $minimalWidthSheet, $maximalLengthSheet, $maximalWidthSheet, 'landscape');
        //     // } elseif ($this->orientationPlano == 'potrait') {
        //     //     $this->resultPlanoLandscapeItems = $this->calculateSheetsInPlano($this->planoLength, $this->planoWidth, $this->resultSheetPotraitItems, $minimalLengthSheet, $minimalWidthSheet, $maximalLengthSheet, $maximalWidthSheet, 'potrait');
        //     // } else {
        //     // }
        // } else {
        // }
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

                    $colomnSheet = floor($planoLength / $currentSheetLength);
                    $rowSheet = floor($planoWidth / $currentSheetWidth);
                    $wastePlanoLength = $planoLength - ($currentSheetLength * $colomnSheet);
                    $wastePlanoWidth = $planoWidth - ($currentSheetWidth * $rowSheet);

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

                    if($dataSheet['sheetLength'] == $itemSheet['sheetLength'] && $itemSheet['sheetWidth'] <= $dataSheet['wastePlanoWidth']){
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
                        $result[$key]['totalItemsOnSheetWasteWidth'] = $bestMatchingSheet['totalItemsOnSheet'];
                        $result[$key]['colomnSheetWasteWidth'] = floor($planoLength / $bestMatchingSheet['sheetLength']);
                        $result[$key]['rowSheetWasteWidth'] = floor($dataSheet['wastePlanoWidth'] / $bestMatchingSheet['sheetWidth']);

                        $result[$key]['totalItemsOnPlanoWasteWidth'] = $result[$key]['totalItemsOnSheetWasteWidth'] * $result[$key]['colomnSheetWasteWidth'] * $result[$key]['rowSheetWasteWidth'];
                        $result[$key]['totalItemsFinal'] = (int) $bestMatchingSheet['totalItemsFinal'] + (int) $result[$key]['totalItemsOnPlanoWasteWidth'];
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
                $bestResult = $dataSheet;
            }
        }

        $this->dispatch('createLayoutSetting', $bestResult);
        $this->dispatch('createLayoutBahan', $bestResult);


        // $max_colomn = floor($maximalLengthSheet / $itemsLength);
        // $max_row = floor($maximalWidthSheet / $itemsWidth);

        // // Initialize row counter
        // $row = 0;

        // // Run the while loop until maximum row is reached
        // while ($row < $max_row) {
        //     // Increment row counter
        //     $row++;

        //     // Initialize col counter
        //     $colomn = 0;

        //     // Reset sheetLength and sheetWidth for each new row
        //     $sheetLength = 0;
        //     $sheetWidth = 0;

        //     // Run the while loop until maximum col is reached
        //     while ($colomn < $max_colomn) {
        //         // Increment col counter
        //         $colomn++;

        //         // Menghitung ukuran panjang dan lebar sheet
        //         $sheetLength = $colomn * $itemsLength + $sheetMarginLeft + $sheetMarginRight + $gapBetweenLengthItems * ($colomn - 1);
        //         $sheetWidth = $row * $itemsWidth + $sheetMarginTop + $sheetMarginBottom + $gapBetweenWidthItems * ($row - 1);

        //         // Memeriksa kriteria minimal dan maksimal
        //         if (($sheetLength >= $minimalLengthSheet && $sheetLength <= $maximalLengthSheet) && ($sheetWidth >= $minimalWidthSheet && $sheetWidth <= $maximalWidthSheet)) {
        //             $result[] = [
        //                 'sheetMarginTop' => (float) $sheetMarginTop,
        //                 'sheetMarginBottom' => (float) $sheetMarginBottom,
        //                 'sheetMarginLeft' => (float) $sheetMarginLeft,
        //                 'sheetMarginRight' => (float) $sheetMarginRight,
        //                 'gapBetweenLengthItems' => (float) $gapBetweenLengthItems,
        //                 'gapBetweenWidthItems' => (float) $gapBetweenWidthItems,
        //                 'panjangItems' => (float) $itemsLength,
        //                 'lebarItems' => (float) $itemsWidth,
        //                 'sheetLength' => (float) $sheetLength,
        //                 'sheetWidth' => (float) $sheetWidth,
        //                 'colomn' => (int) $colomn,
        //                 'row' => (int) $row,
        //                 'orientationItems' => $orientationSetting,
        //                 'totalItemsOnSheet' => (int) $colomn * (int) $row,
        //             ];
        //         }
        //     }
        // }

        // for ($colomn = floor(($maximalLengthSheet - $sheetMarginLeft - $sheetMarginRight) / $itemsLength); $colomn > 0; $colomn--) {
        //     for ($row = floor(($maximalWidthSheet - $sheetMarginTop - $sheetMarginBottom) / $itemsWidth); $row > 0; $row--) {
        //         // Menghitung ukuran panjang dan lebar sheet
        //         $sheetLength = $colomn * $itemsLength + $sheetMarginLeft + $sheetMarginRight + $gapBetweenLengthItems * ($colomn - 1);
        //         $sheetWidth = $row * $itemsWidth + $sheetMarginTop + $sheetMarginBottom + $gapBetweenWidthItems * ($row - 1);

        //         // Memeriksa kriteria minimal dan maksimal
        //         if ($sheetLength >= $minimalLengthSheet && $sheetLength <= $maximalLengthSheet && $sheetWidth >= $minimalWidthSheet && $sheetWidth <= $maximalWidthSheet) {
        //             $result[] = [
        //                 'sheetMarginTop' => (float) $sheetMarginTop,
        //                 'sheetMarginBottom' => (float) $sheetMarginBottom,
        //                 'sheetMarginLeft' => (float) $sheetMarginLeft,
        //                 'sheetMarginRight' => (float) $sheetMarginRight,
        //                 'gapBetweenLengthItems' => (float) $gapBetweenLengthItems,
        //                 'gapBetweenWidthItems' => (float) $gapBetweenWidthItems,
        //                 'panjangItems' => (float) $itemsLength,
        //                 'lebarItems' => (float) $itemsWidth,
        //                 'sheetLength' => (float) $sheetLength,
        //                 'sheetWidth' => (float) $sheetWidth,
        //                 'colomn' => (int) $colomn,
        //                 'row' => (int) $row,
        //                 'orientationItems' => $orientationSetting,
        //                 'totalItemsOnSheet' => (int) $colomn * (int) $row,
        //             ];
        //         }
        //     }
        // }

        return $result;
    }

    public function calculateSheetsInPlano($planoLength, $planoWidth, $sheetData, $minimalLengthSheet, $minimalWidthSheet, $maximalLengthSheet, $maximalWidthSheet, $orientationPlano)
    {
        $result = [];
        foreach ($sheetData as $key => $data) {
            $tempSheetLength = $data['sheetLength'];
            $tempSheetWidth = $data['sheetWidth'];

            if ($orientationPlano == 'landscape') {

                [$data['sheetLength'], $data['sheetWidth']] = [$data['sheetWidth'], $data['sheetLength']];
            } else {

                [$data['sheetLength'], $data['sheetWidth']] = [$data['sheetLength'], $data['sheetWidth']];
            }

            // plano dibagi menjadi kolomn
            $colomnPlano = floor($planoLength / $data['sheetLength']);
            $rowPlano = floor($planoWidth / $data['sheetWidth']);

            if ((($colomnPlano * $data['sheetLength']) <= $planoLength) && (($rowPlano * $data['sheetWidth']) <= $planoWidth)) {
                $wasteResult = $this->calculateWasteInPlano($planoLength, $planoWidth, $data['sheetLength'], $data['sheetWidth'], $colomnPlano, $rowPlano, $sheetData, $minimalLengthSheet, $minimalWidthSheet, $maximalLengthSheet, $maximalWidthSheet, $data['panjangItems'], $data['lebarItems'], $data['sheetMarginTop'], $data['sheetMarginBottom'], $data['sheetMarginLeft'], $data['sheetMarginRight'], $data['gapBetweenLengthItems'], $data['gapBetweenWidthItems']);

                $sheetSizes = [
                    'tempSheetLength' => $tempSheetLength,
                    'tempSheetWidth' => $tempSheetWidth,
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
                    'sheetSizesExtra1' => $wasteResult['sheetSizesExtra1'],
                    'sheetSizesExtra2' => $wasteResult['sheetSizesExtra2'],
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

        if ($bestTotalItemsOnPlanoEntry['sheetSizes']) {
            $this->dispatch('createLayoutSettingSheetSize', $bestTotalItemsOnPlanoEntry['sheetSizes']);
        }

        if ($bestTotalItemsOnPlanoEntry['sheetSizesExtra1']) {
            $this->dispatch('createLayoutSettingsheetSizesExtra1', $bestTotalItemsOnPlanoEntry['sheetSizesExtra1']);
        }

        $this->dispatch('createLayoutBahanSheetSize', $bestTotalItemsOnPlanoEntry);

        // if($bestTotalItemsOnPlanoEntry['sheetSizesExtra2']){
        //     $this->dispatch('createLayoutSettingSheetSizeExtra2', $bestTotalItemsOnPlanoEntry['sheetSizesExtra2']);
        //     $this->dispatch('createLayoutBahanSheetSizeExtra2', $bestTotalItemsOnPlanoEntry['sheetSizesExtra2']);
        // }


        // dd($result,$bestTotalItemsOnPlanoEntry );

        return $result;
    }

    public function calculateWasteInPlano($planoLength, $planoWidth, $sheetLength, $sheetWidth, $colomnPlano, $rowPlano, $sheetData, $minimalLengthSheet, $minimalWidthSheet, $maximalLengthSheet, $maximalWidthSheet, $itemsLength, $itemsWidth, $sheetMarginTop, $sheetMarginBottom, $sheetMarginLeft, $sheetMarginRight, $gapBetweenLengthItems, $gapBetweenWidthItems)
    {
        $result = [];
        $sheetSizesExtra1 = [];
        $sheetSizesExtra2 = [];

        $wasteLength = $planoLength - ($sheetLength * $colomnPlano);
        $wasteWidth = $planoWidth - ($sheetWidth * $rowPlano);

        if ($wasteWidth) {
            for ($colomn = floor(($maximalLengthSheet - $sheetMarginLeft - $sheetMarginRight) / $itemsLength); $colomn > 0; $colomn--) {
                for ($row = floor(($maximalWidthSheet - $sheetMarginTop - $sheetMarginBottom) / $itemsWidth); $row > 0; $row--) {
                    // Menghitung ukuran panjang dan lebar sheet
                    $sheetLength = $colomn * $itemsLength + $sheetMarginLeft + $sheetMarginRight + $gapBetweenLengthItems * ($colomn - 1);
                    $sheetWidth = $row * $itemsWidth + $sheetMarginTop + $sheetMarginBottom + $gapBetweenWidthItems * ($row - 1);

                    // Memeriksa kriteria minimal dan maksimal
                    if ($sheetLength >= $minimalLengthSheet && $sheetLength <= $maximalLengthSheet && $sheetWidth >= $minimalWidthSheet && $sheetWidth <= $maximalWidthSheet) {
                        $sheetSizesExtra1 = [
                            'sheetMarginTop' => (float) $sheetMarginTop,
                            'sheetMarginBottom' => (float) $sheetMarginBottom,
                            'sheetMarginLeft' => (float) $sheetMarginLeft,
                            'sheetMarginRight' => (float) $sheetMarginRight,
                            'gapBetweenLengthItems' => (float) $gapBetweenLengthItems,
                            'gapBetweenWidthItems' => (float) $gapBetweenWidthItems,
                            'panjangItems' => (float) $itemsLength,
                            'lebarItems' => (float) $itemsWidth,
                            'colomnSheet' => (int) $colomn,
                            'rowSheet' => (int) $row,
                            'orientationItems' => '',
                            'sheetLength' => (float) $sheetLengthExtra1,
                            'sheetWidth' => (float) $sheetWidthExtra1,
                            'colomnPlano' => (int) floor($planoLength / $sheetLengthExtra1),
                            'rowPlano' => (int) floor($wasteWidth / $sheetWidthExtra1),
                            'totalItemsOnSheet' => (int) $colomn * (int) $row,
                            'totalItemsOnPlano' => (int) ((int) $max_colomn * (int) $max_row) * ((int)$colomn * (int) $row),
                        ];
                    }
                }
            }

            // $max_colomn = floor($colomnPlano);
            // $max_row = floor($wasteWidth / $itemsWidth);

            // $row = 0;

            // // Run the while loop until maximum row is reached
            // while ($row < $max_row) {
            //     // Increment row counter
            //     $row++;

            //     // Initialize col counter
            //     $colomn = 0;

            //     // Reset sheetLength and sheetWidth for each new row
            //     $sheetLengthExtra1 = 0;
            //     $sheetWidthExtra1 = 0;

            //     // Run the while loop until maximum col is reached
            //     while ($colomn < $max_colomn) {
            //         // Increment col counter
            //         $colomn++;

            //         // Menghitung ukuran panjang dan lebar sheet
            //         $sheetLengthExtra1 = ($colomn * $itemsLength) + $sheetMarginLeft + $sheetMarginRight + ($gapBetweenLengthItems * ($colomn - 1));
            //         $sheetWidthExtra1 = ($row * $itemsWidth) + $sheetMarginTop + $sheetMarginBottom + ($gapBetweenWidthItems * ($row - 1));

            //         // Memeriksa kriteria minimal dan maksimal
            //         if ($sheetLengthExtra1 == $sheetLength && $wasteWidth >= $sheetWidthExtra1) {
            //             $sheetSizesExtra1 = [
            //                 'sheetMarginTop' => (float) $sheetMarginTop,
            //                 'sheetMarginBottom' => (float) $sheetMarginBottom,
            //                 'sheetMarginLeft' => (float) $sheetMarginLeft,
            //                 'sheetMarginRight' => (float) $sheetMarginRight,
            //                 'gapBetweenLengthItems' => (float) $gapBetweenLengthItems,
            //                 'gapBetweenWidthItems' => (float) $gapBetweenWidthItems,
            //                 'panjangItems' => (float) $itemsLength,
            //                 'lebarItems' => (float) $itemsWidth,
            //                 'colomnSheet' => (int) $colomn,
            //                 'rowSheet' => (int) $row,
            //                 'orientationItems' => '',
            //                 'sheetLength' => (float) $sheetLengthExtra1,
            //                 'sheetWidth' => (float) $sheetWidthExtra1,
            //                 'colomnPlano' => (int) floor($planoLength / $sheetLengthExtra1),
            //                 'rowPlano' => (int) floor($wasteWidth / $sheetWidthExtra1),
            //                 'totalItemsOnSheet' => (int) $colomn * (int) $row,
            //                 'totalItemsOnPlano' => (int) ((int) $max_colomn * (int) $max_row) * ((int)$colomn * (int) $row),
            //             ];
            //         }
            //     }
            // }

            // foreach ($sheetData as $item) {
            //     if($wasteWidth >= $item['sheetWidth'] && $sheetLength == $item['sheetLength']){
            //         $wasteColomnPlano = floor($planoLength / $item['sheetLength']);
            //         $wasteRowPlano = floor($wasteWidth / $item['sheetWidth']);
            //         $wasteWidth -= $item['sheetWidth'];

            //         $sheetSizesExtra1 = [
            //             'sheetMarginTop' => (float) $item['sheetMarginTop'],
            //             'sheetMarginBottom' => (float) $item['sheetMarginBottom'],
            //             'sheetMarginLeft' => (float) $item['sheetMarginLeft'],
            //             'sheetMarginRight' => (float) $item['sheetMarginRight'],
            //             'gapBetweenLengthItems' => (float) $item['gapBetweenLengthItems'],
            //             'gapBetweenWidthItems' => (float) $item['gapBetweenWidthItems'],
            //             'panjangItems' => $item['panjangItems'],
            //             'lebarItems' => $item['lebarItems'],
            //             'colomnSheet' => $item['colomn'],
            //             'rowSheet' => $item['row'],
            //             'orientationItems' => $item['orientationItems'],
            //             'sheetLength' => $item['sheetLength'],
            //             'sheetWidth' => $item['sheetWidth'],
            //             'colomnPlano' => (int) $colomnPlano,
            //             'rowPlano' => (int) $wasteRowPlano,
            //             'planoLength' => (int) $planoLength,
            //             'planoWidth' => (int) $planoWidth,
            //             'totalItemsOnSheet' => (int) $item['totalItemsOnSheet'],
            //             'totalItemsOnPlano' => (int) ($wasteColomnPlano * $wasteRowPlano) * $item['totalItemsOnSheet'],
            //             'wasteLength' => $wasteResult['wasteLength'],
            //             'wasteWidth' => $wasteWidth,
            //         ];

            //         foreach ($matchingSheets as $list) {
            //             if($wasteWidth >= $list['sheetWidth']){
            //                 $wasteColomnPlano = floor($data['sheetLength'] / $list['sheetLength']);
            //                 $wasteRowPlano = floor($wasteWidth / $list['sheetWidth']);
            //                 $wasteWidth -= $list['sheetWidth'];
            //                 $sheetSizesExtra2 = [
            //                     'sheetMarginTop' => (float) $list['sheetMarginTop'],
            //                     'sheetMarginBottom' => (float) $list['sheetMarginBottom'],
            //                     'sheetMarginLeft' => (float) $list['sheetMarginLeft'],
            //                     'sheetMarginRight' => (float) $list['sheetMarginRight'],
            //                     'gapBetweenLengthItems' => (float) $list['gapBetweenLengthItems'],
            //                     'gapBetweenWidthItems' => (float) $list['gapBetweenWidthItems'],
            //                     'panjangItems' => $list['panjangItems'],
            //                     'lebarItems' => $list['lebarItems'],
            //                     'colomnSheet' => $list['colomn'],
            //                     'rowSheet' => $list['row'],
            //                     'orientationItems' => $list['orientationItems'],
            //                     'sheetLength' => $list['sheetLength'],
            //                     'sheetWidth' => $list['sheetWidth'],
            //                     'colomnPlano' => (int) $wasteColomnPlano,
            //                     'rowPlano' => (int) $wasteRowPlano,
            //                     'planoLength' => (int) $planoLength,
            //                     'planoWidth' => (int) $planoWidth,
            //                     'totalItemsOnSheet' => (int) $list['totalItemsOnSheet'],
            //                     'totalItemsOnPlano' => (int) ($wasteColomnPlano * $wasteRowPlano) * $list['totalItemsOnSheet'],
            //                     'wasteLength' => $wasteResult['wasteLength'],
            //                     'wasteWidth' => $wasteWidth,
            //                 ];

            //             }
            //         }
            //     }
            // }


        $result = [
            'sheetLength' => $sheetLength,
            'sheetWidth' => $sheetWidth,
            'wasteLength' => $wasteLength,
            'wasteWidth' => $wasteWidth,
            'sheetSizesExtra1' => $sheetSizesExtra1,
            'sheetSizesExtra2' => $sheetSizesExtra2,
        ];
        }



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

    public function setLayoutSettingDataUrlExtra1($dataURL)
    {
        $this->folderTmpSettingExtra1 = 'public/' . $this->spk->spk_number . '/hitung-bahan/tmp-setting/';
        $this->layoutSettingDataUrlExtra1 = $dataURL;
        $base64ImageSetting = $dataURL;
        $uniqueIdSetting = uniqid();
        $this->fileNameSettingExtra1 = $uniqueIdSetting . '.png';
        $imageSetting = base64_decode(substr($base64ImageSetting, strpos($base64ImageSetting, ',') + 1));
        Storage::put($this->folderTmpSettingExtra1 . $this->fileNameSettingExtra1, $imageSetting);

        $this->showPreviewSettingExtra1 = true;
    }

    public function setLayoutSettingDataJsonExtra1($dataJson)
    {
        $this->layoutSettingDataJsonExtra1 = $dataJson;
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
