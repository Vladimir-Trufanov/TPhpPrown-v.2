<?php namespace prown; 
                                         
// PHP7/HTML5, EDGE/CHROME                               *** MakeCookie.php ***

// ****************************************************************************
// * TPhpPrown          Установить новое значение COOKIE в браузере, заменить *
// *              этим значением соответствующее данное во внутреннем массиве *
// *       $_COOKIE и установить новое значение переменной-кукиса в программе *
// *                                                                          *
// * v1.5, 25.03.2020                              Автор:       Труфанов В.Е. *
// * Copyright © 2018 tve                          Дата создания:  03.02.2018 *
// ****************************************************************************

// Функция установливает новое значение кукиса в браузере и синхронизирует это
// значение еще с двумя объектами:
// а) обновляет значение данного кукиса в глобальном массиве $_COOKIE. Это действие
// позволяет использовать значение уже в текущем PHP-сценарии без перезагрузки
// страницы;
// б) возращает указанное значение по завершении работы для передачи его 
// соответствующей переменной-кукису. 

// Возникновение ошибок при выполнении функции или отсутствие поддержки кукисов 
// в браузере не влияет на установление значения переменой-кукиса на сервере и
// соответствующего значения в массиве $_COOKIE. Эти значения могут быть 
// подтверждены при следующей загрузке страницы.

// Синтаксис:
//
//   $Result=MakeCookie($Name,$Value=null,$Type=tStr,$Init=false,$Duration=cook512,
//   $Options=["expires"=>cook512,"path"=>"/","domain"=>"","secure"=>false,
//   "httponly"=>false,"samesite"=>null],$ModeError=rvsTriggerError)

// Параметры:
//
//   $Name - имя кукиса в браузере клиента (по имени кукиса можно формировать 
//      глобальную переменную сайтовой страницы добавлением префикса "с_". 
//      Например: "BrowEntry" --> "$с_BrowEntry");
//   $Value - значение кукиса браузера, это же значение во внутреннем массиве
//      $_COOKIE и у соответствующей глобальной переменной сайтовой страницы. 
//      Если $Value=null или неопределено, то функция возвращает установленное 
//      значение кукиса;
//   $Type - константа, определяющая тип значения: tInt - integer, целое число 
//      (из множества {...,-2,-1,0,1,2,...}); tFloat - double, число с плавающей
//      точкой; tStr - string, набор символов=байт (256 различных значений);
//      tBool - boolean, простейший тип, выражающие истинность значения.  
//      По умолчанию - tStr;
//   $Init = true, это означает, что требуется установить указанное значение 
//      кукиса, только в том случае, если кукиса еще не было. В обычных условиях
//      (по умолчанию, когда $Init=false) значение кукиса меняется всегда;
//   $Duration - время жизни кукиса (по умолчанию 44236800 = 512 дней =
//      512д*24ч*60м*60с): 

//      cookDelete=-3600, для удаления кукиса после завершения сессии; 
//      cookSession=0, для задания кукиса только на время сессии;
//      cook512=44236800;

//   $Options - опции кукиса, это дополнительные параметры кукиса (RFC6265bis):
//      "expires" - время, когда срок действия кукиса истекает; "path" - путь к 
//      каталогу на сервере, из которого будет доступен кукис; "domain" - домен, 
//      на котором возникает кукис; "secure" - указывает на то, что кукис должен
//      передаваться от клиента по защищенному соединению; "httponly" - кукис
//      будет доступен только через HTTP-протокол; "samesite" - режим связывания 
//      кукиса со сторонними сайтами (должен быть либо None, либо Lax, либо 
//      Strict)
//   $ModeError - режим вывода сообщений об ошибке (по умолчанию через 
//      исключение с пользовательской ошибкой на сайте doortry.ru)

// Возвращаемое значение: 
//
//   $Result  - установленное значение COOKIE в браузере, во внутреннем массиве
//      $_COOKIE и переменной-кукиса в сценарии сайтовой страницы

// Замечание: 
//   При изменении кукиса встроенной функцией PHP setcookie меняется только 
// значение кукиса в браузере, а его величина в массиве $_COOKIE в текущем
// PHP-сценарии остается без изменения. Поэтому для синхронизации значений (на 
// сервере) следует использовать MakeCookie.

