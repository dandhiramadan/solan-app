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

    public function mount($state, $id)
    {
        $spk = Instruction::with([
            'layoutSetting' => function ($query) {
                $query->orderBy('sortorder');
            },
        ])->find($id);
        $this->spk = $spk;

        foreach ($spk->layoutSetting as $data) {
            $dataLayoutSetting[] = [
                'noFormLayoutSetting' => $this->noFormLayoutSetting,
                'dataJSON' => $data['dataJSON'],
            ];

            $this->resultLayoutSetting = $dataLayoutSetting;
            $this->noFormLayoutSetting++;
        }
    }

    public function render()
    {
        return view('livewire.hitung-bahan.components.form-hitung-bahan');
    }
}
