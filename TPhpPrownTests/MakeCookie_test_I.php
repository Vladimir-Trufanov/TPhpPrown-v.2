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
   // Если выбрана MakeCookie, то выполняем перезагрузку страницы
   // для выполнения проходов теста
   if(isChecked('formDoor','MakeCookie'))
   {
      // Инициируем массив сообщений теста
      if ($NumTest==0)
      {
         $aCookMessa=array();             // создали пустой массив
         //$aCookMessa[0] = 'первый левый'; 
         //$aCookMessa[1] = 'первый ghfdsq'; 
         $s_CookMessa=prown\MakeSession('CookMessa',serialize($aCookMessa),tStr);      
         echo 'CookMessa='.$s_CookMessa.'<br>';
      }


      // Регистрируем очередной проход
      if (IsSet($_SESSION['CookTrack']))
      {
         $s_CookTrack=$_SESSION['CookTrack']+1;  
         prown\MakeSession('CookTrack',$s_CookTrack,tInt);     
         echo 'CookTrack='.$s_CookTrack.'<br>';
      }
      // Если все проходы завершены, то останавливаем перезагрузку страниц
      if (($s_CookTrack>3)||($s_CookTrack<0))
      {
            $s_CookTrack=0;  
            prown\MakeSession('CookTrack',$s_CookTrack,tInt);     
            echo 'STOP CookTrack='.$s_CookTrack.'<br>';
      }
      // Перезагружаем страницу для нового прохода 
      else
      {
         //if ($_SERVER['HTTP_HOST']=='kwinflat.ru')
         //{
            //echo "Location: https://".$_SERVER['HTTP_HOST'].$page;
            //Header("Location: https://".$_SERVER['HTTP_HOST'].$page);
         //}
         //else 
         //{
            $page="/index.php";
            //echo "Location: http://".$_SERVER['HTTP_HOST'].$page;
            Header("Location: http://".$_SERVER['HTTP_HOST'].$page);
         //}
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
