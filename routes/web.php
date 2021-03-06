<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ProfessionController;
use App\Http\Controllers\Users\ExamController;
use App\Http\Controllers\Users\DocumentController;
use App\Http\Controllers\Users\CandidateController;
use App\Http\Controllers\Users\CandidateProfessionController;
use App\Http\Controllers\Admins\ExamController as AdminExamController;
use App\Http\Controllers\Admins\UserController as AdminUserController;
use App\Http\Controllers\Admins\LocationController as AdminLocationController;
use App\Http\Controllers\Admins\QuestionController as AdminQuestionController;
use App\Http\Controllers\Admins\CandidateController as AdminCandidateController;
use App\Http\Controllers\Admins\ProfessionController as AdminProfessionController;

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
//     return view('home');
// });

Route::group([
    'prefix' => 'users',
    'as' => 'users.',
    'middleware' => ['auth', 'preventBackHistory'],
], function() {
    // for authenticated users
    // Additional routes for resource controller
    Route::post('/candidates/{candidate}/professions/{profession}/apply', [CandidateProfessionController::class, 'apply'])->name('candidates.professions.apply');
    Route::post('/candidates/{candidate}/professions/{profession}/unapply', [CandidateProfessionController::class, 'unapply'])->name('candidates.professions.unapply');
    Route::resource('candidates.professions', CandidateProfessionController::class)->only(['update']);

    Route::get('/candidates/{candidate}/professions', [CandidateController::class, 'professions'])->name('candidates.professions');
    Route::resource('candidates', CandidateController::class)->only(['show', 'edit', 'update']);

    Route::delete('/candidates/{candidate}/document/destroy', [DocumentController::class, 'destroy'])->name('candidates.documents.destroy');

    Route::get('candidates/{candidate}/professions/{profession}/exams/{exam}', [ExamController::class, 'show'])->name('candidates.professions.exams.show');
    Route::get('candidates/{candidate}/professions/{profession}/exams/{exam}/results', [ExamController::class, 'results'])->name('candidates.professions.exams.results');
});

Route::group([
    'prefix' => 'admins',
    'as' => 'admins.',
    'middleware' => ['auth', 'admin', 'preventBackHistory'],
], function() {
    // for authenticated admin users
    Route::get('/professions/expired', [AdminProfessionController::class, 'expired'])->name('professions.expired');
    // This route is not in use right now, find a way how to also restore all related questons that have been soft deleted (observer method or similar solution).
    // Route::post('/professions/restore-all', [AdminProfessionController::class, 'restoreAll'])->name('professions.restore-all');
    Route::post('/professions/{profession}/restore', [AdminProfessionController::class, 'restore'])->name('professions.restore');
    Route::post('/professions/{profession}/force-delete', [AdminProfessionController::class, 'forceDelete'])->name('professions.force-delete');
    Route::get('/professions/destroyed', [AdminProfessionController::class, 'destroyed'])->name('professions.destroyed');
    Route::resource('professions', AdminProfessionController::class);

    Route::resource('users', AdminUserController::class)->except(['show', 'destroy']);

    Route::resource('candidates', AdminCandidateController::class)->only(['index', 'show']);

    // Custom route for resource controller because we needed additional parameter
    Route::get('/questions/create/{exam?}', [AdminQuestionController::class, 'create'])->name('questions.create');
    Route::post('/questions/{question}/restore', [AdminQuestionController::class, 'restore'])->name('questions.restore');
    Route::post('/questions/{question}/force-delete', [AdminQuestionController::class, 'forceDelete'])->name('questions.force-delete');
    Route::get('/questions/destroyed', [AdminQuestionController::class, 'destroyed'])->name('questions.destroyed');
    Route::resource('questions', AdminQuestionController::class)->except(['create', 'show']);

    Route::get('/locations/{location}/candidates', [AdminLocationController::class, 'candidates'])->name('locations.candidates');
    Route::get('/locations/{location}/professions', [AdminLocationController::class, 'professions'])->name('locations.professions');
    Route::post('locations/{location}/enable', [AdminLocationController::class, 'enable'])->name('locations.enable');
    Route::post('locations/{location}/disable', [AdminLocationController::class, 'disable'])->name('locations.disable');
    Route::resource('locations', AdminLocationController::class)->except(['show', 'destroy']);

    Route::get('exams/{exam}/questions', [AdminExamController::class, 'questions'])->name('exams.questions');
    Route::get('exams/{exam}/professions', [AdminExamController::class, 'professions'])->name('exams.professions');
    Route::resource('exams', AdminExamController::class)->except(['show', 'destroy']);
});

// This routes does not require authentication.
Route::get('/', [ProfessionController::class, 'index'])->name('professions.index'); // Home page
Route::resource('professions', ProfessionController::class)->only(['show']);

Route::resource('locations', LocationController::class)->only(['index', 'show']);

// Routes related to authentication.
Auth::routes();