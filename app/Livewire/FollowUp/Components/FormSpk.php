<?php

namespace App\Livewire\FollowUp\Components;

use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\WithFileUploads;

class FormSpk extends Component
{
    use WithFileUploads;

    #[Rule('required', message: 'Pemesan harus diisi.')]
    public $customer_name;

    #[Rule('required', message: 'Customer number harus diisi.')]
    public $customer_number;

    #[Rule('required', message: 'File contoh harus diisi.')]
    public $file_contoh;

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
