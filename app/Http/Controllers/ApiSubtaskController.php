<?php

namespace App\Http\Controllers;

use App\Models\Subtask;
use Illuminate\Http\Request;

class ApiSubtaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tasks = Subtask::all();
        return response()->json([
            'status' => true,
            'response' => $tasks
        ]);
    }

    public function getByIdTask($task_id)
    {
       if(Subtask::where('task_id',$task_id)->exists()){
          $tasks = Subtask::where('task_id',$task_id)->get();
          if (!$tasks) {
            return response()->json(['error' => 'Task not found'], 404);
          }
          return response()->json([
            'status' => true,
            'response' => $tasks
        ]);
       }

    }

    public function updateSubtask(Request  $request,$id)
    {

       $subtask = Subtask::find($id);

       if (!$subtask) {
           return response()->json(['message' => 'Sub Task not found'], 404);
       }

       $subtask->update($request->all());

       return response()->json([
           'status' => true,
           'message' => "SubTask Updated successfully!",
           'task' => $subtask
       ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function createSubtask(Request  $request)
    {

        //$user = User::find($id);

        //if($user){

           $task = Subtask::create([
            'name' => $request->input('name'),
            'user_id' => $request->input('user_id'),
            'task_id' => $request->input('task_id'),
            'state' => $request->input('state'),
            'priority' => $request->input('priority'),
            'limit_date' => $request->input('limit_date'),
        ]);

            return response()->json([
                'status' => true,
                'message' => "SubTask Created successfully!",
                'response' => $task
                    ], 200);
                /*}else{
                    return response()->json(['message' => 'Invalid'], 401);
                }*/

    }

    public function deleteSubtask($id)
    {
       if(Subtask::where('id',$id)->exists()){

          $subtasks = Subtask::find($id);

          if (!$subtasks) {
            return response()->json(['error' => 'SubTask not found'], 404);
          }

          $subtasks->delete();

          return response()->json([
            'status' => true,
            'message' => "SubTask Delete successfully!",
            'response' => $subtasks
        ]);
       }

    }



}
