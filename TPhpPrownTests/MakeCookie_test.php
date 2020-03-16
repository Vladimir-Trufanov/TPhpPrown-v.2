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
   function test_MakeCookie_Incremental()
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

      // Выбираем данные сессии для трассировки и тестирования очередного прохода
      if (IsSet($_SESSION))
      {
         // Регистрируем очередной проход
         if (IsSet($_SESSION['CookTrack']))
         {
            $s_CookTrack=$_SESSION['CookTrack']+1;  
            prown\MakeSession('CookTrack',$s_CookTrack,tInt);     
            echo 'CookTrack='.$s_CookTrack.'<br>';
         }
         // Вытаскиваем данные о ранее выведенных сообщениях
         if (IsSet($_SESSION['CookMessa']))
         {
            $s_CookMessa=$_SESSION['CookMessa'];  
            echo 'CookMessa='.$s_CookMessa.'<br>';
            // Формируем массив сообщений
            $aCookMessa=unserialize($s_CookMessa);
            $CookCount=count($aCookMessa);
            for ($i=0; $i<$CookCount; $i++)
            {
               echo $i.': '.$aCookMessa[$i].'<br>';
            } 
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
      // Если все проходы завершены, то останавливаем перезагрузку страниц
      if (($s_CookTrack>4)||($s_CookTrack<0))
      {
            $s_CookTrack=0;  
            prown\MakeSession('CookTrack',$s_CookTrack,tInt);     
            echo 'STOP CookTrack='.$s_CookTrack.'<br>';
      }
      // Перезагружаем страницу для нового прохода 
      else
      {
      }
  }
}
// **************************************************** MakeCookie_test.php ***
