<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard(){
        $participant = DB::table('members')
        ->join('teams', 'members.kode_tim', '=', 'teams.kode_tim')
        ->join('competitions','teams.kode_lomba','=','competitions.kode_lomba')
        ->get();
        return view('Admin/Manage/adminDashboard')->with(['participants'=>$participant]);
    }
    public function adminLogin(){
        return view('Admin/Auth/adminLogin');
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
                return redirect('admin-dashboard');
            }
        }
        return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }
    public function verifyParticipant(Request $request){
        $participant = Member::where('member_id',$request->member_id)->first();
        if ($participant->verify == 0) {
            $participant->verify = 1;
        }else{
            $participant->verify == 0
        }
        $participant->save();
        return redirect('admin-dashboard');
    }
    public function docNotValid(Request $request){
        $participant = Member::where('member_id',$request->member_id)->first();
        if ($participant->verify == 0) {
            $participant->verify = 2;
        }else{
            $participant->verify == 0
        }
        $participant->save();
        return redirect('admin-dashboard');
    }

    public function deleteParticipant(Request $request){
        $participant = Member::where('member_id',$request->member_id)->first();
        $participant->delete();
        return redirect('admin-dashboard');
    }

    public function adminRegister(Request $request){
        
        return view('Admin/Auth/AdminRegister');
    }
}
