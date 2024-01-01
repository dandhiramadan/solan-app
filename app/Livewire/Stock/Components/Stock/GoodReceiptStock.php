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
    public $productSelected, $sender, $recipient, $catatan, $rak, $baris;

    public function addAccessoryInput()
    {
        $this->accessories[] = ['id' => null, 'quantity' => null];
    }

    public function removeAccessoryInput($key)
    {
        unset($this->accessories[$key]);
        $this->accessories = array_values($this->accessories);
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
                'sender' => 'required',
                'recipient' => 'required',
                'rak' => 'required',
                'baris' => 'required',
                'accessories.*.id' => 'required',
                'accessories.*.quantity' => 'required',
            ],
            [
                'productSelected.required' => 'Product harus diisi.',
                'sender.required' => 'Sender harus diisi.',
                'recipient.required' => 'Receipient harus diisi.',
                'rak.required' => 'Rak harus diisi.',
                'baris.required' => 'Baris harus diisi.',
                'accessories.*.id.required' => 'Kondisi harus diisi',
                'accessories.*.id.quantity' => 'Quantity harus diisi',
            ],
        );

        try {
            DB::beginTransaction();

            $product = Product::find($this->productSelected);

            $stock = Stock::create([
                'giver' => $this->sender,
                'receiver' => $this->recipient,
                'rack' => $this->rak,
                'row' => $this->baris,
                'type' => 'In',
                'catatan' => $this->catatan,
            ]);

            // Attach accessories to the pivot table
            foreach ($this->accessories as $accessory) {
                $product->accessories()->attach($accessory['id'], ['product_id' => $product->id, 'stock_id' => $stock->id, 'quantity' => $accessory['quantity']]);
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
