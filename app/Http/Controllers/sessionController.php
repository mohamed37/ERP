<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use App\User;
class sessionController extends Controller
{
    
    use AuthenticatesUsers;
    
    public function store(Request $request)
    {
        
      //  $response = new Response($value);
        $user = $request->session()->get('user_id');
        
        $users = User::where('email', $request->email)->get();
        
        if($users == $user)
        {
            if($request->session()->has('user_id'))
            {
            var_dump($request->session()->all());
            } else {
                echo 'no ' . $users;
            }      
        }
         
        //     $request->sessoin()->put('user_id', $user);
        //     return view('test');
            
        // } else {
            
        //    return redirect()->route('/login');
        // }
        
        //echo 'created session ' . $request->session()->get('user_id') ;
        
    }
    
    public function destroy(Request $request)
    {
        $request->session()->forget('user_id');
        
        session()->flash('success',__('site.deleted_successfully'));
        
        return $this->loggedOut($request) ?: redirect('/login');

    }
}
