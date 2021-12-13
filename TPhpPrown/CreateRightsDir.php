<?php namespace prown;
// PHP7/HTML5, EDGE/CHROME                          *** CreateRightsDir.php ***
// ****************************************************************************
// * TPhpPrown                      Создать каталог (проверить существование) *
// *                                                       и задать его права *
// *                                                                          *
// * v1.0, 11.12.2021                              Автор:       Труфанов В.Е. *
// * Copyright © 2018 tve                          Дата создания:  08.12.2021 *
// ****************************************************************************

// Функция CreateRightsDir создает каталог в файловой системе сервера (сайта) и
// определяет права каталога для пользователя, для его группы и всех остальных:
// на запись, чтение и выполнение. Если каталог уже существует, то функция 
// только выполняет попытку переопределить права. В завершение работы функция 
// сравнивает права, которые установились, с правами, которые должны были 
// установиться. Если желание не совпадает с фактом, то выдается сообщение об 
// ошибке или формируется исключение.
//
// Имя каталога задается по спецификации: имя задается вместе с относительным 
// или абсолютным путем, например:
//
// $imgDir="Gallery";  Здесь явно путь не указан, поэтому новый каталог "Gallery"
// создается в каталоге из которого запущен текущий PHP-сценарий.
//
// $ImgDir=$_SERVER['DOCUMENT_ROOT'].'/Gallery';  Здесь новый каталог "Gallery"
// создается в корневом каталоге сайта.

// Синтаксис:
//
//   $Result=CreateRightsDir($Dir,$modeDir=0777,$ModeError=rvsTriggerError);
//
// Параметры:
//
//   $Dir - спецификация создаваемого каталога, то есть абсолютный или 
//      относительный путь к каталогу и имя каталога;
//   $modeDir - параметр назначения прав каталога. Это восьмеричное число,
//      состоящее из четырех цифр: первая цифра всегда равна нулю (так как 
//      указывает восьмеричное число); вторая цифра указывает разрешения для 
//      владельца каталога; третья цифра указывает разрешения для группы 
//      пользователей владельца; четвертая цифра указывает разрешения для всех 
//      остальных. Возможные значения: 1 = выполнение, 2 = право на запись,
//      4 = разрешения на чтение (суммы значений дают возможность установить
//      несколько разрешений)
//   $ModeError - режим вывода сообщений об ошибке (по умолчанию сообщение 
//      выводится через исключение с пользовательской ошибкой на сайте 
//      doortry.ru)
//
// Возвращаемое значение: 
//
//   $Result - текст сообщения об ошибке (string) при $ModeError=rvsReturn или 
//      true/false в случае успешного/неуспешного выполнения функции при 
//      $ModeError<>rvsReturn
//
// Зарегистрированные ошибки/исключения:
//   
//   ----RecalcDirectIncorrect - "Неверно указано направление пересчета";
//   ----UnitMeasureIncorrect  - "Неверно указана единица измерения"

require_once 'iniConstMem.php';
require_once 'iniErrMessage.php';
require_once 'MakeUserError.php';
 
// ****************************************************************************
// *       Создать каталог (проверить существование) и задать его права       *
// ****************************************************************************
function CreateRightsDir($Dir,$modeDir=0777,$ModeError=rvsTriggerError)
// https://habr.com/ru/sandbox/124577/ - статья про удаление каталога 
{
   $Result=true;
   // Если каталога нет, то будем создавать его
   ConsoleLog('$Dir='.$Dir); 
   if (!is_dir($Dir))
   // Каталога нет, будем создавать его
   {
      ConsoleLog('Каталога нет, будем создавать его!');
      set_error_handler("prown\CreateRightsHandler");
      //$is=@mkdir($Dir); 
      $is=mkdir($Dir);
      //print_r(error_get_last()); 
      restore_error_handler();
      $a=error_get_last();
      if ($a==null) ConsoleLog('У null длины нет');
      else          ConsoleLog('Длина $a='.count($a));
      // Создаем каталог
      if (!$is)
      {
         // Отмечаем ошибку создания каталога - Directory creation error по 
         // одной из причин:
         // а) неправильно указана спецификация каталога (например, в пути или
         // в названии каталога присутствуют запрещенные символы)
         ConsoleLog(DirСreateError.': '.$Dir);
         //$Result=MakeUserError(DirСreateError.': '.$Dir,'TPhpPrown',$ModeError);
      }
      // И отдельно (чтобы сработало на старых Windows) задаем права
      else
      {
         if (!chmod($Dir,$modeDir))
         {
           ConsoleLog('Ошибка назначения прав каталога: '.$Dir);
         }
      }
   }
   // Если каталог существует, то будем проверять его права
   else
   {
      ConsoleLog('Каталог существует, будем проверять его права!'); 
   }
   return $Result;
}


