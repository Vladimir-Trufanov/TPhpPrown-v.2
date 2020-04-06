<?php

// PHP7/HTML5, EDGE/CHROME                          *** MakeRegExp_test.php ***
// ****************************************************************************
// * TPhpPrown      Тест функции MakeRegExp - Отработать регулярное выражение *
// *                                       на тексте и оттрассировать разбор. *
// *                       Рекомендуется использовать только для трассировки. *
// *                                                                          *
// * v1.0, 06.04.2020                              Автор:       Труфанов В.Е. *
// * Copyright © 2019 tve                          Дата создания:  06.04.2020 *
// ****************************************************************************

class test_MakeRegExp extends UnitTestCase 
{
   // Здесь все должно хорошо найтись в своих позициях
   function test_MakeRegExp()
   {
      MakeTitle("MakeRegExp",'');
      $string='Это строка для проверки функции MakeRegExp';
      $preg='/Это/u';
      $prefix='MakeRegExp("'.$preg.'","'.$string.'"); ';
      $Result=prown\MakeRegExp($preg,$string,$matches);
      //$this->assertEqual('Это',$Result);
      //MakeTestMessage($prefix,'Подстрока '.'"Это"'.' найдена в строке',80);

      $string='Строкой этой проверяется функция MakeRegExp для поиска "это"';
      $preg='/это/u';
      $prefix='MakeRegExp("'.$preg.'","'.$string.'"); ';
      $Result=prown\MakeRegExp($preg,$string,$matches);
      //$this->assertEqual('это',$Result);
      //MakeTestMessage($prefix,'Подстрока '.'"Это"'.' найдена в строке',80);

      $string='Строкой этой проверяется функция MakeRegExp для поиска "это"';
      $preg='/эти/u';
      $prefix='MakeRegExp("'.$preg.'","'.$string.'"); ';
      $Result=prown\MakeRegExp($preg,$string,$matches);
      //$this->assertEqual('это',$Result);
      //MakeTestMessage($prefix,'Подстрока '.'"Это"'.' найдена в строке',80);
   }
}
// **************************************************** MakeRegExp_test.php ***
