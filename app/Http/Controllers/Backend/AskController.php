<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Ask;

class AskController extends Controller
{
    
    public function __construct()
    {
         //create read update delete
         $this->middleware(['permission:read-asks'])->only('index');
         $this->middleware(['permission:create-asks'])->only('create');
         $this->middleware(['permission:update-asks'])->only('update');
         $this->middleware(['permission:delete-asks'])->only('destroy');
 
      
    }// end of __construct

  
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $asks = Ask::latest()->paginate(5);
        
        return view('dashboard.asks.index', compact('asks'));
    }
    
    public function rows(Request $request)
    { 
         if($request->ajax())
        {
        $asks = Ask::when($request->search ,function($q) use($request){
            
            return $q->where('question', 'like',  '%' . $request->search . '%')
                     ->orWhere('answer','Like', '%'. $request->search .  '%');
                     
        })->orderBy('question', 'desc')->paginate(5);
            
            return view('Dashboard.asks.rows',compact('asks'));
            
            //return response()->json($asks, 200);
      } else {
          
          return view('Dashboard.asks.index', compact('asks'));
      }   
          
    }
    
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.asks.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'question' => 'required|unique:asks',
            'answer' => 'required|unique:asks',
            
        ]);
        
        Ask::create($request->all())->save();
        
        session()->flash('success', __('site.added_successfully'));
        
        return redirect()->route('asks.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ask $ask)
    {
        return view('dashboard.asks.show', compact('ask'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Ask $ask)
    {
        return view('dashboard.asks.edit', compact('ask'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Ask $ask)
    {
        $ask->update($request->all());
        
        session()->flash('success', __('site.updated_successfully'));
        
        return redirect()->route('asks.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ask $ask)
    {
        $ask->delete();
        
        session()->flash('success', __('site.deleted_successfully'));
        
        return redirect()->back();
    }
    
     public function multidelete(Request $request)
    {
         $ids = $request->ids;
        
        $asks = Ask::whereIn('id', explode(",", $ids))->delete();
        
        session()->flash('success', __('site.deleted_successfully'));
        
        return redirect()->route('asks.index');

  } 
}
