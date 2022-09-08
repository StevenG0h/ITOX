<?php

use App\Http\Controllers\ParticipantController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/SignUp', [ParticipantController::class,'signUp'])->name('SignUp');
Route::post('/SignUpProcess', [ParticipantController::class,'signUpProcess'])->name('SignUpProcess');
Route::get('/SignIn', [ParticipantController::class,'signIn'])->name('SignIn');
Route::post('/SignInProcess', [ParticipantController::class,'signInProcess'])->name('SignInProcess');
Route::get('/CreateTeam', [ParticipantController::class,'CreateTeam'])->name('CreateTeam');
Route::get('/AddMember', [ParticipantController::class,'AddMember'])->name('AddMember');
Route::get('/AddInstitution', [ParticipantController::class,'AddInstitution'])->name('AddInstitution');
Route::get('/Dashboard', [ParticipantController::class,'Dashboard'])->name('Dashboard');
