<?php

namespace App\Http\Controllers;

use App\Models\Player;
use App\Models\Technical;
use Illuminate\Http\Request;

class TechnicalController extends Controller
{
    public function index()
    {
  
        return view('admin.technical');
    }

    public function tacticalIndex()
    {
        
        return view('admin.tactical');
    }

    public function physicalIndex()
    {
        
        return view('admin.physical');
    }

    public function mentalIndex()
    {
        
        return view('admin.mental');
    }

}
   