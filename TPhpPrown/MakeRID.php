<?php namespace prown; 
                                         
// PHP7/HTML5, EDGE/CHROME                                  *** MakeRID.php ***

// ****************************************************************************
// * TPhpPrown                Сформировать RID - идентификатор читателя сайта *
// *                                                                          *
// * v1.0, 07.01.2022                              Автор:       Труфанов В.Е. *
// * Copyright © 2022 tve                          Дата создания:  07.01.2022 *
// ****************************************************************************

// Замечание: 
//
//   --- Параметры страницы сайта хранятся либо в кукисах браузера, либо в 
//   сохраняемых переменных на диске компьютера пользователя.
//   На 30.05.2019 параметры страницы сайта хранятся в кукисах.

// Синтаксис:
//
//   $Result=MakeRID();

// Параметры:
//
//   -$Name  - имя параметра страницы сайта (как правило, по имени параметра 
//      формируется глобальная переменная сайтовой страницы добавлением префикса
//      "p_". Например: "FormNews" --> "$p_FormNews");
//   -$Value - значение параметра страницы сайта;
//   -$Type  - константа, определяющая тип значения: tArr, tObj, tInt, tFloat, 
//      tStr, tBool, tNull. По умолчанию - tInt.

// Возвращаемое значение: 
//
// -$Result  - установленное значение параметра страницы сайта и соответствующей
//      переменной в сценарии сайтовой страницы

require_once "getBrowscap.php";

function MakeRID()
{
    $Result='';
    // 'platform'
    $Result.=getBrowscap('platform');
    // два символа 'browser'
    $Result.=get2signs(getBrowscap('browser'));
    // 'majorver'
    $Result.=getBrowscap('majorver');
    // два символа 'device_type'
    $Result.=get2signs(getBrowscap('device_type'));
    // измененный ip-адрес
    $Result.=getIPsigns();
    return $Result;
}
// Выбрать 2 первых символа строки
function get2signs($str)
{
    $substr=substr($str,0,2);
    return $substr;
}
// Заменить разделители ip-адреса на "-"
function getIPsigns()
{
   return str_replace(['.',':'],'-',$_SERVER['REMOTE_ADDR']);
}

// Сформировать NumRID - нумерованный идентификатор читателя сайта - спецификацию
// нового файла, который будет создан в файловой системе сервера
function MakeNumRID($DirFile,$PostFix,$ExtFile,$isNum=false)
{
   // Изначально назначаем префикс имени файла в соответствии с RID 
   $PrefName=MakeRID(); $PrefNameOut=$PrefName;
   if ($isNum)
   {
      // Проверяем наличие ненумерованного RID-файла
      $is=isNumFile($PrefName,$DirFile,$PostFix,$ExtFile,null);
      // Если ненумерованный RID-файл есть, удаляем его и создаем
      // имя RID-файла с номером "9"
      if ($is) $PrefNameOut=MakeNumFile($PrefName,$DirFile,$PostFix,$ExtFile,null);
      // Иначе, перебираем спецификации всех возможных нумерованных RID-файлов 
      // (9,8,7,6,5,4,3,2,1)
      else
      {
         $i=9;
         while ($i>0) 
         {
            $is=isNumFile($PrefName,$DirFile,$PostFix,$ExtFile,$i);
            // Если нумерованный RID-файл есть, удаляем его и создаем
            // имя RID-файла с номером ниже
            if ($is) 
            {
               $PrefNameOut=MakeNumFile($PrefName,$DirFile,$PostFix,$ExtFile,$i);
               break;
            }
            $i=$i-1; 
         }
      }
   }
   return $PrefNameOut;
}

// Проверяем по спецификации, есть ли указанный RID-файл
function isNumFile($PrefName,$DirFile,$PostFix,$ExtFile,$i)
{
   $is=false;
   // Формируем спецификацию файла для проверки существования
   $NameFile=$PrefName.$PostFix;
   if ($i<>null) $NameFile=$PrefName.strval($i).$PostFix;
   $SpecFile=$DirFile.'/'.$NameFile.'.'.$ExtFile;
   // Проверяем существование файла
   if (file_exists($SpecFile)) 
   {
      $is=true;
   }
   return $is;
}
// Так как нумерованный RID-файл есть, то удаляем его и создаем
// имя RID-файла с номером ниже
function MakeNumFile($PrefName,$DirFile,$PostFix,$ExtFile,$i)
{
   // Формируем спецификацию файла для удаления
   $NameFile=$PrefName.$PostFix;
   if ($i==null) 
   {
      $NameFile=$PrefName.$PostFix;          
      $DeleFile=$DirFile.'/'.$NameFile.'.'.$ExtFile;
      $PrefNameOut=$PrefName.'9';      
   }
   else if ($i==1) 
   {
      $NameFile=$PrefName.'1'.$PostFix;          
      $DeleFile=$DirFile.'/'.$NameFile.'.'.$ExtFile;
      $PrefNameOut=$PrefName;      
   }
   else
   {
      $NameFile=$PrefName.$i.$PostFix;      
      $DeleFile=$DirFile.'/'.$NameFile.'.'.$ExtFile;
      $PrefNameOut=$PrefName.strval($i-1);      
   }
   if (file_exists($DeleFile)) unlink($DeleFile);
   return $PrefNameOut;
}
// ************************************************************ MakeRID.php ***
 
