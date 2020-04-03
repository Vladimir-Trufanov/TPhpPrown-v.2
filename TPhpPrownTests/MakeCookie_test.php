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
      // Трассируем проход в консоли
      // prown\ConsoleLog('OUT_$s_CookTrack',$s_CookTrack);
      // Формируем массив ранее сформированных сообщений
      $s_CookMessa=$_SESSION['CookMessa'];  
      $aCookMessa=unserialize($s_CookMessa);
      // Формируем массив результатов тестов
      $s_Equals=$_SESSION['Equals'];  
      $aEquals=unserialize($s_Equals);
      // Проводим сравнения на последнем проходе, выводим сообщения
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
   }
}
// **************************************************** MakeCookie_test.php ***
