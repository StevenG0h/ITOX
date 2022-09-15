<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use App\Models\Member;
use App\Models\payment;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\File;

class ParticipantController extends Controller
{
    
    public function checkTeam(){
        $user = Auth::user();
        if($user->kode_tim != null){
            return true;
        }else{
            return false;
        }
    }
    public function checkInstitution(){
        $user = Auth::user();
        $kodeTim = $user->kode_tim;
        $team = Team::where('kode_tim',$kodeTim)->first();
        if($team->kode_lomba != null){
            return true;
        }else{
            return false;
        }
    }
    public function checkMember(){
        $user = Auth::user();
        $kodeTim = $user->kode_tim;
        $member = Member::where('kode_tim',$kodeTim)->get();
        $team = Team::where('kode_tim',$kodeTim)->first();
        $competition = Competition::where('kode_lomba',$team->kode_lomba)->first();
        if (($member->count() < $competition->max_anggota)==false) {
            return true;
        }else{
            return false;
        }
    }

    public function CreateTeam(){
        if ($this->checkTeam() == true) {
            return redirect()->intended('dashboard');
        }
        return view('Participant/Competition/CreateTeam');
    }
    public function registerTeam(Request $request){
        $team = new Team;
        $member = new Member();
        $validated = $request->validate([
            'nama_tim' => 'required|max:255|unique:teams',
            'nomor_hp' => 'required|max:15|unique:teams',
            'nomor_identitas' => 'required|max:255|unique:members',
            'nama' => 'required|max:255',
            'institusi_asal' => 'required|max:255',
            'jenis_institusi' => 'required|max:30',
        ]);
        $request->validate([
            'url_dokumen'=>[
                'required',File::types(['jpg','jpeg','png','pdf'])->max(1024 * 300)
            ]
        ]);
        $team->nama_tim = $request->nama_tim;
        $team->nomor_hp = $request->nomor_hp;
        $team->institusi_asal = $request->institusi_asal;
        $team->jenis_institusi = $request->jenis_institusi;
        $team->save();

        $user = Auth::user();
        $user->kode_tim = $team->kode_tim;
        $user->save();
        $file_location = 'MemberDoc/'.$request->nama_tim.'/'.$request->nomor_identitas;
        $member->nama = $request->nama;
        $member->kode_tim = $team->kode_tim;
        $member->nomor_identitas = $request->nomor_identitas;
        $member->url_dokumen = $file_location.'/'.$request->file('url_dokumen')->getClientOriginalName();
        $member->verify = 0;
        $member->save();
        $request->file('url_dokumen')->storeAs('public/'.$file_location,$request->file('url_dokumen')->getClientOriginalName());
        $team->kode_ketua = $member->member_id;
        $team->save();
        return redirect()->intended('add-institution');
    }
    public function AddInstitution(){
        $auth = Auth::user();
        $team = Team::where('kode_tim',$auth->kode_tim)->first();

        if($team->jenis_institusi == 'Perguruan Tinggi/umum'){
            $competition = Competition::select(['nama_lomba','kode_lomba'])->where('kategori','>','0')->get();
        }else{
            $competition = Competition::select(['nama_lomba','kode_lomba'])->where('kategori','=','0')->get();
        }
        if ($this->checkInstitution() == true) {
            return redirect()->intended('dashboard');
        }
        if ($this->checkTeam() == false) {
            return redirect()->intended('create-team');
        }
        return view('Participant/Competition/AddInstitution')->with(['competitions'=>$competition]);
    }
    public function AddInstitutionProcess(Request $request){
        $user = Auth::user();
        $kodeTim = $user->kode_tim;
        $team = Team::where('kode_tim',$kodeTim)->first();
        $validated = $request->validate([
            'kode_lomba' => 'required'
        ]);
        $team->kode_lomba = $request->kode_lomba;
        $team->save();
        return redirect('add-member');
    }
    public function AddMember(){
        if ($this->checkMember() == true) {
            return redirect()->intended('dashboard');
        }
        $user = Auth::user();
        $kodeTim = $user->kode_tim;
        $member = Member::where('kode_tim',$kodeTim)->get();
        $team = Team::where('kode_tim',$kodeTim)->first();
        $competition = Competition::where('kode_lomba',$team->kode_lomba)->first();
        $restMember =  $competition->max_anggota - $member->count();
        return view('Participant/Competition/AddMember')->with(['restMember' =>$restMember,'kodeTim'=>$kodeTim,'namaTim'=>$team->nama_tim]);
    }
    public function AddMemberProcess(Request $request){
        $validated = $request->validate([
            'nomor_identitas' => 'required|max:255|unique:members',
            'nama' => 'required|max:255',
            'nama_tim'=> 'required'
        ]);
        $request->validate([
            'url_dokumen.*'=>[
                'required',File::types(['jpg','jpeg','png','pdf'])->max(1024 * 300)
            ]
        ]);
        for ($i=0; $i < count($request->kode_tim); $i++) { 
            $member = new Member();
            $file_location = 'MemberDoc/'.$request->nama_tim[$i].'/'.$request->nomor_identitas[$i];
            $member->nama = $request->nama[$i];
            $member->kode_tim = $request->kode_tim[$i];
            $member->nomor_identitas = $request->nomor_identitas[$i];
            $member->url_dokumen = $file_location.'/'.$request->file('url_dokumen')[$i]->getClientOriginalName();
            $member->verify = 0;
            $member->save();
            $request->file('url_dokumen')[$i]->storeAs('public/'.$file_location,$request->file('url_dokumen')[$i]->getClientOriginalName());
        }
        return redirect()->intended('dashboard');
    }

    public function Dashboard(){
        if ($this->checkTeam() == false) {
            return redirect()->intended('create-team');
        }
        if($this->checkInstitution() == false){
            return redirect()->intended('add-institution');
        }
        if($this->checkMember() == false){
            return redirect()->intended('add-member');
        }
        
        $auth = Auth::user();
        $team = Team::where('kode_tim',$auth->kode_tim)->first();
        $member = Member::where('kode_tim',$auth->kode_tim)->get();
        $namaLomba = Competition::where('kode_lomba',$team->kode_lomba)->first()->nama_lomba;
        $paymentStatus = payment::where('kode_tim',$auth->kode_tim)->first();
        if ($paymentStatus == null) {
            $paymentStatus = 1;
        }else if($paymentStatus->verified == false){
            $paymentStatus = 2;
        }else{
            $paymentStatus = 3;
        }
        return view('Participant/Dashboard')->with(['team'=>$team, 'members'=>$member,'namaLomba'=>$namaLomba,'paymentStatus'=>$paymentStatus]);
    }
    public function Payment(){
        return view('Participant/Competition/Payment');
    }
    public function PaymentProcess(Request $request){
        $request->validate([
            'bukti_pembayaran'=>[
                'required',File::types(['jpg','jpeg','png','pdf'])->max(1024 * 300)
            ]
        ]);
        $user = Auth::user();
        $payment =  new payment;
        $team = Team::where('kode_tim',$user->kode_tim)->first();
        $payment->kode_tim = $user->kode_tim;
        $file_location = 'public/Bukti-pembayaran/'.$team->nama_tim;
        $payment->verified = 0;
        $payment->bukti_pembayaran = $file_location.'/'.$request->file('bukti_pembayaran')->getClientOriginalName();
        $payment->save();
        $request->file('bukti_pembayaran')->storeAs($file_location,$request->file('bukti_pembayaran')->getClientOriginalName());
        return redirect()->intended('dashboard');
    }
}
