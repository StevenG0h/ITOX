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

Route::middleware(['auth'])->group(function (){
    Route::get('/CreateTeam', [ParticipantController::class,'CreateTeam'])->name('CreateTeam');
    Route::get('/AddMember', [ParticipantController::class,'AddMember'])->name('AddMember');
    Route::get('/AddInstitution', [ParticipantController::class,'AddInstitution'])->name('AddInstitution');
    Route::get('/Dashboard', [ParticipantController::class,'Dashboard'])->name('Dashboard')->middleware('regis.check');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
