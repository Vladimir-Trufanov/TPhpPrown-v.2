<?php

// PHP7/HTML5, EDGE/CHROME                       *** ChangeDimInfo_test.php ***

// ****************************************************************************
// * TPhpPrown                        ---Преобразовать значение к заданному типу *
// ****************************************************************************

//                                                   Автор:       Труфанов В.Е.
//                                                   Дата создания:  20.04.2019
// Copyright © 2019 tve                              Посл.изменение: 02.04.2020

require_once $SiteHost."/TPhpPrown/TPhpPrown/iniConstMem.php";

class test_RecalcSizeInfo extends UnitTestCase 
{
   // Преобразование строки к целому числу
   function test_RecalcSizeInfo_Simple()
   {
      MakeTitle("RecalcSizeInfo");
      $Unit='KiB';
      $Result=prown\RecalcFromBytes($Unit,24962496,2);
      echo '---'.$Result.'---<br>';
      $Unit='KiBi';
      $Result=prown\RecalcFromBytes($Unit,24962496,2,rvsReturn);
      echo '---'.$Result.'---<br>';
      
      $Unit='KiB';
      //$Unit='GiB';
      $Result=prown\RecalcSizeInfo(cdiFromBytes,$Unit,24962496,2);
      echo '---'.$Result.'---<br>';
      $Result=prown\RecalcSizeInfo(3,$Unit,24962496,2,rvsReturn);
      echo '---'.$Result.'---<br>';
      $Result=prown\RecalcSizeInfo('FromBytes',$Unit,24962496,2,rvsReturn);
      echo '---'.$Result.'---<br>';
      $Result=prown\RecalcFromBytes($Unit,24962496,0);
      echo '---'.$Result.'---<br>';
      $Result=prown\RecalcFromBytes($Unit,24962496,4);
      echo '---'.$Result.'---<br>';
      
      $Result=prown\RecalcToBytes($Unit,2,0); 
      echo '---'.$Result.'---<br>';
      $Result=prown\RecalcToBytes($Unit,2.8563,0); 
      echo '---'.$Result.'---<br>';
      $Result=prown\RecalcToBytes($Unit,2.8563,2); 
      echo '---'.$Result.'---<br>';
      $Result=prown\RecalcSizeInfo(cdiToBytes,$Unit,2.8563,2);
      echo '---'.$Result.'---<br>';
      
      $string="1958";
      $Result=prown\MakeType($string,tInt);
      $this->assertEqual($Result,1958);
      $this->assertNotEqual($Result,'1959');  
      MakeTestMessage(
         '$string="1958"; $Result=prown\MakeType($string,tInt); ',
         'Преобразование строчного "1958" к целому 1958',70);
      $string='3.1415926';
      $Result=prown\MakeType($string,tFloat);
      $this->assertEqual($Result,3.1415926);
      $this->assertNotEqual($Result,3.1415926+1959);  
      MakeTestMessage(
         '$string="3.1415926"; $Result=prown\MakeType($string,tFloat); ',
         'Преобразование строки "3.1415926" к числу 3.1415926',70);
      SimpleMessage();
   }
}
// ************************************************* ChangeDimInfo_test.php ***
