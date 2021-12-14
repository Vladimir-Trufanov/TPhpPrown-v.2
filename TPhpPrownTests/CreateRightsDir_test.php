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

      // Выполняем удаление возможно существующего каталога и проверяем
      // успешное его создание
      $ImgDir=$_SERVER['DOCUMENT_ROOT'].'/CreateRightsDir';
      if(is_dir($ImgDir)) rmdir($ImgDir);
      $Result=prown\CreateRightsDir($ImgDir,0777,rvsReturn);
      $this->assertEqual($Result,true);
      // Дважды проверяем возвращаемый результат при успешном создании каталога 
      // и при изменении прав существующего каталога
      $Result=prown\CreateRightsDir($ImgDir,0777,rvsCurrentPos);
      $this->assertEqual($Result,true);
      if(is_dir($ImgDir)) rmdir($ImgDir);
      $Result=prown\CreateRightsDir($ImgDir,0777,rvsCurrentPos);
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
      
      // --Выполняем удаление возможно существующего каталога и проверяем
      // --успешное его создание
      $ImgDir=$_SERVER['DOCUMENT_ROOT'].'/CreateRightsDir';
      if(is_dir($ImgDir)) rmdir($ImgDir);
      $Result=prown\CreateRightsDir($ImgDir,0977,rvsReturn);
      $this->assertEqual($Result,true);

      
      
      
      
   }
}
// *********************************************** CreateRightsDir_test.php ***
