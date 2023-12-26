<?php

namespace App\Livewire\Stock\Components;

use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;

class PendingApprovedTask extends Component
{
    use WithPagination;

    public function mount()
    {

    }

    public function render()
    {
        return view('livewire.stock.components.pending-approved-task', [
            'pendingApproved' => Task::where('order_status', 'Running')
                ->where('text', 'Cari/Ambil Stock')
                ->where('status', 'Pending Approved')
                ->where('pekerjaan', 'Cari/Ambil Stock')
                ->where('state', 'Pending Approved')
                ->with('instruction')
                ->paginate(1),
            'pendingApprovedCount' => Task::where('order_status', 'Running')
                ->where('text', 'Cari/Ambil Stock')
                ->where('status', 'Pending Approved')
                ->where('pekerjaan', 'Cari/Ambil Stock')
                ->where('state', 'Pending Approved')
                ->count(),
        ]);
    }
}
