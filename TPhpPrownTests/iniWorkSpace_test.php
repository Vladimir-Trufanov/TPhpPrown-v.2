<?php

// PHP7/HTML5, EDGE/CHROME                        *** iniWorkSpace_test.php ***

// ****************************************************************************
// *          Cформировать массив параметров рабочего пространства сайта      *
// ****************************************************************************

//                                                   Автор:       Труфанов В.Е.
//                                                   Дата создания:  31.01.2020
// Copyright © 2020 tve                              Посл.изменение: 31.01.2020

class test_iniWorkSpace extends UnitTestCase 
{
   // Преобразование строки к целому числу
   function test_iniWorkSpace_Simple()
   {
      MakeTitle("iniWorkSpace");
      $WidthLine=80;
      $_WORKSPACE=iniWorkSpace();

      $this->assertEqual($_WORKSPACE[wsSiteRoot],$_SERVER['DOCUMENT_ROOT']);
      MakeTestMessage('$_WORKSPACE[wsSiteRoot] = '.$_SERVER['DOCUMENT_ROOT'].' ',
         'определен верно!',$WidthLine);

      $path=GetAbove($_SERVER['DOCUMENT_ROOT']);
      $this->assertEqual($_WORKSPACE[wsSiteAbove],$path);
      MakeTestMessage('$_WORKSPACE[wsSiteAbove] = '.$path.' ','определен верно!',$WidthLine);
      
      $path=GetAbove(GetAbove($_SERVER['DOCUMENT_ROOT']));
      $this->assertEqual($_WORKSPACE[wsSiteHost],$path);
      MakeTestMessage('$_WORKSPACE[wsSiteHost] = '.$path.' ','определен верно!',$WidthLine);
      
      require_once($_WORKSPACE[wsSiteHost].'/TPhpPrown/TPhpPrown/WorkSpace/getSiteDevice.php');
      $path=getSiteDevice();  // 'Computer' | 'Mobile' | 'Tablet'
      $this->assertEqual($_WORKSPACE[wsSiteDevice],$path);
      MakeTestMessage('$_WORKSPACE[wsSiteDevice] = '.$path.' ','определен верно!',$WidthLine);
      
      $path=$_SERVER['HTTP_USER_AGENT'];
      //echo $_WORKSPACE[wsUserAgent].'<br>';
      //echo $path.'<br>';
      $this->assertEqual($_WORKSPACE[wsUserAgent],$path);
      SimpleMessage(); SimpleMessage($path);
      MakeTestMessage('$_WORKSPACE[wsUserAgent] ','определен верно!',$WidthLine);
      
      SimpleMessage();
   }
}
// ************************************************** iniWorkSpace_test.php ***
