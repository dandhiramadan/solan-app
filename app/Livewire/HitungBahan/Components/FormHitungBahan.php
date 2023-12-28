<?php

namespace App\Livewire\HitungBahan\Components;

use App\Models\Machine;
use Livewire\Component;
use App\Models\Instruction;
use App\Models\LayoutBahan;
use Livewire\Attributes\On;
use App\Models\LayoutSetting;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

#[Title('Form Hitung Bahan')]
class FormHitungBahan extends Component
{
    public $spk;

    #[Rule('required', message: 'Quantity harus diisi.')]
    public $quantityItems;

    #[Rule('required', message: 'Panjang Barang Jadi harus diisi.')]
    public $itemsLength;

    #[Rule('required', message: 'Lebar Barang Jadi harus diisi.')]
    public $itemsWidth;

    public $gapBetweenItems;

    //machine
    #[Rule('required', message: 'Machine harus diisi.')]
    public $machineSelected;
    public $minimalLengthSheet;
    public $minimalWidthSheet;
    public $maximalLengthSheet;
    public $maximalWidthSheet;
    public $maximalLengthBahan;
    public $maximalWidthBahan;

    //jarak
    #[Rule('required', message: 'Pond harus diisi.')]
    public $pondSelected;

    #[Rule('required', message: 'Potong Jadi harus diisi.')]
    public $potongJadiSelected;

    #[Rule('required', message: 'Jarak Potong harus diisi.')]
    public $jarakPotongJadiSelected;

    public $sheetMarginTop = 1;
    public $sheetMarginBottom = 0.5;
    public $sheetMarginLeft = 0.5;
    public $sheetMarginRight = 0.5;

    //bahan
    #[Rule('required', message: 'Panjang Plano harus diisi.')]
    public $planoLength;

    #[Rule('required', message: 'Lebar Plano harus diisi.')]
    public $planoWidth;

    //orientasi
    #[Rule('required', message: 'Orientasi harus diisi.')]
    public $orientationSheet;

    #[Rule('required', message: 'Orientasi harus diisi.')]
    public $orientationPlano;

    public $resultSheet = [];
    public $resultPlano = [];

    public $maxItemsOnPlano;
    public $showCalculate = true;

    public $layoutSettingDataJson;
    public $layoutSettingDataUrl;

    public $layoutBahanDataJson;
    public $layoutBahanDataUrl;

    public $folderTmpSetting;
    public $fileNameSetting;
    public $showPreviewSetting = false;
    public $showCanvasSetting = true;

    public $folderTmpBahan;
    public $fileNameBahan;
    public $showPreviewBahan = false;
    public $showCanvasBahan = true;

    public $detailResultSetting = [];
    public $detailResultBahan = [];

    public function mount($id)
    {
        $this->spk = Instruction::find($id);
        $this->quantityItems = $this->spk->quantity - $this->spk->quantity_stock;
    }

    public function render()
    {
        return view('livewire.hitung-bahan.components.form-hitung-bahan', [
            'machine' => Machine::where('type', 'Mesin Cetak')->get(),
        ]);
    }

    private function calculateSheetDimensions($itemsLength, $itemsWidth, $gapBetweenItems, $minimalLengthSheet, $minimalWidthSheet, $maximalLengthSheet, $maximalWidthSheet, $sheetMarginTop, $sheetMarginBottom, $sheetMarginLeft, $sheetMarginRight, $orientationSheet)
    {
        if ($itemsLength > $itemsWidth) {
            $orientationSheet = 'landscape';
        } else {
            $orientationSheet = 'potrait';
        }

        if ($orientationSheet == 'landscape') {
            [$itemsLength, $itemsWidth] = [$itemsLength, $itemsWidth];
        } else {
            [$itemsLength, $itemsWidth] = [$itemsWidth, $itemsLength];
        }

        //landscape
        $max_col = floor($maximalLengthSheet / $itemsLength);
        $max_row = floor($maximalWidthSheet / $itemsWidth);

        // Create an empty array to store the results
        $results = [];

        // Initialize row counter
        $row_counter = 0;

        // Run the while loop until maximum row is reached
        while ($row_counter < $max_row) {
            // Increment row counter
            $row_counter++;

            // Initialize col counter
            $col_counter = 0;

            // Reset sheetLength and sheetWidth for each new row
            $sheetLength = 0;
            $sheetWidth = 0;

            // Run the while loop until maximum col is reached
            while ($col_counter < $max_col) {
                // Increment col counter
                $col_counter++;

                // Increment sheetLength and sheetWidth based on col and row counters
                $sheetLength = $itemsLength * $col_counter + $gapBetweenItems * ($col_counter - 1) + $sheetMarginLeft + $sheetMarginRight;
                $sheetWidth = $itemsWidth * $row_counter + $gapBetweenItems * ($row_counter - 1) + $sheetMarginTop + $sheetMarginBottom;

                if ($sheetLength >= $minimalLengthSheet && $sheetLength <= $maximalLengthSheet && ($sheetWidth >= $minimalWidthSheet && $sheetWidth <= $maximalWidthSheet)) {
                    $results[] = [
                        'col' => (int) $col_counter,
                        'row' => (int) $row_counter,
                        'sheetLength' => (float) $sheetLength,
                        'sheetWidth' => (float) $sheetWidth,
                        'wasteLength' => (float) $maximalLengthSheet - $sheetLength,
                        'wasteWidth' => (float) $maximalWidthSheet - $sheetWidth,
                        'orientationSheet' => $orientationSheet,
                        'itemsPerSheet' => (float) $col_counter * $row_counter,
                        'itemsLength' => (float) $itemsLength,
                        'itemsWidth' => (float) $itemsWidth,
                        'gapBetweenItems' => (float) $gapBetweenItems,
                        'sheetMarginTop' => (float) $sheetMarginTop,
                        'sheetMarginBottom' => (float) $sheetMarginBottom,
                        'sheetMarginLeft' => (float) $sheetMarginLeft,
                        'sheetMarginRight' => (float) $sheetMarginRight,
                    ];
                }
            }
        }

        $bestDimensionSheet = [];
        $minWaste = PHP_INT_MAX;

        // Iterate through $results to find the result with the smallest waste
        foreach ($results as $result) {
            $totalWaste = $result['wasteLength'] * $result['wasteWidth'];

            if ($totalWaste < $minWaste) {
                $minWaste = $totalWaste;
                $bestDimensionSheet = [
                    'col' => (int) $result['col'],
                    'row' => (int) $result['row'],
                    'sheetLength' => (float) $result['sheetLength'],
                    'sheetWidth' => (float) $result['sheetWidth'],
                    'wasteLength' => (float) $result['wasteLength'],
                    'wasteWidth' => (float) $result['wasteWidth'],
                    'orientationSheet' => (float) $result['orientationSheet'],
                    'itemsPerSheet' => (float) $result['itemsPerSheet'],
                    'itemsLength' => (float) $result['itemsLength'],
                    'itemsWidth' => (float) $result['itemsWidth'],
                    'gapBetweenItems' => (float) $result['gapBetweenItems'],
                    'sheetMarginTop' => (float) $result['sheetMarginTop'],
                    'sheetMarginBottom' => (float) $result['sheetMarginBottom'],
                    'sheetMarginLeft' => (float) $result['sheetMarginLeft'],
                    'sheetMarginRight' => (float) $result['sheetMarginRight'],
                ];
            }
        }

        $this->dispatch('createLayoutSetting', $bestDimensionSheet);

        return $bestDimensionSheet;
    }

