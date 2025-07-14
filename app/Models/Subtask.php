<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Subtask",
 *     type="object",
 *     title="Subtask",
 *     required={"id", "name", "task_id", "user_id", "priority", "state"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Subir documento"),
 *     @OA\Property(property="task_id", type="integer", example=2),
 *     @OA\Property(property="user_id", type="integer", example=3),
 *     @OA\Property(property="priority", type="integer", example=2),
 *     @OA\Property(property="state", type="integer", example=0),
 *     @OA\Property(property="limit_date", type="string", format="date-time", example="2025-07-31T23:59:00Z"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-13T15:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-13T15:10:00Z")
 * )
 */

class Subtask extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','task_id', 'user_id', 'priority', 'limit_date', 'state'
    ];

}
