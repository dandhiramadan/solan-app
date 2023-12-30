<?php

namespace App\Livewire\Stock\Components;

use Livewire\Component;
use App\Models\Instruction;
use Livewire\Attributes\Title;

#[Title('Form Request Stock')]
class FormRequestStock extends Component
{
    public $id, $state;
    public function mount($state, $id)
    {
        $this->id = $id;
        $this->state = $state;
    }

    public function render()
    {
        return view('livewire.stock.components.form-request-stock');
    }
}
