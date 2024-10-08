<?php namespace prown;

// PHP7/HTML5, EDGE/CHROME                            *** iniErrMessage.php ***
// ****************************************************************************
// * TPhpPrown                          Определить общие сообщения библиотеки *
// *                                                                          *
// * v1.4, 18.12.2021                              Автор:       Труфанов В.Е. *
// * Copyright © 2019 tve                          Дата создания:  26.01.2019 *
// ****************************************************************************

// Модуль собирает в одном файле константы, соответствующие пользовательским 
// ошибочным сообщениям и предупреждениям со всех функций библиотеки.

// CreateRightsDir:                   Создать каталог (проверить существование) 
//                                                           и задать его права 
define ("DirСreateError",    "Ошибка создания каталога");
define ("DirNameIncorrect",  "Неверно указано название каталога");
define ("DirRightsNoAssign", "Ошибка назначения прав каталога");
define ("NoDeterminRights",  "Ошибка определения прав каталога");
define ("NoErrReporting",    "Указан оператор @, ошибки отключены");
define ("NonWellNumeric",    "Некорректное числовое значение в правах каталога");
define ("RightsDonotMatch",  "Установленные и желаемые права не совпадают");

// isCalcInBrowser: Проанализировать UserAgent браузера по версиям родительских
//                      браузеров и определить работает ли функция Calc для CSS
define ("ManyBrowsersRec", "В UserAgent присутствует несколько браузеров");
define ("InverBrowsers",   "Неверная или отсутствует версия браузера");

// MakeCookie:       Установить новое значение COOKIE в браузере, заменить этим 
//              значением соответствующее данное во внутреннем массиве $_COOKIE
//                    и установить новое значение переменной-кукиса в программе
define ("CantСookiesToType", "Невозможно привести кукис к указанному типу");
define ("SendCookieFailed",  "Отправка кукиса потерпела неудачу");

// MakeRegExp:       Отработать регулярное выражение на тексте и оттрассировать 
//                   разбор. Рекомендуется использовать только для трассировки.
//  Для выборки подстроки по регулярному выражению следует пользоваться Findes.
define ("FetchStrObsolete", "Устарела функция выборки подстроки MakeRegExp");

// MakeType:                            Преобразовать значение к заданному типу 
define ("ConversNotPossible", "Неверный тип значения или преобразование невозможно");

// MakeUserError:       Cгенерировать ошибку/исключение или просто сформировать 
//                               сообщение об ошибке в системе обработки ошибок
define ("WrongTypeError",   "Неверно указан тип ошибки");

// RecalcSizeInfo:             Изменить представление информации о размерности, 
//                то есть пересчитать число байт в число килобайт или кибибайт,
//                мегабайт или мебибайт, ... или пересчитать в обратную сторону
define ("RecalcDirectIncorrect",   "Неверно указано направление пересчета");
define ("UnitMeasureIncorrect",    "Неверно указана единица измерения");

// ViewPerms:                    Подготовить строку для показа параметров файла  
//                                                                 или каталога 
define ("ErrDeterminRights",     "Ошибка определения прав каталога или файла");

// ****************************************************** iniErrMessage.php *** 

