<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Cache;

class Broadcasting extends Component
{
    public function render()
    {
        $key = 'broadcast_' . auth()->user()->id;
        $event = Cache::get($key);
        if ($event) {
            Cache::forget($key);
            $this->dispatch('broadcast', $event); // for livewire 3
        }


        return view('livewire.broadcasting');
        // return <<<'blade'
        //     <div wire:poll.1s></div>
        // blade;
    }
}
