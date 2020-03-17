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
   function test_MakeCookie_Incremental()
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
         if (IsSet($_SESSION['CookMessa']))
         {
            $s_CookMessa=$_SESSION['CookMessa'];  
            echo 'CookMessa='.$s_CookMessa.'<br>';
            // Формируем массив сообщений
            $aCookMessa=unserialize($s_CookMessa);
            //$CookCount=count($aCookMessa);
            // Определяем проход и закладываем его в сообщения
            $s_CookTrack=$_SESSION['CookTrack'];  
            //$aCookMessa[count($aCookMessa)]='--- '.$s_CookTrack.' проход ---'; 
            //$aCookMessa[count($aCookMessa)]=''; 

            
            
            $aCookMessa[count($aCookMessa)] = count($aCookMessa).': первый левый'; 
            $aCookMessa[count($aCookMessa)] = count($aCookMessa).': первый ghfdsq'; 
            $s_CookMessa=prown\MakeSession('CookMessa',serialize($aCookMessa),tStr);      

            
            

       
   
   
   
      \prown\ViewGlobal(avgCOOKIE);
      MakeTitle("MakeCookie");
      $string='1958';
      $Result=\prown\MakeType($string,tInt);
      $this->assertEqual($Result,1958);
      $this->assertNotEqual($Result,'1959');  
      MakeTestMessage(
         '$string="1958"; $Result=\prown\MakeType($string,tInt); ',
         'Преобразование строчного "1958" к целому 1958',70);
      
      // Выводим все накопленные сообщения
      for ($i=0; $i<count($aCookMessa); $i=$i+2)
      {
         //echo $i.': '.$aCookMessa[$i].'<br>';
         MakeTestMessage($aCookMessa[$i],$aCookMessa[$i+1],70);
      } 
      
      
      
      
      
      
      
      /*
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
            echo "Location: http://".$_SERVER['HTTP_HOST'].$page;
            //Header("Location: http://".$_SERVER['HTTP_HOST'].$page);
         //}
      }
      */
         }
      }


  }
}
// **************************************************** MakeCookie_test.php ***
