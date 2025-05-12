@extends('layouts.student')

@section('content')
    <div class="container mt-4 mb-5">
        <div class="row">
            <div class="col-md-12">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('student.subjects') }}">My Subjects</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('student.subject.details', ['subject' => $task->subject]) }}">{{ $task->subject->name }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('student.task.details', ['task' => $task]) }}">{{ $task->name }}</a></li>
                        <li class="breadcrumb-item active">Submit Solution</li>
                    </ol>
                </nav>

                <!-- Task Details Card -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h1 class="h3 mb-0">Submit Solution for: {{ $task->name }}</h1>
                    </div>
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-3">Subject:</dt>
                            <dd class="col-sm-9">{{ $task->subject->name }}</dd>

                            <dt class="col-sm-3">Description:</dt>
                            <dd class="col-sm-9">{{ $task->description }}</dd>

                            <dt class="col-sm-3">Points:</dt>
                            <dd class="col-sm-9">{{ $task->points }}</dd>
                        </dl>
                    </div>
                </div>

                <!-- Submission Form -->
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h2 class="h4 mb-0">Your Solution</h2>
                    </div>
                    <div class="card-body">
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('student.task.submit', ['task' => $task]) }}" method="POST">
                            @csrf
                            
                            <div class="mb-4">
                                <label for="solution" class="form-label">Solution *</label>
                                <textarea 
                                    class="form-control @error('solution') is-invalid @enderror" 
                                    id="solution" 
                                    name="solution" 
                                    rows="10" 
                                    required
                                    placeholder="Type your solution here...">{{ old('solution') }}</textarea>
                                @error('solution')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <div class="form-text">This field is required. Please provide your complete solution.</div>
                            </div>

                            <div class="mb-4">
                                <label for="comments" class="form-label">Additional Comments (Optional)</label>
                                <textarea 
                                    class="form-control @error('comments') is-invalid @enderror" 
                                    id="comments" 
                                    name="comments" 
                                    rows="3" 
                                    placeholder="Add any additional comments or notes about your solution...">{{ old('comments') }}</textarea>
                                @error('comments')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('student.task.details', ['task' => $task]) }}" class="btn btn-secondary">Cancel</a>
                                <button type="submit" class="btn btn-primary">Submit Solution</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection