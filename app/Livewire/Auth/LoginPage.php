<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.auth.app')]
class LoginPage extends Component
{
    public function render()
    {
        return view('livewire.auth.login-page');
    }
}
