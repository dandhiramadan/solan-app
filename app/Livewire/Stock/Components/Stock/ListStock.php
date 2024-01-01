<?php

namespace App\Livewire\Stock\Components\Stock;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('List Stock')]
class ListStock extends Component
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
        return view('livewire.stock.components.stock.list-stock', [
            'products' => Product::with('accessories', 'stocks')->search($this->search)->paginate($this->paginate),
        ]);
    }
}