    private function calculateAllSheetDimensions($itemsLength, $itemsWidth, $gapBetweenItems, $minimalLengthSheet, $minimalWidthSheet, $maximalLengthSheet, $maximalWidthSheet, $sheetMarginTop, $sheetMarginBottom, $sheetMarginLeft, $sheetMarginRight, $orientationSheet)
    {
        if ($itemsLength > $itemsWidth) {
            $orientationSheet = 'landscape';
        } else {
            $orientationSheet = 'potrait';
        }

        if ($orientationSheet == 'landscape') {
            [$itemsLength, $itemsWidth] = [$itemsLength, $itemsWidth];
        } else {
            [$itemsLength, $itemsWidth] = [$itemsWidth, $itemsLength];
        }

        //landscape
        $max_col = floor($maximalLengthSheet / $itemsLength);
        $max_row = floor($maximalWidthSheet / $itemsWidth);

        // Create an empty array to store the results
        $results = [];

        // Initialize row counter
        $row_counter = 0;

        // Run the while loop until maximum row is reached
        while ($row_counter < $max_row) {
            // Increment row counter
            $row_counter++;

            // Initialize col counter
            $col_counter = 0;

            // Reset sheetLength and sheetWidth for each new row
            $sheetLength = 0;
            $sheetWidth = 0;

            // Run the while loop until maximum col is reached
            while ($col_counter < $max_col) {
                // Increment col counter
                $col_counter++;

                // Increment sheetLength and sheetWidth based on col and row counters
                $sheetLength = $itemsLength * $col_counter + $gapBetweenItems * ($col_counter - 1) + $sheetMarginLeft + $sheetMarginRight;
                $sheetWidth = $itemsWidth * $row_counter + $gapBetweenItems * ($row_counter - 1) + $sheetMarginTop + $sheetMarginBottom;

                if ($sheetLength >= $minimalLengthSheet && $sheetLength <= $maximalLengthSheet && ($sheetWidth >= $minimalWidthSheet && $sheetWidth <= $maximalWidthSheet)) {
                    $results[] = [
                        'col' => (int) $col_counter,
                        'row' => (int) $row_counter,
                        'sheetLength' => (float) $sheetLength,
                        'sheetWidth' => (float) $sheetWidth,
                        'wasteLength' => (float) $maximalLengthSheet - $sheetLength,
                        'wasteWidth' => (float) $maximalWidthSheet - $sheetWidth,
                        'orientationSheet' => $orientationSheet,
                        'itemsPerSheet' => (int) $col_counter * (int) $row_counter,
                        'itemsLength' => (float) $itemsLength,
                        'itemsWidth' => (float) $itemsWidth,
                        'gapBetweenItems' => (float) $gapBetweenItems,
                        'sheetMarginTop' => (float) $sheetMarginTop,
                        'sheetMarginBottom' => (float) $sheetMarginBottom,
                        'sheetMarginLeft' => (float) $sheetMarginLeft,
                        'sheetMarginRight' => (float) $sheetMarginRight,
                    ];
                }
            }
        }

        return $results;
    }

