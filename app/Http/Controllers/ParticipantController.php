<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ParticipantController extends Controller
{
    
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
