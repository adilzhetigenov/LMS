    @extends('layouts.teacher')
    @section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Edit Task</h1>
        
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('teacher.subjects') }}">My Subjects</a></li>
                <li class="breadcrumb-item"><a href="{{ route('teacher.subject.details', ['subject' => $task->subject]) }}">{{ $task->subject->name }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('teacher.task.details', ['task' => $task]) }}">{{ $task->name }}</a></li>
                <li class="breadcrumb-item active">Edit</li>
            </ol>
        </nav>
        
        <div class="card">
            <div class="card-body">
                <form action="{{ route('teacher.task.update', ['task' => $task]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Task name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $task->name }}" required minlength="5">
                        <div class="invalid-feedback">
                            Task name is required and must be at least 5 characters long.
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Task description</label>
                        <textarea class="form-control" id="description" name="description" rows="5" required>{{ $task->description }}</textarea>
                        <div class="invalid-feedback">
                            Task description is required.
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="points" class="form-label">Points</label>
                        <input type="number" class="form-control" id="points" name="points" value="{{ $task->points }}" min="1" required>   
                        <div class="invalid-feedback">
                            Points is required and must be a positive number.
                        </div>
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="{{ route('teacher.task.details', ['task' => $task]) }}" class="btn btn-secondary me-md-2">Cancel</a>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection