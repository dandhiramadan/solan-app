<?php

namespace App\Livewire\Stock\Components\Product;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Management Accessories')]
class ManagementAccessories extends Component
{
    public function render()
    {
        return view('livewire.stock.components.product.management-accessories');
    }
}
