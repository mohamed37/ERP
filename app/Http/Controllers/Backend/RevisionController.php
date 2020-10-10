<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Category;
use App\Revision;

class RevisionController extends Controller
{
    public function __construct()
    {
         //create read update delete
         $this->middleware(['permission:read-revisions'])->only('index');
         $this->middleware(['permission:create-revisions'])->only('create');
         $this->middleware(['permission:update-revisions'])->only('update');
         $this->middleware(['permission:delete-revisions'])->only('destroy');
 
      
    }// end of __construct

    public function index(Request $request)
    {
        $revisions = Revision::latest()->paginate(5);

        return view('dashboard.revisions.index', compact('revisions'));

    }//end of index

    public function rows(Request $request)
    { 
     if($request->ajax())
     {
       $revisions = Revision::when($request->search, function($q) use($request){
            return $q->where('review', 'Like','%'. $request->search . '%');
                     })->orderBy('id', 'desc')->paginate(5);
            
            return view('Dashboard.revisions.rows',compact('revisions'));
            
            //return response()->json($revisions, 200);
      } else {
          
          return view('Dashboard.revisions.index', compact('revisions'));
      }   
          
    }

    public function create()
    {
        $categories = Category::get();
        
        if($categories->count() <= 0)
        {
            return view('dashboard.categories.create');
            
        }else { 
               
           return view('dashboard.revisions.create', compact('categories'));
        }
    }//end of create


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'category_id' => 'required|min:1',
            'review' => 'required',
            'pdf'     => 'required|mimes:pdf, docx' 
            
        ]);
        
        if($request->pdf)
        {
            $file = $request->pdf;
            
            $upload = time() . $file->HashName();
            
            $file->move(public_path('uploads/files' , $upload));
        }
        
        //dd($request->pdf);
        Revision::create([
            'category_id' => $request->category_id,
            'review' => $request->review,
            'pdf' => 'uploads/files/'.$upload,
            
        ])->save();
        
        session()->flash('success', __('site.added_successfully'));
        
        return redirect()->route('revisions.index');

    }//end of store


    public function show(Revision $revision)
    {
        $categories = Category::get();
        
        return view('dashboard.revisions.show', compact('revision', 'categories'));

    }//end of edit

    public function edit(Revision $revision)
    {
        $categories = Category::get();
        
        return view('dashboard.revisions.edit', compact('revision', 'categories'));

    }//end of edit

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Revision $revision)
    {
        $revision->update($request->all());
        
        session()->flash('success', __('site.updated_successfully'));
        
        return redirect()->route('revisions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Revision $revision)
   {
        $revision->delete();
        
        session()->flash('success', __('site.deleted_successfully'));
        
        return redirect()->back();
    }
   
   
  public function multidelete(Request $request)
  {
         $ids = $request->ids;
        
        $revisions = Revision::whereIn('id', explode(",", $ids))->delete();
        
        session()->flash('success', __('site.deleted_successfully'));
        
        return redirect()->route('revisions.index');

  }
}
