<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Instruction;
use Livewire\Attributes\On;

class Offcanvas extends Component
{
    #[On('show-off-canvas')]
    public function showOffCanvas($id)
    {
        $instruction = Instruction::find($id);
    }

    public function render()
    {
        return view('livewire.components.offcanvas');
    }
}
