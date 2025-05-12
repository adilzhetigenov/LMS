@php
    $layout = 'layouts.main';
    if (auth()->check()) {
        $layout = auth()->user()->role === 'teacher' ? 'layouts.teacher' : 'layouts.student';
    }
@endphp

@extends($layout)

@section('content')
    <div class="container mt-4 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h1 class="h3 mb-0">Contact Information</h1>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-3 fw-bold">Name:</div>
                            <div class="col-md-9">Adil Zhetigenov</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-3 fw-bold">Neptun Code:</div>
                            <div class="col-md-9">RHZ142</div>
                        </div>
                        <div class="row">
                            <div class="col-md-3 fw-bold">Email Address:</div>
                            <div class="col-md-9">jetigenovadil@gmail.com</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
