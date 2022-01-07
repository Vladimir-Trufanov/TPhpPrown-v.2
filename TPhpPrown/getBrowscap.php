<?php namespace prown; 
                                         
// PHP7/HTML5, EDGE/CHROME                              *** getBrowscap.php ***

// ****************************************************************************
// *         Выбрать свойство текущего браузера по файлу browscap.ini         *
// ****************************************************************************

//                                                   Автор:       Труфанов В.Е.
//                                                   Дата создания:  06.01.2022
// Copyright © 2022 tve                              Посл.изменение: 07.01.2022

/**
 * 
 *
**/
$browser_getBrowscap=NULL;
function getBrowscap($ParmBrows)
{
   global $browser_getBrowscap;
   if ($browser_getBrowscap==NULL) 
   {
      //echo 'NULL<br>';
      $browser_getBrowscap = get_browser();
   }
   else
   {
      //echo 'Не-не-не NULL<br>';
   }
   $Result=_getBrowscap((array)$browser_getBrowscap,$ParmBrows);
   return $Result;
}
function _getBrowscap ($array,$ParmBrows) 
{
   $Result='';
   while (list($key,$value)=each($array)) 
   {                                 
      //echo '***'.$key.'='.$ParmBrows.'<br>';
      if ($key==$ParmBrows)
      {
         $Result=$value;
         break;   
      }
   }
   //echo '$Result='.$Result.'<br>';
   return $Result;
}

function listBrowscap()
{
   global $browser_getBrowscap;
   if ($browser_getBrowscap==NULL) $browser_getBrowscap = get_browser();
   return _listBrowscap((array)$browser_getBrowscap);
}
function _listBrowscap($array) 
{
   $str=$_SERVER['HTTP_USER_AGENT']."<hr>";
   while (list ($key, $value)=each($array)) 
   {
      // Пропускаем 2 информационно-управляющие строки
      if ($key=='browser_name_regex') $str.='';
      else if ($key=='browser_name_pattern') $str.='';
      else $str.="<b>$key:</b> $value\n";
   }
   return $str;
}

// ******************************************************** getBrowscap.php ***
