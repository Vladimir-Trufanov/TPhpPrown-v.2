<?php namespace prown; 
                                         
// PHP7/HTML5, EDGE/CHROME                               *** ViewGlobal.php ***

// ****************************************************************************
// *                  Показать значения глобальных переменных                 *
// ****************************************************************************

//                                                   Автор:       Труфанов В.Е.
//                                                   Дата создания:  30.01.2018
// Copyright © 2018 TVE                              Посл.изменение: 24.05.2019
         
// PHP7/HTML5, EDGE/CHROME                              *** MakeSession.php ***

// ****************************************************************************
// * TPhpPrown      Установить новое значение сессионной переменной и вернуть *
// *                его для изменения глобальной переменной сайтовой страницы *
// *                                                                          *
// * v1.0, 25.05.2018                              Автор:       Труфанов В.Е. *
// * Copyright © 2019 tve                          Дата создания:  25.05.2019 *
// ****************************************************************************

// Синтаксис:
//
//   $Result=MakeSession($Name,$Value,$Type);

// Параметры:
//
//   ---$Value  - значение переменной, которое следует привести к заданному типу;
//   ---$Type   - константа, определяющая тип значения: array, object, integer,
//      double, string, boolean, null.

// Возвращаемое значение: 
//
//   ---$Result  - переданное значение функции заданного типа или null, если тип
//      значения указан неверно

//require_once "MakeType.php";
require_once "iniConstMem.php";
require_once "CommonPrown.php";

define ('avgAll',    0);    // Все массивы
define ('avgCOOKIE', 1);    // Массив значений $_COOKIE, переданных скрипту через HTTP Cookies
define ('avgENV',    2);    // Массив значений, переданных скрипту через переменные окружения \$_ENV
define ('avgFILES',  4);    // Элементы $_FILES, загруженные в текущий скрипт через метод HTTP POST
define ('avgGET',    8);    // Массив параметров $_GET, явно переданных скрипту через URL 
define ('avgGLOBALS',16);   // Ссылки на все переменные глобальной области видимости $GLOBALS 
define ('avgPOST',   32);   // Массив параметров, скрыто переданных скрипту $_POST 
define ('avgREQUEST',64);   // Массив \$_REQUEST, по умолчанию содержащий переменные \$_GET,\$_POST,\$_COOKIE
define ('avgSESSION',128);  // Переменные сессии, которые доступны для текущего скрипта $_SESSION
define ('avgSERVER', 256);  // Информация о сервере и среде исполнения $_SERVER
define ('avgWORKSPACE', 528);  // Переменные рабочего пространства $_WORKSPACE

// Вывести шапку таблицы                          
function ViewCaption($Caption)
{
    echo "<h2>".$Caption."</h2>";
    echo '<table>';
    echo "<tr>";
    echo "<th>ПАРАМЕТР</th>";
    echo "<th> </th>";
    echo "<th>ЗНАЧЕНИЕ</th>";
    echo "</tr>";
}
// Вывести строку массива
function ViewLineMiddle($Name,$key,$ivalue)
{
    // Обрабатываем ситуацию, когда значением является массив -
    // в этом случае просто формируем текст 'array'
    if (gettype($ivalue)==tArr) $value=tArr;
    else $value=$ivalue;
    // Выводим строку массива
    echo "<tr>";
    echo "<td>".$Name." [\"".$key."\"]"."</td>";
    echo "<td>".'&nbsp;'."</td>";
    echo "<td>".$value."</td>";
    echo "</tr>";
}
// Вывести данные массива кукисов с блокировкой "PHPSESSID"
function ViewCookieMiddle($aArray,$Name)
{
    foreach($aArray as $key => $value)
    {
        if (!(($key=="PHPSESSID")
            ))
        { 
            ViewLineMiddle($Name,$key,$value);
        }
    }
}
// Вывести данные массива с блокировкой суперглобальных переменных
function ViewGlobalMiddle($aArray,$Name)
{
    foreach($aArray as $key => $value)
    {
        if (!(($key=='_GET')
            ||($key=='_POST')
            ||($key=='_COOKIE')
            ||($key=='_FILES')
            ||($key=='_SERVER')
            ||($key=='_SESSION')
            ||($key=='GLOBALS')
            ||($key=='_REQUEST')
            ||($key=='_WORKSPACE')
            ))
        { 
            ViewLineMiddle($Name,$key,$value);
        }
    }
}
// Вывести данные массива
function ViewMiddle($aArray,$Name)
{
    // Если требуется вывод кукисов, то выводим их отдельной
    // функцией с блокировкой переменной "PHPSESSID"
    if ($Name=="\$_COOKIE") 
    {
        ViewCookieMiddle($aArray,$Name);
    }
    // Если требуется вывод глобальных переменных, то выводим их отдельной
    // функцией с блокировкой суперглобальных переменных
    else if ($Name=="\$GLOBALS") 
    {
        ViewGlobalMiddle($aArray,$Name);
    }
    // Иначе выводим массив в обычном режиме
    else
    {
        foreach($aArray as $key => $value)
        {
            ViewLineMiddle($Name,$key,$value);
        }
    }
    
}
// Вывести подвал таблицы                      
function ViewEnd()
{
    echo "</table>";
}

