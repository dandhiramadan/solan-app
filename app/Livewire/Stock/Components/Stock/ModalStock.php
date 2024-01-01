<?php

namespace App\Livewire\Stock\Components\Stock;

use App\Models\Product;
use Livewire\Component;
use App\Models\Customer;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;

class ModalStock extends Component
{
    public $title,
        $dataStock = [];
    public $name, $customerSelected, $panjang, $lebar, $catatan;

    #[On('show-modal-details')]
    public function openModalDetails($title, $id)
    {
        $this->reset();
        $this->title = $title;
        $dataStock = Product::with('accessories', 'stocks')
            ->where('id', $id)
            ->get();

        $dataTransformed = [];

        foreach ($dataStock as $item) {
            foreach ($item['stocks'] as $key => $stock) {
                $dataTransformed[] = [
                    'quantity' => $stock->pivot->quantity,
                    'description' => $item['accessories'][$key]['description'],
                    'receiver' => $stock->receiver,
                    'giver' => $stock->giver,
                    'rack' => $stock->rack,
                    'row' => $stock->row,
                ];
            }
        }

        $this->dataStock = $dataTransformed;

        $product = Product::find($id);
        $this->name = $product->name;
        $this->customerSelected = $product->customer_name;
        $this->panjang = $product->panjang;
        $this->lebar = $product->lebar;
        $this->catatan = $product->catatan;
    }

    public function render()
    {
        return view('livewire.stock.components.stock.modal-stock', [
            'customer' => Customer::all(),
        ]);
    }
}