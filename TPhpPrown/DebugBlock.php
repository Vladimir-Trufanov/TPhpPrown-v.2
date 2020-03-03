<?php namespace prown;

// PHP7/HTML5, EDGE/CHROME                               *** DebugBlock.php ***

// ****************************************************************************
// * TPHPPROWN                             Блок отладочных функций библиотеки *
// ****************************************************************************

//                                                   Автор:       Труфанов В.Е.
//                                                   Дата создания:  01.11.2016
// Copyright © 2016 tve                              Посл.изменение: 02.03.2020

function ConsoleLog($String,$Parm=null) 
{
   // Формируем текст сообщения
   if ($Parm==null) $messa=$String;
   else $messa=$String.'='.$Parm;
   // Выводим сообщение
   ?>
   <script>
      var messa="<?php echo $messa; ?>";
      console.log(messa);
   </script>
   <?php
}
function Alert($String,$Parm=null)
{
   // Формируем текст сообщения
   if ($Parm==null) $messa=$String;
   else $messa=$String.'='.$Parm;
   // Выводим сообщение
   ?>
   <script>
      var messa="<?php echo $messa; ?>";
      alert(messa);
   </script>
   <?php
}
// ****************************************************************************
// *      Обеспечить вывод околонулевых значений в браузере: число и          *
// *                связанная с ним дополнительная подстрока                  *
// ****************************************************************************
function NoSpace($Value,$Ext)
{
   //echo "<br>".'$Value='.$Value.' $Ext='.$Ext."<br>";
   $Result=" ";
   if ($Value<0)
	{
      if ($Value<-0.0001) $Result="$Value"."$Ext"; 
   }
   if ($Value>0)
	{
      if ($Value>0.0001) $Result="$Value"."$Ext"; 
   }
   return $Result;
}
// ****************************************************************************
// *      Обеспечить вывод околонулевых значений в браузере: только число     *
// ****************************************************************************
function NoZero($Value)
{
   $Result=" ";
   if ($Value<0)
	{
      if ($Value<-0.0001) $Result=$Value; 
   }
   if ($Value>0)
	{
      if ($Value>0.0001) $Result=$Value; 
   }
   //echo "<br>".'in.NoZero'."<br>";
   return $Result;
}
// ********************************************************* DebugBlock.php ***

