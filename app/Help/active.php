<?php

 function is_active(string $routeName)
 {
        return null !== request()->segment(3) && request()->segment(3) == $routeName ? 'active' : ' ' ;
 }


 


   //fetch Countries

   function getCountry()
   {
       return  $countries = array('Egypt', 'Libay', 'Tunisia', 
                                  'Sudan', 'Palstian', 'Syria');
   }

  function getCITY($country_name)
  {
      $cities = array(
          'Egypt' => array('Mahalla', 'Mansoura', 'Tanta', 'KafrElshaik', 'ALexandria', 'Cairo'),
          'Syria' => array('Demashk', 'Halab', 'Aleppo', 'Latakia', 'Homs', 'Duma'),
          'Palstian' => array('Gaza', 'Khan Yunis', 'Hebron', 'Elquds', 'Rafh'),
          'Libay' => array('Tripoli', 'Benghazi', 'Misrata', 'Sirt', 'Tobrul'),
          'Tunisia' => array('Sousse', 'Sfax', 'Tunis', 'Kairouan', 'Bizerte'),
          'Sudan' => array('Khartoum', 'Port Sudan', 'Nyala', 'Kassla', 'Bizerte'),
      );

            return $cities[$country_name];
        

  }
?>