function CreateRightsHandler($errno,$errstr,$errfile,$errline)
{
   ConsoleLog('$errno='.$errno);
   ConsoleLog('$errstr='.$errstr);
   ConsoleLog('$errfile='.$errfile);
   ConsoleLog('$errline='.$errline);
   putErrorInfo('CreateRightsHandler',$errno,$errstr,$errfile,$errline);
   // Если error_reporting нулевой, значит, использован оператор @,
   // все ошибки должны игнорироваться
   if (!error_reporting()) 
   {
      ConsoleLog(NoErrReporting);
      return true;
   }
   else
   {
      // Отлавливаем ошибку "Неверно указано название каталога"
      // "Directory name is incorrect"
      $Find='No such file or directory';
      $Resu=Findes('/'.$Find.'/u',$errstr); 
      if ($Resu==$Find) 
      {
         ConsoleLog(DirNameIncorrect);
      }
      // Обобщаем остальные ошибки
      else 
      {
         ConsoleLog(DirСreateError);
         return false;
      }
   }
}  


/*
function is_octal($x) 
{
   return !(decoct(octdec($x)) == $x);
   
   // В следующих примерах показан вывод значений в консоль:
   
   $x=0123;
   prown\ConsoleLog(decoct(octdec($x)));     // =   3
   prown\ConsoleLog($x);                     // =  83
   $x=123;
   prown\ConsoleLog(decoct(octdec($x)));     // = 123
   prown\ConsoleLog($x);                     // = 123
   
}
*/

/*
function CreateRightsDir($Dir,$modeDir=0777,$ModeError=rvsTriggerError)
// https://habr.com/ru/sandbox/124577/ - статья про удаление каталога 
{
   $Result=true;
   //MakeUserError(DirNameIncorrect.': '.$Dir,'TPhpPrown----',rvsTriggerError);
   // Если каталога нет, то будем создавать его
   ConsoleLog('$Dir='.$Dir); 
   if (!is_dir($Dir))
   // Каталога нет, будем создавать его
   {
      $errs=35;
      ConsoleLog('Каталога нет, будем создавать его!');
      //set_error_handler('prown\CreateRightsHandler',$errstri);
      //set_error_handler('prown\CreateRightsHandler');
      //$is=@mkdir($Dir); 
      $is=mkdir($Dir); 
      ConsoleLog('Привет! '.sayLogic($is));
      //ConsoleLog('Привет! '.prown\sayLogic($is));
      
      // Создаем каталог
      //set_error_handler("CreateRightsHandler");

      
      if (!mkdir($Dir))
      {
         // Отмечаем ошибку создания каталога - Directory creation error по 
         // одной из причин:
         // а) неправильно указана спецификация каталога (например, в пути или
         // в названии каталога присутствуют запрещенные символы)
         ConsoleLog(DirСreateError.': '.$Dir);
         // Отмечаем ошибку "Неверно указано направление пересчета"
         //$Result=MakeUserError(DirСreateError.': '.$Dir,'TPhpPrown',$ModeError);
      }
      // И отдельно (чтобы сработало на старых Windows) задаем права
      else
      {
         if (!chmod($Dir,$modeDir))
         {
           ConsoleLog('Ошибка назначения прав каталога: '.$Dir);
         }
      }
      
   }
   // Если каталог существует, то будем проверять его права
   else
   {
      ConsoleLog('Каталог существует, будем проверять его права!'); 
   }
   return $Result;
}

*/


// **************************************************** CreateRightsDir.php ***
