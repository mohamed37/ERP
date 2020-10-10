<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\Course;
use App\Category;

class CoursesController extends Controller
{
    public function __construct()
    {
         //create read update delete
         $this->middleware(['permission:read-courses'])->only('index');
         $this->middleware(['permission:create-courses'])->only('create');
         $this->middleware(['permission:update-courses'])->only('update');
         $this->middleware(['permission:delete-courses'])->only('destroy');
 
      
    }// end of __construct

    public function index(Request $request)
    {
        $courses = Course::latest()->paginate(5);

        return view('dashboard.courses.index', compact('courses'));
 
    }
    
    public function rows(Request $request)
    { 
     if($request->ajax())
     {
       $courses = Course::when($request->search, function($q) use($request){
            return $q->where('name', 'Like','%'. $request->search . '%')
                     ->orWhere('langs', 'Like','%'. $request->search . '%')
                     ->orWhere('tools', 'Like','%'. $request->search . '%');
                    })->orderBy('name', 'desc')->paginate(5);
            
            return view('Dashboard.courses.rows')->with('courses', $courses);
            
            //return response()->json($courses, 200);
      } else {
          
          return view('Dashboard.courses.index', compact('courses'));
      }   
          
    }


    public function create()
    {
        $categories = Category::get();
        
        if($categories->count() <= 0)
        {
            return view('dashboard.categories.create');
            
        }else { 
               
           return view('dashboard.courses.create', compact('categories'));
        }
    }//end of create

    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required|min:1',
            'name' => 'required|unique:courses',
            'langs' => 'required',
            'tools' => 'required',
            'details' => 'required|max:255',
            'image' => 'required',
            'days' => 'required',
            
        ]);
        
        $data = $request->all();
        
        $data = $request->except('image');
        
        if ($request->image)
        {

          Image::make($request->image)->resize(300, null, function ($constraint) {
                 $constraint->aspectRatio();
             })->save(public_path('uploads/courses_images/' . $request->image->hashName()));

          $data['image'] = $request->image->hashName();

         }//end of if
  
        $course = Course::create($data);
        
        
        $course->save();
        
        session()->flash('success', __('site.added_successfully'));
        
        return redirect()->route('courses.index');

    }//end of store


    public function show(Course $course)
    {
        $categories = Category::get();
        
        $course->update(['status' => 1]);
        
        return view('dashboard.courses.show', compact('course', 'categories'));

    }//end of edit

    public function edit(Course $course)
    {
        $categories = Category::get();
        
        return view('dashboard.courses.edit', compact('course', 'categories'));

    }//end of edit

    public function update(Request $request, Course $course)
    {
        $data = $request->all();
        
        $course->update($data);
        
        $data = $request->except(['image']);

        if($request->image)
        {
           if($request->image != $course->image) 
           {
             Storage::disk('public_uploads')->delete('/courses_images/'. $course->image);
           }

          Image::make($request->image)->resize(300, null, function ($constraint){
                      $constraint->aspectRatio();
           })->save(public_path('uploads/courses_images/' .$request->image->hashName()));

           $data['image'] = $request->image->hashName();
        }

        session()->flash('success', __('site.updated_successfully'));
        
        return redirect()->route('courses.index');

    }//end of update

    public function destroy(Course $course)
    {
        if($course->image != 'defualt.png') 
           {
             Storage::disk('public_uploads')->delete('/courses_images/'. $course->image);
           }
        $course->delete();
       
        session()->flash('success', __('site.deleted_successfully'));
        
        return redirect()->route('courses.index');
    }//end of destroy
    
    
    
  public function multidelete(Request $request)
  {
         $ids = $request->ids;
        
        $categories = Category::whereIn('id', explode(",", $ids))->get();
        foreach ($categories as $category)
        {
            if($category->image != 'defualt.png')
            {
             Storage::disk('public_uploads')->delete('/courses_images/'. $course->image);
                $category->delete();
            }
        }
        session()->flash('success', __('site.deleted_successfully'));
        
        return redirect()->route('categories.index');

      
  }
}
