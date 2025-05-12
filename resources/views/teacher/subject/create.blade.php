@extends('layouts.teacher')
@section('content')
    <!-- Main Content -->
    <div class="container mt-4 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h1 class="h3 mb-0">Create New Subject</h1>
                    </div>
                    <div class="card-body">
                    <form action="{{ route('teacher.subject.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="subject_name" class="form-label">Subject Name</label>
                            <input type="text" class="form-control" id="subject_name" name="name" required minlength="3">
                            <div class="form-text">Minimum 3 characters</div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="subject_code" class="form-label">Subject Code</label>
                            <input type="text" class="form-control" id="subject_code" name="code" required pattern="IK-[A-Z]{3}[0-9]{3}">
                            <div class="form-text">Format: IK-SSSNNN where S is a capital letter and N is a number (e.g., IK-WEB101)</div>
                        </div>
                        <div class="mb-3">
                            <label for="credits" class="form-label">Credit Value</label>
                            <input type="number" class="form-control" id="credits" name="credits" required min="1" max="10">
                        </div>
                        <div class="d-flex justify-content-between">
                            <a href="/teacher/subjects" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Create Subject</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection