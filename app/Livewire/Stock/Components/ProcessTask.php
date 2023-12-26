<?php

namespace App\Livewire\Stock\Components;

use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;

class ProcessTask extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.stock.components.process-task', [
            'process' => Task::where('order_status', 'Running')
                ->where('text', 'Cari/Ambil Stock')
                ->where('status', 'Process')
                ->where('pekerjaan', 'Cari/Ambil Stock')
                ->where('state', 'Process')
                ->with('instruction')
                ->paginate(10),
            'processCount' => Task::where('order_status', 'Running')
                ->where('text', 'Cari/Ambil Stock')
                ->where('status', 'Process')
                ->where('pekerjaan', 'Cari/Ambil Stock')
                ->where('state', 'Process')
                ->count(),
        ]);
    }
}
