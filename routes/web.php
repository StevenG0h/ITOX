<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\landing;
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

Route::get('/home', [landing::class,'index'])->name('landing');
Route::get('/', function(){
    return redirect('/home');
})->name('landing');

Route::middleware(['auth'])->group(function (){
    Route::get('/create-team', [ParticipantController::class,'CreateTeam'])->name('CreateTeam');
    Route::post('/register-team', [ParticipantController::class,'RegisterTeam'])->name('RegisterTeam');
    Route::get('/members', [ParticipantController::class,'showMembers'])->name('showMembers');
    Route::get('/add-member', [ParticipantController::class,'AddMember'])->name('AddMember');
    Route::get('/edit-member/{member_id}', [ParticipantController::class,'EditMember'])->name('EditMember');
    Route::post('/adding-member', [ParticipantController::class,'AddMemberProcess'])->name('AddMemberProcess');
    Route::post('/editing-member', [ParticipantController::class,'EditMemberProcess'])->name('EditMemberProcess');
    Route::get('/add-competition', [ParticipantController::class,'AddInstitution'])->name('AddInstitution');
    Route::post('/add-competition-process', [ParticipantController::class,'AddInstitutionProcess'])->name('AddInstitutionProcess');
    Route::post('/delete-member', [ParticipantController::class,'deleteMember'])->name('deleteMember');
    Route::get('/dashboard', [ParticipantController::class,'Dashboard'])->name('Dashboard');
    Route::get('/payment', [ParticipantController::class,'Payment'])->name('Payment');
    Route::post('/payment-process', [ParticipantController::class,'PaymentProcess'])->name('PaymentProcess');
});

Route::middleware(['isAdmin'])->group(function(){
    Route::get('/register-admin', [AdminController::class,'registerAdmin'])->name('registerAdmin');
    Route::post('/register-admin-process', [AdminController::class,'registerAdminProcess'])->name('registerAdminProcess');
    Route::get('/admin-dashboard', [AdminController::class,'Dashboard'])->name('AdminDashboard');
    Route::get('/users', [AdminController::class,'userView'])->name('userView');
    Route::post('/delete-user', [AdminController::class,'deleteUser'])->name('deleteUser');
    Route::post('/verify-participant', [AdminController::class,'verifyParticipant'])->name('verifyParticipant');
    Route::post('/delete-participant', [AdminController::class,'deleteParticipant'])->name('deleteParticipant');
    Route::post('/doc-not-valid-participant', [AdminController::class,'docNotValid'])->name('docNotValid');
    Route::get('/competitions', [AdminController::class,'showCompetitions'])->name('showCompetitions');
    Route::get('/add-competitions', [AdminController::class,'addCompetitionsView'])->name('addCompetitionsView');
    Route::post('/add-competitions-process', [AdminController::class,'addCompetitionsProcess'])->name('addCompetitionsProcess');
    Route::get('/add-competition-fee/{kode_lomba}', [AdminController::class,'addCompetitionFeeView'])->name('addCompetitionFeeView');
    Route::post('/add-competition-fee-process', [AdminController::class,'addCompetitionFee'])->name('addCompetitionFee');
    Route::post('/delete-competitions-process', [AdminController::class,'deleteCompetitions'])->name('deleteCompetitions');
    Route::get('/update-competitions/{kode_lomba}', [AdminController::class,'updateCompetitionView'])->name('updateCompetitionView');
    Route::post('/update-competitions-maskot', [AdminController::class,'updateMaskot'])->name('updateMaskot');
    Route::post('/update-competitions-Guidebook', [AdminController::class,'updateGuidebook'])->name('updateGuidebook');
    Route::post('/update-competitions-process', [AdminController::class,'updateCompetitionProcess'])->name('updateCompetitionProcess');
    Route::post('/update-competitions-fee-process', [AdminController::class,'updateCompetitionFee'])->name('updateCompetitionFee');
    Route::get('/teams', [AdminController::class,'teamsView'])->name('teamsView');
    Route::post('/deleteTeam', [AdminController::class,'deleteTeam'])->name('deleteTeam');
    Route::get('/payments', [AdminController::class,'paymentsView'])->name('paymentsView');
    Route::post('/delete-payment', [AdminController::class,'deletePayment'])->name('deletePayment');
    Route::post('/verify-payment', [AdminController::class,'verifyPayment'])->name('verifyPayment');
    Route::post('/verify-payment-not-valid', [AdminController::class,'verifyPaymentNotValid'])->name('verifyPaymentNotValid');
});


Route::middleware(['guest'])->group(function (){
    Route::get('/admin-login', [AdminController::class,'AdminLogin'])->name('AdminLogin');
    Route::post('/admin-login-process', [AdminController::class,'AdminLoginProcess'])->name('AdminLoginProcess');
});

Auth::routes();

