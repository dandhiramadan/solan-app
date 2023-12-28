<?php

namespace App\Livewire\HitungBahan\Components;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Form Hitung Bahan')]
class FormHitungBahan extends Component
{
    public function render()
    {
        return view('livewire.hitung-bahan.components.form-hitung-bahan');
    }
}
