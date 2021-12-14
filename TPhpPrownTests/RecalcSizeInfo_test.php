<?php

// PHP7/HTML5, EDGE/CHROME                       *** ChangeDimInfo_test.php ***

// ****************************************************************************
// * TPhpPrown               Изменить представление информации о размерности, *
// *            то есть пересчитать число байт в число килобайт или кибибайт, *
// *            мегабайт или мебибайт, ... или пересчитать в обратную сторону *
// ****************************************************************************

//                                                   Автор:       Труфанов В.Е.
//                                                   Дата создания:  03.09.2021
// Copyright © 2021 tve                              Посл.изменение: 13.09.2021

require_once $SiteHost."/TPhpPrown/TPhpPrown/iniConstMem.php";

class test_RecalcSizeInfo extends UnitTestCase 
{
   function test_RecalcSizeInfo_Simple()
   {
      MakeTitle("RecalcSizeInfo");
      
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

      $Unit="MiB";
      $Result=prown\RecalcFromBytes($Unit,24962496,6);
      $this->assertEqual($Result,23.806091);
      MakeTestMessage(
         '$Unit="MiB"; $Result=prown\RecalcFromBytes($Unit,24962496,2); ',
         'Изменено представление размера в байтах на мебибайты = 23.806091 MiB',80);

      $Unit='YiBi';
      $Result=prown\RecalcFromBytes($Unit,24962496,2,rvsReturn);
      $this->assertEqual($Result,'[TPhpPrown] Неверно указана единица измерения [$Unit=YiBi]');
      $Result=prown\RecalcSizeInfo(cdiFromBytes,$Unit,2,0,rvsReturn);
      $this->assertEqual($Result,'[TPhpPrown] Неверно указана единица измерения [$Unit=YiBi]');
      MakeTestMessage(
         '$Unit="YiBi"; $Result=prown\RecalcSizeInfo(cdiFromBytes,$Unit,2,0,rvsReturn); ',
         $Result,80);

      $Unit='MB';
      $Result=prown\RecalcFromBytes($Unit,24962496000000,0,rvsReturn);
      $this->assertEqual($Result,24962496);
      MakeTestMessage(
         '$Unit="MB"; prown\RecalcFromBytes($Unit,24962496000000,0,rvsReturn); ',
         'Заменено представление размера на мегабайты = 24962496 MB',80);

      $Unit='GB';
      $Result=prown\RecalcFromBytes($Unit,24962496000000,2,rvsReturn);
      $this->assertEqual($Result,24962.5);
      MakeTestMessage(
         '$Unit="GB"; prown\RecalcFromBytes($Unit,24962496000000,0,rvsReturn); ',
         'Заменено представление размера на гигабайты = 24962.5 GB',80);

      $Unit='TB';
      $Result=prown\RecalcFromBytes($Unit,24962496000000,2,rvsReturn);
      $this->assertEqual($Result,24.96);
      MakeTestMessage(
         '$Unit="TB"; prown\RecalcFromBytes($Unit,24962496000000,0,rvsReturn); ',
         'Заменено представление размера на терабайты = 24.96 TB',80);

      $Unit='PB';
      $Result=prown\RecalcFromBytes($Unit,24962496000000,4,rvsReturn);
      $this->assertEqual($Result,0.025);
      $Unit='EB';
      $Result=prown\RecalcFromBytes($Unit,24962496000000,8,rvsReturn);
      $this->assertEqual($Result,2.496E-5);
      $Unit='ZB';
      $Result=prown\RecalcFromBytes($Unit,24962496000000,4,rvsReturn);
      $this->assertEqual($Result,1.0E+21);
      $Unit='YB';
      $Result=prown\RecalcFromBytes($Unit,24962496000000,4,rvsReturn);
      $this->assertEqual($Result,1.0E+24);
      MakeTestMessage(
         '$Unit="YB"; prown\RecalcFromBytes($Unit,24962496000000,4,rvsReturn); ',
         'Заменено представление размера на йоттабайты = 1.0E+24 YB',80);
      $Unit='B';
      $Result=prown\RecalcSizeInfo(cdiFromBytes,$Unit,24962496,2);
      $this->assertEqual($Result,24962496);
      MakeTestMessage(
         '$Unit="B"; prown\RecalcSizeInfo(cdiFromBytes,$Unit,24962496,2); ',
         'Оставлено представление размера в байтах = 24962496 B',80);
      SimpleMessage();

      $Unit='MB';
      $Result=prown\RecalcToBytes($Unit,2.8563,2); 
      $this->assertEqual($Result,2856300);
      MakeTestMessage(
         '$Unit="MB"; prown\RecalcToBytes($Unit,2.8563,2); ',
         'Изменено представление размера в мегабайтах на байты - 2856300 B',80);

      $Unit='MiB';
      $Result=prown\RecalcSizeInfo(cdiToBytes,$Unit,2.8563,2); 
      $this->assertEqual($Result,2995047.63);
      MakeTestMessage(
         '$Unit="MiB"; prown\RecalcSizeInfo(cdiToBytes,$Unit,2.8563,2); ',
         'Изменено представление размера в мебибайтах на байты - 2995047.63 B',80);

      $Unit='KiBi';
      $Result=prown\RecalcToBytes($Unit,2.8563,2,rvsReturn); 
      $this->assertEqual($Result,'[TPhpPrown] Неверно указана единица измерения [$Unit=KiBi]');
      MakeTestMessage(
         '$Unit="KiBi"; $Result=prown\RecalcToBytes($Unit,2,0,rvsReturn); ',
         $Result,80);

      $Unit='KiB';
      $Result=prown\RecalcSizeInfo("Byte",$Unit,2.8563,2,rvsReturn); 
      $this->assertEqual($Result,'[TPhpPrown] Неверно указано направление пересчета [$Direct=Byte]');
      MakeTestMessage(
         '$Unit="KiB"; $Result=prown\RecalcSizeInfo("Byte",$Unit,2.8563,2,rvsReturn); ',
         $Result,80);

      $Unit='B';
      $Result=prown\RecalcSizeInfo(cdiToBytes,$Unit,2.8563,2,rvsReturn); 
      $this->assertEqual($Result,2.86);
      MakeTestMessage(
         '$Unit="B"; $Result=prown\RecalcSizeInfo(cdiToBytes,$Unit,2.8563,2); ',
         'Оставлено представление размера в байтах = 2.86 B',80);
      SimpleMessage();
   }
}
// ************************************************* ChangeDimInfo_test.php ***
