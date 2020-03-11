<?php
// PHP7/HTML5, EDGE/CHROME                                     *** Main.php ***

// ****************************************************************************
// * TPhpPrown-test                   Кто прожил жизнь, тот больше не спешит! *
// ****************************************************************************

//                                                   Автор:       Труфанов В.Е.
//                                                   Дата создания:  13.01.2019
// Copyright © 2019 tve                              Посл.изменение: 10.03.2020

// Подключаем файлы библиотеки прикладных модулей и рабочего пространства
$TPhpPrown=$SiteHost.'/TPhpPrown';
require_once $TPhpPrown."/TPhpPrown/CommonPrown.php";
require_once $TPhpPrown."/TPhpPrown/DebugBlock.php";
require_once $TPhpPrown."/TPhpPrown/Findes.php";
require_once $TPhpPrown."/TPhpPrown/getTranslit.php";
require_once $TPhpPrown."/TPhpPrown/iniConstMem.php";
require_once $TPhpPrown."/TPhpPrown/isCalcInBrowser.php";
require_once $TPhpPrown."/TPhpPrown/MakeCookie.php";
require_once $TPhpPrown."/TPhpPrown/MakeSession.php";
require_once $TPhpPrown."/TPhpPrown/MakeType.php";
require_once $TPhpPrown."/TPhpPrown/ViewGlobal.php";
require_once $TPhpPrown."/TPhpPrown/ViewSimpleArray.php";
// Подключаем модуль обеспечения тестов
require_once $TPhpPrown."/TPhpPrownTests/FunctionsBlock.php";

// Инициализируем сессионную переменную для возможного теста MakeCookie
// и делаем подготовку текущего прохода этого теста
$s_CookTrack=prown\MakeSession('CookTrack',0,tInt,true);      
MakeCookieTest($s_CookTrack);
//prown\ViewGlobal(avgWORKSPACE,$_WORKSPACE);
echo('$s_CookTrack='.$s_CookTrack.'<br>');

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

<script>
   function isCheckClick() 
   {
      //var parentDOM=document.getElementById("myform");
      //var test=parentDOM.getElementsByName("formDoor[]");  //test is not target element
        //console.log(test);//HTMLCollection[1]
      var up_names = document.getElementsByName("formDoor[]");
      console.log(up_names.length); // displays "INPUT"
      
      for (let i = 0; i < up_names.length; i++) 
      {
         console.log(up_names[i].tagName);  
         //console.log(up_names[i].nodeName); 
         //console.log(up_names[i].innerHTML); 
         console.log(up_names[i].outerHTML); 
         console.log(up_names[i].value); 
      }
      
      var checked=[];
      var count=up_names.length;
      var i = 0;
      while (i<count) 
      {
         if (up_names[i].checked) 
         {
            checked.push(i);
         }
      }
      //console.log(checked); 
   }
   </script>
 





</head>
<body>
<div id="res"></div>
<a target="_blank" href="#"><img src="89.gif" ></a>

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
//echo 'PHP_VERSION_ID='.PHP_VERSION_ID.'<br>';
//echo 'PHP_VERSION='.PHP_VERSION.'<br>';
//echo $SiteRoot.'<br>';
//echo $SiteHost.'<br>';
//echo $TPhpPrown.'<br>';
//echo $UserAgent.'<br>';
// ---

// Выводим список прикладных функций библиотеки TPhpPrown и обрабатываем
// выбранные тесты

// Форма для тестирования предоставляет несколько вариантов выбора: 

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

// Представленные далее три ветки выбора являются заключительными для 
// создаваемой страницы: вторая ветка инициирует тестовую оболочку TSimpleTest, 
// которая всегда запускает тесты в завершении текущей страницы и заканчивает
// страницу тегами </body></html>.

// Поэтому теги </body></html> принудительно вставляются в первую и третью ветки,
// а также выводятся вместе с сообщением "Элементы для тестирования Вами не 
// выбраны!"

if (prown\isComRequest(ChooseAll,'formSubmit'))
{
   // Вырисовываем чекбоксы для тестирования
   FunctionsCheckbox($aPhpPrown,ChooseAll,ChoiceList);
   // Завершаем разметку, так как здесь теста не будет
   echo "\n</body>\n</html>\n";   
}
else if (prown\isComRequest(ToTest,'formSubmit'))
{
   // Вырисовываем чекбоксы для тестирования
   FunctionsCheckbox($aPhpPrown,ToTest,ChoiceList);
   // Запускаем тестирование (тестом будет и завершена разметка)
   MakeTest($SiteRoot,$aPhpPrown);
}
else
{
   // Вырисовываем чекбоксы 
   FunctionsCheckbox($aPhpPrown,ToTest,ChoiceList);
   // Завершаем разметку, так как здесь теста не будет
   echo "\n</body>\n</html>\n";   
}
 
// *************************************************************** Main.php ***
