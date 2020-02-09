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

// ******************************************************* iniWorkSpace.php ***
 
