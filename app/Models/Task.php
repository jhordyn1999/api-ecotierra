<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Task",
 *     type="object",
 *     title="Task",
 *     required={"id", "name", "user_id", "priority", "state"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Actualizar endpoints"),
 *     @OA\Property(property="user_id", type="integer", example=2),
 *     @OA\Property(property="priority", type="integer", example=1),
 *     @OA\Property(property="state", type="integer", example=0),
 *     @OA\Property(property="limit_date", type="string", format="date-time", example="2025-07-31T23:59:00Z"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-07-13T15:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-07-13T15:10:00Z")
 * )
 */

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'user_id', 'priority' , 'state' , 'limit_date'
    ];
}
