<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClubController;
use App\Http\Controllers\ExerciseController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\SessionGroupController;
use App\Http\Controllers\TestingClassController;
use App\Http\Controllers\TrainingPlanController;
use App\Http\Controllers\TrainingSessionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//
//Route::get('/testingclass', function(){
//   return view('testing-class-index');
//});

Route::get('/testing-class', [TestingClassController::class, 'index']);

Route::middleware('auth', 'user.approved')->group(function () {

    Route::get('exercises/favorites', [ExerciseController::class, 'bookmarks'])->name('exercises.bookmarks');

    Route::resource('exercises', ExerciseController::class)->only([
        'index', 'show',
    ]);

    Route::resource('training-plans', TrainingPlanController::class)->only([
        'index', 'show',
    ]);

    Route::resource('session-groups', SessionGroupController::class)->only([
        'index', 'show',
    ]);

    Route::resource('training-sessions', TrainingSessionController::class)->only([
        'index', 'show',
    ]);

    Route::resource('clubs', ClubController::class)->only([
        'index',
    ]);

    Route::resource('categories', CategoryController::class)->only([
        'index', 'show',
    ]);

    Route::resource('guides', GuideController::class)->only([
       'index', 'show'
    ]);

    Route::get('training-sessions/{trainingSession}/print', [TrainingSessionController::class, 'print'])->name('training-sessions.print');

    Route::get('/', function(){
        return view('dashboard');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/user-not-approved', [UserController::class, 'notApproved'])->middleware('auth')->name('user-not-approved');

Route::get('table', function () {
    return view('test.table');
});
