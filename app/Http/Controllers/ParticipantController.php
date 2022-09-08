<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ParticipantController extends Controller
{
    public function signUp(){
        return view('Participant/Account/SignUp');
    }
    public function signUpProcess(Request $request){
        $validated = $this->validate($request, [
            'email' => 'email|unique:users',
            'password' => 'required|confirmed|max:255|min:8'
        ]);

        if ($validated) {
            $participant = new User();
            $participant->email = $validated['email'];
            $participant->password = Hash::make($validated['password']);
            $participant->save();
            return redirect(route('SignIn'));
        }else{
            return back();
        }
    }
    
    public function signIn(){
        return view('Participant/Account/SignIn');
    }
    public function signInProcess(Request $request){
        $validated = $this->validate($request, [
            'email' => 'email',
            'password' => 'required'
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();
            return redirect()->intended('Dashboard');
        }else{
            return back()->withErrors([
                'email' => 'Username atau password tidak cocok',
            ]); 
        }
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
