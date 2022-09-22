<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Competition;
use App\Models\Member;
use App\Models\payment;
use App\Models\registration_fee;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        return redirect('add-competition-fee/'.$competition->kode_lomba);
    }

    public function addCompetitionFeeView(Request $request){
        $competition = Competition::where('kode_lomba',$request->kode_lomba)->first();
        $kategori = $competition->kategori;
        $kode_lomba = $competition->kode_lomba;
        return view('Admin/Manage/addFee')->with(['kategori'=>$kategori,'kode_lomba'=>$kode_lomba]);
    }

    public function addCompetitionFee(Request $request){
        $request->validate(['kategori'=>'required','kode_lomba'=>'required','biaya_pendaftaran'=>'required']);
        for ($i=0; $i < $request->biaya_pendaftaran ; $i++) { 
            $fee = new registration_fee ;
            $fee->kategori = $request[$i]->kategori;
            $fee->kode_lomba = $request[$i]->kode_lomba;
            $fee->biaya_pendaftaran = $request[$i]->biaya_pendaftaran;
            $fee-Save();
        }
        return redirect('competitions');
    }

    public function deleteCompetitions(Request $request){
        $competition = Competition::where('kode_lomba',$request->kode_lomba)->first();
        $competition->delete();
        return redirect('competitions');
    }

    public function updateCompetitionView(Request $request){
        $competition = Competition::where('kode_lomba',$request->kode_lomba)->first();
        $fee = registration_fee::where('kode_lomba',$competition->kode_lomba)->get();
        return view('Admin/Manage/UpdateCompetition')->with(['competition'=>$competition,'fee'=>$fee]);
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
    
    public function UpdateCompetitionFee(Request $request){
        $fee = registration_fee::where('kode_lomba',$request->kode_lomba)->get();
        for ($i=0; $i < count($request->biaya); $i++) { 
            if (empty($fee[$i])) {
                $fee[$i] = new registration_fee();
                $fee[$i]->kode_lomba = $request->kode_lomba;
            }
            $fee[$i]->kategori = $request->fee_category[$i];
            $fee[$i]->biaya = $request->biaya[$i];
            $fee[$i]->save();
        }
        
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

    public function paymentsView(){
        $team = DB::table('teams')
        ->join('members', 'members.member_id', '=', 'teams.kode_ketua')
        ->join('competitions','teams.kode_lomba','=','competitions.kode_lomba')
        ->join('payments','teams.kode_tim','=','payments.kode_tim')
        ->get();
        return view('Admin/Manage/Payment')->with(['teams'=>$team]);
    }

    public function teamsView(){
        $teams = DB::table('teams')
        ->join('members', 'members.member_id', '=', 'teams.kode_ketua')
        ->join('competitions','teams.kode_lomba','=','competitions.kode_lomba')
        ->paginate(50);
        $anggota = [];
        $payment = [];
        foreach ($teams as $team) {
            $cekAnggota = Member::where('kode_tim',$team->kode_tim)->get(); 
            $cekPayment = payment::where('kode_tim',$team->kode_tim)->first(); 
            $member = 0;
            foreach ($cekAnggota as $dataAnggota) {
                if($dataAnggota->verify == 1){
                    $member++;
                }
            }
            if($member == count($cekAnggota)){
                array_push($anggota,1);
            }else{
                array_push($anggota,0);
            }
            
            if($cekPayment != null){
                if($cekPayment->verified ==1){
                    array_push($payment,1);
                }else{
                    array_push($payment,0);
                }
            }else{
                array_push($payment,0);
            }
        }
        return view('Admin/Manage/Team')->with(['teams'=>$teams,'anggota'=>$anggota,'payment'=>$payment]);
    }
    public function deleteTeam(Request $request){
        $team = Team::where('kode_tim',$request->kode_tim)->first();
        $team->delete();
        return redirect('teams');
    }
    public function verifyPayment(Request $request){
        $participant = payment::where('kode_tim',$request->kode_tim)->first();
        if ($participant->verified == 0) {
            $participant->verified = 1;
        }else{
            $participant->verified = 0;
        }
        $participant->save();
        return redirect('payments');
    }   
    public function deletePayment(Request $request){
        $participant = payment::where('payment_id',$request->payment_id)->first();
        $participant->delete();
        return redirect('payments');
    }   

    public function verifyPaymentNotValid(Request $request){
        $participant = payment::where('kode_tim',$request->kode_tim)->first();
        if ($participant->verified == 0) {
            $participant->verified = 2;
        }else{
            $participant->verified = 0;
        }
        $participant->save();
        return redirect('payments');
    }

    public function userView(Request $request){
        $user = DB::table('users')->join('teams','teams.kode_tim','=','users.kode_tim')
        ->join('members','members.member_id','=','teams.kode_ketua')
        ->orderBy('id','desc')
        ->paginate(50);
        $admin = DB::table('users')->join('admins','users.id','=','admins.user_id')->get();
        return view('Admin/Manage/user')->with(['users'=>$user,'admins'=>$admin]);
    }

    public function deleteUser(Request $request){
        $user = User::where('id',$request->id)->first();
        $members = Member::Where('kode_tim',$user->kode_tim)->get();
        if ($members != null) {
            foreach ($members as $member) {
                $member->delete();
            }
        }
        $user->delete();
        return redirect('users');
    }

    public function registerAdmin(){
        return view('Admin/Auth/AdminRegister');
    }
    public function registerAdminProcess(Request $request){
        $request->validate([
            'nama'=> 'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = new User;
        $admin = new Admin;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();
        $admin->user_id = $user->id;
        $admin->nama = $request->nama;
        $admin->status = 1;
        $admin->save();
        return redirect('users');
    }
}
