<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Task;
use App\Models\Solution;

class StudentController extends Controller
{
    public function subjects()
    {
        $subjects = auth()->user()->subjects ?? collect();
        return view('student.subjects', ['subjects' => $subjects]);
    }

    public function take()
    {
        $subjects = Subject::all();
        return view('student.subject.take', ['subjects' => $subjects]);
    }

    public function takeSubject(Subject $subject)
    {
        if (!$subject->students()->where('student_id', auth()->id())->exists()) {
            $subject->students()->attach(auth()->id());
            return redirect()->route('student.subjects')->with('success', 'Successfully enrolled in the subject.');
        }
        
        return redirect()->route('student.subjects')->with('error', 'You are already enrolled in this subject.');
    }

    public function subjectDetails(Subject $subject)
    {
        $subject->load(['tasks.solutions' => function($query) {
            $query->where('student_id', auth()->id());
        }]);
        return view('student.subject.details', ['subject' => $subject]);
    }

    public function leaveSubject(Subject $subject)
    {
        $subject->students()->detach(auth()->id());
        return redirect()->route('student.subjects')->with('success', 'Successfully left the subject.');
    }

    public function taskDetails(Task $task)
    {
        $task->load('solutions');
        return view('student.task.details', ['task' => $task]);
    }

    public function showSubmitForm(Task $task)
    {
        $task->load('solutions');
        return view('student.task.submit', ['task' => $task]);
    }

    public function submitTask(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'solution' => [
                'required',
                'string',
                'min:10',
                'max:10000',
                function ($attribute, $value, $fail) {
                    if (trim($value) === '') {
                        $fail('The solution cannot be empty or just whitespace.');
                    }
                },
            ],
            'comments' => [
                'nullable',
                'string',
                'max:1000',
            ]
        ], [
            'solution.required' => 'Please provide your solution.',
            'solution.min' => 'Your solution must be at least 10 characters long.',
            'solution.max' => 'Your solution cannot exceed 10000 characters.',
            'comments.max' => 'Comments cannot exceed 1000 characters.'
        ]);

        $solution = new Solution([
            'task_id' => $task->id,
            'student_id' => auth()->id(),
            'solution' => $validatedData['solution'],
            'comments' => $validatedData['comments'] ?? null,
            'status' => 'not evaluated',
            'submitted_at' => now(),
            'points' => 0
        ]);

        $solution->save();

        return redirect()->route('student.task.details', $task)
            ->with('success', 'Solution submitted successfully.');
    }
}
