<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Subtask;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiTaskController extends Controller
{
    /**
     * @OA\Get(
     *     path="/tasks",
     *     summary="Listar todas las tareas",
     *     tags={"Tasks"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de tareas"
     *     )
     * )
     */
    public function index()
    {
        $tasks = Task::all();
        return response()->json([
            'status' => true,
            'response' => $tasks
        ]);
    }

    /**
     * @OA\Get(
     *     path="/taskChildAll",
     *     summary="Listar tareas con subtareas anidadas",
     *     tags={"Tasks"},
     *     @OA\Response(
     *         response=200,
     *         description="Lista de tareas con subtareas"
     *     )
     * )
     */
    public function taskChild()
    {
        $tasks = Task::select('tasks.*', DB::raw("CONCAT(users.name, ' ', users.last_name) as user_full_name"))
            ->join('users', 'tasks.user_id', '=', 'users.id')
            ->get();

        foreach ($tasks as $task) {
            $subtask = Subtask::where('task_id', $task->id)->get();
            $task->subtask = $subtask ?? [];
        }

        return response()->json([
            'status' => true,
            'response' => $tasks
        ]);
    }

    /**
     * @OA\Post(
     *     path="/tasks",
     *     summary="Crear una nueva tarea",
     *     tags={"Tasks"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","user_id","state","priority"},
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="user_id", type="integer"),
     *             @OA\Property(property="state", type="integer"),
     *             @OA\Property(property="priority", type="integer"),
     *             @OA\Property(property="limit_date", type="string", format="date-time", nullable=true)
     *         )
     *     ),
     *     @OA\Response(response=200, description="Tarea creada correctamente")
     * )
     */
    public function createTask(Request $request)
    {
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
    }

    /**
     * @OA\Put(
     *     path="/tasks/{id}",
     *     summary="Actualizar una tarea",
     *     tags={"Tasks"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="state", type="integer"),
     *             @OA\Property(property="priority", type="integer"),
     *             @OA\Property(property="limit_date", type="string", format="date-time", nullable=true)
     *         )
     *     ),
     *     @OA\Response(response=200, description="Tarea actualizada correctamente"),
     *     @OA\Response(response=404, description="Tarea no encontrada")
     * )
     */
    public function updateTask(Request $request, $id)
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

    /**
     * @OA\Delete(
     *     path="/tasks/{id}",
     *     summary="Eliminar una tarea",
     *     tags={"Tasks"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Tarea eliminada correctamente"),
     *     @OA\Response(response=404, description="Tarea no encontrada")
     * )
     */
    public function deleteTask($id)
    {
        if (Task::where('id', $id)->exists()) {
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
