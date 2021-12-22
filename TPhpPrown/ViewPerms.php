<?php namespace prown;

// PHP7/HTML5, EDGE/CHROME                                *** ViewPerms.php ***
// ****************************************************************************
// * TPhpPrown    Подготовить строку для показа параметров файла или каталога *
// *                                                                          *
// * v1.0, 22.12.2021                              Автор:       Труфанов В.Е. *
// * Copyright © 2021 tve                          Дата создания:  19.12.2021 *
// ****************************************************************************

// https://www.php.net/manual/ru/function.fileperms.php
// ----------------------- В PHP не требуется строгого определения типа переменной. Каждая переменная
// может поменять свой тип в зависимости от контекста кода. Это и плохо и хорошо.
// Хорошо то, что в большинстве случаев можно не думать о типе переменной, 
// но существуют ситуации, когда такая универсальность вызывает многозначные 
// толкования и может быть источником ошибок. Это плохо. Например: при 
// формировании упорядоченных списков или массивов, или когда требуется работа с 
// размерностями в числах с плавающей точкой (и в других случаях, когда PHP 
// требует точного указания типа переменной). 

// Синтаксис:
//
//  --- $Result=MakeType($Value,$Type,$ModeError=rvsTriggerError);

// Параметры:
//
//   ---$Value - значение переменной, которое следует привести к заданному типу;
//   --$Type - константа, определяющая тип значения: integer, double, string,
//      boolean.
//   --$ModeError - режим вывода сообщений об ошибке (по умолчанию через 
//      исключение с пользовательской ошибкой на сайте doortry.ru)

// Возвращаемое значение: 
//
//   --$Result - значение, переданное функции и преобразованное к заданному типу
//      или null, если тип значения указан неверно или преобразование невозможно
//
// Зарегистрированные ошибки/исключения:
//   
//  -- ConversNotPossible - "Тип значения указан неверно или преобразование невозможно";

require_once "CommonPrown.php";
require_once 'iniErrMessage.php';
require_once 'MakeUserError.php';

function ViewPerms($Dir,&$info,$ModeError=rvsTriggerError)
{
   $Result=true;
   $info='U.---.---.--- 0000';
   // Сбрасываем кэш состояния файла
   clearstatcache(true,$Dir); 
   // Определяем установленные права и обыгрываем возможные ошибки определения:
   set_error_handler("prown\ViewPermsHandler");
   $perms = fileperms($Dir);
   restore_error_handler();
   // Ошибка, завершаем работу и возвращаем неопределенный результат
   if (!$perms)
   {
      ConsoleLog('$info1='.$info);
      $Result=MakeUserError(ErrDeterminRights.'[onerror]: '.$Dir,'TPhpPrown',$ModeError);
      if ($ModeError<>rvsReturn) $Result=false;
   }
   else
   { 
     switch ($perms & 0xF000) 
     {
      case 0xC000: // сокет
         $info = 's';
         break;
      case 0xA000: // символическая ссылка
         $info = 'l';
         break;
      case 0x8000: // обычный
         $info = 'r';
         break;
      case 0x6000: // файл блочного устройства
         $info = 'b';
         break;
      case 0x4000: // каталог
         $info = 'd';
         break;
      case 0x2000: // файл символьного устройства
         $info = 'c';
         break;
      case 0x1000: // FIFO канал
         $info = 'p';
         break;
      default: // неизвестный
         $info = 'u';
     }
     $info .= '.';
     // Владелец
     $info .= (($perms & 0x0100) ? 'r' : '-');
     $info .= (($perms & 0x0080) ? 'w' : '-');
     $info .= (($perms & 0x0040) ?
        (($perms & 0x0800) ? 's' : 'x' ) :
        (($perms & 0x0800) ? 'S' : '-'));
     $info .= '.';
     // Группа
     $info .= (($perms & 0x0020) ? 'r' : '-');
     $info .= (($perms & 0x0010) ? 'w' : '-');
     $info .= (($perms & 0x0008) ?
        (($perms & 0x0400) ? 's' : 'x' ) :
        (($perms & 0x0400) ? 'S' : '-'));
     $info .= '.';
     // Мир
     $info .= (($perms & 0x0004) ? 'r' : '-');
     $info .= (($perms & 0x0002) ? 'w' : '-');
     $info .= (($perms & 0x0001) ?
        (($perms & 0x0200) ? 't' : 'x' ) :
        (($perms & 0x0200) ? 'T' : '-'));
     $info .= ' ';
     $info .= substr(sprintf('%o',$perms), -4);
     ConsoleLog('$info1='.$info);
   }
   return $Result;
}
// ****************************************************************************
// *       Обыграть возможные ошибки определения прав каталога или файла      *
// ****************************************************************************
function ViewPermsHandler($errno,$errstr,$errfile,$errline)
{
   putErrorInfo('ViewPermsHandler',$errno,
      '['.ErrDeterminRights.'] '.$errstr,$errfile,$errline);
}  
   
// ********************************************************** ViewPerms.php *** 
