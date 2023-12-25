<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Task;
use App\Models\WorkStep;
use Illuminate\Http\Request;

class GanttController extends Controller
{
    public function get()
    {
        $tasks = new Task();
        $links = new Link();
        $workSteps = WorkStep::all();
        $workStepCollection = $workSteps->map(function ($workStep) {
            return [
                'value' => $workStep->description,
                'label' => $workStep->description,
            ];
        });

        return response()->json([
            'data' => $tasks->orderBy('sortorder')->get(),
            'links' => $links->all(),
            'collections' => [
                'priority' => [['value' => 1, 'label' => 'Normal'], ['value' => 2, 'label' => 'Medium'], ['value' => 3, 'label' => 'High']],
                'workstep' => $workStepCollection,
            ],
        ]);
    }
}
