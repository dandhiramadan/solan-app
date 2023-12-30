<?php

namespace App\Livewire\Components;

use App\Models\Task;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class ListTask extends Component
{
    use WithPagination;
    public $search;
    public $paginate;

    public $title, $prefix, $orderStatus, $text, $state, $color, $targetRoute;

    #[On('search')]
    public function updateSearch($search)
    {
        $this->search = $search;
    }

    #[On('show')]
    public function updatePaginate($show)
    {
        $this->paginate = $show;
    }

    public function mount($title, $prefix, $orderStatus, $text, $state, $color, $targetRoute)
    {
        $this->title = $title;
        $this->orderStatus = $orderStatus;
        $this->text = $text;
        $this->state = $state;
        $this->color = $color;
        $this->targetRoute = $targetRoute;
    }

    public function render()
    {
        return view('livewire.components.list-task', [
            'listTask' => Task::where('order_status', $this->orderStatus)
                ->where('text', $this->text)
                ->where('state', $this->state)
                ->search($this->search)
                ->with('instruction')
                ->paginate($this->paginate),
            'listTaskCount' => Task::where('order_status', $this->orderStatus)
                ->where('text', $this->text)
                ->where('state', $this->state)
                ->count(),
        ]);
    }
}
