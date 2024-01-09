<?php

namespace App\Livewire\HitungBahan\Components;

use Livewire\Component;
use App\Models\Instruction;
use Livewire\Attributes\Title;

#[Title('Form Hitung Bahan')]
class FormHitungBahan extends Component
{
    public $spk;
    public $resultLayoutSetting = [];
    public $noFormLayoutSetting = 1;
    public $resultLayoutBahan = [];
    public $noFormLayoutBahan = 1;

    public function mount($state, $id)
    {
        $spk = Instruction::with([
            'layoutSetting' => function ($query) {
                $query->orderBy('sortorder');
            },
            'layoutBahan' => function ($query) {
                $query->orderBy('sortorder');
            },
        ])->find($id);

        $this->spk = $spk;

        foreach ($spk->layoutSetting as $data) {
            $dataLayoutSetting[] = [
                'noFormLayoutSetting' => $this->noFormLayoutSetting,
                'state' => $data['state'],
                'itemsLength' => $data['panjang_barang_jadi'],
                'itemsWidth' => $data['lebar_barang_jadi'],
                'sheetLength' => $data['panjang_lembar_cetak'],
                'sheetWidth' => $data['lebar_lembar_cetak'],
                'colomnItems' => $data['panjang_naik'],
                'rowItems' => $data['lebar_naik'],
                'gapBetweenLengthItems' => $data['jarak_panjang'],
                'gapBetweenWidthItems' => $data['jarak_lebar'],
                'marginTop' => $data['sisi_atas'],
                'marginBottom' => $data['sisi_bawah'],
                'marginLeft' => $data['sisi_kiri'],
                'marginRight' => $data['sisi_kanan'],
                'gapVertical' => $data['sisi_kanan'],
                'gapHorizontal' => $data['sisi_kanan'],
                'dataURL' => null,
                'dataJSON' => $data['dataJSON'],
            ];

            $this->resultLayoutSetting = $dataLayoutSetting;
            $this->noFormLayoutSetting++;
        }

        foreach($spk->layoutBahan as $data) {

            $dataLayoutBahan[] = [
                'noFormLayoutBahan' => $this->noFormLayoutBahan,
                'state' => $data['state'],
                'planoLength' => $data['panjang_plano'],
                'planoWidth' => $data['lebar_plano'],
                'sheetSize' => json_decode($data['lembar_cetak'], true),
                // 'sheetLength' => $data['panjang_bahan_cetak'],
                // 'sheetWidth' => $data['lebar_bahan_cetak'],
                // 'colomnItems' => $data['panjang_naik'],
                // 'rowItems' => $data['lebar_naik'],
                // 'gapBetweenLengthItems' => $data['jarak_panjang'],
                // 'gapBetweenWidthItems' => $data['jarak_lebar'],
                // 'marginTop' => $data['sisi_atas'],
                // 'marginBottom' => $data['sisi_bawah'],
                // 'marginLeft' => $data['sisi_kiri'],
                // 'marginRight' => $data['sisi_kanan'],
                // 'gapVertical' => $data['sisi_kanan'],
                // 'gapHorizontal' => $data['sisi_kanan'],
                'dataURL' => null,
                'dataJSON' => $data['dataJSON'],
            ];

            $this->resultLayoutBahan = $dataLayoutBahan;
            $this->noFormLayoutBahan++;
        }

        // dd($this->resultLayoutBahan);
    }

    public function addFormSetting()
    {
        $this->resultLayoutSetting[] = [
            'noFormLayoutSetting' => $this->noFormLayoutSetting,
            'state' => null,
            'itemsLength' => null,
            'itemsWidth' => null,
            'sheetLength' => null,
            'sheetWidth' => null,
            'colomnItems' => null,
            'rowItems' => null,
            'gapBetweenLengthItems' => null,
            'gapBetweenWidthItems' => null,
            'marginTop' => null,
            'marginBottom' => null,
            'marginLeft' => null,
            'marginRight' => null,
            'gapVertical' => null,
            'gapHorizontal' => null,
            'dataURL' => null,
            'dataJSON' => null,
        ];

        $this->noFormLayoutSetting++;
    }

    public function render()
    {
        return view('livewire.hitung-bahan.components.form-hitung-bahan');
    }

    public function store()
    {
        $this->validate([
            'resultLayoutSetting.*.state' => 'required',
            'resultLayoutSetting.*.noFormLayoutSetting' => 'required|integer',
            'resultLayoutSetting.*.itemsLength' => 'required|numeric',
            'resultLayoutSetting.*.itemsWidth' => 'required|numeric',
            'resultLayoutSetting.*.sheetLength' => 'required|numeric',
            'resultLayoutSetting.*.sheetWidth' => 'required|numeric',
            'resultLayoutSetting.*.colomnItems' => 'required|integer',
            'resultLayoutSetting.*.rowItems' => 'required|integer',
            'resultLayoutSetting.*.gapBetweenLengthItems' => 'required|numeric',
            'resultLayoutSetting.*.gapBetweenWidthItems' => 'required|numeric',
            'resultLayoutSetting.*.marginTop' => 'required|numeric',
            'resultLayoutSetting.*.marginBottom' => 'required|numeric',
            'resultLayoutSetting.*.marginLeft' => 'required|numeric',
            'resultLayoutSetting.*.marginRight' => 'required|numeric',
            'resultLayoutSetting.*.gapVertical' => 'required|numeric',
            'resultLayoutSetting.*.gapHorizontal' => 'required|numeric',
        ]);
    }
}
