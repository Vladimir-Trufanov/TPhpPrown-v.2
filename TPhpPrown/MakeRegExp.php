<?php namespace prown;

// PHP7/HTML5, EDGE/CHROME                               *** MakeRegExp.php ***

// ****************************************************************************
// * TPhpPrown     Отработать регулярное выражение на тексте и оттрассировать *
// *               разбор. Рекомендуется использовать только для трассировки. *
// * Для выборки подстроки по регулярному выражению следует пользоваться дру- *
// * гими функциями (например, Findes).
// *                                                                          *
// * v1.1, 21.05.2019                              Автор:       Труфанов В.Е. *
// * Copyright © 2018 tve                          Дата создания:  02.04.2018 *
// ****************************************************************************

// Функция предназначена для проверки и отладки регулярных выражений. Она
// надстроена над функцией PHP: preg_match_all. MakeRegExp запускает указанное 
// регулярное выражение по требуемому тексту и показывает все найденные 
// фрагменты текста в соответствии с регулярным выражением. 
// MakeRegExp может использоваться для настройки функции Findes перед встраиваем
// её в код сценария PHP.

require_once "iniConstMem.php";
require_once "iniErrMessage.php";
require_once "MakeUserError.php";

// Синтаксис:
//
//   MakeRegExp($pattern,$text,&$matches=null,$isTrass=mriIsDeprecated);

// Параметры:
//
//   $pattern - текст регулярного выражения;
//   $text    - текст, который должен быть обработан регулярным выражением;
//   $matches - массив найденных фрагментов и позиций их начала после работы
//      регулярного выражения (параметр по ссылке);
//   $isTrass - режим трассировки найденных соответствий регулярному выражению:
//
//   mriStandTracing - трассировка результатов стандартным выводом;
//   mriInstallTrace - установленная трассировка MakeRegExp
//   mriTracingBlock - трассировка заблокирована
//   mriIsDeprecated - разбор и сообщение устаревшего использования (по умолчанию)

/// Возвращаемое значение: 
//
//   $Result  - количество найденных соответствий регулярному выражению.
//      $Result=0, если соответствий не найдено. 

// Зарегистрированные ошибки/исключения:
//   
//   FetchStrObsolete - "Устарела выборка подстроки регулярным выражением".

// ****************************************************************************
// *  Выполнить функцию preg_match_all, при необходимости, отттрассировать ее *
// ****************************************************************************
function MakeRegExp($pattern,$text,&$imatches=null,$isTrass=mriIsDeprecated)
{
   $Prefix='TPhpPrown';
   
   // Ошибки:
   // Warning: preg_match_all(): No ending delimiter '/' found in 
   //        C:\Webservers\kwinflat-ru\www\TPHPPROWN\regx.php on line 17
   // Warning: preg_match_all(): Delimiter must not be alphanumeric or backslash in 
   //        C:\Webservers\kwinflat-ru\www\TPHPPROWN\regx.php on line 20
   
   // Готовим массив результатов
   if ($imatches===null) $matches=array(); 
   else $matches=$imatches;
   // Выполняем регулярное выражение и получаем результаты поиска
   $Result=preg_match_all($pattern,$text,$matches,PREG_OFFSET_CAPTURE);
   // Выводим исходные данные трассировки
   if (($isTrass==mriStandTracing)||($isTrass==mriInstallTrace))
   {
      echo '<br>'.'$text: <strong>'.$text.'</strong>';
      echo '<br>'.'$pattern: <strong>'.$pattern.'</strong><br>';
   }
   // Выполняем трассировку результатов стандартным выводом
   if ($isTrass==mriStandTracing)
   {
      echo 'mriStandTracing:<br>';
      print_r($matches); 
   }
   // Выполняем установленную трассировка MakeRegExp
   if ($isTrass==mriInstallTrace)
   {
      echo 'mriInstallTrace:';
      // Показываем нулевой результат, если поиск неудачный  
      if ($Result==0)
      {
         echo '<br>'.'$Result=0';
      }
      // Формируем и показываем массив найденных  результатов: 
      // что найдено и позиция
      else 
      {
         for ($i=0; $i<count($matches); $i++)
		   {
            $findes=$matches[$i];    
            for ($j=0; $j<count($findes); $j++)
            {
               echo '<br>'.
               '$matches['.$i.']['.$j.'][0] = <strong>'.$matches[$i][$j][0].'</strong> ... '.
               '$matches['.$i.']['.$j.'][1] = <strong>'.$matches[$i][$j][1].'</strong>';
            }
         }
      }
   }
   // Если трассировка не нужна, то выдаем сообщение:
   // "Устарела выборка подстроки регулярным выражением"
   if ($isTrass==mriIsDeprecated)
   {
      MakeUserError(FetchStrObsolete,'TPhpPrown',rvsCurrentPos,E_USER_DEPRECATED);
   }
   // Возвращаем результат регулярного выражения
   $imatches=$matches;
   return $Result;
}
// ********************************************************* MakeRegExp.php ***