    private function calculateNumSheetsInPlano($sheetLength, $sheetWidth, $itemsPerSheet, $planoLength, $planoWidth, $orientationPlano)
    {
        if ($orientationPlano == 'landscape') {
            [$sheetLength, $sheetWidth] = [$sheetLength, $sheetWidth];
        } else {
            [$sheetLength, $sheetWidth] = [$sheetWidth, $sheetLength];
        }

        $max_col = floor($planoLength / $sheetLength);
        $max_row = floor($planoWidth / $sheetWidth);

        $results = [];

        // Initialize row counter
        $row_counter = 0;

        // Run the while loop until maximum row is reached
        while ($row_counter < $max_row) {
            // Increment row counter
            $row_counter++;

            // Initialize col counter
            $col_counter = 0;

            // Reset sheetLength and sheetWidth for each new row
            $cutSheetLength = 0;
            $cutSheetWidth = 0;

            // Run the while loop until maximum col is reached
            while ($col_counter < $max_col) {
                // Increment col counter
                $col_counter++;

                // Increment sheetLength and sheetWidth based on col and row counters
                $cutSheetLength = $sheetLength * $col_counter;
                $cutSheetWidth = $sheetWidth * $row_counter;

                if ($cutSheetLength <= $planoLength && $cutSheetWidth <= $planoWidth) {
                    $totalPlano = $this->quantityItems / ($itemsPerSheet * ($col_counter * $row_counter));
                    $totalPlano = (int) ceil($totalPlano);
                    if ($totalPlano != floor($totalPlano)) {
                        $totalPlano += 1;
                    }
                    $results = [
                        'col' => (int) $col_counter,
                        'row' => (int) $row_counter,
                        'planoLength' => (float) $planoLength,
                        'planoWidth' => (float) $planoWidth,
                        'sheetLength' => (float) $sheetLength,
                        'sheetWidth' => (float) $sheetWidth,
                        'cutSheetLength' => (float) $cutSheetLength,
                        'cutSheetWidth' => (float) $cutSheetWidth,
                        'wasteCutLength' => (float) $planoLength - $cutSheetLength,
                        'wasteCutWidth' => (float) $planoWidth - $cutSheetWidth,
                        'orientationPlano' => (float) $orientationPlano,
                        'itemsPerPlano' => (int) $itemsPerSheet * ($col_counter * $row_counter),
                        'totalItems' => (int) $itemsPerSheet * ($col_counter * $row_counter),
                        'totalPlano' => (int) $totalPlano,
                    ];
                }
            }
        }

        $this->dispatch('createLayoutBahan', $results);

        return $results;
    }

