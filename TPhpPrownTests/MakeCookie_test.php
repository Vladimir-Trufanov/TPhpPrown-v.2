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
   function test_MakeCookies()
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
            //echo 'CookMessa='.$s_CookMessa.'<br>';
            $aCookMessa=unserialize($s_CookMessa);
            // Формируем массив результатов тестов
            $s_Equals=$_SESSION['Equals'];  
            echo 'Equals='.$s_Equals.'<br>';
            $aEquals=unserialize($s_Equals);
            // 
            //$CookCount=count($aCookMessa);
            // Проводим тесты на первом проходе
                  $this->assertEqual('1Типичный1','$i');
            if ($s_CookTrack==1)
            {
               $aCookMessa[count($aCookMessa)]='--- '.$s_CookTrack.' проход ---'; 
               $aCookMessa[count($aCookMessa)]='';
               //\prown\ViewGlobal(avgCOOKIE);
               MakeTitle("MakeCookie");
               if (IsSet($_COOKIE['cookTypeStr'])) 
               {
                  $aCookMessa[count($aCookMessa)]='MakeCookie';
                  $aCookMessa[count($aCookMessa)]='MakeCookie';
                  $i=$_COOKIE['cookTypeStr'];
                  $this->assertEqual('1Типичный1',$i);
                  //$aCookMessa[count($aCookMessa)]=$i;
                  //$aCookMessa[count($aCookMessa)]=$i;
               }
               //$this->assertEqual('Типичный',$_COOKIE['cookTypeStr']);
               
               //$string='1958';
               //$Result=\prown\MakeType($string,tInt);
               //$this->assertEqual($Result,1958);
               //$this->assertNotEqual($Result,'1959');
               // Закладываем сообщение  
               $aCookMessa[count($aCookMessa)]=
                  "MakeCookie:cookTypeStr=Типичный,".
                  "cookTypeInt=137,cookTypeFloat=3.1415926 "; 
               $aCookMessa[count($aCookMessa)]=
                  "Обычные кукисы через имя и значение установлены"; 
            }
            // Фиксируем новое состояние списка сообщений
            $s_CookMessa=prown\MakeSession('CookMessa',serialize($aCookMessa),tStr);      
            echo 'CookMess2='.$s_CookMessa.'<br>';
            
            // На последнем нулевом проходе выводим все накопленные сообщения
            // и проводим тесты
            if ($s_CookTrack==0)
            {
               // Выводим все накопленные сообщения
               for ($i=0; $i<count($aCookMessa); $i=$i+2)
               {
                  MakeTestMessage($aCookMessa[$i],$aCookMessa[$i+1],80);
               }
               // Выводим все накопленные сообщения
               //for ($i=0; $i<count($aCookMessa); $i=$i+2)
               //{
               //   MakeTestMessage($aCookMessa[$i],$aCookMessa[$i+1],80);
               //}
            } 
         }
      }
   }
}
// **************************************************** MakeCookie_test.php ***