// Вывести таблицу                      
function ViewArr($Caption,$aArray,$Name)
{
    ViewCaption($Caption); 
    ViewMiddle($aArray,$Name); 
    ViewEnd();
}

// Показать значения глобальных переменных 
function ViewGlobal($Parm,$_Array=null)
{
    //Alert('$Parmi',$Parm);
    if ($Parm==avgCOOKIE)
    {
        ViewArr("Массив значений \$_COOKIE, переданных скрипту через HTTP Cookies",$_COOKIE,"\$_COOKIE");
    }
    elseif ($Parm==avgWORKSPACE)
    {
       ViewArr("Массив значений \$_WORKSPACE - переменных рабочего пространства",$_Array,"\$_WORKSPACE");
    }
    elseif ($Parm==avgGET)
    {
        ViewArr("Массив параметров \$_GET, явно переданных скрипту через URL",$_GET,"\$_GET");
    }
    elseif ($Parm==avgGLOBALS)
    {
        ViewArr("Массив значений глобальных переменных страницы сайта",$GLOBALS,"\$GLOBALS");
    }
    elseif ($Parm==avgREQUEST)
    {
        ViewArr("Массив \$_REQUEST, содержащий переменные \$_GET, \$_POST, \$_COOKIE",$_REQUEST,"\$_REQUEST");
    }
    
    elseif ($Parm==avgSESSION)
    {
        if (IsSet($_SESSION))
        ViewArr("Переменные сессии, которые доступны для текущего скрипта \$_SESSION",$_SESSION,"\$_SESSION");
        else echo 'Нет $_SESSION!<br>';
    }
    elseif ($Parm==avgFILES)
    {
        //if (IsSet($_FILES))
        ViewArr("Элементы \$_FILES, загруженные в текущий скрипт через метод HTTP POST",$_FILES,"\$_FILES");
        
      /*        
      $i=0;
      $families = [["Tom", "Alice"], ["Bob", "Kate"], ["Sam", "Mary"]];
      $families = (array) $_FILES;
      foreach ($families as $family)
      {
         $j=0;
         foreach ($family as $user)
         {
            \prown\ConsoleLog('$i-$j='.$i.'-'.$j); 
            \prown\ConsoleLog('$user='.$user); 
            $j=$j+1;
         }
         $i=$i+1;
      }
      */

        
        //else echo 'Нет загруженных файлов!<br>';
    }
    elseif ($Parm==avgPOST)
    {
        //if (IsSet($_FILES))
        ViewArr("Массив параметров, скрыто переданных скрипту \$_POST",$_POST,"\$_POST");
        //else echo 'Нет загруженных файлов!<br>';
    }
    elseif ($Parm==avgSERVER)
    {
        if (IsSet($_SERVER))
        ViewArr("Информация о сервере и среде исполнения \$_SERVER",$_SERVER,"\$_SERVER");
        else echo 'Нет $_SERVER!<br>';
    }
}



/*
The problem occurs when you have a form that uses both single file and HTML array feature. 
The array isn't normalized and tends to make coding for it really sloppy. 
I have included a nice method to normalize the $_FILES array.

<?php
  function normalize_files_array($files = []) {
    $normalized_array = [];
	foreach($files as $index => $file) {
      if (!is_array($file['name'])) {
        $normalized_array[$index][] = $file;
        continue;
      }
      foreach($file['name'] as $idx => $name) {
        $normalized_array[$index][$idx] = [
          'name' => $name,
          'type' => $file['type'][$idx],
          'tmp_name' => $file['tmp_name'][$idx],
          'error' => $file['error'][$idx],
          'size' => $file['size'][$idx]
        ];
      }
    }
    return $normalized_array;
  }
?>
*/


// ViewArr("Массив значений, переданных скрипту через переменные окружения \$_ENV",$_ENV,"\$_ENV");
// ViewArr("Ссылки на все переменные глобальной области видимости \$GLOBALS",$GLOBALS,"\$GLOBALS");

// ********************************************************* ViewGlobal.php ***

