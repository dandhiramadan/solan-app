<?php

namespace App\Http\Controllers;

use App\Models\Link;
use App\Models\Task;
use App\Models\User;
use App\Models\WorkStep;
use Illuminate\Http\Request;

class GanttController extends Controller
{
    public function get()
    {
        $tasks = Task::orderBy('sortorder')->with('instruction')->get();
        $taskCollection = $tasks->map(function ($task) {
            return [
                'id' => $task->id,
                'instruction_id' => $task->instruction_id,
                // 'spknumber' => $task->instruction->spk_number,
                'spknumber' => 1,
                'owners' => $task->user_id,
                'type' => $task->type,
                'text' => $task->text,
                'target_lembar_cetak' => $task->target_lembar_cetak,
                'jumlah_lembar_cetak' => $task->jumlah_lembar_cetak,
                'duration' => $task->duration,
                'progress' => $task->progress,
                'start_date' => $task->start_date,
                'parent' => $task->parent,
                'sortorder' => $task->sortorder,
                'priority' => $task->priority,
                'schedulestatus' => $task->schedule_status,
                'readonly' => $task->readonly,
                'open' => true ,
            ];
        });

        $links = new Link();
        $workSteps = WorkStep::all();
        $workStepCollection = $workSteps->map(function ($workStep) {
            return [
                'value' => $workStep->description,
                'label' => $workStep->description,
            ];
        });

        $users = User::all();
        $userCollection = $users->map(function ($user) {
            return [
                'value' => $user->id,
                'label' => $user->name,
            ];
        });

        return response()->json([
            'data' => $taskCollection->values()->all(),
            'links' => $links->all(),
            'collections' => [
                'priority' => [['value' => 1, 'label' => 'Normal'], ['value' => 2, 'label' => 'Medium'], ['value' => 3, 'label' => 'High']],
                'people' => $userCollection,
                'workstep' => $workStepCollection,
            ],
        ]);
    }
}
