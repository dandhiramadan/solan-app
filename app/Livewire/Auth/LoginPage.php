<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;

#[Layout('components.auth.app')]
class LoginPage extends Component
{
    #[Rule('required', message: 'Username harus diisi.')]
    public $username;

    #[Rule('required', message: 'Password harus diisi.')]
    public $password;

    public function render()
    {
        return view('livewire.auth.login-page');
    }

    public function login()
    {
        $this->validate();

        // Attempt to log the user in
        if (Auth::attempt(['username' => $this->username, 'password' => $this->password])) {
            // Determine the user's role and redirect to the appropriate dashboard
            $user = Auth::user();
            switch ($user->role) {
                case 'Follow Up':
                    return redirect()->route('dashboard.FollowUp');
                    break;

                default:
                    return redirect()->route('login');
                    break;
            }
        }

        session()->flash('error', 'Username/password Salah.');
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
