<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Task;
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
            ->orderBy('date', 'asc'))
            ->get()
            ->toArray();
        return $tasks;
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
            'date' => $request->input('date'),
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
