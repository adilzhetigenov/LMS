@extends('layouts.teacher')
@section('content')
    <!-- Main Content -->
    <div class="container mt-4 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h1 class="h3 mb-0">Create New Task for {{$subject->name}} </h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('teacher.task.store', ['subject' => $subject]) }}" method="post">
                            @csrf
                            <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                            <div class="mb-3">
                                <label for="name" class="form-label">Task Name</label>
                                <input type="text" class="form-control" id="name" name="name" required minlength="5">
                                <div class="form-text">Minimum 5 characters</div>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Task Description</label>
                                <textarea class="form-control" id="description" name="description" rows="5" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="points" class="form-label">Points</label>
                                <input type="number" class="form-control" id="points" name="points" value="10" required min="1" max="100">
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('teacher.subject.details', ['subject' => $subject]) }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Create Task</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection