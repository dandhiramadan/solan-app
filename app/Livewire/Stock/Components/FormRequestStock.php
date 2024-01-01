<?php

namespace App\Livewire\Stock\Components;

use App\Models\Stock;
use App\Models\Product;
use Livewire\Component;
use App\Models\LogStock;
use App\Models\Accessory;
use App\Models\Instruction;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\DB;

#[Title('Form Request Stock')]
class FormRequestStock extends Component
{
    public $id, $state;
    public $gunakanStock;
    public $showStock = false;
    public $stockSelected;
    public $dataStock = [];
    public $totalQuantity;

    public function mount($state, $id)
    {
        $this->id = $id;
        $this->state = $state;
    }

    public function render()
    {
        return view('livewire.stock.components.form-request-stock', [
            'products' => Product::all(),
        ]);
    }

    public function updateGunakanStock($state)
    {
        $this->showStock = $state;
    }

    public function updatedStockSelected()
    {
        $dataProduct = Product::with('accessories')
            ->where('id', $this->stockSelected)
            ->get();

        $dataTransformed = [];

        foreach ($dataProduct as $item) {
            foreach ($item['stocks'] as $key => $stock) {
                $dataTransformed[] = [
                    'stock_id' => $stock->pivot->stock_id,
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
    }

    public function store()
    {
        try {
            DB::beginTransaction();

            $product = Product::find($this->stockSelected);

            foreach ($this->dataStock as $accessory) {
                $this->totalQuantity += $accessory['requestQuantity'];
            }

            foreach ($this->dataStock as $accessory) {
                $stock = Stock::create([
                    'giver' => $accessory['giver'],
                    'receiver' => $accessory['receiver'],
                    'rack' => $accessory['rack'],
                    'row' => $accessory['row'],
                    'type' => 'Out',
                    'total_quantity' => $this->totalQuantity,
                ]);
            }

            $accessoriesToSync = [];

            // Prepare data for sync
            foreach ($this->dataStock as $accessory) {
                $dataAccessories = Accessory::where('description', $accessory['description'])->first();
                // Check if the accessory is already attached
                $existingQuantity = $product->accessories()->find($dataAccessories->id)->pivot->quantity ?? 0;

                // Calculate the new quantity by adding to the existing quantity
                $newQuantity = currency_convert($existingQuantity) - currency_convert($accessory['requestQuantity']);

                $accessoriesToSync[$dataAccessories->id] = [
                    'quantity' => $newQuantity,
                    'stock_id' => $accessory['stock_id'],
                    'product_id' => $this->stockSelected,
                ];

                $createLog = LogStock::create([
                    'description' => 'Permintaan stock product ' . $product->name . ', ukuran ' . $product->panjang . ' cm x ' . $product->lebar . ' cm, untuk Nomor SPK ' . $accessory['giver'] . ', kondisi stock ' . $accessory['description'] . ', dengan total quantity ' . $this->totalQuantity,
                ]);
            }

            // Sync accessories using the prepared data
            $product->accessories()->syncWithoutDetaching($accessoriesToSync);

            DB::commit();

            $this->redirectRoute('dashboard.Stock');
            session()->flash('success', 'Data berhasil disimpan.');
        } catch (Throwable $th) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan !!! ' . $th->getMessage());
        }
    }
}
