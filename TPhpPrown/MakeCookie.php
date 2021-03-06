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
//   $Options=["path"=>"/","domain"=>"","secure"=>false,"httponly"=>false,"samesite"=>null],
//   $ModeError=rvsTriggerError)

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

//      cook512=44236800,  время жизни кукиса составляет 512 дней
//      cookSession=0,     время жизни кукиса - до завершения сеанса браузера
//      cookDelete=-1,     кукис удалить по завершении сеанса браузера

//   $Options - дополнительные параметры (RFC6265bis до 29 октября 2019 г),
//      по умолчанию $Options =
//      ["path"=>"/","domain"=>"","secure"=>false,"httponly"=>false,"samesite"=>null]
//      "path" - путь к каталогу на сервере, из которого будет доступен кукис; 
//      "domain" - домен, на котором возникает кукис; "secure" - указывает на то, 
//      что кукис должен передаваться от клиента по защищенному соединению; 
//      "httponly" - кукис будет доступен только через HTTP-протокол; "samesite" 
//      - режим связывания кукиса со сторонними сайтами (должен быть либо None, 
//      либо Lax, либо Strict)
//
//   $ModeError - режим вывода сообщений об ошибке (по умолчанию через 
//      исключение с пользовательской ошибкой на сайте doortry.ru)

// Возвращаемое значение: 
//
//   $Result  - установленное значение COOKIE в браузере, во внутреннем массиве
//      $_COOKIE и переменной-кукиса в сценарии сайтовой страницы

// Замечания: 
//   1) При изменении кукиса встроенной функцией PHP setcookie меняется только 
// значение кукиса в браузере, а его величина в массиве $_COOKIE в текущем
// PHP-сценарии остается без изменения. Поэтому для синхронизации значений (на 
// сервере) следует использовать MakeCookie.
//   2) На 05.03.2020 в версии PHP 7.3.8 не удалось проверить действие параметра 
// "samesite". Не обнаруживаются константы None, Lax, Strict.

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
   // Отмечаем, что "Невозможно привести кукис к указанному типу"
   if ($Result===null)
   {
      MakeUserError(CantСookiesToType.' ['.$Value.'-->'.$Type.']','TPhpPrown',$ModeError);
   }
   // Определяем длительность кукиса
   if ($Dur==cookSession) $Duration=cookSession;
   elseif ($Dur==cookDelete) $Duration=cookDelete;
   else $Duration=time()+$Dur;
   // Определяем другие параметры кукиса
   if (IsSet($Options['path'])) $Pathi=$Options['path']; else $Pathi="/";
   if (IsSet($Options['domain'])) $Domaini=$Options['domain']; else $Domaini="";
   if (IsSet($Options['secure'])) $Securi=$Options['secure']; else $Securi=FALSE;
   if (IsSet($Options['httponly'])) $Httponli=$Options['httponly']; else $Httponli=FALSE;
   if (IsSet($Options['samesite'])) $Samesite=$Options['samesite']; else $Samesite=null;
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
      MakeUserError(SendCookieFailed.' ['.$Name.']','TPhpPrown',$ModeError);
   }
   // Устанавливаем новое куки в массиве кукисов
   else $_COOKIE[$Name]=$Value;
   // Возвращаем новое куки на выход в переменную страницы сайта
   return $Result;
}

function MakeCookie($Name,$Value=null,$Type=tStr,$Init=false,$Duration=cook512,
   $Options=["path"=>"/","domain"=>"","secure"=>false,"httponly"=>false,"samesite"=>null],
   $ModeError=rvsTriggerError)
{
   // Устанавливаем значение, если инициализация
   if ($Init===true) 
   {
      // Если кукиса еще нет, то устанавливаем его
      if (!(IsSet($_COOKIE[$Name]))) 
      {
         $Result=_MakeCookie($Name,$Value,$Type,$Duration,$Options,$ModeError);
      }
      // Если кукис уже есть, но требуется ему установить время до закрытия
      // браузера, то устанавливаем
      else 
      {
         $Result=$_COOKIE[$Name];
         if (($Duration==cookDelete)||($Duration==cookSession))
         {
            $Result=_MakeCookie($Name,$Value,$Type,$Duration,$Options,$ModeError);
         }
      }
   }
   // При запросе значения, возвращаем установленное значение кукиса
   // (здесь идет проверка по типу и значению, так как проверка только по 
   // значению может не отличить 0 от NULL)
   elseif ($Value===null) 
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
 