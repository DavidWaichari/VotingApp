<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdminMiddleware;

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

Route::get('/', function () {
    return redirect('/login');
    // return view('welcome');
});

Auth::routes();
Route::post('/request_otp', [App\Http\Controllers\AuthenticationController::class, 'requestOTP'])->name('request.otp');
Route::get('/validate_otp', [App\Http\Controllers\AuthenticationController::class, 'validateOtp'])->name('validate.otp');
Route::post('/validate_otp', [App\Http\Controllers\AuthenticationController::class, 'validateOtpStore'])->name('validate.otp.store');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/vote', [App\Http\Controllers\HomeController::class, 'vote'])->name('vote');
Route::get('/candidates', [App\Http\Controllers\HomeController::class, 'fetchCandidates'])->name('candidates');
Route::get('/auth_user', [App\Http\Controllers\HomeController::class, 'authUser'])->name('auth.user');
Route::get('/unauthorized', [App\Http\Controllers\HomeController::class, 'unauthorized'])->name('unauthorized');
Route::group(['prefix' => '/admin', 'middleware'=> IsAdminMiddleware::class], function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard']);
    Route::get('/candidates', [App\Http\Controllers\AdminController::class, 'candidates']);
    Route::get('/candidates/create', [App\Http\Controllers\AdminController::class, 'createCandidate']);
    Route::get('/registered_voters', [App\Http\Controllers\AdminController::class, 'registeredVoters']);
    Route::get('/unregistered_voters', [App\Http\Controllers\AdminController::class, 'unregisteredVoters']);
    Route::post('/candidates/store', [App\Http\Controllers\AdminController::class, 'saveCandidate']);
    Route::get('/send_sms', [App\Http\Controllers\AdminController::class, 'sendSMS']);
    Route::get('/voters/create', [App\Http\Controllers\AdminController::class, 'createVoter']);
});