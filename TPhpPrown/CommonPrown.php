<?php namespace prown;

// PHP7/HTML5, EDGE/CHROME                              *** CommonPrown.php ***
// ****************************************************************************
// * TPhpPrown                     Блок общих функций для сайтов и библиотеки *
// *                                                                          *
// * v1.1, 04.02.2020                               Автор:      Труфанов В.Е. *
// * Copyright © 2018 tve                           Дата создания: 05.03.2018 *
// ****************************************************************************

// ****************************************************************************
// *                          Получить команду через параметр                 *
// ****************************************************************************
function getComRequest($Com='Com')
{
   $Result=NULL;
   if (IsSet($_REQUEST[$Com]))
   { 
      $Result=$_REQUEST[$Com];
   }
   return $Result;
}
// ****************************************************************************
// *    Проверить присутствует ли в запросе параметр с указанным значением    *
// *          (проверить передана ли данная команда через параметр)           *
// ****************************************************************************
function isComRequest($subs,$Com='Com')
{
   $Result=false;
   if (IsSet($_REQUEST[$Com]))
   { 
      if ($_REQUEST[$Com]==$subs) $Result=true;
   }
   return $Result;
}
// ******************************************************** CommonPrown.php *** 