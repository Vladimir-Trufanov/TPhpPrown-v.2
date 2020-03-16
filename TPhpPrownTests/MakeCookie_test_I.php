<?php
// PHP7/HTML5, EDGE/CHROME                        *** MakeCookie_test_I.php ***

// ****************************************************************************
// * TPhpPrown-test           Блок обслуживания перезапусков теста MakeCookie *
// ****************************************************************************

//                                                   Автор:       Труфанов В.Е.
//                                                   Дата создания:  13.01.2019
// Copyright © 2020 tve                              Посл.изменение: 16.03.2020

// ****************************************************************************
// *                  Задать очередную порцию кукисов для теста               *
// ****************************************************************************
function MakeCookieTest($NumTest=0)
{
   $Result='None';
   $ModeError=rvsCurrentPos;
   // Инициируем массив сообщений теста
   if ($NumTest==0)
   {
      $aCookMessa=array();             // создали пустой массив
      //$aCookMessa[0] = 'первый левый'; 
      //$aCookMessa[1] = 'первый ghfdsq'; 
      $s_CookMessa=prown\MakeSession('CookMessa',serialize($aCookMessa),tStr);      
      //$CookCount=count($aCookMessa);   // задали начальную размерность массива
      //$s_CookCount=prown\MakeSession('CookCount',$CookCount,tInt); 
   }
   elseif ($NumTest==1)
   {
      //$Result=prown\MakeCookie('cookTypical','Типичный',null,null,null,null,$ModeError);
      // Обычное задание кукиса через имя и значение
      $Result=prown\MakeCookie('cookTypeStr','Типичный');
      $Result=prown\MakeCookie('cookTypeInt',137);
      $Result=prown\MakeCookie('cookTypeFloat',3.1415926);
      $Result=prown\MakeCookie('cookTypeZero',0,tInt,true);
   }
   return $Result;  
}
// ************************************************** MakeCookie_test_I.php ***
