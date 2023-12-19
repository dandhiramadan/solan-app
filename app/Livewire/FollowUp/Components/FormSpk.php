<?php

namespace App\Livewire\FollowUp\Components;

use Livewire\Component;
use Livewire\Attributes\Rule;

class FormSpk extends Component
{
    #[Rule('required', message: 'Pemesan harus diisi.')]
    public $customer_name;

    #[Rule('required', message: 'Customer number harus diisi.')]
    public $customer_number;

    public function render()
    {
        return view('livewire.follow-up.components.form-spk');
    }

    public function save()
    {
        $this->validate();

        dd($this->customer_name);
    }
}
