<?php namespace prown;

// PHP7/HTML5, EDGE/CHROME                            *** ChangeDimInfo.php ***
// ****************************************************************************
// * TPhpPrown               Изменить представление информации о размерности, *
// *            то есть пересчитать число байт в число килобайт или кибибайт, *
// *            мегабайт или мебибайт, ... или пересчитать в обратную сторону *
// *                                                                          *
// * v1.0, 08.09.2021                              Автор:       Труфанов В.Е. *
// * Copyright © 2018 tve                          Дата создания:  08.09.2021 *
// ****************************************************************************

// 

// Синтаксис:
//
//   $Result=MakeType($Value,$Type,$ModeError=rvsTriggerError);

// Параметры:
//
//   $Value - значение переменной, которое следует привести к заданному типу;
//   $Type - константа, определяющая тип значения: integer, double, string,
//      boolean.
//   $ModeError - режим вывода сообщений об ошибке (по умолчанию через 
//      исключение с пользовательской ошибкой на сайте doortry.ru)

// Возвращаемое значение: 
//
//   $Result - значение, переданное функции и преобразованное к заданному типу
//      или null, если тип значения указан неверно или преобразование невозможно
//
// Зарегистрированные ошибки/исключения:
//   
//   ConversNotPossible - "Тип значения указан неверно или преобразование невозможно";

//require_once 'iniConstMem.php';
//require_once 'iniErrMessage.php';
//require_once 'MakeUserError.php';

function ChangeDimInfo($Value,$Direct,$Dim,$ModeError=rvsTriggerError)
{
   $Result=Ok;
   return $Result;
}

function formatBytes($size, $precision = 2)
{
    $base = log($size, 1024);
    $suffixes = array('', 'K', 'M', 'G', 'T');   

    return round(pow(1024, $base - floor($base)), $precision) .' '. $suffixes[floor($base)];
}

//echo formatBytes(24962496);
// 23.81M

//echo formatBytes(24962496, 0);
// 24M

//echo formatBytes(24962496, 4);
// 23.8061M

function memoryInBytes($value) 
{
    $unit = strtolower(substr($value, -1, 1));
    return (int) $value * pow(1024, array_search($unit, array(1 =>'k','m','g')));
}

// ****************************************************** ChangeDimInfo.php *** 
