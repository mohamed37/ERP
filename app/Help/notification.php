<?php 

  use App\Course as course;
  
  if(!function_exists('getCourse'))
  {
   
   function getCourse($type = 'data')
  {
      
    if($type == 'data')
    {
        
       $course = Course::where('status', 0)->orderBy('created_at', 'desc')->get();
       
    }else {
        
       $course = Course::where('status', 0)->count();
        
    }
    return $course;
    
    
   } // end of function
  
}// end of if 
