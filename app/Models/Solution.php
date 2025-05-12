<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    /** @use HasFactory<\Database\Factories\SolutionFactory> */
    use HasFactory;

    protected $fillable = [
        'task_id',
        'student_id',
        'points',
        'status',
        'submitted_at',
        'evaluated_at',
        'comments',
        'solution'
    ];

    public function task()  
    {   
        return $this->belongsTo(Task::class);
    }

    public function student()
    {
        return $this->belongsTo(User::class);
    }
}
