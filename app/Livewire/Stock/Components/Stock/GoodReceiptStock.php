<?php

namespace App\Livewire\Stock\Components\Stock;

use App\Models\Stock;
use App\Models\Product;
use Livewire\Component;
use App\Models\Accessory;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\DB;

#[Title('Good Receipt Stock')]
class GoodReceiptStock extends Component
{
    public $accessories = [];
    public $productSelected, $totalQuantity, $sender, $recipient, $catatan, $rak, $baris;

    public function addAccessoryInput()
    {
        $this->accessories[] = ['id' => null, 'quantity' => null];
    }

    public function render()
    {
        return view('livewire.stock.components.stock.good-receipt-stock', [
            'products' => Product::all(),
            'dataAccessories' => Accessory::all(),
        ]);
    }

    public function store()
    {
        $this->validate(
            [
                'productSelected' => 'required',
                'totalQuantity' => 'required',
                'sender' => 'required',
                'recipient' => 'required',
                'rak' => 'required',
                'baris' => 'required',
            ],
            [
                'productSelected.required' => 'Product harus diisi.',
                'totalQuantity.required' => 'Total Quantity harus diisi.',
                'sender.required' => 'Sender harus diisi.',
                'recipient.required' => 'Receipient harus diisi.',
                'rak.required' => 'Rak harus diisi.',
                'baris.required' => 'Baris harus diisi.',
            ],
        );

        try {
            DB::beginTransaction();

            $product = Product::find($this->productSelected);

            $stock = Stock::create([
                'product_id' => $this->productSelected,
                'total_quantity' => $this->totalQuantity,
                'giver' => $this->sender,
                'receiver' => $this->recipient,
                'rack' => $this->rak,
                'row' => $this->baris,
                // 'catatan' => $this->catatan,
            ]);

            // Attach accessories to the pivot table
            foreach ($this->accessories as $accessory) {

                $product->accessories()->attach($accessory['id'], $accessory['quantity']);
            }

            DB::commit();

            $this->redirectRoute('goodReceiptStock.Stock');
            session()->flash('success', 'Data berhasil disimpan.');
        } catch (Throwable $th) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan !!! ' . $th->getMessage());
        }
    }
}
