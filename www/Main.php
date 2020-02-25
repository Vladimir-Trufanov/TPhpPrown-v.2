<?php
// PHP7/HTML5, EDGE/CHROME                                     *** Main.php ***

// ****************************************************************************
// * TPhpPrown-test                   Кто прожил жизнь, тот больше не спешит! *
// ****************************************************************************

//                                                   Автор:       Труфанов В.Е.
//                                                   Дата создания:  13.01.2019
// Copyright © 2019 tve                              Посл.изменение: 23.02.2020

// Подключаем файлы библиотеки прикладных модулей и рабочего пространства
$TPhpPrown=$SiteHost.'/TPhpPrown';
require_once $TPhpPrown."/TPhpPrown/CommonPrown.php";
require_once $TPhpPrown."/TPhpPrown/Findes.php";
require_once $TPhpPrown."/TPhpPrown/getTranslit.php";
require_once $TPhpPrown."/TPhpPrown/iniConstMem.php";
require_once $TPhpPrown."/TPhpPrown/isCalcInBrowser.php";
require_once $TPhpPrown."/TPhpPrown/MakeCookie.php";
require_once $TPhpPrown."/TPhpPrown/MakeType.php";
require_once $TPhpPrown."/TPhpPrown/ViewGlobal.php";
// Подключаем модуль обеспечения тестов
require_once $TPhpPrown."/TPhpPrownTests/FunctionsBlock.php";
?>
<!DOCTYPE html>
<html>
<head>
<title>TPhpPrown - библиотека PHP-прикладных функций</title>
<meta charset="utf-8">
<link href="https://fonts.googleapis.com/css?family=Anonymous+Pro:400,400i,700,700i&amp;subset=cyrillic" rel="stylesheet">

<link rel="stylesheet" type="text/css" 
   href="https://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.3/themes/ui-lightness/jquery-ui.css">
<script
   src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.2.min.js">
</script>
<script 
   src="https://ajax.aspnetcdn.com/ajax/jquery.ui/1.11.2/jquery-ui.min.js">
</script>
<script src="/TPhpPrownTests.js"> </script>
</head>
<body>

<?php
// Определяем сайтовые константы
define ("ChooseAll",  "Выбрать все элементы"); // Первая кнопка Submit  
define ("ToTest",     "Протестировать");       // Вторая кнопка Submit 
define ("ChoiceList", "Укажите список прикладных функций библиотеки TPhpPrown"); 
// Инициализируем список прикладных функций библиотеки TPhpPrown 
// и рабочего пространства сайта
$aPhpPrown=array
(            
   'iniWorkSpace'   =>'cформировать массив параметров рабочего пространства сайта',   
   'Findes'         =>'выбрать из строки подстроку, соответствующую регулярному выражению',   
   'isCalcInBrowser'=>'определить по родительским браузерам работает ли функция Calc для CSS',   
   'MakeCookie'     =>'установить новое значение COOKIE в браузере и в массиве $_COOKIE',
   'MakeType'       =>'преобразовать значение к заданному типу',
   'MakeUserError'  =>'cгенерировать ошибку/исключение или просто сформировать сообщение об ошибке',
);
// ---
//phpinfo();
//echo $SiteRoot.'<br>';
//echo $SiteHost.'<br>';
//echo $TPhpPrown.'<br>';
//echo $UserAgent.'<br>';
//prown\ViewGlobal(avgSERVER);
// ---

$TestsWere=false;
// ****************************************************************************
// *            Вывести список прикладных функций библиотеки TPhpPrown        *
// ****************************************************************************

// Выводим форму для следующего тестирования, которая предоставляет пользователю
// несколько вариантов выбора: 

// все флажки имеют одно имя (formDoor[]). Одно имя говорит о том, 
// что все флажки связаны между собой. Квадратные скобки указывают на то, 
// что все значения будут доступны из одного массива. 
// То есть $_POST['formDoor'] возврашает массив, содержащий значения флажков, 
// которые были выбраны пользователем.
// 
// С помощью кнопки "Выбрать всё" и запроса соответствующего типа
// http://localhost:84/index.php?
//    formSubmit=%D0%92%D1%8B%D0%B1%D1%80%D0%B0%D1%82%D1%8C+%D0%B2%D1%81%D1%91
//    &
//    formDoor%5B%5D=Findes можно выбрать все флажки

if (prown\isComRequest(ChooseAll,'formSubmit'))
{
   //echo 'Test1<br>';
   FunctionsCheckbox($aPhpPrown,ChooseAll,ChoiceList);
}
else if (prown\isComRequest(ToTest,'formSubmit'))
{
   // Вырисовываем чекбоксы для тестирования
   FunctionsCheckbox($aPhpPrown,ToTest,ChoiceList);
   //echo 'Test2<br>';
   // Запускаем тестирование
   MakeTest($SiteRoot,$aPhpPrown);
   $TestsWere=true;
}
else
{
   //echo 'Test3<br>';
   // Вырисовываем чекбоксы 
   FunctionsCheckbox($aPhpPrown,ToTest,ChoiceList);
}
?>
<a target="_blank" href="#"><img src="89.gif" ></a>
<!-- 
<a target="_blank" href="#">
<img src="http://s14.rimg.info/89ec86760c43451421aef6bd4dbd2c65.gif" ></a>
<a target="_blank" href="http://smayliki.ru/smilie-873369351.html">
<img src="http://s14.rimg.info/89ec86760c43451421aef6bd4dbd2c65.gif" ></a>
-->
<?php
if (!($TestsWere)) echo 'УРА!</body></html>';
 
// *************************************************************** Main.php ***
