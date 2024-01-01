<?php

namespace App\Livewire\Stock\Components\Stock;

use App\Models\Product;
use Livewire\Component;
use App\Models\Accessory;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\DB;

#[Title('Adjustment Stock')]
class AdjustmentStock extends Component
{
    public $productSelected, $totalQuantity, $sender, $recipient, $catatan, $rak, $baris;
    public function render()
    {
        return view('livewire.stock.components.stock.adjustment-stock', [
            'products' => Product::all(),
        ]);
    }

    public function save()
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

            $createAdjustmentStock = Stock::create([
                'product_id' => $this->productSelected,
                'quantity' => $this->totalQuantity,
                'sender' => $this->sender,
                'recipient' => $this->recipient,
                'rak' => $this->rak,
                'baris' => $this->baris,
                'type' => 'In',
                'catatan' => $this->catatan,
            ]);

            DB::commit();

            $this->redirectRoute('managementAccessories.Stock');
            session()->flash('success', 'Data berhasil disimpan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan !!! ' . $th->getMessage());
        }
    }
}
