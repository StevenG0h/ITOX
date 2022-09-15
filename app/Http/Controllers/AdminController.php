<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Competition;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\File;

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
            $participant->verify == 0;
        }
        $participant->save();
        return redirect('admin-dashboard');
    }
    public function docNotValid(Request $request){
        $participant = Member::where('member_id',$request->member_id)->first();
        if ($participant->verify == 0) {
            $participant->verify = 2;
        }else{
            $participant->verify == 0;
        }
        $participant->save();
        return redirect('admin-dashboard');
    }

    public function deleteParticipant(Request $request){
        $participant = Member::where('member_id',$request->member_id)->first();
        $participant->delete();
        return redirect('admin-dashboard');
    }

    public function showCompetitions(Request $request){
        $competitions = Competition::get();
        return view('Admin/Manage/competitions')->with(['competitions'=>$competitions]);
    }

    public function addCompetitionsView(){
        return view('Admin/Manage/addCompetitions');
    }

    public function addCompetitionsProcess(Request $request){
        $request->validate([
            'nama_lomba'=>'required|unique:competitions',
            'batas_pendaftaran'=>'required',
            'max_anggota'=>'required',
            'desc'=>'required|max:100',
        ]);
        $request->validate([
            'url_guidebook'=>['required',File::types(['pdf'])],
            'maskot'=>['required',File::types(['png'])]
        ]);
        $competition = new Competition;
        $competition->nama_lomba = $request->nama_lomba;
        $competition->max_anggota = $request->max_anggota;
        $competition->kategori = $request->kategori;
        $competition->batas_pendaftaran = $request->batas_pendaftaran;
        $file_location = 'Guidebook/'.$request->nama_lomba;
        $maskot_location = 'maskot/'.$request->nama_lomba;
        $competition->url_guidebook = $file_location.'/'.$request->file('url_guidebook')->getClientOriginalName();
        $competition->maskot = $maskot_location.'/'.$request->file('url_guidebook')->getClientOriginalName();
        $competition->save();
        $request->file('url_guidebook')->storeAs('public/'.$file_location,$request->file('url_guidebook')->getClientOriginalName());
        $request->file('maskot')->storeAs('public/'.$file_location,$request->file('url_guidebook')->getClientOriginalName());
        return redirect('competitions');
    }

    

    public function deleteCompetition(Request $request){

    }

    public function adminRegister(Request $request){
        
        return view('Admin/Auth/AdminRegister');
    }
}
