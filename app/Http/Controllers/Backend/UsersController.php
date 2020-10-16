<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\User;
use App\Role;
use DB;



class UsersController extends Controller
{
    
     public function __construct()
    {
//        //create read update delete
//        $this->middleware(['permission:read-users'])->only('index');
//        $this->middleware(['permission:create-users'])->only('create');
//        $this->middleware(['permission:update-users'])->only('update');
//        $this->middleware(['permission:delete-users'])->only('destroy');
//
//     
    }//end of constructor
     
     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
     
     
    public function index(Request $request)
    { 
        $users = User::orderBy('name', 'desc')->paginate(5);
               
        return view('Dashboard.users.index', compact('users'));    
        
        
     
    }
      
    public function rows(Request $request)
    { 
     if($request->ajax())
     {
       $users = User::when($request->search, function($q) use($request){
            return $q->where('name', 'Like','%'. $request->search . '%')
                     ->orWhere('email', 'Like','%'. $request->search . '%');
                    })->orderBy('name', 'desc')->paginate(5);
            
            return view('Dashboard.users.rows')->with('users', $users);
            
            //return response()->json($users, 200);
      } else {
          
          return view('Dashboard.users.index', compact('users'));
      }   
          
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::get();
        
        return view('Dashboard.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // VALIDATION DATA 
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
            'role' => 'required|min:1',
            'image' => 'required',    
        ]);
        
            
         $data = $request->all();
        
        $data = $request->except(['password', 'image','password_confirmation','role']);
        
        $data['password']= bcrypt($request->password);

           Image::make($request->image)->resize(300, null, function ($constraint) {
                  $constraint->aspectRatio();
              })->save(public_path('uploads/users_images/' . $request->image->hashName()));

           $data['image'] = $request->image->hashName();

         //dd($data);
            $user =  User::create($data);
            $user->attachRole($request->role);
       
            $user->save();

            session()->flash('success', __('site.added_successfully'));

         return redirect()->route('users.index');
     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,User $user)
    {
        $roles = Role::get();
        
        return view('Dashboard.users.show',compact('user', 'roles')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        
        return view('Dashboard.users.edit', compact('user')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->all();
        
        
        $data = $request->except(['password', 'image','role']);

             if($request->image) 
             {
                 
               if($request->image != $user->image)
                 {
                    Storage::disk('public_uploads')->delete('/users_images/'. $user->image);
                 }
                 
               Image::make($request->image)->resize(300, null, function ($constraint){
                           $constraint->aspectRatio();
                })->save(public_path('uploads/users_images/' .$request->image->hashName()));

                $data['image'] = $request->image->hashName();
                
             }//end of image
                 
             
             if($request->has('password') && $request->get('password') != '')
             {
                    $data['password'] = bcrypt($request->password);
             }

             $user->attachRole($request->role);

             $user->update($data);
           
             
             //dd($request->all());
             
             session()->flash('success', __('site.updated_successfully'));

             return redirect()->route('users.index');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
     if($user->image != 'defualt.png')
      {
         
      Storage::disk('public_uploads')->delete('/users_images/'. $user->image); 
      
      }  
      
      $user->delete();
      
       session()->flash('success', __('site.deleted_successfully'));
        
        return redirect()->route('users.index');
    }
    
    
    
    public function multidelete(Request $request)
    {
            $ids =  $request->ids;
            
            //dd($ids);
            
            $users = User::whereIn('id',  explode(",",$ids))->get();
            foreach($users as $user) 
            {
                
               // dd($users);
                
                 if ($user->image != 'defualt.png') 
                {
                    Storage::disk('public_uploads')->delete('/users_images/' . $user->image);    
                    $user->delete();
                
                } 
            }       
        session()->flash('success', __('site.deleted_successfully'));
           
            return redirect()->route('users.index');
    } // end of destroy multi rows
    
            
} 

