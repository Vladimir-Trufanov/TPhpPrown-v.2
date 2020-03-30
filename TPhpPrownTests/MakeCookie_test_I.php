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
   // Разрешаем выполнение проходов, только когда выбраны тесты MakeCookie
   if (isChecked('formDoor','MakeCookie'))
   {
      _MakeCookieTest();
   }
}
// Выполняем инициализацию проходов
function _MakeCookieTest()
{
   // Выделяем первый в сессии заход для того, чтобы инициировать счетчик
   // проходов по тесту (с перезагрузкой страницы)
   if (!IsSet($_SESSION['CookTrack']))
   {
      $s_CookTrack=prown\MakeSession('CookTrack',0,tInt,true);      
   }
   else
   {
      // Отмечаем новый проход
      $s_CookTrack=$_SESSION['CookTrack'];      
      $s_CookTrack++;  
      prown\MakeSession('CookTrack',$s_CookTrack,tInt);     
   }
   // На нулевом проходе инициируем массив сообщений теста, 
   // массив результатов тестов (проверка всех результатов делается на 
   // последнем проходе, чтобы высветить вывод)
   if ($s_CookTrack==0)
   {
      // Готовим массив для накопления сообщений и их вывода 
      // на последнем проходе
      $aCookMessa=array();  // создали пустой массив
      // Готовим массив данных тестов для накопления и их сравнения 
      // на последнем проходе
      $aEquals=array();     // создали пустой массив
   }
   // На первом и последующих проходах поднимаем массивы
   // данных для тестов и сообщений из сессионных переменных
   else
   {
      // Формируем массив ранее сформированных сообщений
      $s_CookMessa=$_SESSION['CookMessa'];  
      $aCookMessa=unserialize($s_CookMessa);
      // Формируем массив результатов тестов
      $s_Equals=$_SESSION['Equals'];  
      $aEquals=unserialize($s_Equals);
   }
   // Готовим кукисы для тестов, проверки и сообщения 
   PrepareCookies($s_CookTrack,$aEquals,$aCookMessa);
   // Записываем данные для тестов и сообщения в сессионные переменные
   prown\MakeSession('CookMessa',serialize($aCookMessa),tStr);      
   prown\MakeSession('Equals',serialize($aEquals),tStr);      
   // Если проходы не завершены, то перезагружаем страницу для нового прохода: 
   // "http://localhost:84/index.php?formDoor[]=MakeCookie&formSubmit=Протестировать"
   if ($s_CookTrack<LastTrack) 
   {
      $page="/index.php?formDoor%5B%5D=MakeCookie&".
         "formSubmit=%D0%9F%D1%80%D0%BE%D1%82%D0%B5%D1%81%D1%82%".
         "D0%B8%D1%80%D0%BE%D0%B2%D0%B0%D1%82%D1%8C";
      //echo "Location: http://".$_SERVER['HTTP_HOST'].$page;
      Header("Location: http://".$_SERVER['HTTP_HOST'].$page,true);
   }
   // Когда добрались до последнего прохода, то не прерываем сценарий,
   // а проходим дальше по коду до вывода данных тестов
}
// ****************************************************************************
// *                Проверить существование удаленных кукисов                 *
// ****************************************************************************
function isCookieDel()
{
   $Result=false;
   if (IsSet($_COOKIE['cookTypeStr'])) $Result=true;
   elseif (IsSet($_COOKIE['cookTypeInt'])) $Result=true;
   elseif (IsSet($_COOKIE['cookTypeFloat'])) $Result=true;
   elseif (IsSet($_COOKIE['cookTypeZero'])) $Result=true;
   return $Result;
}
// ****************************************************************************
// *            Подготовить кукисы для тестов, проверки и сообщения           *
// ****************************************************************************
function PrepareCookies($s_CookTrack,&$aEquals,&$aCookMessa)
{
   $Result=true;
   if ($s_CookTrack==0)
   {
      // Выполняем контроль удаленных кукисов предыдущих тестов
      $pref='t00=';         // подготовили префикс для самого первого теста
      if (isCookieDel())
      {
         $aEquals[count($aEquals)]=$pref.prown\sayLogic(isCookieDel()); 
         $aEquals[count($aEquals)]=$pref.prown\sayLogic(true);
         $aCookMessa[count($aCookMessa)]=
            "Color=Red;".
            "*** Браузер перед тестами MakeCookie следует перезапустить! *** "; 
         $aCookMessa[count($aCookMessa)]=
            "t00: Обнаружены оставшиеся кукисы от прежних тестов"; 
      }
      else
      {
         $aEquals[count($aEquals)]=$pref.prown\sayLogic(isCookieDel()); 
         $aEquals[count($aEquals)]=$pref.prown\sayLogic(false);
         $aCookMessa[count($aCookMessa)]=
            "Браузер перед тестами MakeCookie был перезапущен "; 
         $aCookMessa[count($aCookMessa)]=
            "t00: Оставшихся кукисов от прежних тестов не обнаружено"; 
      }
      // Задаем кукисы для тестов на 1 проходе
      $Result=prown\MakeCookie('cookTypeStr',cookStr,tStr,false,cookSession);
      $Result=prown\MakeCookie('cookTypeInt',cookInt);
      $Result=prown\MakeCookie('cookTypeFloat',cookFloat);
      $Result=prown\MakeCookie('cookTypeZero',cookZero,tInt,true);
   }
   elseif ($s_CookTrack==1)
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
         "t11-t13: Установка кукисов по именам и значениям подтверждена"; 
      // Пытаемся проинициализировать кукис повторно
      $Result=prown\MakeCookie('cookTypeZero',cookZero+16,tInt,true);
   }
   elseif ($s_CookTrack==2)
   {
      // Проверяем повторную инициализацию кукиса
      $pref='t21='; 
      $aEquals[count($aEquals)]=$pref.strval(cookZero);                   
      $aEquals[count($aEquals)]=$pref.strval($_COOKIE['cookTypeZero']);   
      // Закладываем 1 сообщение 2 прохода 
      $aCookMessa[count($aCookMessa)]=
         'prown\MakeCookie("Zero",0,tInt,true); '.
         'prown\MakeCookie("Zero",16,tInt,true); ';
      $aCookMessa[count($aCookMessa)]=
         "Zero=0, Повторной инициализации кукиса не произошло"; 
      // Складываем данные для проверки запросов на значения кукисов
      $pref='t22='; 
      $Result=prown\MakeCookie('cookTypeStr');
      $aEquals[count($aEquals)]=$pref.strval(cookStr); 
      $aEquals[count($aEquals)]=$pref.strval($Result);
      $aEquals[count($aEquals)]=$pref.strval(cookStr); 
      $aEquals[count($aEquals)]=$pref.strval($_COOKIE['cookTypeStr']);
      $pref='t23='; 
      $Result=prown\MakeCookie('cookTypeInt');
      $aEquals[count($aEquals)]=$pref.strval(cookInt); 
      $aEquals[count($aEquals)]=$pref.strval($Result);
      $aEquals[count($aEquals)]=$pref.strval(cookInt); 
      $aEquals[count($aEquals)]=$pref.strval($_COOKIE['cookTypeInt']);
      $pref='t24='; 
      $Result=prown\MakeCookie('cookTypeFloat');
      $aEquals[count($aEquals)]=$pref.strval(cookFloat); 
      $aEquals[count($aEquals)]=$pref.strval($Result);
      $aEquals[count($aEquals)]=$pref.strval(cookFloat); 
      $aEquals[count($aEquals)]=$pref.strval($_COOKIE['cookTypeFloat']);
      // Закладываем 2 сообщение 2 прохода 
      $aCookMessa[count($aCookMessa)]=
         "MakeCookie:cookTypeStr=Типичный,".
         "cookTypeInt=137,cookTypeFloat=3.1415926 "; 
      $aCookMessa[count($aCookMessa)]=
         "t22-t24: Выполнена проверка значений кукисов по именам"; 
   }
   elseif ($s_CookTrack==LastTrack)
   {
      // Готовим кукисы для удаления при закрытии браузера
      $Result=prown\MakeCookie('cookTypeInt',cookInt,tInt,false,cookDelete);
      $Result=prown\MakeCookie('cookTypeFloat',cookFloat,tFloat,false,cookDelete);
      $Result=prown\MakeCookie('cookTypeZero',cookZero,tInt,true,cookDelete);
   }
   return $Result;
}
// ************************************************** MakeCookie_test_I.php ***