    private function calculateNumSheetsAutoRotateInPlano($resultAllSheet, $planoLength, $planoWidth, $orientationPlano)
    {
        $results = [];

        $sheetLength = $resultAllSheet['sheetLength'];
        $sheetWidth = $resultAllSheet['sheetWidth'];
        $itemsPerSheet = $resultAllSheet['itemsPerSheet'];

        if ($orientationPlano == 'landscape') {
            [$sheetLength, $sheetWidth] = [$sheetLength, $sheetWidth];
        } elseif ($orientationPlano == 'potrait') {
            [$sheetLength, $sheetWidth] = [$sheetWidth, $sheetLength];
        }

        $max_col = floor($planoLength / $sheetLength);
        $max_row = floor($planoWidth / $sheetWidth);

        // Initialize row counter
        $row_counter = 0;

        // Run the while loop until maximum row is reached
        while ($row_counter < $max_row) {
            // Increment row counter
            $row_counter++;

            // Initialize col counter
            $col_counter = 0;

            // Reset sheetLength and sheetWidth for each new row
            $cutSheetLength = 0;
            $cutSheetWidth = 0;

            // Run the while loop until maximum col is reached
            while ($col_counter < $max_col) {
                // Increment col counter
                $col_counter++;

                // Increment sheetLength and sheetWidth based on col and row counters
                $cutSheetLength = $sheetLength * $col_counter;
                $cutSheetWidth = $sheetWidth * $row_counter;

                if ($cutSheetLength <= $planoLength && $cutSheetWidth <= $planoWidth) {
                    $resultAllSheetPlano = [
                        'colSheet' => (int) $resultAllSheet['col'],
                        'rowSheet' => (int) $resultAllSheet['row'],
                        'col' => (int) $col_counter,
                        'row' => (int) $row_counter,
                        'planoLength' => (float) $planoLength,
                        'planoWidth' => (float) $planoWidth,
                        'sheetLength' => (float) $sheetLength,
                        'sheetWidth' => (float) $sheetWidth,
                        'cutSheetLength' => (float) $cutSheetLength,
                        'cutSheetWidth' => (float) $cutSheetWidth,
                        'wasteCutLength' => (float) $planoLength - $cutSheetLength,
                        'wasteCutWidth' => (float) $planoWidth - $cutSheetWidth,
                        'orientationSheet' => $resultAllSheet['orientationSheet'],
                        'orientationPlano' => $orientationPlano,
                        'itemsPerSheet' => (int) $resultAllSheet['itemsPerSheet'],
                        'itemsPerPlano' => (int) $resultAllSheet['itemsPerSheet'] * ((int) $col_counter * (int) $row_counter),
                    ];

                    // Logika penentuan nilai tambahan
                    if ($resultAllSheetPlano['wasteCutLength'] >= $resultAllSheetPlano['sheetWidth']) {
                        $resultAllSheetPlano['planoLength_extra_1'] = $resultAllSheetPlano['wasteCutLength'];
                        $resultAllSheetPlano['planoWidth_extra_1'] = $resultAllSheetPlano['planoWidth'];

                        $resultAllSheetPlano['planoLength_extra_2'] = $resultAllSheetPlano['cutSheetLength'];
                        $resultAllSheetPlano['planoWidth_extra_2'] = $resultAllSheetPlano['wasteCutWidth'];
                    } elseif ($resultAllSheetPlano['wasteCutWidth'] >= $resultAllSheetPlano['sheetLength']) {
                        $resultAllSheetPlano['planoLength_extra_1'] = $resultAllSheetPlano['wasteCutLength'];
                        $resultAllSheetPlano['planoWidth_extra_1'] = $resultAllSheetPlano['cutSheetWidth'];

                        $resultAllSheetPlano['planoLength_extra_2'] = $resultAllSheetPlano['planoLength'];
                        $resultAllSheetPlano['planoWidth_extra_2'] = $resultAllSheetPlano['wasteCutWidth'];
                    } else {
                        // Inisialisasi nilai tambahan dengan null
                        $resultAllSheetPlano['planoLength_extra_1'] = null;
                        $resultAllSheetPlano['planoWidth_extra_1'] = null;
                        $resultAllSheetPlano['planoLength_extra_2'] = null;
                        $resultAllSheetPlano['planoWidth_extra_2'] = null;
                    }

                    $resultAllSheetPlano['col_extra_1'] = floor($resultAllSheetPlano['planoLength_extra_1'] / $resultAllSheetPlano['sheetWidth']);
                    $resultAllSheetPlano['row_extra_1'] = floor($resultAllSheetPlano['planoWidth_extra_1'] / $resultAllSheetPlano['sheetLength']);
                    $resultAllSheetPlano['item_per_plano_extra_1'] = $resultAllSheetPlano['itemsPerSheet'] * ((int) $resultAllSheetPlano['col_extra_1'] * (int) $resultAllSheetPlano['row_extra_1']);

                    $resultAllSheetPlano['col_extra_2'] = floor($resultAllSheetPlano['planoLength_extra_2'] / $resultAllSheetPlano['sheetWidth']);
                    $resultAllSheetPlano['row_extra_2'] = floor($resultAllSheetPlano['planoWidth_extra_2'] / $resultAllSheetPlano['sheetLength']);
                    $resultAllSheetPlano['item_per_plano_extra_2'] = $resultAllSheetPlano['itemsPerSheet'] * ((int) $resultAllSheetPlano['col_extra_2'] * (int) $resultAllSheetPlano['row_extra_2']);

                    $results[] = $resultAllSheetPlano;
                }
            }
        }

        $maxTotalItems = 0;
        $selectedDataPlano = null;
        $bestDimensionPlano = [];
        foreach ($results as $dataPlano) {
            $totalItems = $dataPlano['itemsPerPlano'] + $dataPlano['item_per_plano_extra_1'] + $dataPlano['item_per_plano_extra_2'];

            if ($totalItems > $maxTotalItems) {
                $totalPlano = $this->quantityItems / $totalItems;
                $totalPlano = (int) ceil($totalPlano);
                if ($totalPlano != floor($totalPlano)) {
                    $totalPlano += 1;
                }

                $bestDimensionPlano = [
                    'col' => (int) $dataPlano['col'],
                    'row' => (int) $dataPlano['row'],
                    'planoLength' => (float) $dataPlano['planoLength'],
                    'planoWidth' => (float) $dataPlano['planoWidth'],
                    'sheetLength' => (float) $dataPlano['sheetLength'],
                    'sheetWidth' => (float) $dataPlano['sheetWidth'],
                    'cutSheetLength' => (float) $dataPlano['cutSheetLength'],
                    'cutSheetWidth' => (float) $dataPlano['cutSheetWidth'],
                    'totalItems' => (int) $totalItems,

                    'planoLength_extra_1' => (int) $dataPlano['planoLength_extra_1'],
                    'planoWidth_extra_1' => (int) $dataPlano['planoWidth_extra_1'],
                    'col_extra_1' => (int) $dataPlano['col_extra_1'],
                    'row_extra_1' => (int) $dataPlano['row_extra_1'],
                    'item_per_plano_extra_1' => (int) $dataPlano['item_per_plano_extra_1'],

                    'planoLength_extra_2' => (int) $dataPlano['planoLength_extra_2'],
                    'planoWidth_extra_2' => (int) $dataPlano['planoWidth_extra_2'],
                    'col_extra_2' => (int) $dataPlano['col_extra_2'],
                    'row_extra_2' => (int) $dataPlano['row_extra_2'],
                    'item_per_plano_extra_2' => (int) $dataPlano['item_per_plano_extra_2'],

                    'totalPlano' => (int) $totalPlano,
                ];
            }
        }

        $this->dispatch('createLayoutBahanAutoRotate', $bestDimensionPlano);

        return $bestDimensionPlano;
    }

