<?php

namespace App\Livewire\Stock\Components\Product;

use Livewire\Component;
use App\Models\Accessory;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('Management Accessories')]
class ManagementAccessories extends Component
{
    use WithPagination;
    public $search;
    public $paginate = 5;

    public function updateSearch($search)
    {
        $this->search = $search;
    }

    public function updatePaginate($show)
    {
        $this->paginate = $show;
    }

    public function render()
    {
        return view('livewire.stock.components.product.management-accessories', [
            'accessories' => Accessory::search($this->search)->paginate($this->paginate),
        ]);
    }
}
