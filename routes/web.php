<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsAdminMiddleware;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\ElectionController;
use App\Http\Controllers\VoterController;

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
Route::get('/candidates/ajax', [App\Http\Controllers\CandidateController::class, 'ajaxFetchCandidates']);
Route::get('/auth_user', [App\Http\Controllers\HomeController::class, 'authUser'])->name('auth.user');
Route::get('/unauthorized', [App\Http\Controllers\HomeController::class, 'unauthorized'])->name('unauthorized');
Route::group(['prefix' => '/admin', 'middleware'=> IsAdminMiddleware::class], function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard']);
    Route::get('/elections/{id}/start', [App\Http\Controllers\ElectionController::class, 'startElection']);
    Route::get('/elections/{id}/stop', [App\Http\Controllers\ElectionController::class, 'stopElection']);
    Route::resource('/elections', ElectionController::class);
    Route::resource('/elections', ElectionController::class);
    Route::resource('/candidates', CandidateController::class);
    Route::get('/voters/registered', [App\Http\Controllers\VoterController::class, 'registeredVoters']);
    Route::get('/voters/unregistered', [App\Http\Controllers\VoterController::class, 'unregisteredVoters']);
    Route::get('/voters/streaming', [App\Http\Controllers\VoterController::class, 'resultsStreaming']);
    Route::get('/voters/streaming_data', [App\Http\Controllers\VoterController::class, 'ajaxResultsStreaming']);
    Route::post('/voters/import', [App\Http\Controllers\VoterController::class, 'importVoters'])->name('voters.import');
    Route::resource('/voters', VoterController::class);
    Route::get('/send_sms', [App\Http\Controllers\AdminController::class, 'sendSMS']);
});