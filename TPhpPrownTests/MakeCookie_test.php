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
      }
      // Готовим данные для тестов второго прохода
      elseif ($s_CookTrack==2)
      {
      }
      // Фиксируем данные для тестов
      prown\MakeSession('Equals',serialize($aEquals),tStr);      
      // Фиксируем новое состояние списка сообщений
      $s_CookMessa=prown\MakeSession('CookMessa',serialize($aCookMessa),tStr);      
      // Проводим сравнения на последнем (нулевом) проходе,
      // готовим кукисы для удаления 
      if ($s_CookTrack==LastTrack)
      {
         // Выводим все накопленные сообщения и проводим тесты
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
      // Если все проходы завершены, то останавливаем перезагрузку страниц
      if ($s_CookTrack==LastTrack) 
      {
         // Cбрасываем счетчик проходов (при инициализации выйдем на 0 проход)
         $s_CookTrack=-1;  
         prown\MakeSession('CookTrack',$s_CookTrack,tInt);     
      }
      // Если проходы не завершены то перезагружаем страницу для нового прохода: 
      // "http://localhost:84/index.php?formDoor[]=MakeCookie&formSubmit=Протестировать"
      else
      {
         $page="/index.php?formDoor%5B%5D=MakeCookie&".
            "formSubmit=%D0%9F%D1%80%D0%BE%D1%82%D0%B5%D1%81%D1%82%".
            "D0%B8%D1%80%D0%BE%D0%B2%D0%B0%D1%82%D1%8C";
         echo "Location: http://".$_SERVER['HTTP_HOST'].$page;
         //Header("Location: http://".$_SERVER['HTTP_HOST'].$page,true);
      }
      prown\ViewGlobal(avgCOOKIE);
   }
}
// **************************************************** MakeCookie_test.php ***
