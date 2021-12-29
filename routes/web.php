<?php

use App\Http\Controllers\Admins\AdminProfessionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Users\CandidateProfessionController;
use App\Http\Controllers\Users\ProfessionController;

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
], function() {
    // for authenticated users
    Route::resource('professions', ProfessionController::class)->only(['show']);

    // Additional routes for resource controller
    Route::post('/candidates/{candidate}/professions/{profession}', [CandidateProfessionController::class, 'apply'])->name('candidates.professions.apply');
    Route::put('/candidates/{candidate}/professions/{profession}', [CandidateProfessionController::class, 'unapply'])->name('candidates.professions.unapply');
    Route::resource('candidates.professions', CandidateProfessionController::class)->only(['index']);
});

Route::group([
    'prefix' => 'admins',
    'as' => 'admins.',
], function() {
    /// for authenticated admin users
    Route::get('/professions/expired', [AdminProfessionController::class, 'expiredProfessions'])->name('professions.expired');
    Route::resource('professions', AdminProfessionController::class)->only(['index', 'create', 'store', 'show']);
});

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Auth::routes();