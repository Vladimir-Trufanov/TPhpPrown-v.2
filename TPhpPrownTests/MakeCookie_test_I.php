<?php
// PHP7/HTML5, EDGE/CHROME                        *** MakeCookie_test_I.php ***

// ****************************************************************************
// * TPhpPrown-test           Блок обслуживания перезапусков теста MakeCookie *
// ****************************************************************************

//                                                   Автор:       Труфанов В.Е.
//                                                   Дата создания:  13.01.2019
// Copyright © 2020 tve                              Посл.изменение: 20.03.2020

// ****************************************************************************
// *                  Задать очередную порцию кукисов для теста               *
// ****************************************************************************
function MakeCookieTest()
{
   $Result=true;
   $ModeError=rvsCurrentPos;
   // Если выбран MakeCookie-тест, то выделяем первый в сессии заход для того,
   // чтобы удалить сессионный кукис и инициируем счетчик проходов
   if (isChecked('formDoor','MakeCookie'))
   {
      if (!IsSet($_SESSION['CookTrack']))
      {
         prown\MakeSession('CookTrack',0,tInt,true);      
      }
   } 
   // Если выбрана MakeCookie и есть счетчик проходов MakeCookie, 
   // то готовим кукисы текущего прохода и выполняем перезагрузку страницы
   if (isChecked('formDoor','MakeCookie')&&(IsSet($_SESSION['CookTrack']))) 
   {
      // Регистрируем очередной проход
      $s_CookTrack=$_SESSION['CookTrack'];  
      echo 'CookTrack='.$s_CookTrack.'<br>';
      // На нулевом проходе инициируем массив сообщений теста,
      // массив результатов тестов (проверка всех результатов делается на 
      // последнем проходе, чтобы высветить вывод)
      // и задаем кукисы для их проверки на 1 проходе
      if ($s_CookTrack==0)
      {
         $aCookMessa=array(); // создали пустой массив
         $s_CookMessa=prown\MakeSession('CookMessa',serialize($aCookMessa),tStr);      
         $aEquals=array();    // создали пустой массив
         prown\MakeSession('Equals',serialize($aEquals),tStr);      
         // Задаем обычные кукисы через имя и значение
         $Result=prown\MakeCookie('cookTypeStr',cookStr);
         $Result=prown\MakeCookie('cookTypeInt',cookInt);
         $Result=prown\MakeCookie('cookTypeFloat',cookFloat);
         $Result=prown\MakeCookie('cookTypeZero',cookZero,tInt,true);
      }
      // Готовим следующий проход
      $s_CookTrack++;  
      prown\MakeSession('CookTrack',$s_CookTrack,tInt);     
      echo 'CookTrack='.$s_CookTrack.'<br>';
      
      // Если все проходы завершены, то останавливаем перезагрузку страниц
      if (($s_CookTrack>1)||($s_CookTrack<0))
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
