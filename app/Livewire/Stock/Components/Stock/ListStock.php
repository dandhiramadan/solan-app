<?php

namespace App\Livewire\Stock\Components\Stock;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('List Stock')]
class ListStock extends Component
{
    public function render()
    {
        return view('livewire.stock.components.stock.list-stock');
    }
}
