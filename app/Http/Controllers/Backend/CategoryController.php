<?php

namespace App\Http\Controllers\Backend;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function __construct()
    {
         //create read update delete
         $this->middleware(['permission:read-categories'])->only('index');
         $this->middleware(['permission:create-categories'])->only('create');
         $this->middleware(['permission:update-categories'])->only('update');
         $this->middleware(['permission:delete-categories'])->only('destroy');
 
      
    }// end of __construct

    public function index(Request $request)
    {
        $categories = Category::latest()->paginate(5);

        return view('dashboard.categories.index', compact('categories'));

    }//end of index
    
    public function rows(Request $request)
    { 
     if($request->ajax())
     {
       $categories = Category::when($request->search, function($q) use($request){
            return $q->where('name', 'Like','%'. $request->search . '%');
                     })->orderBy('name', 'desc')->paginate(5);
            
            return view('Dashboard.categories.rows',compact('categories'));
            
            //return response()->json($categories, 200);
      } else {
          
          return view('Dashboard.categories.index', compact('categories'));
      }   
          
    }


    public function create()
    {
        return view('dashboard.categories.create');

    }//end of create

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required'
        ]);
        
        
        $category = Category::create($request->all());
        $category->save();
        
        session()->flash('success', __('site.added_successfully'));
        
        return redirect()->route('categories.index');

    }//end of store


    public function show(Category $category)
    {
        return view('dashboard.categories.show', compact('category'));

    }//end of edit

    public function edit(Category $category)
    {
        return view('dashboard.categories.edit', compact('category'));

    }//end of edit

    public function update(Request $request, Category $category)
    {
        
        $category->update($request->all());
        
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('categories.index');

    }//end of update

    public function destroy(Category $category)
    {
        $category->delete();
       
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('categories.index');
    }//end of destroy

 
  public function multidelete(Request $request)
  {
         $ids = $request->ids;
        
        $categories = Category::whereIn('id', explode(",", $ids))->delete();
        session()->flash('success', __('site.deleted_successfully'));
        
        return redirect()->route('categories.index');

      
  }

}//end of controller
