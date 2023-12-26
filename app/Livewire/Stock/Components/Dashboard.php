<?php

namespace App\Livewire\Stock\Components;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.stock.components.dashboard');
    }
}
