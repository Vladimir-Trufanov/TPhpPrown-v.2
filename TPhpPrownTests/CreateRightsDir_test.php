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
      SimpleMessage();
      
      // !!! 09.12.2021: $ImgDir='Gallery' - на домашнем компьютере новый 
      // каталог был создан в корневом каталоге PHP = "С:\PHP"
      
      // Проверяем ошибку создания каталога с неправильно указанным путем
      $ImgDir='-'.$_SERVER['DOCUMENT_ROOT'].'/CreateRightsDir';
      $Result=prown\CreateRightsDir($ImgDir,0777,rvsReturn);
      $Value='[TPhpPrown] Ошибка создания каталога: -C:\TPhpPrown\www/CreateRightsDir';
      $this->assertEqual($Result,$Value);
      SimpleMessage('$ImgDir='."'".'-$_SERVER["DOCUMENT_ROOT"]/CreateRightsDir'."';",'black');
      MakeTestMessage(
         '$Result=prown\CreateRightsDir($ImgDir);',
         'Проверена ошибка создания каталога с неправильно указанным путем',80);


      SimpleMessage('<span style="color:black; font-weight:bold; font-family:Anonymous Pro, monospace; font-size:0.9em">');
      $Result=prown\CreateRightsDir($ImgDir,0777,rvsCurrentPos);
      SimpleMessage('</span>');
      SimpleMessage('==='.$Result.'===');
      $this->assertEqual($Result,true);
      
      
      $Value='[TPhpPrown] Ошибка создания каталога: -C:\TPhpPrown\www/CreateRightsDir';
      //$this->assertEqual($Result,$Value);
      //SimpleMessage('$ImgDir='."'".'-$_SERVER["DOCUMENT_ROOT"]/CreateRightsDir'."';",'black');
     // MakeTestMessage(
     //    '$Result=prown\CreateRightsDir($ImgDir);',
     //    'Проверена ошибка создания каталога с неправильно указанным путем',80);










      // Выполняем удаление возможно существующего каталога и проверяем
      // успешное его создание
      $ImgDir=$_SERVER['DOCUMENT_ROOT'].'/CreateRightsDir';
      if(is_dir($ImgDir)) rmdir($ImgDir);
      $Result=prown\CreateRightsDir($ImgDir,0777,rvsReturn);
      SimpleMessage('***'.$Result.'***');
      
      /*
      $Result=prown\CreateRightsDir($ImgDir);
      //$this->assertEqual($Result,24377.44);
      */
      //MakeTestMessage('Код вызова функции','Пробный вызов функции',80);
      //MakeTestMessage('Gallery','Пробный вызов функции',80);
      
      $Unit='KiB';
      $Result=prown\RecalcSizeInfo(cdiFromBytes,$Unit,24962496,2);
      $this->assertEqual($Result,24377.44);
      MakeTestMessage(
         '$Unit="KiB"; $Result=prown\RecalcSizeInfo(cdiFromBytes,$Unit,24962496,2; ',
         'Изменено представление размера в байтах на кибибайты - 24377.44 KiB',80);

      $Result=prown\RecalcSizeInfo(3,$Unit,24962496,2,rvsReturn);
      $this->assertEqual($Result,'[TPhpPrown] Неверно указано направление пересчета [$Direct=3]');
      MakeTestMessage(
         '$Unit="KiB"; $Result=prown\RecalcSizeInfo(3,$Unit,24962496,2,rvsReturn); ',
         $Result,80);
   }
}
// *********************************************** CreateRightsDir_test.php ***
