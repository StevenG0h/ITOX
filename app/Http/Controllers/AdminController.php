<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Competition;
use App\Models\Member;
use App\Models\payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\File;

class AdminController extends Controller
{
    public function dashboard(Request $request){
        if($request->search == null){
            $participant = DB::table('members')
            ->join('teams', 'members.kode_tim', '=', 'teams.kode_tim')
            ->join('competitions','teams.kode_lomba','=','competitions.kode_lomba')
            ->orderBy('member_id','desc')
            ->paginate(50);
        }else{
            $participant = DB::table('members')
            ->join('teams', 'members.kode_tim', '=', 'teams.kode_tim')
            ->join('competitions','teams.kode_lomba','=','competitions.kode_lomba')
            ->where($request->search_category,'=',$request->search)
            ->orderBy('member_id','desc')
            ->paginate(50);
        }
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
            $participant->verify = 0;
        }
        $participant->save();
        return redirect('admin-dashboard');
    }

    public function docNotValid(Request $request){
        $participant = Member::where('member_id',$request->member_id)->first();
        if ($participant->verify == 0) {
            $participant->verify = 2;
        }else{
            $participant->verify = 0;
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
            'min_anggota'=>'required',
            'max_anggota'=>'required',
            'desc'=>'required|max:100',
        ]);
        $request->validate([
            'url_guidebook'=>['required',File::types(['pdf'])],
            'maskot'=>['required',File::types(['png'])]
        ]);
        $competition = new Competition;
        $competition->nama_lomba = $request->nama_lomba;
        $competition->min_anggota = $request->min_anggota;
        $competition->max_anggota = $request->max_anggota;
        $competition->kategori = $request->kategori;
        $competition->batas_pendaftaran = $request->batas_pendaftaran;
        $competition->desc = $request->desc;
        $file_location = 'Guidebook/'.$request->nama_lomba;
        $maskot_location = 'maskot/'.$request->nama_lomba;
        $competition->url_guidebook = $file_location.'/'.$request->file('url_guidebook')->getClientOriginalName();
        $competition->maskot = $maskot_location.'/'.$request->file('maskot')->getClientOriginalName();
        $competition->save();
        $request->file('url_guidebook')->storeAs('public/'.$file_location,$request->file('url_guidebook')->getClientOriginalName());
        $request->file('maskot')->storeAs('public/'.$maskot_location,$request->file('maskot')->getClientOriginalName());
        return redirect('competitions');
    }

    public function deleteCompetitions(Request $request){
        $competition = Competition::where('kode_lomba',$request->kode_lomba)->first();
        $competition->delete();
        return redirect('competitions');
    }

    public function updateCompetitionView(Request $request){
        $competition = Competition::where('kode_lomba',$request->kode_lomba)->first();
        return view('Admin/Manage/UpdateCompetition')->with(['competition'=>$competition]);
    }

    public function UpdateCompetitionProcess(Request $request){
        $request->validate([
            'nama_lomba'=>'required',
            'batas_pendaftaran'=>'required',
            'min_anggota'=>'required',
            'max_anggota'=>'required',
            'desc'=>'required|max:100',
        ]);
        $competition = Competition::where('kode_lomba',$request->kode_lomba)->first();
        $competition->nama_lomba = $request->nama_lomba;
        $competition->max_anggota = $request->max_anggota;
        $competition->min_anggota = $request->min_anggota;
        $competition->kategori = $request->kategori;
        $competition->batas_pendaftaran = $request->batas_pendaftaran;
        $competition->desc = $request->desc;
        $competition->save();
        return redirect('competitions');
    }

    public function updateMaskot(Request $request){
        $request->validate([
            'maskot'=>['required',File::types(['png'])]
        ]);
        $competition = Competition::where('kode_lomba',$request->kode_lomba)->first();
        $maskot_location = 'maskot/'.$request->nama_lomba;
        $competition->maskot = $maskot_location.'/'.$request->file('maskot')->getClientOriginalName();
        $competition->save();
        $request->file('maskot')->storeAs('public/'.$maskot_location,$request->file('maskot')->getClientOriginalName());
        return redirect('competitions');
    }

    public function updateGuidebook(Request $request){
        $request->validate([
            'url_guidebook'=>['required',File::types(['pdf'])]
        ]);
        $competition = Competition::where('kode_lomba',$request->kode_lomba)->first();
        $file_location = 'Guidebook/'.$request->nama_lomba;
        $competition->url_guidebook = $file_location.'/'.$request->file('url_guidebook')->getClientOriginalName();
        $competition->save();
        $request->file('url_guidebook')->storeAs('public/'.$file_location,$request->file('url_guidebook')->getClientOriginalName());
        return redirect('competitions');
    }

    public function teamsView(){
        $team = DB::table('teams')
        ->join('members', 'members.member_id', '=', 'teams.kode_ketua')
        ->join('competitions','teams.kode_lomba','=','competitions.kode_lomba')
        ->join('payments','teams.kode_tim','=','payments.kode_tim')
        ->get();
        return view('Admin/Manage/Team')->with(['teams'=>$team]);
    }

    public function verifyPayment(Request $request){
        $participant = payment::where('kode_tim',$request->kode_tim)->first();
        if ($participant->verified == 0) {
            $participant->verified = 1;
        }else{
            $participant->verified = 0;
        }
        $participant->save();
        return redirect('teams');
    }   
    public function verifyPaymentNotValid(Request $request){
        $participant = payment::where('kode_tim',$request->kode_tim)->first();
        if ($participant->verified == 0) {
            $participant->verified = 2;
        }else{
            $participant->verified = 0;
        }
        $participant->save();
        return redirect('teams');
    }

    public function userView(Request $request){
        $user = DB::table('users')->join('teams','teams.kode_tim','=','users.kode_tim')
        ->join('members','members.member_id','=','teams.kode_ketua')
        ->orderBy('id','desc')
        ->paginate(50);
        $admin = DB::table('users')->join('admins','users.id','=','admins.user_id')->paginate(50);
        return view('Admin/Manage/user')->with(['users'=>$user,'admins'=>$admin]);
    }

    public function adminRegister(Request $request){
        return view('Admin/Auth/AdminRegister');
    }
}
