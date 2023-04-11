<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status',
        'user_id'
    ];

    static function getTasksByUserId(int $userId): array|\Illuminate\Database\Eloquent\Collection

    {
        $tasks = self::query()->where('user_id', '=', $userId)->get();
        return $tasks->sortBy('created_at');
    }
}
