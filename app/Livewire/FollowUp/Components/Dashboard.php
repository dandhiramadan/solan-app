<?php

namespace App\Livewire\FollowUp\Components;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;
use App\Events\BroadcastingEvent;

#[Title('Dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        $user = Auth()->user();
        event(new BroadcastingEvent(
            $user->id,
            'message-received',
            [
                'message_id' => '1',
                'message_text' => 'some text'
            ]
        ));


        return view('livewire.follow-up.components.dashboard');
    }
}
