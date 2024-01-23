<?php namespace prown;

// PHP7/HTML5                                              *** Replaces.php ***
// ****************************************************************************
// * TPhpPrown                                    Заменить фрагмент в тексте  *
// *                                      неявным общим регулярным выражением *
// *                                                                          *
// * v1.0, 23.01.2024                              Автор:       Труфанов В.Е. *
// * Copyright © 2024 tve                          Дата создания:  23.01.2024 *
// ****************************************************************************

// Функция заменяем заданный фрагмент в тексте через явное задание его начальных 
// символов и завершающих на новый фрагмент. 
//
// Замечание: Функция Replaces надстроена над функцией PHP: preg_replace и 
// находит "жадный", то есть наидлинный фрагмент с заданными начальными и 
// завершающими символами с помощью наиболее общего регулярного выражения:
// define ("regMostCommon",'([0-9a-zA-Zа-яёА-ЯЁ><!=":;,%\[\]\{\}\/\-\.\s\n\r\$\^\*\+\?\\\|\(\)]+)');
// 
// При указании начальных символов заменяемого фрагмента и завершающих следует 
// экранировать специальные символы. Новый фрагмент формируется "как есть".
//
// Специальные символы следует экранировать обратной наклонной чертой (обратным слэшем) "\"
//
// Спецсимволы, которые следует экранировать:             $ ^ . * + ? \ { } [ ] ( ) |
// по опыту tve (22.01.2024) экранировать:                -
// если ограничитель рег.выражения / , то экранировать:   /
// экранировать пробел, перевод строки, возврат каретки:  \s \n \r
//
// Не являются спецсимволами:                             // @ : , ' " ; - _ = < > % # ~ ` & ! /

// Синтаксис:                                     
//
//   $Result=Replaces($begreg,$text,$endreg,$newfrag);

// Параметры:
//
//   $begreg  - регулярное выражение начала заменяемого фрагмента текста;
//   $text    - текст, в котором должен быть вырезан заданный фрагмент и вставлен новый; 
//   $endreg  - регулярное выражение завершения заменяемого фрагмента текста; 
//   $newfrag - текст нового фрагмента текста.

// Возвращаемое значение: 
// 
//   $Result  - измененный текст после работы регулярного выражения 

// Пример работы функции: 

/*
// Задаем текст, в котором следует заменить фрагменты
$Text=
'<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="" xml:lang="">
<head>
  <meta charset="utf-8" />
  <meta name="generator" content="pandoc" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
  <title>Untitled</title>
  <style type="text/css">
      code{white-space: pre-wrap;}
      span.smallcaps{font-variant: small-caps;}
      span.underline{text-decoration: underline;}
      div.line-block{white-space: pre-line;}
      div.column{display: inline-block; vertical-align: top; width: 50%;}
  </style>
  <!--[if lt IE 9]>
    <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv-printshiv.min.js"></script>
  <![endif]-->
</head>
<body>
Hello World!
</body>
</html>
';
*/

/*
// Заменяем текст второй строки на <html>
$beg='<html';
$endreg='lang="">';
$newfrag='<html>';
echo prown\Replaces($beg,$Text,$endreg,$newfrag);
*/

/*
// На место трех строк meta вставляем только первую
$beg='<meta';
$endreg='"\s\/>';
$newfrag='<meta charset="utf-8" />';
echo prown\Replaces($beg,$Text,$endreg,$newfrag);
*/

/*
// Убираем все строки стиля (включая возврат каретки и перевод строки вначале)
$begreg='\/title>';
$endreg='\/style>';
$newfrag='/title>';
echo prown\Replaces($begreg,$Text,$endreg,$newfrag);
*/

require_once "iniRegExp.php";
function Replaces($begreg,$text,$endreg,$newfrag)
{
   $Result=preg_replace('/'.$begreg.regMostCommon.$endreg.'/u',$newfrag,$text);
   return $Result;
}
// ************************************************************* Findes.php ***