require_once "CommonPrown.php";
require_once "iniConstMem.php";
require_once "iniErrMessage.php";
require_once "MakeType.php";
require_once "MakeUserError.php";

function _MakeCookie($Name,$Value,$Type,$Dur,$Options,$ModeError)
{
   $PhpVersion=getPhpVersion(); 
   // Приводим кукис к заданному типу
   $Result=MakeType($Value,$Type);
   // echo '$Value='.$Value.'['.$Type.'] --> $Result='.$Result;
   // Отмечаем, что "Невозможно привести кукис к указанному типу"
   if ($Result===null)
   {
      \prown\MakeUserError(CantСookiesToType.' ['.$Value.'-->'.$Type.']','TPhpPrown',$ModeError);
   }
   // Определяем длительность кукиса
   if (IsSet($Options['expires'])) $Duration=time()+$Options['expires'];
   else $Duration=time()+$Dur;
   // Определяем другие параметры кукиса
   if (IsSet($Options['path'])) $Pathi=$Options['path'];
   else $Pathi="";
   if (IsSet($Options['domain'])) $Domaini=$Options['domain'];
   else $Domaini="";
   if (IsSet($Options['secure'])) $Securi=$Options['secure'];
   else $Securi=FALSE;
   if (IsSet($Options['httponly'])) $Httponli=$Options['httponly'];
   else $Httponli=FALSE;
   if (IsSet($Options['samesite'])) $Samesite=$Options['samesite'];
   else $Samesite=null;
   // Отправляем новое куки браузеру для соответствующих версий
   if ($PhpVersion<50200)
   {
      $Ret=setcookie($Name,$Value,$Duration,$Pathi,$Domaini,$Securi);
   }
   elseif ($PhpVersion<70300)
   {
      $Ret=setcookie($Name,$Value,$Duration,$Pathi,$Domaini,$Securi,$Httponli);
   }
   else
   {
      // $Ret=setcookie($Name,$Value,$Options); 05.03.2020, "samesite" не работает
      $Ret=setcookie($Name,$Value,$Duration,$Pathi,$Domaini,$Securi,$Httponli);
   }
   // Если перед вызовом функции клиенту уже передавался какой-либо вывод 
   // (теги, пустые строки, пробелы, текст и т.п.), setcookie() потерпит 
   // неудачу и вернет FALSE. Если setcookie() успешно отработает, то вернет 
   // TRUE. Это, однако, не означает, что клиентское приложение (браузер) 
   // правильно приняло и обработало cookie.
   if ($Ret==FALSE)
   {
      \prown\MakeUserError(SendCookieFailed.' ['.$Name.']','TPhpPrown',$ModeError);
   }
   // Устанавливаем новое куки в массиве кукисов
   if (IsSet($_COOKIE[$Name])) $_COOKIE[$Name]=$Value;
   // Возвращаем новое куки на выход в переменную страницы сайта
   return $Result;
}

function MakeCookie($Name,$Value=null,$Type=tStr,$Init=false,$Duration=cook512,
   $Options=["expires"=>cook512,"path"=>"/","domain"=>"","secure"=>false,
   "httponly"=>false,"samesite"=>null],$ModeError=rvsTriggerError)

   // Замечание: 05.03.2020 на версии PHP 7.3.8 не удалось проверить действие 
   // параметра "samesite". Не обнаруживаются константы None, Lax, Strict.

{
   // Устанавливаем значение, если инициализация
   if ($Init==true) 
   {
      if (!(IsSet($_COOKIE[$Name]))) 
      {
         $Result=_MakeCookie($Name,$Value,$Type,$Duration,$Options,$ModeError);
      }
      else $Result=$_COOKIE[$Name];
   }
   // При запросе значения, возвращаем установленное значение кукиса
   elseif ($Value==null) 
   {
      $Result=$_COOKIE[$Name];
   }
   // Устанавливаем значение в обычном режиме
   else 
   {
      $Result=_MakeCookie($Name,$Value,$Type,$Duration,$Options,$ModeError);
   } 
   return $Result;
}
// ********************************************************* MakeCookie.php ***
 
