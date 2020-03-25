<?php

// PHP7/HTML5, EDGE/CHROME                          *** MakeCookie_test.php ***

// ****************************************************************************
// * TPhpPrown          Установить новое значение COOKIE в браузере, заменить *
// *              этим значением соответствующее данное во внутреннем массиве *
// *       $_COOKIE и установить новое значение переменной-кукиса в программе *
// ****************************************************************************

//                                                   Автор:       Труфанов В.Е.
//                                                   Дата создания:  23.02.2020
// Copyright © 2020 tve                              Посл.изменение: 25.03.2020

class test_MakeCookie extends UnitTestCase 
{
   function test_MakeCookies()
   {
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
            // а именно парами складываем значения для сравнения 
            // на последнем проходе 
            if ($s_CookTrack==1)
            {
               // Складываем данные для проверки кукисов через имя и значение
               $pref='t11='; // В первом проходе первый тест
               $aEquals[count($aEquals)]=$pref.strval(cookStr); 
               $aEquals[count($aEquals)]=$pref.strval($_COOKIE['cookTypeStr']);
               $pref='t12='; // В первом проходе второй тест
               $aEquals[count($aEquals)]=$pref.strval(cookInt); 
               $aEquals[count($aEquals)]=$pref.strval($_COOKIE['cookTypeInt']);
               $pref='t13='; 
               $aEquals[count($aEquals)]=$pref.strval(cookFloat); 
               $aEquals[count($aEquals)]=$pref.strval($_COOKIE['cookTypeFloat']);
               // Закладываем 1 сообщение 1 прохода 
               $aCookMessa[count($aCookMessa)]=
                  "MakeCookie:cookTypeStr=Типичный,".
                  "cookTypeInt=137,cookTypeFloat=3.1415926 "; 
               $aCookMessa[count($aCookMessa)]=
                  "Установка обычных кукисов по именам и значениям подтверждена"; 
               // Пытаемся проинициализировать кукис повторно
               $pref='t14='; 
               $Result=prown\MakeCookie('cookTypeZero',cookZero+16,tInt,true);
               $aEquals[count($aEquals)]=$pref.strval(cookZero);                   
               $aEquals[count($aEquals)]=$pref.strval($_COOKIE['cookTypeZero']);   
               // Закладываем 2 сообщение 1 прохода 
               $aCookMessa[count($aCookMessa)]=
                  'prown\MakeCookie("Zero",0,tInt,true); '.
                  'prown\MakeCookie("Zero",16,tInt,true); ';
               $aCookMessa[count($aCookMessa)]=
                  "Zero=0, Повторной инициализации кукиса не произошло"; 
               // Складываем данные для проверки запросов на значения кукисов
               $pref='t15='; 
               $Result=prown\MakeCookie('cookTypeStr');
               $aEquals[count($aEquals)]=$pref.strval(cookStr); 
               $aEquals[count($aEquals)]=$pref.strval($Result);
               $pref='t16='; 
               $Result=prown\MakeCookie('cookTypeInt');
               $aEquals[count($aEquals)]=$pref.strval(cookInt); 
               $aEquals[count($aEquals)]=$pref.strval($Result);
               $pref='t17='; 
               $Result=prown\MakeCookie('cookTypeFloat');
               $aEquals[count($aEquals)]=$pref.strval(cookFloat); 
               $aEquals[count($aEquals)]=$pref.strval($Result);
               // Закладываем 3 сообщение 1 прохода 
               $aCookMessa[count($aCookMessa)]=
                  "MakeCookie:cookTypeStr=Типичный,".
                  "cookTypeInt=137,cookTypeFloat=3.1415926 "; 
               $aCookMessa[count($aCookMessa)]=
                  "Выполнена проверка значений кукисов по именам"; 
            }
            // Готовим данные второго прохода для проведения тестов
            elseif ($s_CookTrack==2)
            {
            }
            // Фиксируем данные для тестов
            prown\MakeSession('Equals',serialize($aEquals),tStr);      
            // Фиксируем новое состояние списка сообщений
            $s_CookMessa=prown\MakeSession('CookMessa',serialize($aCookMessa),tStr);      
            // На последнем нулевом проходе выводим все накопленные сообщения
            // и проводим тесты
            echo 'TS CookTrack='.$s_CookTrack.'<br>';
            if ($s_CookTrack==3)
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
            //if ($s_CookTrack>3)
            // Трассируем оставшиеся кукисы
            if (IsSet($_COOKIE ["cookTypeStr"])) 
            echo '$_COOKIE ["cookTypeStr"]='.$_COOKIE ["cookTypeStr"].'<br>';
 
 
//             $_COOKIE ["cookTypeInt"]	137
//$_COOKIE ["cookTypeFloat"]	3.1415926
//$_COOKIE ["cookTypeZero"]	0

            prown\ViewGlobal(avgCOOKIE);
            
         }
      }
   }
}
// **************************************************** MakeCookie_test.php ***
