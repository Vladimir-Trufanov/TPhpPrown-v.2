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
      MakeTitle("iniWorkSpace");
      $WidthLine=80;
      $this->assertEqual($SiteRoot,$_SERVER['DOCUMENT_ROOT']);
      MakeTestMessage('$_WORKSPACE[wsSiteRoot] = '.$_SERVER['DOCUMENT_ROOT'].' ',
         'Корневой каталог сайта определен верно!',$WidthLine);
      $path=GetAbove($_SERVER['DOCUMENT_ROOT']);
      $this->assertEqual($_WORKSPACE[wsSiteAbove],$path);
      MakeTestMessage('$_WORKSPACE[wsSiteAbove] = '.$path.' ',
         'Надсайтовый каталог также определен верно!',$WidthLine);
      $path=GetAbove(GetAbove($_SERVER['DOCUMENT_ROOT']));
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
      if (isHost('localhost')) $path='true'; else $path='false' ;
      $this->assertEqual('true',$path);
      if (isHost('localhosting')) $path='true'; else $path='false' ;
      $this->assertEqual('false',$path);
      MakeTestMessage("isHost('localhost')=true; isHost('localhosting')=false ",
         'Текущий сайт соответствует заданному доменному имени!',$WidthLine);
      if (isHost('localhosting','localhost')) $path='true'; else $path='false' ;
      $this->assertEqual('true',$path);
      if (isHost('localhost','localhost')) $path='true'; else $path='false' ;
      //echo 'true'.'<br>';
      //echo $path.'<br>';
      $this->assertEqual('true',$path);
      MakeTestMessage("isHost('localhosting','localhost')=true; ".
         "isHost('localhost','localhost')=true ",
         'Отладочный сайт соответствует заданному доменному имени!',$WidthLine);
      




      SimpleMessage();
   }
}
// ************************************************** iniWorkSpace_test.php ***
