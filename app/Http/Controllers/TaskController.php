<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the tasks.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * @return [array]
     */
    public function index()
    {
        $tasks = (Task::where('user_id', Auth::id())
            ->orderBy('dateStart', 'asc'))
            ->get();

        $data = collect();

        foreach ($tasks as $key => $task) {
            $data->push([
                'name' => $task['name'],
                'description' => $task['description'],
                'dateStart' => $task['dateStart'],
                'dateEnd' => $task['dateEnd'],
                'hourStart' => (new Carbon($task['dateStart']))->format('H'),
                'hourEnd' => (new Carbon($task['dateEnd']))->format('H')
            ]);
        }

        return $data;
    }

    // add task
    /**
     * @param TaskRequest $request
     * 
     * @return json
     */
    public function add(TaskRequest $request)
    {
        $task = new Task([
            'name' => $request->input('name'),
            'dateStart' => $request->input('dateStart'),
            'dateEnd' => $request->input('dateEnd'),
            'description' => $request->input('description'),
        ]);
        $task->save();

        return response()->json('Tâche ajoutée avec succès');
    }

    // edit task
    /**
     * @param int $id
     * 
     * @return json
     */
    public function edit($id)
    {
        $task = Task::find($id);
        return response()->json($task);
    }

    // update task
    /**
     * @param int $id
     * @param TaskRequest $request
     * 
     * @return json
     */
    public function update($id, TaskRequest $request)
    {
        $task = Task::find($id);
        $task->update($request->all());

        return response()->json('Tâche modifiée avec succès');
    }

    // delete task
    /**
     * @param int $id
     * 
     * @return json
     */
    public function delete($id)
    {
        $task = Task::find($id);
        $task->delete();

        return response()->json('Tâche supprimée avec succès');
    }
}
