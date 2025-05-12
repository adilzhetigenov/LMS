<?php

use App\Http\Controllers\ContactController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('main',["numberOfUsers" => 10]);
});
Route::get("/contact", [ContactController::class, 'index'])->name('contact');
Route::get('/auth/register', [RegisterController::class, 'register'])->name('register');
Route::get('/auth/login', [LoginController::class, 'login'])->name('login.form');
Route::post('/auth/register', [RegisterController::class, 'store']);
Route::post('/auth/login', [LoginController::class, 'authenticate'])->name('login');
Route::post('/auth/logout', [LoginController::class, 'logout'])->name('logout');



Route::get('/student/subjects', [StudentController::class, 'subjects'])->name('student.subjects');
Route::get('/student/subject/take', [StudentController::class, 'take'])->name('student.subject.take');
Route::post('/student/subject/take/{subject}', [StudentController::class, 'takeSubject'])->name('student.subject.takeSubject');
Route::get('/student/subject/details/{subject}', [StudentController::class, 'subjectDetails'])->name('student.subject.details');
Route::delete('/student/subject/leave/{subject}', [StudentController::class, 'leaveSubject'])->name('student.subject.leave');
Route::get('/student/subject/task/details/{task}', [StudentController::class, 'taskDetails'])->name('student.task.details');

// Show submission form
Route::get('/student/subject/task/submit/{task}', [StudentController::class, 'showSubmitForm'])->name('student.task.submit.form');
// Handle submission
Route::post('/student/subject/task/submit/{task}', [StudentController::class, 'submitTask'])->name('student.task.submit');




Route::get('/teacher/subjects', [TeacherController::class, 'subjects'])->name('teacher.subjects');
Route::get('/teacher/subject/create', [TeacherController::class, 'createSubject'])->name('teacher.subject.create');
Route::post('/teacher/subject/create', [TeacherController::class, 'store'])->name('teacher.subject.store');
Route::get('/teacher/subject/details/{subject}', [TeacherController::class, 'details'])->name('teacher.subject.details');
Route::get('/teacher/subject/edit/{subject}', [TeacherController::class, 'edit'])->name('teacher.subject.edit');
Route::delete('/teacher/subject/{subject}', [TeacherController::class, 'destroy'])->name('teacher.subject.destroy');
Route::put('/teacher/subject/{subject}', [TeacherController::class, 'update'])->name('teacher.subject.update');

Route::get('/teacher/task/create/{subject}', [TeacherController::class, 'createTask'])->name('teacher.task.create');
Route::post('/teacher/task/create/{subject}', [TeacherController::class, 'storeTask'])->name('teacher.task.store');
Route::get('/teacher/task/details/{task}', [TeacherController::class, 'taskDetails'])->name('teacher.task.details');
Route::delete('/teacher/task/{task}', [TeacherController::class, 'destroyTask'])->name('teacher.task.destroy');
Route::get('/teacher/task/edit/{task}', [TeacherController::class, 'editTask'])->name('teacher.task.edit');
Route::put('/teacher/task/{task}', [TeacherController::class, 'updateTask'])->name('teacher.task.update');
Route::get('/teacher/task/evaluate/{task}', [TeacherController::class, 'evaluateTask'])->name('teacher.task.evaluate');
Route::post('/teacher/task/evaluate/{task}', [TeacherController::class, 'storeEvaluation'])->name('teacher.task.evaluate.store');