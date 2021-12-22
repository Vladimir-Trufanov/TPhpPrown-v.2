<?php

// PHP7/HTML5, EDGE/CHROME                     *** CreateRightsDir_test.php ***

// ****************************************************************************
// * TPhpPrown                      Создать каталог (проверить существование) *
// *                                                      и задать его права  *
// ****************************************************************************

//                                                   Автор:       Труфанов В.Е.
//                                                   Дата создания:  09.12.2021
// Copyright © 2021 tve                              Посл.изменение: 10.12.2021

class test_CreateRightsDir extends UnitTestCase 
{

   function test_CreateRightsDir_Simple()
   {
      MakeTitle("CreateRightsDir");
      
      // !!! 09.12.2021: $ImgDir='Gallery' - на домашнем компьютере новый 
      // каталог был создан в корневом каталоге PHP = "С:\PHP"
      
      // Проверяем ошибку создания каталога с неправильно указанным путем
      prown\ConsoleLog('test=1');
      $ImgDir='-'.$_SERVER['DOCUMENT_ROOT'].'/CreateRightsDir';
      $Result=prown\CreateRightsDir($ImgDir,0777,rvsReturn);
      // '[TPhpPrown] Ошибка создания каталога: 
      //    -C:\TPhpPrown\www/CreateRightsDir';
      //    -/home/kwinflatht/kwinflatht.nichost.ru/docs/CreateRightsDir
      $Find='Ошибка создания каталога';
      $Resu=Findes('/'.$Find.'/u',$Result); 
      $this->assertEqual($Resu,$Find);
      SimpleMessage('$ImgDir='."'".'-$_SERVER["DOCUMENT_ROOT"]/CreateRightsDir'."';",'black');
      MakeTestMessage(
         '$Result=prown\CreateRightsDir($ImgDir);',
         'Проверена ошибка создания каталога с неправильно указанным путем',80);

      // Выполняем удаление возможно существующего каталога и проверяем
      // успешное его создание
      prown\ConsoleLog('test=2');
      $ImgDir=$_SERVER['DOCUMENT_ROOT'].'/CreateRightsDir';
      if(is_dir($ImgDir)) rmdir($ImgDir);
      $Result=prown\CreateRightsDir($ImgDir,0777,rvsReturn);
      $this->assertEqual($Result,true);

      // Четырежды проверяем возвращаемый результат при успешном создании
      // каталога и при установлении его прав
      $Find='Установленные и желаемые права не совпадают';

      prown\ConsoleLog('test=3, $modeDir=0600');
      if(is_dir($ImgDir)) rmdir($ImgDir);
      $Result=prown\CreateRightsDir($ImgDir,0600,rvsReturn);
      if (isNichost()) $this->assertEqual($Result,true);
      else 
      {
         $Resu=Findes('/'.$Find.'/u',$Result); 
         $this->assertEqual($Resu,$Find);
      }

      prown\ConsoleLog('test=4, $modeDir=0755');
      if(is_dir($ImgDir)) rmdir($ImgDir);
      $Result=prown\CreateRightsDir($ImgDir,0755,rvsReturn);
      if (isNichost()) $this->assertEqual($Result,true);
      else 
      {
         $Resu=Findes('/'.$Find.'/u',$Result); 
         $this->assertEqual($Resu,$Find);
      }
      
      prown\ConsoleLog('test=5, $modeDir=0700');
      if(is_dir($ImgDir)) rmdir($ImgDir);
      $Result=prown\CreateRightsDir($ImgDir,0700,rvsReturn);
      if (isNichost()) $this->assertEqual($Result,true);
      else 
      {
         $Resu=Findes('/'.$Find.'/u',$Result); 
         $this->assertEqual($Resu,$Find);
      }
      
      prown\ConsoleLog('test=6, $modeDir=0555');
      if(is_dir($ImgDir)) rmdir($ImgDir);
      $Result=prown\CreateRightsDir($ImgDir,0555,rvsCurrentPos);
      $this->assertEqual($Result,true);
      MakeTestMessage(
         '$modeDir=0555; $Result=prown\CreateRightsDir($ImgDir,$modeDir,rvsCurrentPos); ',
         'Сравнительные (IIS-Apache) тесты создания каталога с правами: 0600,0755,0700,0555',80);

      // Обыгрываем исключение IIS при удалении каталога с правами 0555
      prown\ConsoleLog('test=7, $modeDir=0777');
      if(is_dir($ImgDir)) 
      {
         set_error_handler('self::CreateRightsRmdirHandler');
         clearstatcache(true,$ImgDir); // сбросили кэш состояния файла
         $is=rmdir($ImgDir);
         restore_error_handler();
         if (isNichost()) $this->assertEqual($is,true);
         else $this->assertEqual($is,false);
      }
      $Result=prown\CreateRightsDir($ImgDir,0777,rvsCurrentPos);
      $this->assertEqual($Result,true);
      MakeTestMessage(
         '$Result=prown\CreateRightsDir($ImgDir,0777,rvsCurrentPos); ',
         'Обыграно исключение IIS при удалении каталога с правами 0555',80);

      // Трижды проверяем возвращаемый результат  
      // при изменении прав существующего каталога
      $Find='Установленные и желаемые права не совпадают';
      prown\ConsoleLog('test=8, $modeDir=0600');
      $Result=prown\CreateRightsDir($ImgDir,0600,rvsReturn);
      if (isNichost()) $this->assertEqual($Result,true);
      else 
      {
         $Resu=Findes('/'.$Find.'/u',$Result); 
         $this->assertEqual($Resu,$Find);
      }
      prown\ConsoleLog('test=9, $modeDir=0755');
      if(is_dir($ImgDir)) rmdir($ImgDir);
      $Result=prown\CreateRightsDir($ImgDir,0755,rvsReturn);
      if (isNichost()) $this->assertEqual($Result,true);
      else 
      {
         $Resu=Findes('/'.$Find.'/u',$Result); 
         $this->assertEqual($Resu,$Find);
      }
      prown\ConsoleLog('test=10, $modeDir=0700');
      if(is_dir($ImgDir)) rmdir($ImgDir);
      $Result=prown\CreateRightsDir($ImgDir,0700,rvsReturn);
      if (isNichost()) $this->assertEqual($Result,true);
      else 
      {
         $Resu=Findes('/'.$Find.'/u',$Result); 
         $this->assertEqual($Resu,$Find);
      }
      MakeTestMessage(
         '$modeDir=0700; $Result=prown\CreateRightsDir($ImgDir,$modeDir,rvsCurrentPos); ',
         'Сравнительные (IIS-Apache) тесты изменения прав: 0777->0600->0755->0700',80);
      
      // Выполняем последние тесты со сложными правами и ошибками
      prown\ConsoleLog('test=11, $modeDir=0000');
      $s='-'; // Определили строку для указания прав 
      $modeDir=0000;
      $Result=prown\CreateRightsDir($ImgDir,$modeDir,rvsReturn);
      $this->assertEqual($Result,true);
      prown\ViewPerms($ImgDir,$a,rvsReturn);

      $modeDir=07777;
      $Result=prown\CreateRightsDir($ImgDir,$modeDir,rvsReturn);
      $this->assertEqual($Result,true);
      prown\ViewPerms($ImgDir,$a,rvsReturn);
      SimpleMessage($Result,'green');

     /* 
      
      
      
      $modeDir=00400;
      $Result=prown\CreateRightsDir($ImgDir,$modeDir,rvsReturn);
      $this->assertEqual($Result,true);
      self::ViewPerms($ImgDir);
      $modeDir=01400;
      $Result=prown\CreateRightsDir($ImgDir,$modeDir,rvsReturn);
      $this->assertEqual($Result,true);
      self::ViewPerms($ImgDir);
      $modeDir=02400;
      $Result=prown\CreateRightsDir($ImgDir,$modeDir,rvsReturn);
      $this->assertEqual($Result,true);
      self::ViewPerms($ImgDir);
      $modeDir=02400;
      $Result=prown\CreateRightsDir($ImgDir,$modeDir,rvsReturn);
      $this->assertEqual($Result,true);
      self::ViewPerms($ImgDir);
      $modeDir=03770;
      $Result=prown\CreateRightsDir($ImgDir,$modeDir,rvsReturn);
      $this->assertEqual($Result,true);
      self::ViewPerms($ImgDir);
      $modeDir=03777;
      $Result=prown\CreateRightsDir($ImgDir,$modeDir,rvsReturn);
      $this->assertEqual($Result,true);
      self::ViewPerms($ImgDir);
     
      $modeDir=04770;
      $Result=prown\CreateRightsDir($ImgDir,$modeDir,rvsReturn);
      $this->assertEqual($Result,true);
      self::ViewPerms($ImgDir);
      $modeDir=04777;
      $Result=prown\CreateRightsDir($ImgDir,$modeDir,rvsReturn);
      $this->assertEqual($Result,true);
      self::ViewPerms($ImgDir);
      
      $modeDir=05770;
      $Result=prown\CreateRightsDir($ImgDir,$modeDir,rvsReturn);
      $this->assertEqual($Result,true);
      self::ViewPerms($ImgDir);
      $modeDir=05777;
      $Result=prown\CreateRightsDir($ImgDir,$modeDir,rvsReturn);
      $this->assertEqual($Result,true);
      self::ViewPerms($ImgDir);
      
      $modeDir=06770;
      $Result=prown\CreateRightsDir($ImgDir,$modeDir,rvsReturn);
      $this->assertEqual($Result,true);
      self::ViewPerms($ImgDir);
      $modeDir=06777;
      $Result=prown\CreateRightsDir($ImgDir,$modeDir,rvsReturn);
      $this->assertEqual($Result,true);
      self::ViewPerms($ImgDir);
      
      $modeDir=07770;
      $Result=prown\CreateRightsDir($ImgDir,$modeDir,rvsReturn);
      $this->assertEqual($Result,true);
      self::ViewPerms($ImgDir);
      $modeDir=07777;
      $Result=prown\CreateRightsDir($ImgDir,$modeDir,rvsReturn);
      $this->assertEqual($Result,true);
      self::ViewPerms($ImgDir);
     */
      
      
      /*
      prown\ConsoleLog('test=11, $modeDir=01400');
      $modeDir=057777;
      $modeDir=05777;
      $modeDir='0t777';
      $Result=prown\CreateRightsDir($ImgDir,$modeDir,rvsReturn);
      $this->assertEqual($Result,true);
      */
      
   }
   
   // *************************************************************************
   // *               Обыграть возможные ошибки удаления каталога             *
   // *************************************************************************
   function CreateRightsRmdirHandler($errno,$errstr,$errfile,$errline)
   {
      // prown\ConsoleLog('$errno='.$errno);
      // prown\ConsoleLog('$errstr='.$errstr);
      // prown\ConsoleLog('$errfile='.$errfile);
      // prown\ConsoleLog('$errline='.$errline);
      prown\putErrorInfo('CreateRightsRmdirHandler',$errno,
          '['.'Ошибка удаления каталога'.'] '.$errstr,$errfile,$errline);
   }  
}
// *********************************************** CreateRightsDir_test.php ***
