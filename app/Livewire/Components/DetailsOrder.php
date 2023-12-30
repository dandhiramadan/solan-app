<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Instruction;

class DetailsOrder extends Component
{
    public $dataSpk;
    public function mount($id)
    {
        $this->dataSpk = Instruction::find($id);
    }
    public function render()
    {
        return view('livewire.components.details-order');
    }
}
