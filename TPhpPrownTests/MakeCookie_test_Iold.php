<?php
// PHP7/HTML5, EDGE/CHROME                        *** MakeCookie_test_I.php ***

// ****************************************************************************
// * TPhpPrown-test           Блок обслуживания перезапусков теста MakeCookie *
// ****************************************************************************

//                                                   Автор:       Труфанов В.Е.
//                                                   Дата создания:  13.01.2019
// Copyright © 2020 tve                              Посл.изменение: 26.03.2020

// ****************************************************************************
// *  Инициализировать сессионную переменную для возможного теста MakeCookie, *
// * сделать подготовку текущего прохода этого теста, задать очередную порцию *
// *                              кукисов для теста                           *
// ****************************************************************************
function MakeCookieTest()
{
   $Result=true;
   $ModeError=rvsCurrentPos;
   // Выполняем функцию, только в случае, если выбран MakeCookie-тест
   if (isChecked('formDoor','MakeCookie'))
   {
      echo ('Привет!<br>');
      // Выделяем первый в сессии заход для того, чтобы инициировать счетчик
      // проходов по тесту (с перезагрузкой страницы) и
      // выполнить действия по контролю и удалению сессионного кукиса
      if (!IsSet($_SESSION['CookTrack']))
      {
         prown\MakeSession('CookTrack',0,tInt,true);      
      }
      // Регистрируем очередной проход
      $s_CookTrack=$_SESSION['CookTrack'];  
      echo 'IN CookTrack='.$s_CookTrack.'<br>';
      // На нулевом проходе инициируем массив сообщений теста, !!!!!!!!!!
      // массив результатов тестов (проверка всех результатов делается на 
      // последнем проходе, чтобы высветить вывод)
      // и задаем кукисы для их проверки на 1 проходе
      if ($s_CookTrack==0)
      {
         // Готовим массив для накопления сообщений и их вывода 
         // на последнем проходе
         $aCookMessa=array(); // создали пустой массив
         prown\MakeSession('CookMessa',serialize($aCookMessa),tStr);      
         // Готовим массив данных тестов для накопления и их сравнения 
         // на последнем проходе
         $aEquals=array();    // создали пустой массив
         prown\MakeSession('Equals',serialize($aEquals),tStr);      
         // Задаем обычные кукисы через имя и значение
         $Result=prown\MakeCookie('cookTypeStr',cookStr);
         $Result=prown\MakeCookie('cookTypeInt',cookInt);
         $Result=prown\MakeCookie('cookTypeFloat',cookFloat);
         $Result=prown\MakeCookie('cookTypeZero',cookZero,tInt,true);
      }
      // Готовим данные последнего прохода для проведения тестов
      // по удалению кукисов
      elseif ($s_CookTrack==1)
      {
         //$Result=prown\MakeCookie('cookTypeStr',cookStr,false,cookDelete);
         //setcookie('cookTypeStr',cookStr,-3600);
         //setcookie('cookTypeStr',cookStr,cookDelete);
         setcookie('cookTypeStr',cookStr,0);
         //unset($_COOKIE ["cookTypeStr"]);
         //echo 'STOP cookStr=-3600'.'<br>';
         //$Result=prown\MakeCookie('cookTypeInt',cookInt,cookDelete);
         //$Result=prown\MakeCookie('cookTypeFloat',cookFloat,cookDelete);
         //$Result=prown\MakeCookie('cookTypeZero',cookZero,cookDelete);
      }
      prown\ViewGlobal(avgCOOKIE);
      // Готовим следующий проход
      $s_CookTrack++;  
      prown\MakeSession('CookTrack',$s_CookTrack,tInt);     
      
      // Если все проходы завершены, то останавливаем перезагрузку страниц
      if (($s_CookTrack>2)||($s_CookTrack<0))
      {
            $s_CookTrack=0;  
            prown\MakeSession('CookTrack',$s_CookTrack,tInt);     
            echo 'STOP CookTrack='.$s_CookTrack.'<br>';
      }
      else
      // Перезагружаем страницу для нового прохода 
      {
         $page="/index.php?formDoor%5B%5D=MakeCookie&".
            "formSubmit=%D0%9F%D1%80%D0%BE%D1%82%D0%B5%D1%81%D1%82%".
            "D0%B8%D1%80%D0%BE%D0%B2%D0%B0%D1%82%D1%8C";
         //echo "Location: http://".$_SERVER['HTTP_HOST'].$page;
         Header("Location: http://".$_SERVER['HTTP_HOST'].$page,true);
      }
   }
   return $Result;  
}
// ************************************************** MakeCookie_test_I.php ***
