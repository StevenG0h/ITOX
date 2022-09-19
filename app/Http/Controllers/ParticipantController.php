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
        if (($member->count() < $competition->min_anggota)==false) {
            return true;
        }else{
            return false;
        }
    }
    public function paymentCheck(){
        $user = Auth::user();
        $kodeTim = $user->kode_tim;
        $payment = payment::where('kode_tim',$kodeTim)->first();
        if ($payment ==null) {
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
        return redirect()->intended('dashboard');
    }
    public function AddInstitution(){
        $auth = Auth::user();
        $team = Team::where('kode_tim',$auth->kode_tim)->first();

        if($team->jenis_institusi == 'Perguruan Tinggi/umum'){
            $competition = Competition::select(['nama_lomba','kode_lomba'])->where('kategori','>=','1')->get();
        }else{
            $competition = Competition::select(['nama_lomba','kode_lomba'])->where('kategori','<=','1')->get();
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
        return redirect()->intended('members');
    }
    public function showMembers(){
        $user = Auth::user();
        $kodeTim = $user->kode_tim;
        $member = Member::where('kode_tim',$kodeTim)->get();
        $team = Team::where('kode_tim',$kodeTim)->first();
        $competition = Competition::where('kode_lomba',$team->kode_lomba)->first();
        $restMember =  $competition->max_anggota - $member->count();
        return view('Participant/Competition/showMembers')->with(['team'=>$team,'members'=>$member,'restMember'=>$restMember]);
    }
    public function AddMember(){
        if ($this->checkMember() == true) {
            return redirect()->intended('dashboard');
        }
        $user = Auth::user();
        $kodeTim = $user->kode_tim;
        $team = Team::where('kode_tim',$kodeTim)->first();
        $competition = Competition::where('kode_lomba',$team->kode_lomba)->first();
        return view('Participant/Competition/AddMember')->with(['kodeTim'=>$kodeTim,'namaTim'=>$team->nama_tim]);
    }
    public function EditMember(Request $request){
        $member = Member::where('member_id',$request->member_id)->first();
        return view('Participant/Competition/EditMember')->with(['member'=>$member]);
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
        $member = new Member();
        $file_location = 'MemberDoc/'.$request->nama_tim.'/'.$request->nomor_identitas;
        $member->nama = $request->nama;
        $member->kode_tim = $request->kode_tim;
        $member->nomor_identitas = $request->nomor_identitas;
        $member->url_dokumen = $file_location.'/'.$request->file('url_dokumen')->getClientOriginalName();
        $member->verify = 0;
        $member->save();
        $request->file('url_dokumen')->storeAs('public/'.$file_location,$request->file('url_dokumen')->getClientOriginalName());
        return redirect()->intended('dashboard');
    }
    public function EditMemberProcess(Request $request){
        $request->validate([
            'url_dokumen.*'=>[
                'required',File::types(['jpg','jpeg','png','pdf'])->max(1024 * 300)
            ]
        ]);
        $member = Member::where('member_id',$request->member_id)->first();
        $file_location = 'MemberDoc/'.$request->nama_tim.'/'.$request->nomor_identitas;
        $member->nama = $request->nama;
        $member->nomor_identitas = $request->nomor_identitas;
        $member->url_dokumen = $file_location.'/'.$request->file('url_dokumen')->getClientOriginalName();
        $member->verify = 0;
        $member->save();
        $request->file('url_dokumen')->storeAs('public/'.$file_location,$request->file('url_dokumen')->getClientOriginalName());
        return redirect()->intended('dashboard');
    }

    public function Dashboard(){
        if ($this->checkTeam() == false) {
            return redirect()->intended('create-team');
        }
        if($this->checkInstitution() == false){
            return redirect()->intended('add-competition');
        }
        if($this->checkMember() == false){
            return redirect()->intended('members');
        }
        
        $auth = Auth::user();
        $team = Team::where('kode_tim',$auth->kode_tim)->first();
        $member = Member::where('kode_tim',$auth->kode_tim)->get();
        $lomba = Competition::where('kode_lomba',$team->kode_lomba)->first();
        $paymentStatus = payment::where('kode_tim',$auth->kode_tim)->first();
        if ($paymentStatus == null) {
            $paymentStatus = 0;
        }else if($paymentStatus->verified == 0){
            $paymentStatus = 1;
        }
        else if($paymentStatus->verified == 1){
            $paymentStatus = 2;
        }
        else{
            $paymentStatus = 3;
        }
        return view('Participant/Dashboard')->with(['team'=>$team, 'members'=>$member,'namaLomba'=>$lomba->nama_lomba,'paymentStatus'=>$paymentStatus,'guidebook'=>$lomba->url_guidebook]);
    }
    public function Payment(){
        if($this->paymentCheck() ==false){
            return redirect('dashboard');
        }
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
        $file_location = 'Bukti-pembayaran/'.$team->nama_tim;
        $payment->verified = 0;
        $payment->bukti_pembayaran = $file_location.'/'.$request->file('bukti_pembayaran')->getClientOriginalName();
        $payment->save();
        $request->file('bukti_pembayaran')->storeAs('public/'.$file_location,$request->file('bukti_pembayaran')->getClientOriginalName());
        return redirect()->intended('dashboard');
    }
    public function deleteMember(Request $request){
        $member = Member::where('member_id',$request->member_id);
        $team = Team::where('kode_ketua',$request->member_id)->first();
        if($team != null){
            return redirect('members');
        }
        $member->delete();
        return redirect()->intended('members');
    }
}