    private function calculateNumSheetsAutoRotateSizeSheetInPlano($resultAllSheet, $planoLength, $planoWidth)
    {
        $results = [];

        foreach ($resultAllSheet as $data) {
            $sheetLength = $data['sheetLength'];
            $sheetWidth = $data['sheetWidth'];
            $itemsPerSheet = $data['itemsPerSheet'];

            if ($data['orientationSheet'] == 'landscape') {
                [$sheetLength, $sheetWidth] = [$sheetLength, $sheetWidth];
            } elseif ($data['orientationSheet'] == 'potrait') {
                [$sheetLength, $sheetWidth] = [$sheetWidth, $sheetLength];
            }

            $max_col = floor($planoLength / $sheetLength);
            $max_row = floor($planoWidth / $sheetWidth);

            // Initialize row counter
            $row_counter = 0;

            // Run the while loop until maximum row is reached
            while ($row_counter < $max_row) {
                // Increment row counter
                $row_counter++;

                // Initialize col counter
                $col_counter = 0;

                // Reset sheetLength and sheetWidth for each new row
                $cutSheetLength = 0;
                $cutSheetWidth = 0;

                // Run the while loop until maximum col is reached
                while ($col_counter < $max_col) {
                    // Increment col counter
                    $col_counter++;

                    // Increment sheetLength and sheetWidth based on col and row counters
                    $cutSheetLength = $sheetLength * $col_counter;
                    $cutSheetWidth = $sheetWidth * $row_counter;

                    if ($cutSheetLength <= $planoLength && $cutSheetWidth <= $planoWidth) {
                        $dataPlano = [
                            'colSheet' => (int) $data['col'],
                            'rowSheet' => (int) $data['row'],
                            'col' => (int) $col_counter,
                            'row' => (int) $row_counter,
                            'planoLength' => (float) $planoLength,
                            'planoWidth' => (float) $planoWidth,
                            'sheetLength' => (float) $sheetLength,
                            'sheetWidth' => (float) $sheetWidth,
                            'cutSheetLength' => (float) $cutSheetLength,
                            'cutSheetWidth' => (float) $cutSheetWidth,
                            'wasteCutLength' => (float) $planoLength - $cutSheetLength,
                            'wasteCutWidth' => (float) $planoWidth - $cutSheetWidth,
                            'orientationSheet' => $data['orientationSheet'],
                            'itemsPerSheet' => (int) $data['itemsPerSheet'],

                            //item
                            'itemsLength' => $data['itemsLength'],
                            'itemsWidth' => $data['itemsWidth'],
                            'gapBetweenItems' => $data['gapBetweenItems'],
                            'sheetMarginTop' => $data['sheetMarginTop'],
                            'sheetMarginBottom' => $data['sheetMarginBottom'],
                            'sheetMarginLeft' => $data['sheetMarginLeft'],
                            'sheetMarginRight' => $data['sheetMarginRight'],
                        ];

                        // Logika penentuan nilai tambahan
                        if ($dataPlano['wasteCutLength'] >= $dataPlano['sheetWidth']) {
                            $dataPlano['planoLength_extra_1'] = $dataPlano['wasteCutLength'];
                            $dataPlano['planoWidth_extra_1'] = $dataPlano['planoWidth'];

                            $dataPlano['planoLength_extra_2'] = $dataPlano['cutSheetLength'];
                            $dataPlano['planoWidth_extra_2'] = $dataPlano['wasteCutWidth'];
                        } elseif ($dataPlano['wasteCutWidth'] >= $dataPlano['sheetLength']) {
                            $dataPlano['planoLength_extra_1'] = $dataPlano['wasteCutLength'];
                            $dataPlano['planoWidth_extra_1'] = $dataPlano['cutSheetWidth'];

                            $dataPlano['planoLength_extra_2'] = $dataPlano['planoLength'];
                            $dataPlano['planoWidth_extra_2'] = $dataPlano['wasteCutWidth'];
                        } else {
                            // Inisialisasi nilai tambahan dengan null
                            $dataPlano['planoLength_extra_1'] = null;
                            $dataPlano['planoWidth_extra_1'] = null;
                            $dataPlano['planoLength_extra_2'] = null;
                            $dataPlano['planoWidth_extra_2'] = null;
                        }

                        $dataPlano['col_extra_1'] = floor($dataPlano['planoLength_extra_1'] / $dataPlano['sheetWidth']);
                        $dataPlano['row_extra_1'] = floor($dataPlano['planoWidth_extra_1'] / $dataPlano['sheetLength']);
                        $dataPlano['item_per_plano_extra_1'] = $dataPlano['itemsPerSheet'] * ((int) $dataPlano['col_extra_1'] * (int) $dataPlano['row_extra_1']);
                        $dataPlano['waste_length_extra_1'] = $dataPlano['planoLength_extra_1'] - $dataPlano['col_extra_1'] * $dataPlano['sheetWidth'];
                        $dataPlano['waste_width_extra_1'] = $dataPlano['planoWidth_extra_1'] - $dataPlano['row_extra_1'] * $dataPlano['sheetLength'];

                        $dataPlano['col_extra_2'] = floor($dataPlano['planoLength_extra_2'] / $dataPlano['sheetLength']);
                        $dataPlano['row_extra_2'] = floor($dataPlano['planoWidth_extra_2'] / $dataPlano['sheetWidth']);
                        $dataPlano['item_per_plano_extra_2'] = $dataPlano['itemsPerSheet'] * ((int) $dataPlano['col_extra_2'] * (int) $dataPlano['row_extra_2']);
                        $dataPlano['waste_length_extra_2'] = $dataPlano['planoLength_extra_2'] - $dataPlano['col_extra_2'] * $dataPlano['sheetLength'];
                        $dataPlano['waste_width_extra_2'] = $dataPlano['planoWidth_extra_2'] - $dataPlano['row_extra_2'] * $dataPlano['sheetWidth'];

                        foreach ($resultAllSheet as $item) {
                            if ($item['sheetWidth'] >= $dataPlano['waste_length_extra_1'] && $dataPlano['orientationSheet'] == $item['orientationSheet']) {
                                $dataPlano['col_extra_3'] = floor($dataPlano['waste_length_extra_1'] / $item['sheetWidth']);
                                $dataPlano['row_extra_3'] = floor($dataPlano['waste_width_extra_1'] / $item['sheetLength']);
                                $dataPlano['item_per_plano_extra_3'] = $item['itemsPerSheet'] * ((int) $dataPlano['col_extra_3'] * (int) $dataPlano['row_extra_3']);
                            } else {
                                $dataPlano['col_extra_3'] = null;
                                $dataPlano['row_extra_3'] = null;
                                $dataPlano['item_per_plano_extra_3'] = null;
                            }
                            if ($item['sheetLength'] >= $dataPlano['waste_length_extra_2'] && $dataPlano['orientationSheet'] == $item['orientationSheet']) {
                                $dataPlano['col_extra_4'] = floor($dataPlano['waste_length_extra_2'] / $item['sheetWidth']);
                                $dataPlano['row_extra_4'] = floor($dataPlano['waste_width_extra_2'] / $item['sheetLength']);
                                $dataPlano['item_per_plano_extra_4'] = $item['itemsPerSheet'] * ((int) $dataPlano['col_extra_4'] * (int) $dataPlano['row_extra_4']);
                            } else {
                                $dataPlano['col_extra_4'] = null;
                                $dataPlano['row_extra_4'] = null;
                                $dataPlano['item_per_plano_extra_4'] = null;
                            }
                        }

                        $dataPlano['totalItems'] = $dataPlano['colSheet'] * $dataPlano['rowSheet'] + ((int) $dataPlano['item_per_plano_extra_1'] + (int) $dataPlano['item_per_plano_extra_2'] + (int) $dataPlano['item_per_plano_extra_3'] + (int) $dataPlano['item_per_plano_extra_4']);

                        $results[] = $dataPlano;
                    }
                }
            }
        }

        $maxTotalItems = 0;
        $bestDimensionPlano = [];

        foreach ($results as $dataPlano) {
            $totalItems = $dataPlano['totalItems'];

            // Perbarui jika totalItems lebih besar dari $maxTotalItems
            if ($totalItems > $maxTotalItems) {
                $maxTotalItems = $totalItems;
                $totalPlano = $this->quantityItems / $totalItems;
                $totalPlano = (int) ceil($totalPlano);
                if ($totalPlano != floor($totalPlano)) {
                    $totalPlano += 1;
                }
                $bestDimensionPlano = [
                    'colSheet' => (int) $dataPlano['colSheet'],
                    'rowSheet' => (int) $dataPlano['rowSheet'],
                    'col' => (int) $dataPlano['col'],
                    'row' => (int) $dataPlano['row'],
                    'planoLength' => (float) $dataPlano['planoLength'],
                    'planoWidth' => (float) $dataPlano['planoWidth'],
                    'sheetLength' => (float) $dataPlano['sheetLength'],
                    'sheetWidth' => (float) $dataPlano['sheetWidth'],
                    'cutSheetLength' => (float) $dataPlano['cutSheetLength'],
                    'cutSheetWidth' => (float) $dataPlano['cutSheetWidth'],
                    'itemsPerSheet' => (int) $dataPlano['itemsPerSheet'],
                    'orientationSheet' => $dataPlano['orientationSheet'],
                    'itemsPerPlano' => (int) $dataPlano['itemsPerSheet'] * ($dataPlano['col'] * $dataPlano['row']),
                    'totalItems' => (int) $totalItems,

                    'planoLength_extra_1' => (int) $dataPlano['planoLength_extra_1'],
                    'planoWidth_extra_1' => (int) $dataPlano['planoWidth_extra_1'],
                    'col_extra_1' => (int) $dataPlano['col_extra_1'],
                    'row_extra_1' => (int) $dataPlano['row_extra_1'],
                    'item_per_plano_extra_1' => (int) $dataPlano['item_per_plano_extra_1'],

                    'planoLength_extra_2' => (int) $dataPlano['planoLength_extra_2'],
                    'planoWidth_extra_2' => (int) $dataPlano['planoWidth_extra_2'],
                    'col_extra_2' => (int) $dataPlano['col_extra_2'],
                    'row_extra_2' => (int) $dataPlano['row_extra_2'],
                    'item_per_plano_extra_2' => (int) $dataPlano['item_per_plano_extra_2'],

                    'col_extra_3' => (int) $dataPlano['col_extra_3'],
                    'row_extra_3' => (int) $dataPlano['row_extra_3'],
                    'item_per_plano_extra_3' => (int) $dataPlano['item_per_plano_extra_3'],

                    'col_extra_4' => (int) $dataPlano['col_extra_4'],
                    'row_extra_4' => (int) $dataPlano['row_extra_4'],
                    'item_per_plano_extra_4' => (int) $dataPlano['item_per_plano_extra_4'],

                    'itemsLength' => $dataPlano['itemsLength'],
                    'itemsWidth' => $dataPlano['itemsWidth'],
                    'gapBetweenItems' => $dataPlano['gapBetweenItems'],
                    'sheetMarginTop' => $dataPlano['sheetMarginTop'],
                    'sheetMarginBottom' => $dataPlano['sheetMarginBottom'],
                    'sheetMarginLeft' => $dataPlano['sheetMarginLeft'],
                    'sheetMarginRight' => $dataPlano['sheetMarginRight'],

                    'totalPlano' => (int) $totalPlano,
                ];
            }
        }

        $this->dispatch('createLayoutBahanAutoRotateSheet', $bestDimensionPlano);
        $this->dispatch('createLayoutSettingAutoRotate', $bestDimensionPlano);

        return $bestDimensionPlano;
    }

