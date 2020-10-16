<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Employee;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $employees=Employee::paginate(10);
          return view('Dashboard.employee.index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    return view('Dashboard.employee.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the data
        $this->validate($request,array(
            'name'=>'required',
            'age'=>'required',
            'address'=>'required',
            'idcard'=>'required|unique:employees',
            'profession'=>'required',
            'cv'=>'mimes:pdf,docx'
        ));
          $employee=new Employee();
        // store in the database   
      if($request->hasFile('cv')){
            $CvExt=$request->file('cv')->getClientOriginalExtension();
            $fileName=time().'cv.'.$CvExt;
          
            $request->file('cv')->move(public_path('uploads/employee_cv'),$fileName);
          $employee->cv=$fileName;
          
        }
        
    
        $employee->name=$request->name;
        $employee->age=$request->age;
        $employee->address=$request->address;
        $employee->idcard=$request->idcard;
        $employee->profession=$request->profession;
        
        $employee->save();
      
       
       
        session()->flash('success', __('site.added_successfully'));
        //redirect to another page
        return redirect()->route('employees.index');
    }

    /**
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee=Employee::find($id);
          return view('Dashboard.employee.edit',compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $employee=Employee::find($id);
       
        // validate the data
        $this->validate($request,array(
            'name'=>'required',
            'age'=>'required',
            'address'=>'required',
            'idcard'=>'required',
            'profession'=>'required',
            'cv'=>'mimes:pdf,docx'
        ));
      
        // store in the database 
       // dd($request->cv);
      if($request->hasFile('cv'))
      {

      if($request->cv != $employee->cv)
      {
      Storage::disk('public_uploads')->delete('/employee_cv/'. $employee->cv);
      }
       
      $CvExt=$request->file('cv')->getClientOriginalExtension();
      $fileName=time().'cv.'.$CvExt;

      $request->file('cv')->move(public_path('uploads/employee_cv'),$fileName);
        $employee->cv=$fileName;
      }
       
        
        $employee->name=$request->name;
        $employee->age=$request->age;
        $employee->address=$request->address;
        $employee->idcard=$request->idcard;
        $employee->profession=$request->profession;
       
        $employee->save();
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('employees.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee=Employee::findOrFail($id);
         Storage::disk('public_uploads')->delete('/employee_cv/'. $employee->cv);
        $employee->delete();

        session()->flash('success', __('site.deleted_successfully'));

        return redirect()->route('employees.index');
}
}