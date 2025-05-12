@extends('layouts.main')
    <!-- Main Content -->
    @section('content')
    <div class="container mt-4 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h1 class="h3 mb-0">Welcome to Learning Management System</h1>
                    </div>
                    <div class="card-body">
                        <p class="lead">
                            This Learning Management System (LMS) is designed to facilitate teaching and learning processes.
                        </p>
                        <p>
                            With this system, teachers can create and manage subjects, create tasks, and evaluate student solutions.
                            Students can take subjects, view tasks, and submit solutions.
                        </p>
                        <p>
                            To get started, please login or register using the links in the navigation bar.
                        </p>
                        <p>
                            There are {{ $numberOfUsers }} users in the system.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
