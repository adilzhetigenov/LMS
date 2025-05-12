@extends('layouts.teacher')
@section('content') 
    <!-- Main Content -->
    <div class="container mt-4 mb-5">
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h1 class="h3 mb-0">My Subjects</h1>
                <a href="{{ route('teacher.subject.create') }}" class="btn btn-light">Create New Subject</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Subject Name</th>
                                <th>Description</th>
                                <th>Subject Code</th>
                                <th>Credits</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($subjects as $subject)
                            <tr>
                                <td><a href="{{ route('teacher.subject.details', ['subject' => $subject]) }}">{{ $subject->name }}</a></td>
                                <td>{{ $subject->description }}</td>
                                <td>{{ $subject->code }}</td>
                                <td>{{ $subject->credits }}</td>
                            </tr>
                            @endforeach
                            <!-- <tr>
                                <td><a href="subject-details.html">Web Programming</a></td>
                                <td>Introduction to web development technologies</td>
                                <td>IK-WEB101</td>
                                <td>5</td>
                            </tr>
                            <tr>
                                <td><a href="subject-details.html">Database Systems</a></td>
                                <td>Fundamentals of database design and management</td>
                                <td>IK-DBS202</td>
                                <td>4</td>
                            </tr>
                            <tr>
                                <td><a href="subject-details.html">Algorithm Design</a></td>
                                <td>Advanced algorithms and their implementation</td>
                                <td>IK-ALG303</td>
                                <td>6</td>
                            </tr> -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection