<?php

 function is_active(string $routeName)
 {
        return null !== request()->segment(3) && request()->segment(3) == $routeName ? 'active' : ' ' ;
 }


  //fetch Countries 
  
  function getCountry()
  {
        return $countries = ['Egypt', 'Labiay', 'Tunis', 'ALgary', 'Marco', 'Sudan', 'Palstian', 'Jordan', 'Syria', 'Kuiwt','Sudia Arab'];
         
  }
  
  
  //fetch Countries 
  
  function getCity()
  {
      return   $cties = ['Mahalla', 'Tanta', 'KafrElshaik', 'ALexandria', 'Cairo', 'Demashk', 'Halab', 'khza', 'Elquds', 'Rafh'];
      
  }
?>
