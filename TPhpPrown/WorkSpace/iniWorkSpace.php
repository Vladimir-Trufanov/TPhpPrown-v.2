<?php
// PHP7/HTML5, EDGE/CHROME                             *** iniWorkSpace.php ***
// ****************************************************************************
// *         Cформировать массив параметров рабочего пространства сайта       *
// ****************************************************************************

//                                                   Автор:       Труфанов В.Е.
//                                                   Дата создания:  31.01.2020
// Copyright © 2020 TVE                              Посл.изменение: 04.05.2025

// Above($SiteRoot)           - По абсолютному пути каталога выделить вышестоящий каталог
// getComRequest($Com='Com')  - Получить значение указанного параметра из запроса к сайту 
// UnlinkFile($filename)      - Проверить существование и удалить файл из файловой системы

// Определяем константы перечня элементов массива рабочего пространства 
define ("wsSiteRoot",      0);          // Корневой каталог сайта 
define ("wsSiteAbove",     1);          // Надсайтовый каталог
define ("wsSiteHost",      2);          // Каталог хостинга
define ("wsSiteDevice",    3);          // 'Computer' | 'Mobile' | 'Tablet'
define ("wsUserAgent",     4);          // HTTP_USER_AGENT
define ("wsTimeRequest",   5);          // Время запроса сайта
define ("wsRemoteAddr",    6);          // IP-адрес запроса сайта, с которого пользователь просматривает страницу
define ("wsSiteName",      7);          // Доменное имя сайта
define ("wsPhpVersion",    8);          // Версия PHP
define ("wsSiteProtocol",  9);          // HTTP или HTTPS
define ("wsUrlHome",      10);          // Начальная страница сайта
define ("wsRootDir",      11);          // Каталог корня сайта, в котором выполняется текущий скрипт
define ("wsRootUrl",      12);          // Путь и имя выполняемого скрипта
define ("wsRemoteHost",   13);          // Удаленный хост, с которого пользователь просматривает текущую страницу
define ("wsHttpReferer",  14);          // Адрес страницы, с которой браузер пользователя перешёл на текущую страницу

// Формируем массив параметров рабочего пространства сайта 
// и соответствующие глобальные переменные
function iniWorkSpace()
{
   $SiteRoot=$_SERVER['DOCUMENT_ROOT'];  // Корневой каталог сайта
   $SiteAbove=Above($SiteRoot);          // Надсайтовый каталог
   $SiteHost=Above($SiteAbove);          // Каталог хостинга
   include_once($SiteHost.'/TPhpPrown/TPhpPrown/CommonPrown.php');
   include_once($SiteHost.'/TPhpPrown/TPhpPrown/WorkSpace/getSiteDevice.php');
   // Если есть, назначаем реферальную ссылку
   if (IsSet($_SERVER['HTTP_REFERER'])) $Refer=$_SERVER['HTTP_REFERER'];
   else $Refer='NoExist';
   // Если возможно, определяем удаленный хост, с которого пользователь просматривает текущую страницу
   if (IsSet($_SERVER['REMOTE_HOST'])) $RemoteHost=$_SERVER['REMOTE_HOST'];
   else $RemoteHost='NoExist';
   // Собираем массив параметров рабочего пространства сайта 
   $_WORKSPACE=array
   (
      wsSiteRoot      => $SiteRoot,  
      wsSiteAbove     => $SiteAbove, 
      wsSiteHost      => $SiteHost, 
      wsSiteDevice    => getSiteDevice(),  // 'Computer' | 'Mobile' | 'Tablet'
      wsUserAgent     => $_SERVER['HTTP_USER_AGENT'],    
      wsTimeRequest   => $_SERVER['REQUEST_TIME'],    
      wsRemoteAddr    => $_SERVER['REMOTE_ADDR'],    
      wsSiteName      => $_SERVER['HTTP_HOST'],    
      wsPhpVersion    => prown\getPhpVersion(), 
      wsSiteProtocol  => isProtocol(), 
      wsUrlHome       => isProtocol().'://'.$_SERVER['HTTP_HOST'], 
      wsRootDir       => $_SERVER['DOCUMENT_ROOT'],
      wsRootUrl       => $_SERVER['SCRIPT_NAME'],
      wsRemoteHost    => $RemoteHost,
      wsHttpReferer   => $Refer,
   );                              
   // Сбрасываем в лог-файл значения массива $ _SERVER для разных клиентов 
   UnlinkFile(__DIR__ . '/server.log');
   file_put_contents(__DIR__ . '/server.log', print_r($_SERVER, true) . PHP_EOL, FILE_APPEND);
   return $_WORKSPACE;
}   
// ****************************************************************************
// *        По абсолютному пути каталога выделить вышестоящий каталог         *
// ****************************************************************************
function Above($SiteRoot)
{
   $Result=$SiteRoot;
   $Point=strrpos($Result,'\\');
   if ($Point==0) 
	{
      $Point=strrpos($Result,'/');
      if ($Point>0) {$Result=substr($SiteRoot,0,$Point);}
   }
   else 
	{
      $Result=substr($SiteRoot,0,$Point);
   }
   return $Result;
}
// ****************************************************************************
// *          Получить значение указанного параметра из запроса к сайту       *
// *                        (получить команду через параметр)                 *
// ****************************************************************************
function getComRequest($Com='Com')
{
   $Result=NULL;
   if (IsSet($_REQUEST[$Com]))
   { 
      $Result=$_REQUEST[$Com];
   }
   return $Result;
}
// ****************************************************************************
// *                     Вывести сообщение в консоли браузера                 *
// *                                                                          *
// *   (следует отметить, что фунция использует js, то есть уже отправляет    *
// * данные в браузер. Поэтому, например, при следуэющем формировании кукисов *
// * будет ошибка: "Cannot modify header information - headers already sent") *
// ****************************************************************************

