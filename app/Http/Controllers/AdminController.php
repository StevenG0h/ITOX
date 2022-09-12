<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function dashboard(){
        return view('Admin/Manage/adminDashboard');
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
                return redirect('AdminDashboard');
            }
        }
        return back()->withErrors(['email' => 'The provided credentials do not match our records.']);
    }
    public function adminRegister(){
        return view('Admin/Auth/AdminRegister');
    }
}
