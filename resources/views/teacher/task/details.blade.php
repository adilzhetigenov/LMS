@extends('layouts.teacher')
@section('content')

        <!-- Main Content -->
        <div class="container mt-4 mb-5">
        <div class="row">
            <div class="col-md-12">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('teacher.subjects') }}">My Subjects</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('teacher.subject.details', ['subject' => $task->subject]) }}">{{ $task->subject->name }}</a></li>
                        <li class="breadcrumb-item active">{{ $task->name }}</li>
                    </ol>
                </nav>

                <!-- Task Details Card -->
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h1 class="h3 mb-0">{{ $task->name }}</h1>
                        <a href="{{ route('teacher.task.edit', ['task' => $task]) }}" class="btn btn-light">Edit Task</a>
                    </div>
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-3">Subject:</dt>
                            <dd class="col-sm-9">{{ $task->subject->name }} ({{ $task->subject->code }})</dd>

                            <dt class="col-sm-3">Description:</dt>
                            <dd class="col-sm-9">{{ $task->description }}</dd>

                            <dt class="col-sm-3">Points:</dt>
                            <dd class="col-sm-9">{{ $task->points }}</dd>

                            <dt class="col-sm-3">Created At:</dt>
                            <dd class="col-sm-9">{{ $task->created_at->format('Y-m-d') }}</dd>

                            <dt class="col-sm-3">Last Modified:</dt>
                            <dd class="col-sm-9">{{ $task->updated_at->format('Y-m-d') }}</dd>

                            <dt class="col-sm-3">Submitted Solutions:</dt>
                            <dd class="col-sm-9">0</dd>

                            <dt class="col-sm-3">Evaluated Solutions:</dt>
                            <dd class="col-sm-9">0</dd>
                        </dl>
                    </div>
                </div>

                <!-- Solutions List -->
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h2 class="h4 mb-0">Submitted Solutions</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Student</th>
                                        <th>Email</th>
                                        <th>Submission Date</th>
                                        <th>Status</th>
                                        <th>Points</th>
                                        <th>Comments</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($task->solutions as $solution)
                                        <tr>
                                            <td>{{ $solution->student->name }}</td>
                                            <td>{{ $solution->student->email }}</td>
                                            <td>{{ \Carbon\Carbon::parse($solution->submitted_at)->format('Y-m-d H:i') }}</td>
                                            <td>
                                                @if($solution->status === 'evaluated')
                                                    <span class="badge bg-success">Evaluated</span>
                                                @else
                                                    <span class="badge bg-warning text-dark">Not Evaluated</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($solution->status === 'evaluated')
                                                    {{ $solution->points }}/{{ $task->points }}
                                                @else
                                                    -
                                                @endif
                                            </td>
                                            <td>{{ $solution->comments ?? 'No comments' }}</td>
                                            <td>
                                                <a href="{{ route('teacher.task.evaluate', ['task' => $task]) }}" class="btn btn-sm btn-primary">Evaluate</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No solutions submitted yet</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection