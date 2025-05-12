@extends('layouts.teacher')
@section('content')
    <!-- Main Content -->
    <div class="container mt-4 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h1 class="h3 mb-0">{{ $subject->name }}</h1>
                        <div>
                            <a href="{{ route('teacher.subject.edit', ['subject' => $subject->id]) }}" class="btn btn-light me-2">Edit Subject</a>
                            <form action="{{ route('teacher.subject.destroy', ['subject' => $subject->id]) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this subject?')">
                                    Delete Subject
                                </button>
                            </form>
                        </div>
                    </div>
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-3">Description:</dt>
                            <dd class="col-sm-9">{{ $subject->description }}</dd>

                            <dt class="col-sm-3">Subject Code:</dt>
                            <dd class="col-sm-9">{{ $subject->code }}</dd>

                            <dt class="col-sm-3">Credit Value:</dt>
                            <dd class="col-sm-9">{{ $subject->credits }}</dd>

                            <dt class="col-sm-3">Created At:</dt>
                            <dd class="col-sm-9">{{ $subject->created_at }}</dd>

                            <dt class="col-sm-3">Last Modified:</dt>
                            <dd class="col-sm-9">{{ $subject->updated_at }}</dd>

                            <dt class="col-sm-3">Students Enrolled:</dt>
                            <dd class="col-sm-9">{{ $subject->students->count() }} students</dd>
                        </dl>
                    </div>
                </div>

                <!-- Enrolled Students -->
                <div class="card mb-4">
                    <div class="card-header bg-info text-white">
                        <h2 class="h4 mb-0">Enrolled Students</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($subject->students as $student)
                                        <tr>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->email }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center">No students enrolled yet</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Tasks -->
                <div class="card">
                    <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                        <h2 class="h4 mb-0">Tasks</h2>
                        <a href="{{ route('teacher.task.create',['subject' => $subject])}}" class="btn btn-light">Create New Task</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Task Name</th>
                                        <th>Points</th>
                                        <th>Solutions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(\App\Models\Task::where('subject_id', $subject->id)->get() as $task)
                                    <tr>
                                        <td><a href="{{ route('teacher.task.details', ['task' => $task]) }}">{{ $task->name }}</a></td>
                                        <td>{{ $task->points }}</td>
                                        <td>0 submitted / 0 evaluated</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection