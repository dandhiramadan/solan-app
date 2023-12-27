<?php

namespace App\Livewire\Components;

use Livewire\Component;
use Livewire\Attributes\Url;

class Filter extends Component
{
    #[Url(history:true)]
    public $search = '';

    #[Url(history:true)]
    public $show = '';

    public $title;

    public function updatedSearch()
    {
        $this->dispatch('search', search: $this->search);
    }

    public function updatedShow()
    {
        $this->dispatch('show', show: $this->show);
    }

    public function mount($title)
    {
        $this->title = $title;
    }

    public function render()
    {
        return view('livewire.components.filter');
    }
}
