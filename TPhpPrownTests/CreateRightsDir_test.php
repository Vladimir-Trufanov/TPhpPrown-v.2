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
         'Сравнительные (IIS-Unix) тесты создания каталога с правами: 0600,0755,0700,0555',80);

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
         'Сравнительные (IIS-Unix) тесты изменения прав: 0777->0600->0755->0700',80);
      
      // Выполняем последние тесты со сложными правами и ошибками
      prown\ConsoleLog('test=11, $modeDir=0000');
      $modeDir=0000;
      $Result=prown\CreateRightsDir($ImgDir,$modeDir,rvsReturn);
      $this->assertEqual($Result,true);

      $modeDir=07777;
      $Result=prown\CreateRightsDir($ImgDir,$modeDir,rvsReturn);
      $this->assertEqual($Result,true);
      // Определяем строку для указания прав и
      // формируем сообщение со строчным их представлением
      $s='-'; prown\ViewPerms($ImgDir,$s,rvsReturn);
      // Формируем строку сообщения в данном случае с.о:
      // для Unix как пример использования в правах бит - SUID,SGID,Sticky
      if (isNichost()) 
      {
         $ss='Проверено использования в правах бит - SUID,SGID,Sticky';
         $this->assertEqual($s,'d.rws.rws.rwt 7777');
      }
      // для IIS, как различие между заявленными и установленными правами
      else
      {
         $ss=$Result; $this->assertEqual($ss,
         '[TPhpPrown] Установленные и желаемые права не совпадают: 0777<>07777');
      } 
      MakeTestMessage(
         '$modeDir=07777; $Result=prown\CreateRightsDir($ImgDir,$modeDir,rvsCurrentPos); ',
         $ss,80);
      SimpleMessage('Фактически установленные права: '.$s,'green');

      $modeDir=051400;
      $Result=prown\CreateRightsDir($ImgDir,$modeDir,rvsReturn);
      $this->assertEqual($Result,true);

      $modeDir='0t777';
      $Result=prown\CreateRightsDir($ImgDir,$modeDir,rvsReturn);
      $this->assertEqual($Result,true);
      
      // Устанавливаем права на каталог 0777 и удаляем его
      prown\CreateRightsDir($ImgDir,0777,rvsReturn);
      if(is_dir($ImgDir)) rmdir($ImgDir);
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
