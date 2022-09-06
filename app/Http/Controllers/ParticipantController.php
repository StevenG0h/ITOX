<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function signUp(){
        return view('Participant/Account/SignUp');
    }
    public function signIn(){
        return view('Participant/Account/SignIn');
    }
    public function CreateTeam(){
        return view('Participant/Competition/CreateTeam');
    }
    public function AddInstitution(){
        return view('Participant/Competition/AddInstitution');
    }
    public function AddMember(){
        return view('Participant/Competition/AddMember');
    }
    public function Dashboard(){
        return view('Participant/Dashboard');
    }
}
