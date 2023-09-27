<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Subtask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ApiTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Task::all();
        return response()->json([
            'status' => true,
            'response' => $tasks
        ]);
    }



    public function taskChild()
    {
        $tasks = Task::select('tasks.*', DB::raw("CONCAT(users.name, ' ', users.last_name) as user_full_name"))
    ->join('users', 'tasks.user_id', '=', 'users.id')
    ->get();


      foreach ($tasks as $task) {

        if(Subtask::where('task_id',$task->id)->exists()){
            /*$subtask = DB::table('subtasks')
            ->join('users', 'subtasks.user_id', '=', 'users.id')
            ->where('subtasks.task_id',$task->id)
            ->select('subtasks.*','users.name as user_name','users.last_name as user_last_name')->get();*/

            $subtask = Subtask::where('task_id',$task->id)->get();
            $task->subtask = $subtask ? $subtask : [];
         }else{
            $task->subtask = [];
         }
      }

      return response()->json([
        'status' => true,
        'response' => $tasks
    ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createTask(Request  $request)
    {

        //$user = User::find($id);

        //if($user){

           $task = Task::create([
            'name' => $request->input('name'),
            'user_id' => $request->input('user_id'),
            'state' => $request->input('state'),
            'priority' => $request->input('priority'),
            'limit_date' => $request->input('limit_date'),
        ]);

            return response()->json([
                'status' => true,
                'message' => "Task Created successfully!",
                'response' => $task
                    ], 200);
                /*}else{
                    return response()->json(['message' => 'Invalid'], 401);
                }*/

    }


    public function updateTask(Request  $request,$id)
 {

    $task = Task::find($id);

    if (!$task) {
        return response()->json(['message' => 'Task not found'], 404);
    }

    $task->update($request->all());

    return response()->json([
        'status' => true,
        'message' => "Task Updated successfully!",
        'task' => $task
    ], 200);
 }

 public function deleteTask($id)
 {
    if(Task::where('id',$id)->exists()){

       $task = Task::find($id);

       if (!$task) {
         return response()->json(['error' => 'Task not found'], 404);
       }

       $task->delete();

       return response()->json([
         'status' => true,
         'message' => "Task Delete successfully!",
         'response' => $task
     ]);
    }

 }

}
