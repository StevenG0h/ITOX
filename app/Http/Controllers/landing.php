<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use Illuminate\Http\Request;

class landing extends Controller
{
    public function index(){
        $competition = Competition::all();
        return view('landing')->with(['competitions'=>$competition]);
    }
}
