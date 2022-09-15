<?php

use App\Http\Controllers\AdminController;
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
    Route::get('/create-team', [ParticipantController::class,'CreateTeam'])->name('CreateTeam');
    Route::post('/register-team', [ParticipantController::class,'RegisterTeam'])->name('RegisterTeam');
    Route::get('/add-member', [ParticipantController::class,'AddMember'])->name('AddMember');
    Route::post('/adding-member', [ParticipantController::class,'AddMemberProcess'])->name('AddMemberProcess');
    Route::get('/add-institution', [ParticipantController::class,'AddInstitution'])->name('AddInstitution');
    Route::post('/adding-institution', [ParticipantController::class,'AddInstitutionProcess'])->name('AddInstitutionProcess');
    Route::get('/dashboard', [ParticipantController::class,'Dashboard'])->name('Dashboard');
    Route::get('/payment', [ParticipantController::class,'Payment'])->name('Payment');
    Route::post('/payment-process', [ParticipantController::class,'PaymentProcess'])->name('PaymentProcess');
});

Route::middleware(['isAdmin'])->group(function(){
    Route::get('/admin-dashboard', [AdminController::class,'Dashboard'])->name('AdminDashboard');
    Route::post('/verify-participant', [AdminController::class,'verifyParticipant'])->name('verifyParticipant');
    Route::post('/delete-participant', [AdminController::class,'deleteParticipant'])->name('deleteParticipant');
    Route::post('/doc-not-valid-participant', [AdminController::class,'docNotValid'])->name('docNotValid');
    Route::get('/competitions', [AdminController::class,'showCompetitions'])->name('showCompetitions');
    Route::get('/add-competitions', [AdminController::class,'addCompetitionsView'])->name('addCompetitionsView');
    Route::post('/add-competitions-process', [AdminController::class,'addCompetitionsProcess'])->name('addCompetitionsProcess');
});


Route::middleware(['guest'])->group(function (){
    Route::get('/admin-login', [AdminController::class,'AdminLogin'])->name('AdminLogin');
    Route::post('/admin-login-process', [AdminController::class,'AdminLoginProcess'])->name('AdminLoginProcess');
});

Auth::routes();

