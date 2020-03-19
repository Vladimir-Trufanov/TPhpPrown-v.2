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
            // Формируем массив ранее сформированных сообщений
            $s_CookMessa=$_SESSION['CookMessa'];  
            $aCookMessa=unserialize($s_CookMessa);
            // Формируем массив результатов тестов
            $s_Equals=$_SESSION['Equals'];  
            $aEquals=unserialize($s_Equals);
            // Готовим данные первого прохода для проведения тестов 
            if ($s_CookTrack==1)
            {
               $pref='t11='; // В первом проходе первый тест
               $aEquals[count($aEquals)]=$pref.strval(cookStr); 
               $aEquals[count($aEquals)]=$pref.strval($_COOKIE['cookTypeStr']);
               $pref='t12='; // В первом проходе второй тест
               $aEquals[count($aEquals)]=$pref.strval(cookInt); 
               $aEquals[count($aEquals)]=$pref.strval($_COOKIE['cookTypeInt']);
               $pref='t13='; 
               $aEquals[count($aEquals)]=$pref.strval(cookFloat); 
               $aEquals[count($aEquals)]=$pref.strval($_COOKIE['cookTypeFloat']);
               $pref='t14='; 
               $aEquals[count($aEquals)]=$pref.strval(cookZero);                    // !!!
               $aEquals[count($aEquals)]=$pref.strval($_COOKIE['cookTypeZero']);    // !!!
               // Фиксируем данные для тестов
               prown\MakeSession('Equals',serialize($aEquals),tStr);      
               // Закладываем сообщение 1 прохода 
               $aCookMessa[count($aCookMessa)]=
                  "MakeCookie:cookTypeStr=Типичный,".
                  "cookTypeInt=137,cookTypeFloat=3.1415926 "; 
               $aCookMessa[count($aCookMessa)]=
                  "Обычные кукисы через имя и значение установлены"; 
            }
            // Фиксируем новое состояние списка сообщений
            $s_CookMessa=prown\MakeSession('CookMessa',serialize($aCookMessa),tStr);      
            // На последнем нулевом проходе выводим все накопленные сообщения
            // и проводим тесты
            if ($s_CookTrack==0)
            {
               MakeTitle("MakeCookie");
               // Выводим все накопленные сообщения
               for ($i=0; $i<count($aCookMessa); $i=$i+2)
               {
                  MakeTestMessage($aCookMessa[$i],$aCookMessa[$i+1],80);
               }
               // Выполняем все накопленные тесты
               $s_Equals=$_SESSION['Equals'];  
               $aEquals=unserialize($s_Equals);
               for ($i=0; $i<count($aEquals); $i=$i+2)
               {
                   $this->assertEqual($aEquals[$i],$aEquals[$i+1]);
               }
            } 
         }
      }
   }
}
// **************************************************** MakeCookie_test.php ***
