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
   if (isChecked('formDoor','MakeCookie'))
   {
      _MakeCookieTest();
   }
}
function _MakeCookieTest()
{
   // Выделяем первый в сессии заход для того, чтобы инициировать счетчик
   // проходов по тесту (с перезагрузкой страницы)
   if (!IsSet($_SESSION['CookTrack']))
   {
      prown\MakeSession('CookTrack',0,tInt,true);      
   }
   // Выполняем настройки проходов теста
   if (IsSet($_SESSION['CookTrack']))
   {
      // Регистрируем очередной проход
      $s_CookTrack=$_SESSION['CookTrack'];  
      echo 'CookTrack-I='.$s_CookTrack.'<br>';
      // На нулевом проходе инициируем массив сообщений теста, 
      // массив результатов тестов (проверка всех результатов делается на 
      // последнем проходе, чтобы высветить вывод)
      // и задаем кукисы для их проверки на 1 проходе
      if ($s_CookTrack==0)
      {
         // Готовим массив для накопления сообщений и их вывода 
         // на последнем проходе
         $aCookMessa=array(); // создали пустой массив
         // Готовим массив данных тестов для накопления и их сравнения 
         // на последнем проходе
         $aEquals=array();    // создали пустой массив
         // Выполняем контроль удаленных кукисов предыдущих тестов
         // ---
         // Записываем данные для тестов и сообщения в сессионные переменные
         prown\MakeSession('CookMessa',serialize($aCookMessa),tStr);      
         prown\MakeSession('Equals',serialize($aEquals),tStr);      
         // Задаем кукисы для тестов на 1 проходе
         $Result=prown\MakeCookie('cookTypeStr',cookStr,tStr,false,cookSession);
         $Result=prown\MakeCookie('cookTypeInt',cookInt);
         $Result=prown\MakeCookie('cookTypeFloat',cookFloat);
         $Result=prown\MakeCookie('cookTypeZero',cookZero,tInt,true);
      }
      elseif ($s_CookTrack==1)
      {
         $Result=prown\MakeCookie('cookTypeInt',cookInt,tInt,false,cookDelete);
         $Result=prown\MakeCookie('cookTypeZero',cookZero+16,tInt,true);
      }
      // Готовим следующий проход
      $s_CookTrack++;  
      prown\MakeSession('CookTrack',$s_CookTrack,tInt);     
      // Если все проходы завершены, то останавливаем перезагрузку страниц
      if (($s_CookTrack>LastTrack)||($s_CookTrack<0)) {}
      // Перезагружаем страницу для нового прохода: 
      // "http://localhost:84/index.php?formDoor[]=MakeCookie&formSubmit=Протестировать"
      else
      {
         $page="/index.php?formDoor%5B%5D=MakeCookie&".
            "formSubmit=%D0%9F%D1%80%D0%BE%D1%82%D0%B5%D1%81%D1%82%".
            "D0%B8%D1%80%D0%BE%D0%B2%D0%B0%D1%82%D1%8C";
         //echo "Location: http://".$_SERVER['HTTP_HOST'].$page;
         Header("Location: http://".$_SERVER['HTTP_HOST'].$page,true);
      }
   }
}
// ************************************************** MakeCookie_test_I.php ***
