<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskRemark extends Model
{
    use HasFactory;

    protected $fillable = ['task_id', 'text'];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