/**
 * а) если второй параметр функции не передается (или имеет значение null), то 
 * в консоли браузера выводится просто текст, указанный в первом параметре;
 * б) если второй параметр указан, то он интерпретируется, как значение 
 * переменной, указанной в первом параметре и сообщение выводится в виде:
 * "переменная"="значение";
 * в) если любой из первых двух параметров содержит спецсимволы (например:
 * одиночная кавычка - ', двойная кавычка - ", обратный слэш - \ или NUL - 
 * байт NULL), то для правильного отображения в консоли подстроки экранируются
 * (по умолчанию) $isEscape=true.
**/

function ConsoleLog($Stringi,$Parmi=null,$isEscape=true) 
{
   $iString=$Stringi; $Parm=$Parmi;
   // Экранируем параметры при необходимости
   if ($isEscape)
   {
      if (gettype($iString)=='string') $iString=addslashes($iString);
      if (gettype($Parm)=='string') $Parm=addslashes($Parm);
   }
   // Формируем текст сообщения
   if ($Parm===null) $messa=$iString;
   else $messa=$iString.'='.$Parm;
   // Выводим сообщение
   ?>
   <script>
      messa="<?php echo $messa; ?>";
      console.log(messa);
   </script>
   <?php
}
// ****************************************************************************
// *          Проверить существование и удалить файл из файловой системы      *
// *         (используется в случаях, когда необходимо перезаполнить файл)    *
// ****************************************************************************
function UnlinkFile($filename)
{
   if (file_exists($filename)) 
   {
      if (!unlink($filename))
      {
         // Для файла базы данных выводится сообщение о неудачном удалении 
         // в случаях:
         //    а) база данных подключена к стороннему приложению;
         //    б) база данных еще привязана к другому объекту класса;
         //    в) прочее
         throw new Exception("Не удалось удалить файл $filename!");
      } 
   } 
}
// ****************************************************************************
// *    Определить соответствует ли текущий сайт заданному доменному имени    *
// *  (в случае, когда указано доменное имя отладочного сайта, то определить  *
// *                    является ли текущий сайт отладочным)                  *
// ****************************************************************************
function isHost($SiteName,$kwinflatht_nichost_ru='')
{
   //print_r('$SiteName='.$SiteName.'<br>');
   //print_r('$kwinflatht_nichost_ru='.$kwinflatht_nichost_ru.'<br>');
   $Result=false;
   // Вначале проверяем сайт по доменному имени в $_SERVER['HTTP_HOST'] 
   $regexp='/'.$SiteName.'/'; 
   // Выполняем регулярное выражение и получаем результаты поиска
   preg_match($regexp,$_SERVER['HTTP_HOST'],$aMatches,PREG_OFFSET_CAPTURE);
   if (isMatches($aMatches)) $Result=true;
   // При необходимости проверяем отладочный сайт
   else if (strlen($kwinflatht_nichost_ru)>0)
   {
      $regexp='/'.$kwinflatht_nichost_ru.'/'; 
      // Выполняем регулярное выражение и получаем результаты поиска
      preg_match($regexp,$_SERVER['HTTP_HOST'],$aMatches,PREG_OFFSET_CAPTURE);
      if (isMatches($aMatches)) $Result=true;
   }
   return $Result;
}
// Функция preg_match в случае неудачного поиска возвращает пустой массив
// или массив вида  Array([0]=>Array([0]=> ''       [1]=>0)), 
// а при удаче      Array([0]=>Array([0]=>$SiteName [1]=>0)) 
function isMatches($aMatches)
{
   $Result=false;
   if (count($aMatches)>0)
   {
      if ($aMatches[0][0]>'')
      { 
         $Result=true;
      }
   }
   return $Result;
}
// ****************************************************************************
// *                Определить тип протокола сайта 'HTTP' или 'HTTPS'         *
// ****************************************************************************
// http://reset.name/php/php-opredelit-https-ili-http-ispolzuetsja-pri-podkljuchenii/
function isProtocol()
{
   if($_SERVER["SERVER_PORT"] == 443)
      $protocol = 'https';
   elseif (isset($_SERVER["HTTPS"]) && (($_SERVER["HTTPS"] == 'on') || ($_SERVER["HTTPS"] == '1')))
      $protocol = 'https';
   elseif (
   !empty($_SERVER["HTTP_X_FORWARDED_PROTO"]) && $_SERVER["HTTP_X_FORWARDED_PROTO"] == 'https' || 
   !empty($_SERVER["HTTP_X_FORWARDED_SSL"]) && $_SERVER["HTTP_X_FORWARDED_SSL"] == 'on')
      $protocol = 'https';
   elseif (strtolower(substr($_SERVER["SERVER_PROTOCOL"],0,5)) == 'https')
      $protocol = 'https';
   else
      $protocol = 'http';
   return $protocol;
}
// ******************************************************* iniWorkSpace.php ***
 
