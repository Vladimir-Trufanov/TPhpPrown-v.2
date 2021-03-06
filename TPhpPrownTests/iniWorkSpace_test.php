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
      $_WORKSPACE=iniWorkSpace();
      $SiteRoot=$_WORKSPACE[wsSiteRoot];     // Корневой каталог сайта
      $SiteName=$_WORKSPACE[wsSiteName];     // Доменное имя сайта
      MakeTitle("iniWorkSpace");
      $WidthLine=80;
      $this->assertEqual($SiteRoot,$_SERVER['DOCUMENT_ROOT']);
      MakeTestMessage('$_WORKSPACE[wsSiteRoot] = '.$_SERVER['DOCUMENT_ROOT'].' ',
         'Корневой каталог сайта определен верно!',$WidthLine);
      $path=prown\getAbove($_SERVER['DOCUMENT_ROOT']);
      $this->assertEqual($_WORKSPACE[wsSiteAbove],$path);
      MakeTestMessage('$_WORKSPACE[wsSiteAbove] = '.$path.' ',
         'Надсайтовый каталог также определен верно!',$WidthLine);
      $path=prown\getAbove(prown\getAbove($_SERVER['DOCUMENT_ROOT']));
      $this->assertEqual($_WORKSPACE[wsSiteHost],$path);
      MakeTestMessage('$_WORKSPACE[wsSiteHost] = '.$path.' ',
         'Каталог хостинга подтвержден!',$WidthLine);
      $path=getSiteDevice();  // 'Computer' | 'Mobile' | 'Tablet'
      $this->assertEqual($_WORKSPACE[wsSiteDevice],$path);
      MakeTestMessage('$_WORKSPACE[wsSiteDevice] = '.$path.' ',
         'Обозначен тип устройства - '.$path,$WidthLine);
      $path=$_SERVER['HTTP_USER_AGENT'];
      $this->assertEqual($_WORKSPACE[wsUserAgent],$path);
      SimpleMessage($path);
      MakeTestMessage('$_WORKSPACE[wsUserAgent] ',
         'UserAgent определен верно!',$WidthLine);
      $path=$_SERVER['REQUEST_TIME'];
      $this->assertEqual($_WORKSPACE[wsTimeRequest],$path);
      MakeTestMessage('$_WORKSPACE[wsTimeRequest] = '.$path.' ',
         'Время запроса сайта зафиксировано!',$WidthLine);
      $path=$_SERVER['REMOTE_ADDR'];
      $this->assertEqual($_WORKSPACE[wsRemoteAddr],$path);
      MakeTestMessage('$_WORKSPACE[wsRemoteAddr] = '.$path.' ',
         'IP-адрес выделен!',$WidthLine);
      $path=$_SERVER['HTTP_HOST'];
      $this->assertEqual($_WORKSPACE[wsSiteName],$path);
      MakeTestMessage('$_WORKSPACE[wsSiteName] = '.$path.' ',
         'Доменное имя извлечено!',$WidthLine);
      // Проверяем isHost
      if (isHost($SiteName)) $path='true'; else $path='false' ;
      $this->assertEqual('true',$path);
      if (isHost('no'.$SiteName)) $path='true'; else $path='false' ;
      $this->assertEqual('false',$path);
      MakeTestMessage("isHost('".$SiteName."')=true; isHost('no".$SiteName."')=false ",
      'Текущий сайт соответствует заданному доменному имени!',$WidthLine);
      if (isHost('no'.$SiteName,$SiteName)) $path='true'; else $path='false';
      $this->assertEqual('true',$path);
      MakeTestMessage("isHost('no".$SiteName."','".$SiteName."')=true ",
      'Отладочный сайт соответствует заданному доменному имени!',$WidthLine);
      if (isHost($SiteName,'no'.$SiteName)) $path='true'; else $path='false';
      $this->assertEqual('true',$path);
      MakeTestMessage("isHost('".$SiteName."','no".$SiteName."')=true ",
      'В проверке подтвержден текущий сайт!',$WidthLine);
      SimpleMessage();
   }
}
// ************************************************** iniWorkSpace_test.php ***
