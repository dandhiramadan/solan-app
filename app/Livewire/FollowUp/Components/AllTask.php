<?php

namespace App\Livewire\FollowUp\Components;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('All Task')]
class AllTask extends Component
{
    public function render()
    {
        return view('livewire.follow-up.components.all-task');
    }
}
