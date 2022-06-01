<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // all tasks
    public function index()
    {
        $tasks = (Task::where('user_id', Auth::id())
                ->orderBy('date', 'asc'))
            ->get()
            ->toArray();
        return $tasks;
    }

    // add task
    public function add(TaskRequest $request)
    {
        $task = new Task([
            'name' => $request->input('name'),
            'date'=>$request->input('date'),
            'description' => $request->input('description'),
        ]);
        $task->save();

        return response()->json('The task successfully added');
    }

    // edit task
    public function edit($id)
    {
        $task = Task::find($id);
        return response()->json($task);
    }

    // update task
    public function update($id, TaskRequest $request)
    {
        $task = Task::find($id);
        $task->update($request->all());

        return response()->json('The task successfully updated');
    }

    // delete task
    public function delete($id)
    {
        $task = Task::find($id);
        $task->delete();

        return response()->json('The task successfully deleted');
    }
}
