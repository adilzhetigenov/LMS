@extends('layouts.student')
@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>My Subjects</h1>
            <a href="{{ route('student.subject.take') }}" class="btn btn-primary">Take a New Subject</a>
        </div>
        @foreach ($subjects as $subject)
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0"><a href="{{ route('student.subject.details', $subject) }}">{{ $subject->name }}</a></h5>
                        <form action="{{ route('student.subject.leave', $subject->id) }}" method="POST" class="d-inline">   
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Leave Subject</button>
                        </form>
                    </div>
                    <div class="card-body">
                        <p><strong>Description:</strong> {{ $subject->description }}</p>
                        <p><strong>Code:</strong> {{ $subject->code }}</p>
                        <p><strong>Credits:</strong> {{ $subject->credits }}</p>
                        <p><strong>Teacher:</strong> {{ $subject->teacher->name }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @endsection