<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard(){
        return view('Admin/Manage/adminDashboard');
    }
    public function adminLogin(){
        return view('Admin/Auth/adminLogin');
    }
    public function showParticipant(){
        $participant = DB::table('members')
        ->join('teams', 'members.kode_tim', '=', 'teams.kode_tim')
        ->join('competitions','teams.kode_lomba','=','competitions.kode_lomba')
        ->get();
        dd($participant);
    }
    public function adminLoginProcess(Request $request){
        $validate = $request->validate([
            'email'=> 'email|required',
            'password'=>'required'
        ]);
        if (Auth::attempt($validate)) {
            $auth = Auth::user();
            $admin = Admin::where('user_id',$auth->user_id)->first();
            $request->session()->regenerate();
            if ($admin == null) {
                return redirect('dashboard');
            }else{
                return redirect('AdminDashboard');
            }
        }
        return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }
    public function adminDashboard(){
        dd($request);
    }

    public function adminRegister(Request $request){
        
        return view('Admin/Auth/AdminRegister');
    }
}
