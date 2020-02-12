<?php
// PHP7/HTML5, EDGE/CHROME                           *** FunctionsBlock.php ***

// ****************************************************************************
// * TPhpPrown-test                        Блок вспомогательных функций сайта *
// ****************************************************************************

//                                                   Автор:       Труфанов В.Е.
//                                                   Дата создания:  13.01.2019
// Copyright © 2019 tve                              Посл.изменение: 12.02.2020

// ****************************************************************************
// *             Проверить, выбрана ли указанная функция библиотеки           *
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
// *     Проверить выбор флажков, указывающих на функции TPhpPrown, которые   *
// *              следует протестировать и выполнить тестирование             *
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
         echo("<p>Функции для тестирования Вами не выбраны!</p>\n");
      }
      else
      {
         $aDoor=$_POST['formDoor'];
         $N=count($aDoor);
         // Запускаем тестирование и трассировку выбранных функций
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
            }
         }
         if ($lang=='PHP') 
         {
            require_once $SiteHost."/TPhpPrown/TPhpPrownTests/"."FinalMessage_test.php";
         }
      } 
   }
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
