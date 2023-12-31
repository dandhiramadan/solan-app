<?php

namespace App\Livewire\Stock\Components\Product;

use App\Models\Product;
use Livewire\Component;
use App\Models\Customer;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('Management Product')]
class ManagementProducts extends Component
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
        return view('livewire.stock.components.product.management-products',[
            'customer' => Customer::all(),
            'products' => Product::search($this->search)->paginate($this->paginate),
        ]);
    }


}
