<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        /* $name = $request->session()->get('user_id');
        
        if($request->session()->has('user_id'))
        {
         
        return view('home')->with('name', $name);   
       
        }else{
            
             redirect('/login');
        } */
        
        return view('home');
    }
    
    public function indexDashboard()
    {
//        $users = User::paginate();
//                
     return view('Dashboard.dashboard');
    }
}
