    @extends('layouts.student')
    @section('content')
    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('student.subjects') }}">My Subjects</a></li>
                <li class="breadcrumb-item active">{{ $subject->name }}</li>
            </ol>
        </nav>
        
        <div class="card mb-4">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0">{{ $subject->name }}</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <p><strong>Description:</strong> {{ $subject->description }}</p>
                        <p><strong>Code:</strong> {{ $subject->code }}</p>
                        <p><strong>Credits:</strong> {{ $subject->credits }}</p>
                        <p><strong>Created:</strong> {{ $subject->created_at->format('F d, Y') }}</p>
                        <p><strong>Last Modified:</strong> {{ $subject->updated_at->format('F d, Y') }}</p>
                        <p><strong>Number of Students:</strong> {{ $subject->students->count() }}</p>
                        <p><strong>Teacher:</strong> {{ $subject->teacher->name }} ({{ $subject->teacher->email }})</p>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="mb-0">Students</h5>
                            </div>
                            <div class="card-body">
                                <ul class="list-group">
                                    @foreach ($subject->students as $student)
                                        <li class="list-group-item">{{ $student->name }} ({{ $student->email }})</li>
                                    @endforeach
                                    <li class="list-group-item">
                                        <a href="#" data-bs-toggle="collapse" data-bs-target="#moreStudents">Show more...</a>
                                        <div class="collapse" id="moreStudents">
                                            <ul class="list-unstyled ms-3 mt-2">
                                                @foreach ($subject->students as $student)
                                                    <li>{{ $student->name }} ({{ $student->email }})</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <h3 class="mb-3">Tasks</h3>
        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Points</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subject->tasks as $task)
                    <tr>
                        <td><a href="{{ route('student.task.details', $task) }}">{{ $task->name }}</a></td>
                        <td>{{ $task->points }}</td>
                        <td>
                            @if($task->solutions->isNotEmpty())
                                <span class="badge bg-success">Submitted (evaluated: {{ $task->solutions->first()->points }}/{{ $task->points }})</span>
                            @else
                                <span class="badge bg-warning text-dark">Not submitted</span>
                            @endif
                        </td>
                        <td>
                            @if($task->solutions->isEmpty())
                                <a href="{{ route('student.task.submit', $task) }}" class="btn btn-sm btn-primary">Submit</a>
                            @else
                                <button class="btn btn-sm btn-outline-primary" disabled>Already submitted</button>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endsection