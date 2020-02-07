<?php
// PHP7/HTML5, EDGE/CHROME                                     *** Main.php ***

// ****************************************************************************
// * TPhpPrown-test                   Кто прожил жизнь, тот больше не спешит! *
// ****************************************************************************

//                                                   Автор:       Труфанов В.Е.
//                                                   Дата создания:  13.01.2019
// Copyright © 2019 tve                              Посл.изменение: 31.01.2020

// Подключаем файлы библиотеки прикладных модулей и рабочего пространства

$TPhpPrown=$SiteHost.'/TPhpPrown';
require_once $TPhpPrown."/TPhpPrown/CommonPrown.php";
require_once $TPhpPrown."/TPhpPrown/Findes.php";
require_once $TPhpPrown."/TPhpPrown/getTranslit.php";
require_once $TPhpPrown."/TPhpPrown/iniConstMem.php";
require_once $TPhpPrown."/TPhpPrown/isCalcInBrowser.php";
require_once $TPhpPrown."/TPhpPrown/MakeType.php";
require_once $TPhpPrown."/TPhpPrown/ViewGlobal.php";
// Подключаем модуль обеспечения тестов
require_once $TPhpPrown."/TPhpPrownTests/FunctionsBlock.php";
?>
<!DOCTYPE html>
<html>
<head>
<title>Кто прожил жизнь, тот больше не спешит!</title>
<meta charset="utf-8">
<link href="https://fonts.googleapis.com/css?family=Anonymous+Pro:400,400i,700,700i&amp;subset=cyrillic" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="Styles/Styles.css">

<link rel="stylesheet" type="text/css" 
   href="https://ajax.aspnetcdn.com/ajax/jquery.ui/1.10.3/themes/ui-lightness/jquery-ui.css">
<script
   src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.11.2.min.js">
</script>
<script 
   src="https://ajax.aspnetcdn.com/ajax/jquery.ui/1.11.2/jquery-ui.min.js">
</script>

</head>
<body>

<?php
// Определяем сайтовые константы
define ("ChooseAll",  "Выбрать все функции"); // Первая кнопка Submit  
define ("ToTest",     "Протестировать");      // Вторая кнопка Submit 

// Инициализируем список прикладных функций библиотеки TPhpPrown 
// и рабочего пространства сайта
$aPhpPrown=array
(            
   'iniWorkSpace'   =>'cформировать массив параметров рабочего пространства сайта',   
   'Findes'         =>'выбрать из строки подстроку, соответствующую регулярному выражению',   
   'isCalcInBrowser'=>'определить по родительским браузерам работает ли функция Calc для CSS',   
   'MakeType'       =>'преобразовать значение к заданному типу',
   'MakeUserError'  =>'cгенерировать ошибку/исключение или просто сформировать сообщение об ошибке',
);
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

function FunctionsCheckbox($aPhpPrown,$isCheck=ToTest)
{
   $Result = true;
   echo '<form action="'.htmlentities($_SERVER['PHP_SELF']).'" method="post">';
   echo '<p>Укажите функции TPhpPrown, которые следует протестировать?<br><br>';
   echo '<input type="submit" name="formSubmit" value="'.ChooseAll.'"/><br><br>';
   foreach($aPhpPrown as $k=>$v)
   {
      if ($isCheck==ChooseAll)
      {
         echo '<input type="checkbox" checked name="formDoor[]" value="'.$k.'"/>'.$k.' - '.$v.'<br>';
      }
      else
      {
         echo '<input type="checkbox" name="formDoor[]" value="'.$k.'"/>'.$k.' - '.$v.'<br>';
      }
   }
   echo '</p>';
   echo '<input type="submit" name="formSubmit" value="'.ToTest.'"/><br><br>';
   echo '</form>';
   return $Result;
}
// ---
//phpinfo();
//echo 'Работаю!<br>';
//echo $SiteRoot.'<br>';
//echo $SiteHost.' Работаю!<br>';
//echo $TPhpPrown.' Работаю!<br>';
//echo $UserAgent.' Работаю!<br>';
//prown\ViewGlobal(avgSERVER);
// ---

if (prown\isComRequest(ChooseAll,'formSubmit'))
{
   FunctionsCheckbox($aPhpPrown,ChooseAll);
}
else if (prown\isComRequest(ToTest,'formSubmit'))
{
   // Вырисовываем чекбоксы для тестирования
   FunctionsCheckbox($aPhpPrown,ToTest);
   // Запускаем тестирование
   MakeTest($SiteRoot,$aPhpPrown);
}
else
{
   // Вырисовываем чекбоксы 
   FunctionsCheckbox($aPhpPrown,ToTest);
}

?>
</body> 
</html>
<?php
// *************************************************************** Main.php ***
