<?php

// PHP7/HTML5, EDGE/CHROME                          *** MakeCookie_test.php ***

// ****************************************************************************
// * TPhpPrown          Установить новое значение COOKIE в браузере, заменить *
// *              этим значением соответствующее данное во внутреннем массиве *
// *       $_COOKIE и установить новое значение переменной-кукиса в программе *
// ****************************************************************************

//                                                   Автор:       Труфанов В.Е.
//                                                   Дата создания:  23.02.2020
// Copyright © 2020 tve                              Посл.изменение: 17.03.2020


class test_MakeCookie extends UnitTestCase 
{
   function test_MakeCookie_Incremental()
   {
      //require_once $_SERVER['DOCUMENT_ROOT'].'/iniWorkSpace.php';
      //$_WORKSPACE=iniWorkSpace();
      /*
      $SiteHost=$_WORKSPACE[wsSiteHost];     // Каталог хостинга
      require_once $SiteHost."/TPhpPrown/TPhpPrown/ViewGlobal.php";
      //\prown\ViewGlobal(avgCOOKIE);
      */

      // Выбираем данные сессии для трассировки и тестирования очередного прохода
      if (IsSet($_SESSION))
      {
         // Вытаскиваем данные о ранее выведенных сообщениях
         if (IsSet($_SESSION['CookMessa'])&&(IsSet($_SESSION['CookTrack'])))
         {
            // Определяем проход 
            $s_CookTrack=$_SESSION['CookTrack'];  
            echo 'tectCookTrack='.$s_CookTrack.'<br>';
            // Формируем массив ранее сформированных сообщений
            $s_CookMessa=$_SESSION['CookMessa'];  
            echo 'CookMessa='.$s_CookMessa.'<br>';
            $aCookMessa=unserialize($s_CookMessa);
            // 
            $CookCount=count($aCookMessa);
            // Проводим тесты на первом проходе
            if ($s_CookTrack==1)
            {
               $aCookMessa[count($aCookMessa)]='--- '.$s_CookTrack.' проход ---'; 
               $aCookMessa[count($aCookMessa)]='';
               //\prown\ViewGlobal(avgCOOKIE);
               MakeTitle("MakeCookie");
               $string='1958';
               $Result=\prown\MakeType($string,tInt);
               $this->assertEqual($Result,1958);
               $this->assertNotEqual($Result,'1959');
               // Закладываем сообщение  
               $aCookMessa[count($aCookMessa)]=
                  '$string="1958"; $Result=\prown\MakeType($string,tInt); '; 
               $aCookMessa[count($aCookMessa)]=
                  'Преобразование строчного "1958" к целому 1958'; 
            }
            // Фиксируем новое состояние списка сообщений
            $s_CookMessa=prown\MakeSession('CookMessa',serialize($aCookMessa),tStr);      
            // Выводим все накопленные сообщения
            for ($i=0; $i<count($aCookMessa); $i=$i+2)
            {
               MakeTestMessage($aCookMessa[$i],$aCookMessa[$i+1],70);
            } 
         }
      }
   }
}
// **************************************************** MakeCookie_test.php ***
