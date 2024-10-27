<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;

class ClubController extends Controller
{
    public function index()
    {
        $clubs = Club::all();
        return view('admin.clubs.index', compact('clubs'));
    }


   
    // Show a single club
    public function show(Club $club)
    {
        return view('clubs.show', compact('club'));
    }

 
}
