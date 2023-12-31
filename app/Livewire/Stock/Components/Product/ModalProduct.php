<?php

namespace App\Livewire\Stock\Components\Product;

use App\Models\Product;
use Livewire\Component;
use App\Models\Customer;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;

class ModalProduct extends Component
{
    public $title, $action;

    #[On('show-modal-create')]
    public function openModalCreate($title, $action)
    {
        $this->title = $title;
        $this->action = $action;
    }

    public $dataProduct;

    #[On('show-modal-edit')]
    public function openModalEdit($title, $action, $id)
    {
        $this->title = $title;
        $this->action = $action;
        $this->dataProduct = Product::find($id);
        $this->name = $this->dataProduct->name;
        $this->customerSelected = $this->dataProduct->customer_name;
        $this->panjang = $this->dataProduct->panjang;
        $this->lebar = $this->dataProduct->lebar;
        $this->catatan = $this->dataProduct->catatan;
    }

    #[On('show-modal-details')]
    public function openModalDetails($title, $action, $id)
    {
        $this->title = $title;
        $this->action = $action;
        $this->dataProduct = Product::find($id);
        $this->name = $this->dataProduct->name;
        $this->customerSelected = $this->dataProduct->customer_name;
        $this->panjang = $this->dataProduct->panjang;
        $this->lebar = $this->dataProduct->lebar;
        $this->catatan = $this->dataProduct->catatan;
    }

    public function render()
    {
        return view('livewire.stock.components.product.modal-product', [
            'customer' => Customer::all(),
        ]);
    }

    public $name, $customerSelected, $panjang, $lebar, $catatan;

    public function save()
    {
        $this->validate(
            [
                'name' => 'required',
                'customerSelected' => 'required',
                'panjang' => 'required',
                'lebar' => 'required',
            ],
            [
                'name.required' => 'Name Product harus diisi.',
                'customerSelected.required' => 'Customer harus diisi.',
                'panjang.required' => 'Panjang harus diisi.',
                'lebar.required' => 'Lebar harus diisi.',
            ],
        );

        try {
            DB::beginTransaction();

            $createProduct = Product::create([
                'name' => $this->name,
                'customer_name' => $this->customerSelected,
                'panjang' => $this->panjang,
                'lebar' => $this->lebar,
                'catatan' => $this->catatan,
            ]);

            DB::commit();

            $this->redirectRoute('managementProducts.Stock');
            session()->flash('success', 'Data berhasil disimpan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan !!! ' . $th->getMessage());
        }
    }

    public function edit()
    {
        $this->validate(
            [
                'name' => 'required',
                'customerSelected' => 'required',
                'panjang' => 'required',
                'lebar' => 'required',
            ],
            [
                'name.required' => 'Name Product harus diisi.',
                'customerSelected.required' => 'Customer harus diisi.',
                'panjang.required' => 'Panjang harus diisi.',
                'lebar.required' => 'Lebar harus diisi.',
            ],
        );

        try {
            DB::beginTransaction();

            $createProduct = Product::where('id', $this->dataProduct->id)->update([
                'name' => $this->name,
                'customer_name' => $this->customerSelected,
                'panjang' => $this->panjang,
                'lebar' => $this->lebar,
                'catatan' => $this->catatan,
            ]);

            DB::commit();

            $this->redirectRoute('managementProducts.Stock');
            session()->flash('success', 'Data berhasil disimpan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            session()->flash('error', 'Terjadi kesalahan !!! ' . $th->getMessage());
        }
    }
}
