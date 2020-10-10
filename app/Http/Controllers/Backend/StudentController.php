<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

use App\Student;

class StudentController extends Controller
{
    public function rows(Request $request)
    {
        if($request->ajax())
        {
            $students = Student::when($request->search, function($query) use($request){
                return $query->where('first-name', 'Like', '%'. $request->search . '%')
                             ->orWhere('last-name', 'Like', '%'. $request->search . '%')
                             ->orWhere('email', 'Like', '%'. $request->search . '%');
                            
            })->orderBy('id', 'asc')->paginate(4);
            
            return view('Dashboard.students.rows', compact('students'));
        
        } else {
        return view('Dashboard.students.index', compact('students'));
            
        }
    }
    
    public function index(Request $request)
    {
        $students = Student::orderBy('id', 'asc')->paginate(5);
        
        if(request()->has('gender'))
        {
            $students = Student::where('gender', request('gender'))->paginate(4);
       
        } else {
            
            return view('Dashboard.students.index', compact('students'));
        } 
        
        return view('Dashboard.students.index', compact('students'));
    }
    
    
    public function create()
    {
        
        return view('Dashboard.students.create');
    }
    
    public function store(Request $request)
    {
        // VALIDATION DATA 
        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|unique:students',
            'password' => 'required|confirmed',
            'age' => 'required',
            'image' => 'required',  
            'phone' => 'required',
            'address' => 'required',
            'birthday' => 'required',
            'city' => 'required',
            'country' => 'required',  
            'gender' => 'required', 
        ]);
        
            
         $data = $request->all();
        
        $data = $request->except(['password', 'image','password_confirmation']);
        
        $data['password']= bcrypt($request->password);

           Image::make($request->image)->resize(300, null, function ($constraint) {
                  $constraint->aspectRatio();
              })->save(public_path('uploads/students_images/' . $request->image->hashName()));

           $data['image'] = $request->image->hashName();

         //dd($data);
            $student = Student::create($data);
           
            $student->save();

            session()->flash('success', __('site.added_successfully'));

          return redirect()->route('students.index');
     
    }
    
    public function edit(Student $student)
    {

        return view('Dashboard.students.edit', compact('student'));
    }
    
    
    public function update(Request $request, Student $student)
    {
        $data = $request->all();
        
        $data = $request->except(['password', 'image']);

             if($request->image) 
             {
                 
               if($request->image != $student->image)
                 {
                    Storage::disk('public_uploads')->delete('/students_images/'. $student->image);
                 }
                 
               Image::make($request->image)->resize(300, null, function ($constraint){
                           $constraint->aspectRatio();
                })->save(public_path('uploads/students_images/' .$request->image->hashName()));

                $data['image'] = $request->image->hashName();
                
             }//end of image
                 
             
             if($request->has('password') && $request->get('password') != '')
             {
                    $data['password'] = bcrypt($request->password);
             }

             $student->update($data);
           
             
             //dd($request->all());
             
             session()->flash('success', __('site.updated_successfully'));

             return redirect()->route('students.index');
        
    }
    
    public function show(Student $student)
    {
        
        return view('Dashboard.students.show', compact('student'));
    }
    
    
    public function active(Student $student)
    {
        $student->update(['active' => 1]);
        
        return view('Dashboard.students.show', compact('student'));
    }
    
    public function destroy(Student $student)
    {
        
      if($student->image != 'defualt.png')
        {
        
        Storage::disk('public_uploads')->delete('/students_images/'. $student->image); 
        
        }  
        
        $student->delete();
        
        session()->flash('success', __('site.deleted_successfully'));
        
        return redirect()->route('students.index');
    
              
    }
           
    public function trash(Request $request)
    {
        $students = Student::onlyTrashed()->when($request->search, function($q) use($request) {
            return $q->where('created_at', 'Like', '%' . $request->search . '%');
        })->orderBy('created_at', 'desc')->paginate(5);


        return view('dashboard.students.block',compact('students'));
    }
    
    
    public function restore(Student $student)
    {
        $student->withTrashed()->restore();
        
        return redirect()->route('students.trash');
    }


    public function delete(Student $student)
    {
        $students->withTrashed()->forceDelete();
        
        return redirect()->route('students.trash');
    }    
         
           
    public function multidelete(Request $request)
    {
        $ids =  $request->ids;
        
        $students = Student::whereIn('id',  explode(",",$ids))->get();
        foreach($students as $student) 
        {
            
            if ($student->image != 'defualt.png') 
            {
                Storage::disk('public_uploads')->delete('/students_images/' . $student->image);    
                $student->delete();
            
            } 
        }       
        session()->flash('success', __('site.deleted_successfully'));
        
        return redirect()->route('students.index');
    } // end of destroy multi rows
    
}
