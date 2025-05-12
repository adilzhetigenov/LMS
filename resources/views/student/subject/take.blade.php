    @extends('layouts.student')
    @section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Available Subjects</h1>
        @foreach ($subjects as $subject)
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ $subject->name }}</h5>
                        <form action="{{ route('student.subject.takeSubject', $subject) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">Take Subject</button>
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