    public function calculate()
    {
        $this->validate();
        $this->showPreviewSetting = false;
        $this->showCanvasSetting = true;
        $this->showPreviewBahan = false;
        $this->showCanvasBahan = true;

        // //hitungJarakAntarBarang
        if ($this->pondSelected === 'Y' && $this->potongJadiSelected === 'N' && $this->jarakPotongJadiSelected === 'N') {
            $this->gapBetweenItems = 0.4;
        } elseif ($this->pondSelected === 'Y' && $this->potongJadiSelected === 'Y' && $this->jarakPotongJadiSelected === 'N') {
            $this->gapBetweenItems = 0.2;
        } elseif ($this->pondSelected === 'Y' && $this->potongJadiSelected === 'Y' && $this->jarakPotongJadiSelected === 'Y') {
            $this->gapBetweenItems = 0.2;
        } elseif ($this->pondSelected === 'N' && $this->potongJadiSelected === 'Y' && $this->jarakPotongJadiSelected === 'Y') {
            $this->gapBetweenItems = 0.2;
        } elseif ($this->pondSelected === 'N' && $this->potongJadiSelected === 'Y' && $this->jarakPotongJadiSelected === 'N') {
            $this->gapBetweenItems = 0;
        } else {
            $this->gapBetweenItems = 0;
        }

        $machine = Machine::find($this->machineSelected);

        $this->minimalLengthSheet = $machine->panjang_area_cetak_minimal;
        $this->minimalWidthSheet = $machine->lebar_area_cetak_minimal;
        $this->maximalLengthSheet = $machine->panjang_area_cetak_maximal;
        $this->maximalWidthSheet = $machine->lebar_area_cetak_maximal;
        $this->maximalLengthBahan = $machine->panjang_maximal_bahan;
        $this->maximalWidthBahan = $machine->lebar_maximal_bahan;

        if ($this->orientationSheet == 'landscape') {
            $resultSheetLandscape = $this->calculateSheetDimensions($this->itemsLength, $this->itemsWidth, $this->gapBetweenItems, $this->minimalLengthSheet, $this->minimalWidthSheet, $this->maximalLengthSheet, $this->maximalWidthSheet, $this->sheetMarginTop, $this->sheetMarginBottom, $this->sheetMarginLeft, $this->sheetMarginRight, $this->orientationSheet);
            $this->detailResultSetting = $resultSheetLandscape;

            if ($this->orientationPlano == 'landscape') {
                $resultPlanoLandscape = $this->calculateNumSheetsInPlano($resultSheetLandscape['sheetLength'], $resultSheetLandscape['sheetWidth'], $resultSheetLandscape['itemsPerSheet'], $this->planoLength, $this->planoWidth, $this->orientationPlano);
                $this->detailResultBahan = $resultPlanoLandscape;
            } elseif ($this->orientationPlano == 'potrait') {
                $resultPlanoPotrait = $this->calculateNumSheetsInPlano($resultSheetLandscape['sheetLength'], $resultSheetLandscape['sheetWidth'], $resultSheetLandscape['itemsPerSheet'], $this->planoLength, $this->planoWidth, $this->orientationPlano);
                $this->detailResultBahan = $resultPlanoPotrait;
            } else {
                $resultAllSheetLandscape = $this->calculateSheetDimensions($this->itemsLength, $this->itemsWidth, $this->gapBetweenItems, $this->minimalLengthSheet, $this->minimalWidthSheet, $this->maximalLengthSheet, $this->maximalWidthSheet, $this->sheetMarginTop, $this->sheetMarginBottom, $this->sheetMarginLeft, $this->sheetMarginRight, $this->orientationSheet);
                $resultAllPlanoLandscape = $this->calculateNumSheetsAutoRotateInPlano($resultAllSheetLandscape, $this->planoLength, $this->planoWidth, 'landscape');
                $this->detailResultBahan = $resultAllPlanoLandscape;
            }
        } elseif ($this->orientationSheet == 'potrait') {
            $resultSheetPotrait = $this->calculateSheetDimensions($this->itemsLength, $this->itemsWidth, $this->gapBetweenItems, $this->minimalLengthSheet, $this->minimalWidthSheet, $this->maximalLengthSheet, $this->maximalWidthSheet, $this->sheetMarginTop, $this->sheetMarginBottom, $this->sheetMarginLeft, $this->sheetMarginRight, $this->orientationSheet);
            $this->detailResultSetting = $resultSheetPotrait;

            if ($this->orientationPlano == 'landscape') {
                $resultPlanoLandscape = $this->calculateNumSheetsInPlano($resultSheetPotrait['sheetLength'], $resultSheetPotrait['sheetWidth'], $resultSheetPotrait['itemsPerSheet'], $this->planoLength, $this->planoWidth, $this->orientationPlano);
                $this->detailResultBahan = $resultPlanoLandscape;
            } elseif ($this->orientationPlano == 'potrait') {
                $resultPlanoPotrait = $this->calculateNumSheetsInPlano($resultSheetPotrait['sheetLength'], $resultSheetPotrait['sheetWidth'], $resultSheetPotrait['itemsPerSheet'], $this->planoLength, $this->planoWidth, $this->orientationPlano);
                $this->detailResultBahan = $resultPlanoPotrait;
            } else {
                $resultAllSheetPotrait = $this->calculateSheetDimensions($this->itemsLength, $this->itemsWidth, $this->gapBetweenItems, $this->minimalLengthSheet, $this->minimalWidthSheet, $this->maximalLengthSheet, $this->maximalWidthSheet, $this->sheetMarginTop, $this->sheetMarginBottom, $this->sheetMarginLeft, $this->sheetMarginRight, $this->orientationSheet);
                $resultAllPlanoPotrait = $this->calculateNumSheetsAutoRotateInPlano($resultAllSheetPotrait, $this->planoLength, $this->planoWidth, 'potrait');
            }
        } else {
            $resultSheetLandscape = $this->calculateAllSheetDimensions($this->itemsLength, $this->itemsWidth, $this->gapBetweenItems, $this->minimalLengthSheet, $this->minimalWidthSheet, $this->maximalLengthSheet, $this->maximalWidthSheet, $this->sheetMarginTop, $this->sheetMarginBottom, $this->sheetMarginLeft, $this->sheetMarginRight, 'landscape');
            $resultSheetPotrait = $this->calculateAllSheetDimensions($this->itemsLength, $this->itemsWidth, $this->gapBetweenItems, $this->minimalLengthSheet, $this->minimalWidthSheet, $this->maximalLengthSheet, $this->maximalWidthSheet, $this->sheetMarginTop, $this->sheetMarginBottom, $this->sheetMarginLeft, $this->sheetMarginRight, 'potrait');
            $resultAllSheet = array_merge($resultSheetLandscape, $resultSheetPotrait);

            $resultAllPlanoPotrait = $this->calculateNumSheetsAutoRotateSizeSheetInPlano($resultAllSheet, $this->planoLength, $this->planoWidth);

            $this->detailResultSetting = $resultAllPlanoPotrait;
            $this->detailResultBahan = $resultAllPlanoPotrait;
        }

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
        $this->showCanvasSetting = false;
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
        $this->showCanvasBahan = false;
    }

