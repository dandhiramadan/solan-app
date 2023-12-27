<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Instruction;
use Livewire\Attributes\On;

class Offcanvas extends Component
{
    public $spk_number, $spk_type, $taxes_type, $parent, $customer_name, $fsc_type, $spk_number_fsc, $order_date, $delivery_date, $purchase_order, $order_name, $code_style, $request_quantity, $quantity_stock, $quantity, $followup, $price, $ppn, $panjang_barang, $lebar_barang, $spk_layout, $spk_sample, $spk_stock, $document = [], $catatan = [];

    #[On('show-off-canvas')]
    public function showOffCanvas($id)
    {
        $instruction = Instruction::with('document', 'catatan', 'catatan.user')->find($id);
        $this->spk_number = $instruction->spk_number;
        $this->spk_type = $instruction->spk_type;
        $this->taxes_type = $instruction->taxes_type;
        $this->parent = $instruction->parent;
        $this->customer_name = $instruction->customer_name;
        $this->fsc_type = $instruction->fsc_type;
        $this->spk_number_fsc = $instruction->spk_number_fsc;
        $this->order_date = $instruction->order_date;
        $this->delivery_date = $instruction->delivery_date;
        $this->purchase_order = $instruction->purchase_order;
        $this->order_name = $instruction->order_name;
        $this->code_style = $instruction->code_style;
        $this->request_quantity = $instruction->request_quantity;
        $this->quantity_stock = $instruction->quantity_stock;
        $this->quantity = $instruction->quantity - $instruction->quantity_stock;
        $this->followup = $instruction->followup;
        $this->price = $instruction->price;
        $this->ppn = $instruction->ppn;
        $this->panjang_barang = $instruction->panjang_barang;
        $this->lebar_barang = $instruction->lebar_barang;
        $this->spk_layout = $instruction->spk_layout;
        $this->spk_sample = $instruction->spk_sample;
        $this->spk_stock = $instruction->spk_stock;

        $this->document = $instruction->document;
        $this->catatan = $instruction->catatan;
    }

    public function render()
    {
        return view('livewire.components.offcanvas');
    }
}
