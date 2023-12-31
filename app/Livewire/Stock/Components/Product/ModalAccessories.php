<?php

namespace App\Livewire\Stock\Components\Product;

use Livewire\Component;
use App\Models\Customer;
use App\Models\Accessory;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\DB;

class ModalAccessories extends Component
{
    public $description, $catatan;
    public $title, $action;

    #[On('show-modal-create')]
    public function openModalCreate($title, $action)
    {
        $this->reset();
        $this->title = $title;
        $this->action = $action;
    }

    public $dataAccessories;

    #[On('show-modal-edit')]
    public function openModalEdit($title, $action, $id)
    {
        $this->reset();
        $this->title = $title;
        $this->action = $action;
        $this->dataAccessories = Accessory::find($id);
        $this->description = $this->dataAccessories->description;
        $this->catatan = $this->dataAccessories->catatan;
    }

    #[On('show-modal-details')]
    public function openModalDetails($title, $action, $id)
    {
        $this->reset();
        $this->title = $title;
        $this->action = $action;
        $this->dataAccessories = Accessory::find($id);
        $this->description = $this->dataAccessories->description;
        $this->catatan = $this->dataAccessories->catatan;
    }

    public function render()
    {
        return view('livewire.stock.components.product.modal-accessories');
    }

    public function save()
    {
        $this->validate(
            [
                'description' => 'required',
            ],
            [
                'description.required' => 'Description harus diisi.',
            ],
        );

        try {
            DB::beginTransaction();

            $createAccessories = Accessory::create([
                'description' => $this->description,
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

    public function edit()
    {
        $this->validate(
            [
                'description' => 'required',
            ],
            [
                'description.required' => 'Description harus diisi.',
            ],
        );

        try {
            DB::beginTransaction();

            $createProduct = Accessory::where('id', $this->dataAccessories->id)->update([
                'description' => $this->description,
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
