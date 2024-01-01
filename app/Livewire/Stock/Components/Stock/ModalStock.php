<?php

namespace App\Livewire\Stock\Components\Stock;

use App\Models\Stock;
use App\Models\Product;
use Livewire\Component;
use App\Models\Customer;
use App\Models\LogStock;
use App\Models\Accessory;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;

class ModalStock extends Component
{
    public $title, $action, $id;
    public $dataStock = [];
    public $name, $customerSelected, $panjang, $lebar, $catatan, $reason, $totalQuantity;

    #[On('show-modal-details')]
    public function openModalDetails($title, $action, $id)
    {
        $this->reset();
        $this->title = $title;
        $this->action = $action;
        $this->id = $id;
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

    #[On('show-modal-adjustment')]
    public function openModalAdjustment($title, $action, $id)
    {
        $this->reset();
        $this->title = $title;
        $this->action = $action;
        $this->id = $id;
        $dataStock = Product::with('accessories', 'stocks')
            ->where('id', $id)
            ->get();

        $dataTransformed = [];

        foreach ($dataStock as $item) {
            foreach ($item['stocks'] as $key => $stock) {
                $dataTransformed[] = [
                    'product_id' => $stock->pivot->product_id,
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

    public function adjustment()
    {
        $this->validate(
            [
                'reason' => 'required',
            ],
            [
                'reason.required' => 'Reason harus diisi.',
            ],
        );

        try {
            DB::beginTransaction();

            $product = Product::find($this->id);

            foreach ($this->dataStock as $accessory) {
                $this->totalQuantity += $accessory['quantity'];
            }

            foreach ($this->dataStock as $accessory) {
                $stock = Stock::create([
                    'giver' => $accessory['giver'],
                    'receiver' => $accessory['receiver'],
                    'rack' => $accessory['rack'],
                    'row' => $accessory['row'],
                    'type' => 'Adjustment',
                    'total_quantity' => $this->totalQuantity,
                    'catatan' => $this->reason,
                ]);
            }

            $accessoriesToSync = [];

            // Prepare data for sync
            foreach ($this->dataStock as $accessory) {
                $dataAccessories = Accessory::where('description', $accessory['description'])->first();

                $accessoriesToSync[$dataAccessories->id] = [
                    'quantity' => $accessory['quantity'],
                    'stock_id' => $accessory['stock_id'],
                    'product_id' => $accessory['product_id'],
                ];

                $createLog = LogStock::create([
                    'description' => 'Adjustment stock product ' . $product->name . ', dikirim oleh ' . $accessory['giver'] . ', diterima oleh ' . $accessory['receiver'] . ', kondisi stock ' . $accessory['description'] . ', alasan melakukan adjustment : ' . $this->reason . ', dengan total quantity ' . $this->totalQuantity,
                ]);
            }

            // Sync accessories using the prepared data
            $product->accessories()->syncWithoutDetaching($accessoriesToSync);

            DB::commit();

            $this->redirectRoute('listStock.Stock');
            session()->flash('success', 'Data berhasil disimpan.');
        } catch (Throwable $th) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan !!! ' . $th->getMessage());
        }
    }
}
