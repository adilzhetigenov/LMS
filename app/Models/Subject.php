<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    /** @use HasFactory<\Database\Factories\SubjectFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'credits',
        'teacher_id',
        'description'
    ];

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'student_subject', 'subject_id', 'student_id')
            ->where('role', 'student');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function solutions()
    {
        return $this->hasManyThrough(Solution::class, Task::class);
    }
}
