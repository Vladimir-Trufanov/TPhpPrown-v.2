<?php

// PHP7/HTML5, EDGE/CHROME                          *** MakeCookie_test.php ***

// ****************************************************************************
// * TPhpPrown                        Преобразовать значение к заданному типу *
// ****************************************************************************

//                                                   Автор:       Труфанов В.Е.
//                                                   Дата создания:  23.02.2020
// Copyright © 2020 tve                              Посл.изменение: 23.02.2020

require_once $SiteHost."/TPhpPrown/TPhpPrown/iniConstMem.php";

class test_MakeCookie extends UnitTestCase 
{
   // Преобразование строки к целому числу
   function test_MakeCookie_First()
   {
      ?>
      <script>

      function ali(varName)
      {
         //alert(varName);
         return varName;
      }

      ali('varName');
      </script>
      <?php
      
   
   
   
   
      MakeTitle("MakeCookie");
      $string='1958';
      $Result=\prown\MakeType($string,tInt);
      $this->assertEqual($Result,1958);
      $this->assertNotEqual($Result,'1959');  
      MakeTestMessage(
         '$string="1958"; $Result=\prown\MakeType($string,tInt); ',
         'Преобразование строчного "1958" к целому 1958',70);
  }
}
// **************************************************** MakeCookie_test.php ***
