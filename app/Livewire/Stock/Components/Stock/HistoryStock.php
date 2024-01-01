<?php

namespace App\Livewire\Stock\Components\Stock;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('History Stock')]
class HistoryStock extends Component
{
    public function render()
    {
        return view('livewire.stock.components.stock.history-stock');
    }
}
