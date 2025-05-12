@extends('layouts.student')
@section('content')
    <!-- Main Content -->
    <div class="container mt-4 mb-5">
        <div class="row">
            <div class="col-md-12">
                <!-- Breadcrumb -->
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('student.subjects') }}">My Subjects</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('student.subject.details', ['subject' => $task->subject]) }}">{{ $task->subject->name }}</a></li>
                        <li class="breadcrumb-item active">{{ $task->name }}</li>
                    </ol>
                </nav>

                <div class="card mb-4">
                    <div class="card-header bg-primary text-white">
                        <h1 class="h3 mb-0">{{ $task->name }}</h1>
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
                        </dl>

                        <!-- Submit Solution Button -->
                        <div class="mt-4">
                            <a href="{{ route('student.task.submit.form', ['task' => $task]) }}" class="btn btn-primary">Submit New Solution</a>
                        </div>
                    </div>
                </div>

                <!-- Your Solutions -->
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h2 class="h4 mb-0">Your Solutions</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Submission Date</th>
                                        <th>Status</th>
                                        <th>Points</th>
                                        <th>Solution</th>
                                        <th>Comments</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($task->solutions->where('student_id', auth()->id())->sortByDesc('submitted_at') as $solution)
                                        <tr>
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
                                            <td>
                                                <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#solutionModal{{ $solution->id }}">
                                                    View Solution
                                                </button>
                                            </td>
                                            <td>
                                                @if($solution->comments)
                                                    <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#commentsModal{{ $solution->id }}">
                                                        View Comments
                                                    </button>
                                                @else
                                                    No comments
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('student.task.submit.form', ['task' => $task]) }}" class="btn btn-sm btn-primary">Submit New</a>
                                            </td>
                                        </tr>

                                        <!-- Solution Modal -->
                                        <div class="modal fade" id="solutionModal{{ $solution->id }}" tabindex="-1" aria-labelledby="solutionModalLabel{{ $solution->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="solutionModalLabel{{ $solution->id }}">Your Solution</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="border p-3 bg-light">
                                                            {!! nl2br(e($solution->solution)) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Comments Modal -->
                                        <div class="modal fade" id="commentsModal{{ $solution->id }}" tabindex="-1" aria-labelledby="commentsModalLabel{{ $solution->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="commentsModalLabel{{ $solution->id }}">Your Comments</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="border p-3 bg-light">
                                                            {!! nl2br(e($solution->comments)) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No solutions submitted yet</td>
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