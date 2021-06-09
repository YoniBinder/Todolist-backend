<?php

namespace App\Http\Controllers;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        return response()->json(["status" => "success", "error" => false, "count" => count($tasks), "data" => $tasks],200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = new Task();
        $task ->task_name= $request->task_name;
        $task ->done= $request->done;
        if($task->save())
        {
            // return new TaskResource($task);
            $tasks = Task::all();
            return response()->json(["data" => $tasks],200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $task=Task::findOrFail($id);
        return new TaskResource($task);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task ->task_name= $request->task_name;
        $task ->done= $request->done;

        if($task->save())
        {
            // return new TaskResource($task);
            $tasks = Task::all();
            return response()->json(["data" => $tasks],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        if($task->delete())
        {
            // return new TaskResource($task);
            $tasks = Task::all();
            return response()->json(["data" => $tasks],200);
        }
    }
}
