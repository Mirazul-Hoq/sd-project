<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\AssignTeacherController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\MemberController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('auth.login');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/teacher/registration', [TeacherController::class, 'register'])->name('teacher');
Route::post('/teacher/registration', [TeacherController::class, 'store'])->name('teacher.store');

Route::middleware('auth')->group(function() {
    Route::get('/admin-dashboard', [AdminController::class, 'dashboard']);
});


/*
|--------------------------------------------------------------------------
| Admin Related Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->group(function() {

    Route::get('/courses', [CourseController::class, 'index'])->name('courses');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::patch('/courses/update/{course}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/delete/{course}', [CourseController::class, 'delete'])->name('courses.delete');

    Route::get('/assign/course/teacher', [AssignTeacherController::class, 'index'])->name('assign.course.teacher');
    Route::post('/assign/course/teacher', [AssignTeacherController::class, 'store'])->name('course.teacher.store');

    Route::get('session', [SessionController::class, 'index'])->name('session');
    Route::post('session', [SessionController::class, 'store'])->name('session.store');
    Route::patch('/sessions/update/{session}', [SessionController::class, 'update'])->name('session.update');
    Route::delete('/sessions/delete/{session}', [SessionController::class, 'delete'])->name('session.delete');

    Route::get('teacher/list', [AdminController::class, 'teacherList'])->name('teacher.list');
});


/*
|--------------------------------------------------------------------------
| Teacher Related Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'teacher'])->group(function() {
    Route::get('/teacher/section', [AdminController::class, 'teacher'])->name('teacher');
});


/*
|--------------------------------------------------------------------------
| Student Related Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'student'])->group(function() {
    // Group
    Route::get('/student/group', [GroupController::class, 'index'])->name('group');
    Route::post('/student/group', [GroupController::class, 'store'])->name('group.store');
    Route::patch('/student/edit/group/{group}', [GroupController::class, 'update'])->name('group.update');

    // Member
    Route::get('student/group/member/{group}', [MemberController::class, 'index']);
    Route::post('student/group/member', [MemberController::class, 'store']);
});