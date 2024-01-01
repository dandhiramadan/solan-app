<?php

namespace App\Livewire\Stock\Components\Stock;

use App\Models\Stock;
use App\Models\Product;
use Livewire\Component;
use App\Models\LogStock;
use App\Models\Accessory;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\DB;

#[Title('Good Receipt Stock')]
class GoodReceiptStock extends Component
{
    public $accessories = [];
    public $productSelected, $sender, $recipient, $catatan, $rak, $baris, $totalQuantity;

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

            foreach ($this->accessories as $accessory) {
                $this->totalQuantity += $accessory['quantity'];
            }

            $stock = Stock::create([
                'giver' => $this->sender,
                'receiver' => $this->recipient,
                'rack' => $this->rak,
                'row' => $this->baris,
                'type' => 'In',
                'total_quantity' => $this->totalQuantity,
                'catatan' => $this->catatan,
            ]);

            $accessoriesToSync = [];

            // Prepare data for sync
            foreach ($this->accessories as $accessory) {
                // Check if the accessory is already attached
                $existingQuantity = $product->accessories()->find($accessory['id'])->pivot->quantity ?? 0;

                // Calculate the new quantity by adding to the existing quantity
                $newQuantity = currency_convert($existingQuantity) + currency_convert($accessory['quantity']);

                $accessoriesToSync[$accessory['id']] = [
                    'quantity' => $newQuantity,
                    'stock_id' => $stock->id,
                    'product_id' => $product->id,
                ];

                $dataAccessories = Accessory::find($accessory['id']);

                $createLog = LogStock::create([
                    'description' => 'Penambahan untuk product ' . $product->name . ', dikirim oleh ' . $this->sender . ', diterima oleh ' . $this->recipient . ', kondisi stock ' . $dataAccessories->description . ', dengan total quantity ' . $this->totalQuantity,
                ]);
            }

            // Sync accessories using the prepared data
            $product->accessories()->syncWithoutDetaching($accessoriesToSync);

            DB::commit();

            $this->redirectRoute('goodReceiptStock.Stock');
            session()->flash('success', 'Data berhasil disimpan.');
        } catch (Throwable $th) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan !!! ' . $th->getMessage());
        }
    }
}
