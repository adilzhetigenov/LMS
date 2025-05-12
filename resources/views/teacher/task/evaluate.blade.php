@extends('layouts.teacher')
@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Evaluate Solutions</h1>
        
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('teacher.subjects') }}">My Subjects</a></li>
                <li class="breadcrumb-item"><a href="{{ route('teacher.subject.details', ['subject' => $task->subject]) }}">{{ $task->subject->name }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('teacher.task.details', ['task' => $task]) }}">{{ $task->name }}</a></li>
                <li class="breadcrumb-item active">Evaluate Solutions</li>
            </ol>
        </nav>
        
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h5 class="card-title mb-0">Task Details</h5>
            </div>
            <div class="card-body">
                <h5>{{ $task->name }} ({{ $task->points }} points)</h5>
                <p>{{ $task->description }}</p>
            </div>
        </div>

        @forelse($solutions as $solution)
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">Solution by {{ $solution->student->name }} ({{ $solution->student->email }})</h5>
                    <small class="text-muted">Submitted: {{ \Carbon\Carbon::parse($solution->submitted_at)->format('Y-m-d H:i') }}</small>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6>Solution:</h6>
                        <div class="border p-3 bg-light">
                            <pre class="mb-0">{{ $solution->solution }}</pre>
                        </div>
                    </div>

                    <form action="{{ route('teacher.task.evaluate.store', ['task' => $task]) }}" method="POST">
                        @csrf
                        <input type="hidden" name="solution_id" value="{{ $solution->id }}">
                        
                        <div class="mb-3">
                            <label for="points_{{ $solution->id }}" class="form-label">Points (0-{{ $task->points }})</label>
                            <input type="number" class="form-control" id="points_{{ $solution->id }}" name="points" 
                                min="0" max="{{ $task->points }}" required
                                value="{{ $solution->points ?? 0 }}">
                            <div class="invalid-feedback">
                                Points are required and must be between 0 and {{ $task->points }}.
                            </div>
                        </div>
                        
                        <div class="mb-3">
                            <label for="feedback_{{ $solution->id }}" class="form-label">Feedback (optional)</label>
                            <textarea class="form-control" id="feedback_{{ $solution->id }}" name="feedback" rows="3">{{ $solution->comments }}</textarea>
                        </div>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="submit" class="btn btn-primary">Save Evaluation</button>
                        </div>
                    </form>
                </div>
            </div>
        @empty
            <div class="alert alert-info">
                No solutions have been submitted for this task yet.
            </div>
        @endforelse
    </div>
@endsection