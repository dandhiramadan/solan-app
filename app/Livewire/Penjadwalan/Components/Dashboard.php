<?php

namespace App\Livewire\Penjadwalan\Components;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.penjadwalan.components.dashboard');
    }
}
