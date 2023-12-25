<?php

namespace App\Livewire\Penjadwalan\Components;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Layout('components.timeline.app-timeline')]
#[Title('Timeline Task')]
class TimelineTask extends Component
{
    public function render()
    {
        return view('livewire.penjadwalan.components.timeline-task');
    }
}
