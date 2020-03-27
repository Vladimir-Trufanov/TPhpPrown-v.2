<?php

// PHP7/HTML5, EDGE/CHROME                          *** MakeCookie_test.php ***

// ****************************************************************************
// * TPhpPrown          Установить новое значение COOKIE в браузере, заменить *
// *              этим значением соответствующее данное во внутреннем массиве *
// *       $_COOKIE и установить новое значение переменной-кукиса в программе *
// ****************************************************************************

//                                                   Автор:       Труфанов В.Е.
//                                                   Дата создания:  23.02.2020
// Copyright © 2020 tve                              Посл.изменение: 26.03.2020

class test_MakeCookie extends UnitTestCase 
{
   function test_MakeCookies()
   {
      $ModeError=rvsCurrentPos;
      // Регистрируем очередной проход
      $s_CookTrack=$_SESSION['CookTrack'];  
      echo 'CookTrack-T='.$s_CookTrack.'<br>';
      // Готовим данные последнего прохода для проведения тестов
      // по удалению кукисов
      if ($s_CookTrack==1)
      {
         //$Result=prown\MakeCookie('cookTypeStr',cookStr,false,cookDelete);
         //setcookie('cookTypeStr',cookStr,-3600);
         //setcookie('cookTypeStr',cookStr,cookDelete);
         //setcookie('cookTypeStr',cookStr,0);
         //unset($_COOKIE ["cookTypeStr"]);
         //echo 'STOP cookStr=-3600'.'<br>';
         //$Result=prown\MakeCookie('cookTypeInt',cookInt,cookDelete);
         //$Result=prown\MakeCookie('cookTypeFloat',cookFloat,cookDelete);
         //$Result=prown\MakeCookie('cookTypeZero',cookZero,cookDelete);
      }
      // Если все проходы завершены, то сбрасываем счетчик проходов
      if (($s_CookTrack>LastTrack)||($s_CookTrack<0))
      {
            $s_CookTrack=0;  
            prown\MakeSession('CookTrack',$s_CookTrack,tInt);     
      }
      prown\ViewGlobal(avgCOOKIE);
   }
}
// **************************************************** MakeCookie_test.php ***
