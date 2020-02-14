<?php
                                         
// PHP7/HTML5, EDGE/CHROME                             *** iniWorkSpace.php ***

// ****************************************************************************
// *         Cформировать массив параметров рабочего пространства сайта       *
// ****************************************************************************

//                                                   Автор:       Труфанов В.Е.
//                                                   Дата создания:  31.01.2020
// Copyright © 2018 TVE                              Посл.изменение: 09.02.2020

// ----------------------- Перечень элементов массива рабочего пространства ---
define ("wsSiteRoot",    0);        // Корневой каталог сайта 
define ("wsSiteAbove",   1);        // Надсайтовый каталог
define ("wsSiteHost",    2);        // Каталог хостинга
define ("wsSiteDevice",  3);        // 'Computer' | 'Mobile' | 'Tablet'
define ("wsUserAgent",   4);        // HTTP_USER_AGENT
define ("wsTimeRequest", 5);        // Время запроса сайта
define ("wsRemoteAddr",  6);        // IP-адрес запроса сайта
define ("wsSiteName",    7);        // Доменное имя сайта

// ****************************************************************************
// *         Cформировать массив параметров рабочего пространства сайта       *
// ****************************************************************************
function iniWorkSpace()
{
   $SiteRoot=$_SERVER['DOCUMENT_ROOT'];  // Корневой каталог сайта
   $SiteAbove=GetAbove($SiteRoot);       // Надсайтовый каталог
   $SiteHost=GetAbove($SiteAbove);       // Каталог хостинга

   require_once($SiteHost.'/TPhpPrown/TPhpPrown/WorkSpace/getSiteDevice.php');

   // Инициализируем массив параметров рабочего пространства сайта
   $_WORKSPACE=array
   (
      wsSiteRoot    => $SiteRoot,        // Корневой каталог сайта
      wsSiteAbove   => $SiteAbove, 
      wsSiteHost    => $SiteHost, 
      wsSiteDevice  => getSiteDevice(),  // 'Computer' | 'Mobile' | 'Tablet'
      wsUserAgent   => $_SERVER['HTTP_USER_AGENT'],    
      wsTimeRequest => $_SERVER['REQUEST_TIME'],    
      wsRemoteAddr  => $_SERVER['REMOTE_ADDR'],    
      wsSiteName    => $_SERVER['HTTP_HOST'],    
   );

   return $_WORKSPACE;
}
// ****************************************************************************
// *        По абсолютному пути каталога выделить вышестоящий каталог         *
// *   (основное назначение - по абсолютному пути корневого каталога сайта    *
// *          выбрать путь надсайтового каталога и каталога хостинга)         *
// ****************************************************************************
function getAbove($SiteRoot)
{
    $Result=$SiteRoot;
    // Считаем, что отладка идет в Windows IIS,
    // поэтому вначале ищем последний обратный слэш
    $Point=strrpos($Result,'\\');
    // Обратный слэш не найден, считаем что на хостинге (Apache,Linux)
    if ($Point==0) 
	{
	    // echo "Обратного слэша не найдено!"."<br>";
	    // Ищем последний слэш
        $Point=strrpos($Result,'/');
	    // Если слэш найден, выделяем надсайтовый каталог
        if ($Point>0) {$Result=substr($SiteRoot,0,$Point);}
    }
    // Обратный слэш найден, выделяем надсайтовый каталог в Windows
    else 
	{
        // echo "Обратный слэш "; echo "***".$Point."***"."<br>";
	    $Result=substr($SiteRoot,0,$Point);
    }
    return $Result;
}
// ****************************************************************************
// *        По заданному доменному имени ...         *
// ****************************************************************************
function isHost($SiteName,$kwinflatht_nichost_ru='')
{
   $Result=false;
   // Вначале проверяем сайт по доменному имени в $_SERVER['HTTP_HOST'] 
   $regexp='/'.$SiteName.'/'; 
   echo '$SiteName='.$SiteName.'<br>';
   echo 'strlen($SiteName)='.strlen($SiteName).'<br>';
   echo '$regexp='.$regexp.'<br>';
   echo '$_SERVER["HTTP_HOST"]='.$_SERVER['HTTP_HOST'].'<br>';
   // Выполняем регулярное выражение и получаем результаты поиска
   preg_match($regexp,$_SERVER['HTTP_HOST'],$imatches,PREG_OFFSET_CAPTURE);
   // Функция preg_match в случае неудачного поиска возвращает пустой массив
   // или массив вида  Array([0]=>Array([0]=> ''       [1]=>0)), 
   // а при удаче      Array([0]=>Array([0]=>$SiteName [1]=>0)) 
   print_r($imatches);
   echo '<br>1 $kwinflatht_nichost_ru='.$kwinflatht_nichost_ru.'<br>';
   if (count($imatches)>0)
   {
   if ($imatches[0][0]>'')
   { 
      echo '<br>$imatches[0][0]='.$imatches[0][0].'<br>';
      $Result=true;
      //print_r($Result);
      //echo '$matches='.$matches.'<br>';
      //echo '$matches='.$imatches[0][0].'<br>';
   }
   }
   // и при необходимости проверяем отладочный сайт
   else if (strlen($kwinflatht_nichost_ru)>0)
   {
      $regexp='/'.$kwinflatht_nichost_ru.'/'; 
      echo '$kwinflatht_nichost_ru='.$kwinflatht_nichost_ru.'<br>';
      echo 'strlen($SiteName)='.strlen($SiteName).'<br>';
      echo '$regexp='.$regexp.'<br>';
      echo '$_SERVER["HTTP_HOST"]='.$_SERVER['HTTP_HOST'].'<br>';
      // Выполняем регулярное выражение и получаем результаты поиска
      preg_match($regexp,$_SERVER['HTTP_HOST'],$imatches,PREG_OFFSET_CAPTURE);
      print_r($imatches);
      if (count($imatches)>0)
      {
      if ($imatches[0][0]>'')
      { 
         echo '<br>$imatches[0][0]='.$imatches[0][0].'<br>';
         $Result=true;
         //print_r($Result);
         //echo '$matches='.$matches.'<br>';
         //echo '$matches='.$imatches[0][0].'<br>';
      }
      }
   }
   return $Result;
}
// ******************************************************* iniWorkSpace.php ***
 
