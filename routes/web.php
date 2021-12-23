<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfessionController;

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
    'prefix' => 'user',
    'as' => 'user.',
    'namespace' => 'User',
    'middleware' => ['auth'],
], function() {
    // for authenticated users
    Route::resource('professions', ProfessionController::class)->only('index');
});

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'namespace' => 'Admin',
    'middleware' => ['auth', 'admin'],
], function() {
    // for authenticated admin users
});

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Auth::routes();