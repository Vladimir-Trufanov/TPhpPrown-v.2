<?php

// PHP7/HTML5, EDGE/CHROME                          *** MakeCookie_test.php ***

// ****************************************************************************
// * TPhpPrown                        Преобразовать значение к заданному типу *
// ****************************************************************************

//                                                   Автор:       Труфанов В.Е.
//                                                   Дата создания:  23.02.2020
// Copyright © 2020 tve                              Посл.изменение: 23.02.2020


class test_MakeCookie extends UnitTestCase 
{
   // Преобразование строки к целому числу
   function test_MakeCookie_First()
   {
      require_once $_SERVER['DOCUMENT_ROOT'].'/iniWorkSpace.php';
      $_WORKSPACE=iniWorkSpace();
      /*
      $SiteHost=$_WORKSPACE[wsSiteHost];     // Каталог хостинга
      require_once $SiteHost."/TPhpPrown/TPhpPrown/ViewGlobal.php";
      //\prown\ViewGlobal(avgCOOKIE);
      */
      
      if (IsSet($_COOKIE['cookTypical']))
      {
         echo 'cookTypical='.$_COOKIE['cookTypical'].'<br>';
      }
      
      if (IsSet($_SESSION))
      {
         if (IsSet($_SESSION['CookTrack']))
         {
            $s_CookTrack=$_SESSION['CookTrack']+1;  
            prown\MakeSession('CookTrack',$s_CookTrack,tInt);     
         }
      }

       
   
   
   
      \prown\ViewGlobal(avgCOOKIE);
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