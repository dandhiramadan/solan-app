<?php

namespace App\Livewire\Stock\Components\Stock;

use Livewire\Component;
use App\Models\LogStock;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('History Stock')]
class HistoryStock extends Component
{
    use WithPagination;
    public $search;
    public $paginate = 5;

    public function updateSearch($search)
    {
        $this->search = $search;
    }

    public function updatePaginate($show)
    {
        $this->paginate = $show;
    }

    public function render()
    {
        return view('livewire.stock.components.stock.history-stock',[
            'logStocks' => LogStock::search($this->search)->paginate($this->paginate),
        ]);
    }
}
