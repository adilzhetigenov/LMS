<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Task;
use App\Models\Solution;

class TeacherController extends Controller
{
    public function subjects()
    {
        $subjects = Subject::where('teacher_id', auth()->id())->get() ?? collect();
        return view('teacher.subjects', ['subjects' => $subjects]);
    }

    public function createSubject()
    {
        return view('teacher.subject.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "name" => "required",
            "description" => "nullable",
            "code" => "required",
            "credits" => "required"
        ]);
        
        $validatedData['teacher_id'] = auth()->user()->id;
        Subject::create($validatedData);
        return redirect('/teacher/subjects');
    }

    public function details(Subject $subject)
    {
        if ($subject->teacher_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('teacher.subject.details', ['subject' => $subject]);
    }

    public function destroy(Subject $subject)
    {
        if ($subject->teacher_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $subject->delete();
        return redirect()->route('teacher.subjects')
            ->with('success', 'Subject deleted successfully.');
    }

    public function edit(Subject $subject)
    {
        return view('teacher.subject.edit', ['subject' => $subject]);
    }

    public function update(Request $request, Subject $subject)
    {
        $subject->update($request->all());
        return redirect()->route('teacher.subject.details', ['subject' => $subject]);
    }

    public function createTask(Subject $subject)
    {
        return view('teacher.task.create', ['subject' => $subject]);
    }

    public function storeTask(Request $request, Subject $subject)
    {
        $validatedData = $request->validate([
            "name" => "required",
            "description" => "nullable",
            "points" => "required",
            "subject_id" => "required"
        ]);
        
        $validatedData['subject_id'] = $subject->id;
        Task::create($validatedData);
        
        return redirect()->route('teacher.subject.details', ['subject' => $subject]);
    }

    public function taskDetails(Task $task)
    {
        if ($task->subject->teacher_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('teacher.task.details', ['task' => $task]);
    }

    public function destroyTask(Task $task)
    {
        $task->delete();
        return redirect()->route('teacher.task.create');
    }

    public function updateTask(Request $request, Task $task)
    {
        $task->update($request->all());
        return redirect()->route('teacher.task.details', ['task' => $task]);
    }

    public function editTask(Task $task)
    {
        return view('teacher.task.edit', ['task' => $task]);
    }

    public function evaluateTask(Task $task)
    {
        if ($task->subject->teacher_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $task->load(['solutions.student']);
        
        return view('teacher.task.evaluate', [
            'task' => $task,
            'solutions' => $task->solutions ?? collect()
        ]);
    }

    public function storeEvaluation(Request $request, Task $task)
    {
        if ($task->subject->teacher_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $validatedData = $request->validate([
            'solution_id' => 'required|exists:solutions,id',
            'points' => 'required|numeric|min:0|max:' . $task->points,
            'feedback' => 'nullable|string|max:1000'
        ]);

        $solution = Solution::findOrFail($validatedData['solution_id']);
        
        $solution->update([
            'points' => $validatedData['points'],
            'status' => 'evaluated',
            'evaluated_at' => now(),
            'comments' => $validatedData['feedback'] ?? null
        ]);

        return redirect()->route('teacher.task.details', ['task' => $task])
            ->with('success', 'Solution evaluated successfully.');
    }
}

