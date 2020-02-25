<?php
// PHP7/HTML5, EDGE/CHROME                           *** FunctionsBlock.php ***

// ****************************************************************************
// * TPhpPrown-test                        Блок вспомогательных функций сайта *
// ****************************************************************************

//                                                   Автор:       Труфанов В.Е.
//                                                   Дата создания:  13.01.2019
// Copyright © 2019 tve                              Посл.изменение: 16.02.2020

// ****************************************************************************
// *             Проверить, выбран ли указанный элемент библиотеки            *
// ****************************************************************************
function IsChecked($chkname,$value)
{
   if(!empty($_POST[$chkname]))
   {
      foreach($_POST[$chkname] as $chkval)
      {
         if($chkval == $value)
         {
            return true;
         }
      }
   }
   return false;
}
// ****************************************************************************
// *                    Вывести список элементов библиотеки                   *
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
function FunctionsCheckbox($aElements,$isCheck=ToTest,
   $cMess='Укажите прототипы объектов в TJsTools, которые следует протестировать')
{
   $Result = true;
   echo '<form action="'.htmlentities($_SERVER['PHP_SELF']).'" method="post">';
   echo '<p>'.$cMess.'?<br><br>';
   echo '<input type="submit" name="formSubmit" value="'.ChooseAll.'"/><br><br>';
   foreach($aElements as $k=>$v)
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
// ****************************************************************************
// *      Проверить выбор флажков, указывающих на элементы списка, которые    *
// *                            следует протестировать                        *
// ****************************************************************************
// http://form.guide/php-form/php-form-checkbox.html
// http://dnzl.ru/view_post.php?id=182
function MakeTest($SiteRoot,$aPhpPrown,$lang='PHP')
{
   $SiteAbove=GetAbove($SiteRoot);       // Надсайтовый каталог
   $SiteHost=GetAbove($SiteAbove);       // Каталог хостинга
   if(isset($_POST['formSubmit'])) 
   {
      if(empty($_POST['formDoor']))
      {
         echo("<p>Элементы для тестирования Вами не выбраны!</p></body></html>");
      }
      else
      {
         $aDoor=$_POST['formDoor'];
         $N=count($aDoor);
         // Запускаем тестирование и трассировку выбранных элементов
         if ($lang=='PHP') require_once($SiteHost.'/TSimpleTest/autorun.php');
         foreach($aPhpPrown as $k=>$v)
         {
            //echo '<input type="checkbox" checked name="formDoor[]" value="'.$k.'"/>'.$k.' - '.$v.'<br>';
            if(IsChecked('formDoor',$k))
            {
               //echo $k.' тестируется.<br>';
               if ($lang=='PHP') 
               {
                  //echo $SiteHost."/TPhpPrown/TPhpPrownTests/".$k."_test.php";
                  require_once $SiteHost."/TPhpPrown/TPhpPrownTests/".$k."_test.php";
               }
               else if ($lang=='JS') 
               {
                  $scri='TJsTools/'.$k.'.js';
                  $scritest='TJsToolsTests/'.$k.'Test.js';
                  //echo '<br>'.$scri.'<br>'; echo $scritest.'<br>'; 
                  echo '<script src="'.$scri.'"></script>';
                  echo '<script src="'.$scritest.'"></script>'; 
                  //'<script src="TJsTools/Trim.js"></script>';
                  //echo '<script src="TJsToolsTests/TTrimTest.js"></script>'; 
                  //echo '<script src="TJsTools/Trim.js"></script>';
                  //echo '<script src="TJsToolsTests/TTrimTest.js"></script>'; 
                  //echo $SiteHost."/TPhpPrown/TPhpPrownTests/".$k."_test.php";
                  //require_once $SiteHost."/TPhpPrown/TPhpPrownTests/".$k."_test.php";
               }
            }
         }
         if ($lang=='PHP') 
         {
            require_once $SiteHost."/TPhpPrown/TPhpPrownTests/"."FinalMessage_test.php";
         }
      } 
   }
}
// ****************************************************************************
// *       Сформировать оболочку для тестирования JavaScript сценариев        *
// ****************************************************************************
function LeadTest()
{
?>
<!-- 
<h1 id="qunit-header">Заголовок страницы</h1>
<h2 id="qunit-banner"></h2>
<div id="qunit-testrunner-toolbar">Панель инструментов</div>
<h2 id="qunit-userAgent">UserAgent</h2>
<div id="qunit-fixture">Привет!</div>
<div id="qunit"></div>
<ol id="qunit-tests"></ol>

Делаем общий вывод прохождения тестов
в следующей последовательности: 
   а) заголовок страницы;
   б) разделитель (если он не был вызван ранее, в остальных случаях 
      без <div id="qunit"></div> тоже выводится один раз);    
   в) панель инструментов (если она не была вызвана отдельно);    
   г) UserAgent (если он не был вызван отдельно); 
   д) По клику на числе проверок в тесте, разворачивается список проверок 
   е) <div id="qunit-fixture"></div> - образец кода и разметки до тестов
<div id="qunit"></div>
-->
<h2 id="qunit-userAgent"></h2>
<h2 id="qunit-banner"></h2>
<ol id="qunit-tests"></ol>
<h2 id="qunit-userAgent"></h2>
<div id="qunit-fixture">Привет!</div>
<?php
}
/*
function mb_str_pad ($input,$pad_length,$pad_string,$pad_style,$encoding="UTF-8")
{
   return str_pad($input,strlen($input)-mb_strlen($input,$encoding)+$pad_length,$pad_string,$pad_style);
};
*/
function mb_str_padi($input, $pad_length, $pad_string = '-', $pad_type = STR_PAD_RIGHT)
{
	$diff = strlen($input) - mb_strlen($input);
	return str_pad($input, $pad_length + $diff, $pad_string, $pad_type);
}


// ****************************************************************************
// *        Вывести сообщение по завершении очередного теста/подтеста         *
// ****************************************************************************
function SimpleMessage($Name2=' ')
{
   echo 
      "<span style=\"color:#993300; font-weight:bold; ".
      "font-family:'Anonymous Pro', monospace; font-size:0.9em\">".
      $Name2."</span>".' <br>';
}
function MakeTestMessage($Name,$Name2='',$len=64)
{
   echo 
      "<span style=\"color:#993300; font-weight:bold; ".
      "font-family:'Anonymous Pro', monospace; font-size:0.9em\">".' '.
      mb_str_padi($Name,$len,'.').' '.
      "</span>";
   SimpleMessage($Name2);
}
// ****************************************************************************
// *         Вывести заголовок очередной тестируемой функции TPhpPrown        *
// ****************************************************************************
function MakeTitle($Name,$br="<br>")
{
   echo 
      "<span style=\"color:blue; font-weight:bold; font-size:1.1em\">".
      $br.$Name.
      "</span>"."<br>";
}
// ***************************************************** FunctionsBlock.php ***
