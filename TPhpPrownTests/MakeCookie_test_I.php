<?php
// PHP7/HTML5, EDGE/CHROME                        *** MakeCookie_test_I.php ***

// ****************************************************************************
// * TPhpPrown-test           Блок обслуживания перезапусков теста MakeCookie *
// ****************************************************************************

//                                                   Автор:       Труфанов В.Е.
//                                                   Дата создания:  13.01.2019
// Copyright © 2020 tve                              Посл.изменение: 17.03.2020

// ****************************************************************************
// *                  Задать очередную порцию кукисов для теста               *
// ****************************************************************************
function MakeCookieTest()
{
   $Result=true;
   $ModeError=rvsCurrentPos;
   // Если выбрана MakeCookie и есть счетчик проходов MakeCookie, 
   // то готовим кукисы текущего прохода и выполняем перезагрузку страницы
   if (isChecked('formDoor','MakeCookie')&&(IsSet($_SESSION['CookTrack']))) 
   {
      // Регистрируем очередной проход
      $s_CookTrack=$_SESSION['CookTrack'];  
      //echo 'CookTrack='.$s_CookTrack.'<br>';
      // На нулевом проходе инициируем массив сообщений теста
      // и задаем кукисы для их проверки на 1 проходе
      if ($s_CookTrack==0)
      {
         $aCookMessa=array(); // создали пустой массив
         $s_CookMessa=prown\MakeSession('CookMessa',serialize($aCookMessa),tStr);      
         //echo 'CookMessa='.$s_CookMessa.'<br>';
         // Задаем обычные кукисы через имя и значение
         $Result=prown\MakeCookie('cookTypeStr','Типичный');
         $Result=prown\MakeCookie('cookTypeInt',137);
         $Result=prown\MakeCookie('cookTypeFloat',3.1415926);
         //$Result=prown\MakeCookie('cookTypeZero',0,tInt,true);
      }
      // Готовим следующий проход
      $s_CookTrack++;  
      prown\MakeSession('CookTrack',$s_CookTrack,tInt);     
      echo 'CookTrack='.$s_CookTrack.'<br>';
      
      // Если все проходы завершены, то останавливаем перезагрузку страниц
      if (($s_CookTrack>3)||($s_CookTrack<0))
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


      /*
     //$CookCount=count($aCookMessa);   // задали начальную размерность массива
      //$s_CookCount=prown\MakeSession('CookCount',$CookCount,tInt); 
  
   }

      // Выбираем данные сессии для трассировки и тестирования очередного прохода
      if (IsSet($_SESSION))
      {
         // Регистрируем очередной проход
         if (IsSet($_SESSION['CookTrack']))
         {
            $s_CookTrack=$_SESSION['CookTrack']+1;  
            prown\MakeSession('CookTrack',$s_CookTrack,tInt);     
            echo 'CookTrack='.$s_CookTrack.'<br>';
         }
         // Вытаскиваем данные о ранее выведенных сообщениях
         if (IsSet($_SESSION['CookMessa']))
         {
            $s_CookMessa=$_SESSION['CookMessa'];  
            echo 'CookMessa='.$s_CookMessa.'<br>';
            // Формируем массив сообщений
            $aCookMessa=unserialize($s_CookMessa);
            $CookCount=count($aCookMessa);
            for ($i=0; $i<$CookCount; $i++)
            {
               echo $i.': '.$aCookMessa[$i].'<br>';
            } 
         }
      }

   */

   }


   
   /*
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
   */
   return $Result;  
}
// ************************************************** MakeCookie_test_I.php ***
