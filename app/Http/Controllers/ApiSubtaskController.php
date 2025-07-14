<?php

namespace App\Http\Controllers;

use App\Models\Subtask;
use Illuminate\Http\Request;

class ApiSubtaskController extends Controller
{
    /**
     * @OA\Get(
     *     path="/sub-tasks",
     *     summary="Listar todas las subtareas",
     *     tags={"Subtasks"},
     *     @OA\Response(
     *         response=200,
     *         description="Listado de subtareas"
     *     )
     * )
     */
    public function index()
    {
        $tasks = Subtask::all();
        return response()->json([
            'status' => true,
            'response' => $tasks
        ]);
    }

    /**
     * @OA\Get(
     *     path="/sub-tasks/{task_id}",
     *     summary="Obtener subtareas por ID de tarea",
     *     tags={"Subtasks"},
     *     @OA\Parameter(
     *         name="task_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Subtareas encontradas"
     *     ),
     *     @OA\Response(response=404, description="Task not found")
     * )
     */
    public function getByIdTask($task_id)
    {
        if (Subtask::where('task_id', $task_id)->exists()) {
            $tasks = Subtask::where('task_id', $task_id)->get();
            return response()->json([
                'status' => true,
                'response' => $tasks
            ]);
        }
    }

    /**
     * @OA\Post(
     *     path="/sub-tasks",
     *     summary="Crear una nueva subtarea",
     *     tags={"Subtasks"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name","user_id","task_id","state","priority"},
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="user_id", type="integer"),
     *             @OA\Property(property="task_id", type="integer"),
     *             @OA\Property(property="state", type="integer"),
     *             @OA\Property(property="priority", type="integer"),
     *             @OA\Property(property="limit_date", type="string", format="date-time", nullable=true)
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Subtarea creada correctamente"
     *     )
     * )
     */
    public function createSubtask(Request $request)
    {
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
    }

    /**
     * @OA\Put(
     *     path="/sub-tasks/{id}",
     *     summary="Actualizar una subtarea",
     *     tags={"Subtasks"},
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
     *     @OA\Response(response=200, description="Subtarea actualizada correctamente"),
     *     @OA\Response(response=404, description="Subtarea no encontrada")
     * )
     */
    public function updateSubtask(Request $request, $id)
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
     * @OA\Delete(
     *     path="/sub-tasks/{id}",
     *     summary="Eliminar una subtarea",
     *     tags={"Subtasks"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response=200, description="Subtarea eliminada correctamente"),
     *     @OA\Response(response=404, description="Subtarea no encontrada")
     * )
     */
    public function deleteSubtask($id)
    {
        if (Subtask::where('id', $id)->exists()) {
            $subtasks = Subtask::find($id);
            $subtasks->delete();

            return response()->json([
                'status' => true,
                'message' => "SubTask Delete successfully!",
                'response' => $subtasks
            ]);
        }
    }
}
