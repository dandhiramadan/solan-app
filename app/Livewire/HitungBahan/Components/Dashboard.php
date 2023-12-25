<?php

namespace App\Livewire\HitungBahan\Components;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.hitung-bahan.components.dashboard');
    }
}
