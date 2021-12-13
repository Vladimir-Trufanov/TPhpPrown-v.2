<?php

// PHP7/HTML5, EDGE/CHROME                     *** CreateRightsDir_test.php ***

// ****************************************************************************
// * TPhpPrown                      Создать каталог (проверить существование) *
// *                                                      и задать его права  *
// ****************************************************************************

//                                                   Автор:       Труфанов В.Е.
//                                                   Дата создания:  09.12.2021
// Copyright © 2021 tve                              Посл.изменение: 10.12.2021

require_once $SiteHost."/TPhpPrown/TPhpPrown/iniConstMem.php";

class test_CreateRightsDir extends UnitTestCase 
{
   function test_CreateRightsDir_Simple()
   {
      MakeTitle("CreateRightsDir");
      SimpleMessage();
      
      /*
      echo '1 Приветище<br>';
      error_reporting(E_ALL ^ E_NOTICE);
      $y = $x/0;
      $err = error_get_last();
      var_export($err);
      echo '2 Приветище<br>';
      */
      
      
      // !!! 09.12.2021
      // $ImgDir='Gallery'; - на домашнем компьютере новый каталог был создан
      // в каталоге "С:\PHP"
      $ImgDir='-'.$_SERVER['DOCUMENT_ROOT'].'/Gallery';
      //$ImgDir=$_SERVER['DOCUMENT_ROOT'].'/Gallery';
      prown\CreateRightsDir($ImgDir);
      //print_r(error_get_last()); 

      /*
      $Result=prown\CreateRightsDir($ImgDir);
      //$this->assertEqual($Result,24377.44);
      */
      MakeTestMessage('Код вызова функции','Пробный вызов функции',80);
      MakeTestMessage('Gallery','Пробный вызов функции',80);
      
      //,$modeDir=0777
      
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
