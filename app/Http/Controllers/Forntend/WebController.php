<?php

namespace App\Http\Controllers\Forntend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WebController extends Controller
{
    public function welcome()
    {
        return view('Forntend.welcome');
    }
    
    public function home()
    {
        return view('Forntend.home');
    }
    
    public function ask()
    {
        return view('Forntend.asks');
    }
    
    public function revision()
    {
        return view('Forntend.revisions');
    }
    
    public function course()
    {
        return view('Forntend.courses');
    }
    
    
}
