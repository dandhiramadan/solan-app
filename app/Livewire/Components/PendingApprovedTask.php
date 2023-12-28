<?php

namespace App\Livewire\Components;

use App\Models\Task;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;

class PendingApprovedTask extends Component
{
    use WithPagination;
    public $search;
    public $paginate;

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

    public function mount()
    {

    }

    public function render()
    {
        return view('livewire.components.pending-approved-task', [
            'pendingApproved' => Task::where('order_status', 'Running')
                ->where('text', 'Cari/Ambil Stock')
                ->where('status', 'Pending Approved')
                ->where('pekerjaan', 'Cari/Ambil Stock')
                ->where('state', 'Pending Approved')
                ->search($this->search)
                ->with('instruction')
                ->paginate($this->paginate),
            'pendingApprovedCount' => Task::where('order_status', 'Running')
                ->where('text', 'Cari/Ambil Stock')
                ->where('status', 'Pending Approved')
                ->where('pekerjaan', 'Cari/Ambil Stock')
                ->where('state', 'Pending Approved')
                ->count(),
        ]);
    }
}
