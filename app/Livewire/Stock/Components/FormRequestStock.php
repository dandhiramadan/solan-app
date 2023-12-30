<?php

namespace App\Livewire\Stock\Components;

use Livewire\Component;
use App\Models\Instruction;
use Livewire\Attributes\Title;

#[Title('Form Request Stock')]
class FormRequestStock extends Component
{
    public function mount($id)
    {
        $this->dataSpk = Instruction::find($id);
    }

    public function render()
    {
        return view('livewire.stock.components.form-request-stock');
    }
}
