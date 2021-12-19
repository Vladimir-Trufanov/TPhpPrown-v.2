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
      prown\ConsoleLog('Id test_CreateRightsDir='.getmypid());
      MakeTitle("CreateRightsDir");
      
      // !!! 09.12.2021: $ImgDir='Gallery' - на домашнем компьютере новый 
      // каталог был создан в корневом каталоге PHP = "С:\PHP"
      
      // Проверяем ошибку создания каталога с неправильно указанным путем
      prown\ConsoleLog('test=1');
      $ImgDir='-'.$_SERVER['DOCUMENT_ROOT'].'/CreateRightsDir';
      $Result=prown\CreateRightsDir($ImgDir,0777,rvsReturn);
      $Value='[TPhpPrown] Ошибка создания каталога: -C:\TPhpPrown\www/CreateRightsDir';
      $this->assertEqual($Result,$Value);
      SimpleMessage('$ImgDir='."'".'-$_SERVER["DOCUMENT_ROOT"]/CreateRightsDir'."';",'black');
      MakeTestMessage(
         '$Result=prown\CreateRightsDir($ImgDir);',
         'Проверена ошибка создания каталога с неправильно указанным путем',80);

      // Выполняем удаление возможно существующего каталога и проверяем
      // успешное его создание
      prown\ConsoleLog('test=2');
      $ImgDir=$_SERVER['DOCUMENT_ROOT'].'/CreateRightsDir';
      if(is_dir($ImgDir)) rmdir($ImgDir);
      clearstatcache();
      $Result=prown\CreateRightsDir($ImgDir,0777,rvsReturn);
      $this->assertEqual($Result,true);

      // Пять раз проверяем возвращаемый результат при успешном создании
      // каталога и при установлении его прав
      prown\ConsoleLog('test=3, $modeDir=0600');
      if(is_dir($ImgDir)) rmdir($ImgDir);
      clearstatcache();
      $Result=prown\CreateRightsDir($ImgDir,0600,rvsCurrentPos);
      $this->assertEqual($Result,true);
      
      prown\ConsoleLog('test=4, $modeDir=0755');
      if(is_dir($ImgDir)) rmdir($ImgDir);
      clearstatcache();
      $Result=prown\CreateRightsDir($ImgDir,0755,rvsCurrentPos);
      $this->assertEqual($Result,true);
      
      prown\ConsoleLog('test=5, $modeDir=0700');
      if(is_dir($ImgDir)) rmdir($ImgDir);
      clearstatcache();
      $Result=prown\CreateRightsDir($ImgDir,0700,rvsCurrentPos);
      $this->assertEqual($Result,true);
      
      prown\ConsoleLog('test=6, $modeDir=0555');
      if(is_dir($ImgDir)) rmdir($ImgDir);
      clearstatcache();
      $Result=prown\CreateRightsDir($ImgDir,0555,rvsCurrentPos);
      $this->assertEqual($Result,true);
      
      prown\ConsoleLog('test=7, $modeDir=0777');
      if(is_dir($ImgDir)) rmdir($ImgDir);
      clearstatcache();
      $Result=prown\CreateRightsDir($ImgDir,0777,rvsCurrentPos);
      $this->assertEqual($Result,true);


      // Трижды проверяем возвращаемый результат  
      // и при изменении прав существующего каталога
       /*
      clearstatcache();
      if(is_dir($ImgDir)) rmdir($ImgDir);
      $Result=prown\CreateRightsDir($ImgDir,0600,rvsCurrentPos);
      $this->assertEqual($Result,true);
      MakeTestMessage('$Result=prown\CreateRightsDir('.'$_SERVER["DOCUMENT_ROOT"]/CreateRightsDir'.');',
         'Проверено удаление существующего каталога и повторное его создание',80);

      // Проверяем ошибку при создании каталога с типом сообщения "rvsCurrentPos"
      $ImgDir='-'.$_SERVER['DOCUMENT_ROOT'].'/CreateRightsDir';
      SimpleMessage('<span>');
      $Result=prown\CreateRightsDir($ImgDir,0777,rvsCurrentPos);
      echo ' ........ '.'Проверена ошибка при создании каталога с типом сообщения "rvsCurrentPos"';
      SimpleMessage('</span>');
      $this->assertEqual($Result,false);
      */

      /*
      // Выполняем тесты по установлению и сравнению прав
      $ImgDir=$_SERVER['DOCUMENT_ROOT'].'/CreateRightsDir'; 
      if(is_dir($ImgDir)) rmdir($ImgDir);
      $modeDir=0600;
      $Result=prown\CreateRightsDir($ImgDir,$modeDir,rvsReturn);
      $this->assertEqual($Result,true);
      */
      
      /*
      clearstatcache();
      //clearstatcache(true,$ImgDir);
      $modeDir=0555;
      $Result=prown\CreateRightsDir($ImgDir,$modeDir,rvsReturn);
      
      
      clearstatcache();
      //clearstatcache(true,$ImgDir);
      $permissions=fileperms($ImgDir);
      //$fPermissions=sprintf('%o',$permissions);
      //$fPermissions=substr(sprintf('%o',$permissions),-4);

      prown\ConsoleLog('$modeDir='.decoct($modeDir).'; '.'$permissions='.decoct($permissions));
      */
      
      
      
      /*
      $modeDir=017777;
      $Result=prown\CreateRightsDir($ImgDir,$modeDir,rvsReturn);
      $this->assertEqual($Result,true);
      /*
      
      
      $modeDir=0555;
      prown\ConsoleLog('$modeDir=0555: '.$modeDir);
      $ImgDir=$_SERVER['DOCUMENT_ROOT'].'/CreateRightsDir'; 
      if(is_dir($ImgDir)) rmdir($ImgDir);
      $Result=prown\CreateRightsDir($ImgDir,$modeDir,rvsReturn);
      $this->assertEqual($Result,true);
      */
      /*
      $modeDir=0700;
      if(is_dir($ImgDir)) rmdir($ImgDir);
      $Result=prown\CreateRightsDir($ImgDir,$modeDir,rvsReturn);
      $this->assertEqual($Result,true);
     */ 
     /* 
      $modeDir=0755;
      if(is_dir($ImgDir)) rmdir($ImgDir);
      $Result=prown\CreateRightsDir($ImgDir,$modeDir,rvsReturn);
      $this->assertEqual($Result,true);
      */
      
   }
}
// *********************************************** CreateRightsDir_test.php ***
