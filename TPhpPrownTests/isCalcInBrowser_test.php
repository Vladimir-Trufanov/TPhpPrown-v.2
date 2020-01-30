<?php

// PHP7/HTML5, EDGE/CHROME                     *** isCalcInBrowser_test.php ***

// ****************************************************************************
// * TPhpPrown    Проанализировать UserAgent браузера по версиям родительских *
// *                  браузеров и определить работает ли функция Calc для CSS *
// ****************************************************************************

//                                                   Автор:       Труфанов В.Е.
//                                                   Дата создания:  13.02.2019
// Copyright © 2019 tve                              Посл.изменение: 06.01.2020

class test_isCalcInBrowser extends UnitTestCase 
{
   function test_isCalcInBrowser_Chrome()
   {
      $ModeError=rvsCurrentPos;
      MakeTitle("isCalcInBrowser");

      // Ошибочный UserAgent, так как 2 Chrome
      $UserAgent1="Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) ";
      $UserAgent2="Chrome/72.0.3626.96 Chrome/72.0.3626.96 Safari/537.36 ";
      $UserAgent=$UserAgent1.$UserAgent2;
      $Result=\prown\isCalcInBrowser($UserAgent,$ModeError); 
      $this->assertTrue($Result);   
      SimpleMessage($UserAgent1);
      MakeTestMessage($UserAgent2,'Ошибочный UserAgent, так как 2 Chrome',90);

      // Ошибочный UserAgent, так как Chrome c неопределённой версией
      $UserAgent="Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 "."Chrome/аа ";
      $Result=\prown\isCalcInBrowser($UserAgent,$ModeError); 
      $this->assertFalse($Result);   
      MakeTestMessage($UserAgent,'Ошибочный UserAgent, так как Chrome c неопределённой версией',90);
         
      // Нормальный UserAgent от Chrome
      $UserAgent="Mozilla/5.0 (Windows NT 10.0; Win64; x64) ".
         "Chrome/72.0.3626.96 Safari/537.36 ";
      $Result=\prown\isCalcInBrowser($UserAgent,$ModeError); 
      $this->assertTrue($Result);   
      SimpleMessage();
      MakeTestMessage($UserAgent,'"Calc" работает, определено по версии Chrome=72',90);
   }
   // Проверяем 2 версии от Safari
   function test_isCalcInBrowser_Safari()
   {
      $ModeError=rvsCurrentPos;
      $UserAgent="Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML) ".
         "Safari/534.57.2 ";
      $Result=\prown\isCalcInBrowser($UserAgent,$ModeError); 
      $this->assertFalse($Result);
      MakeTestMessage($UserAgent,'Функции Calc нет, определено по версии Safari=534.57',90);

      $UserAgent="Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML) ".
         "Safari/537.21 ";
      $Result=\prown\isCalcInBrowser($UserAgent,$ModeError); 
      $this->assertFalse($Result);
      MakeTestMessage($UserAgent,'Функции Calc нет, определено по версии Safari=537.21',90);
   }
   // Проверяем 2 версии от Firefox
   function test_isCalcInBrowser_Firefox()
   {
      $ModeError=rvsCurrentPos;
      $UserAgent="Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 ".
         "Firefox/31.0 K-Meleon/75.1 ";
      $Result=\prown\isCalcInBrowser($UserAgent,$ModeError); 
      $this->assertTrue($Result);
      MakeTestMessage($UserAgent,'"Calc" работает, определено по версии Firefox=31',90);

      $UserAgent="Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 ".
         "Firefox/65.0 ";
      $Result=\prown\isCalcInBrowser($UserAgent,$ModeError); 
      $this->assertTrue($Result);
      MakeTestMessage($UserAgent,'"Calc" работает, определено по версии Firefox=65',90);
   }
   
   // Проверяем остальные браузеры (считаем, что Calc не работает)
   function test_isCalcInBrowser_Trident()
   {
      $ModeError=rvsCurrentPos;
      $UserAgent="Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 ".
         "Trident/7.0 ";
      $Result=\prown\isCalcInBrowser($UserAgent,$ModeError); 
      $this->assertFalse($Result);
      MakeTestMessage($UserAgent,'Функции Calc нет. Прочие UserAgent-ы, включая Trident',90);
   }
   // Проверяем браузеры c противоречивыми по Calc версиями
   function test_isCalcInBrowser_Mixt()
   {
      $ModeError=rvsCurrentPos;
      $UserAgent="Mozilla/5.0 (Windows NT 6.1; Win64; x86) ".
         "Chrome/55.0.2883.87 Safari/537.36 ";
      $Result=\prown\isCalcInBrowser($UserAgent,$ModeError); 
      $this->assertTrue($Result);
      MakeTestMessage($UserAgent,'Функция Calc работает по Safari/537.36',90);
   }
}

// *********************************************** isCalcInBrowser_test.php ***