    public function setLayoutBahanDataJson($dataJson)
    {
        $this->layoutBahanDataJson = $dataJson;
    }

    public function saveToForm()
    {
        try {
            DB::beginTransaction();
            $createLayoutSetting = LayoutSetting::create([
                'instruction_id' => $this->spk->id,
                'sortorder' => 1,
                'state' => null,
                'panjang_barang_jadi' => $this->detailResultSetting['itemsLength'],
                'lebar_barang_jadi' => $this->detailResultSetting['itemsWidth'],
                'panjang_naik' => $this->detailResultSetting['col'],
                'lebar_naik' => $this->detailResultSetting['row'],
                'jarak_panjang' => $this->detailResultSetting['gapBetweenItems'],
                'jarak_lebar' => $this->detailResultSetting['gapBetweenItems'],
                'sisi_atas' => $this->detailResultSetting['sheetMarginTop'],
                'sisi_bawah' => $this->detailResultSetting['sheetMarginBottom'],
                'sisi_kiri' => $this->detailResultSetting['sheetMarginLeft'],
                'sisi_kanan' => $this->detailResultSetting['sheetMarginRight'],
                'jarak_tambahan_vertical' => null,
                'jarak_tambahan_horizontal' => null,
                'dataJSON' => $this->layoutSettingDataJson,
            ]);

            $createLayoutBahan = LayoutBahan::create([
                'instruction_id' => $this->spk->id,
                'sortorder' => 1,
                'state' => null,
                'include_belakang' => null,
                'panjang_plano' => $this->detailResultBahan['planoLength'],
                'lebar_plano' => $this->detailResultBahan['planoWidth'],
                'panjang_lembar_cetak' => $this->detailResultBahan['sheetLength'],
                'lebar_lembar_cetak' => $this->detailResultBahan['sheetWidth'],
                'jenis_bahan' => null,
                'gramasi' => null,
                'one_plano' => $this->detailResultBahan['totalItems'],
                'sumber_bahan' => null,
                'merk_bahan' => null,
                'supplier' => null,
                'jumlah_lembar_cetak' => null,
                'jumlah_incit' => null,
                'total_lembar_cetak' => null,
                'harga_bahan' => null,
                'jumlah_bahan' => $this->detailResultBahan['totalPlano'],
                'panjang_sisa_bahan' => null,
                'lebar_sisa_bahan' => null,
                'dataJSON' => $this->layoutBahanDataJson,
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan !!! ' . $th->getMessage());
        }
    }
}
